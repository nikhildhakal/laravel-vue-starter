<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Bouncer;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_unauthenticated_users_cannot_list_products(): void
    {
        $this->getJson('/api/products')->assertUnauthorized();
    }

    public function test_users_without_product_abilities_are_forbidden(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->getJson('/api/products')->assertForbidden();
    }

    public function test_product_record_abilities_are_scoped_to_the_bound_product(): void
    {
        $user = User::factory()->create();
        $allowedProduct = Product::factory()->create();
        $otherProduct = Product::factory()->create();
        Bouncer::allow($user)->to('view', $allowedProduct);
        Sanctum::actingAs($user);

        $this->getJson("/api/products/{$allowedProduct->id}")->assertOk();
        $this->getJson("/api/products/{$otherProduct->id}")->assertForbidden();
    }

    public function test_admin_can_list_search_filter_and_sort_products(): void
    {
        $this->actingAsAdmin();
        $category = Category::factory()->create(['name' => 'Preserves']);
        Product::factory()->for($category)->create([
            'name' => 'Apple Jam',
            'slug' => 'apple-jam',
            'sku' => 'JAM-001',
            'price' => 12,
            'quantity' => 8,
            'is_active' => true,
        ]);
        Product::factory()->for($category)->create([
            'name' => 'Pear Jam',
            'slug' => 'pear-jam',
            'sku' => 'JAM-002',
            'price' => 15,
            'quantity' => 0,
            'is_active' => false,
        ]);

        $query = http_build_query([
            'search' => 'Jam',
            'sort_by' => 'price',
            'sort' => 'desc',
            'filters' => [
                'category_id' => 'category_id;=;'.$category->id,
                'in_stock' => 'in_stock;=;1',
                'is_active' => 'is_active;=;1',
            ],
        ]);

        $this->getJson('/api/products?'.$query)
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Apple Jam')
            ->assertJsonPath('data.0.category.title', 'Preserves')
            ->assertJsonPath('data.0.price', '12.00')
            ->assertJsonPath('data.0.in_stock', true)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'category', 'name', 'slug', 'sku', 'price', 'quantity', 'image', 'images'],
                ],
                'links',
                'meta',
            ]);
    }

    public function test_create_properties_include_inactive_categories_and_size_units(): void
    {
        $this->actingAsAdmin();
        $category = Category::factory()->create(['name' => 'Archived Category', 'is_active' => false]);

        $this->getJson('/api/products/create')
            ->assertOk()
            ->assertJsonFragment(['id' => $category->id, 'title' => 'Archived Category'])
            ->assertJsonFragment(['id' => 'kg', 'title' => 'kg']);
    }

    public function test_admin_can_create_a_product_with_an_ordered_gallery(): void
    {
        Storage::fake('public');
        $this->actingAsAdmin();
        $category = Category::factory()->create();

        $response = $this->post('/api/products', [
            ...$this->validProductData($category),
            'slug' => '',
            'gallery_order' => json_encode(['upload:1', 'upload:0']),
            'gallery_uploads' => [
                UploadedFile::fake()->image('front.jpg'),
                UploadedFile::fake()->image('back.png'),
            ],
        ], ['Accept' => 'application/json']);

        $response
            ->assertOk()
            ->assertJsonPath('record.slug', 'raw-honey')
            ->assertJsonPath('record.images.0.name', 'back')
            ->assertJsonPath('record.images.1.name', 'front');

        $product = Product::query()->where('slug', 'raw-honey')->firstOrFail();
        $this->assertCount(2, $product->getMedia('images'));

        foreach ($product->getMedia('images') as $media) {
            Storage::disk('public')->assertExists($media->getPathRelativeToRoot());
            Storage::disk('public')->assertExists($media->getPathRelativeToRoot('thumb'));
        }
    }

    public function test_product_validation_rejects_invalid_price_stock_size_and_gallery(): void
    {
        $this->actingAsAdmin();
        $category = Category::factory()->create();

        $this->postJson('/api/products', [
            ...$this->validProductData($category),
            'price' => 10,
            'sale_price' => 11,
            'quantity' => -1,
            'size_value' => 0,
            'size_unit' => 'box',
            'gallery_order' => ['upload:0'],
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['sale_price', 'quantity', 'size_value', 'size_unit', 'gallery_order']);
    }

    public function test_product_validation_rejects_duplicate_slug_sku_and_missing_category(): void
    {
        $this->actingAsAdmin();
        $category = Category::factory()->create();
        Product::factory()->for($category)->create(['slug' => 'raw-honey', 'sku' => 'HONEY-001']);

        $this->postJson('/api/products', [
            ...$this->validProductData($category),
            'category_id' => 999999,
            'slug' => 'raw-honey',
            'sku' => 'HONEY-001',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['category_id', 'slug', 'sku']);
    }

    public function test_updating_without_a_slug_preserves_it_and_blank_sku_becomes_null(): void
    {
        $this->actingAsAdmin();
        $category = Category::factory()->create();
        $product = Product::factory()->for($category)->create(['slug' => 'stable-product', 'sku' => 'OLD-SKU']);
        $payload = $this->validProductData($category);
        unset($payload['slug']);

        $this->patchJson("/api/products/{$product->id}", [
            ...$payload,
            'name' => 'Renamed Product',
            'sku' => '',
        ])
            ->assertOk()
            ->assertJsonPath('record.slug', 'stable-product')
            ->assertJsonPath('record.sku', null);

        $this->assertSame('stable-product', $product->fresh()->slug);
        $this->assertNull($product->fresh()->sku);
    }

    public function test_admin_can_reorder_replace_and_remove_gallery_images(): void
    {
        Storage::fake('public');
        $this->actingAsAdmin();
        $category = Category::factory()->create();
        $product = Product::factory()->for($category)->create();
        $first = $product->addMedia(UploadedFile::fake()->image('first.jpg'))->toMediaCollection('images');
        $second = $product->addMedia(UploadedFile::fake()->image('second.jpg'))->toMediaCollection('images');
        $firstPath = $first->getPathRelativeToRoot();

        $response = $this->post("/api/products/{$product->id}", [
            '_method' => 'PATCH',
            ...$this->validProductData($category),
            'slug' => $product->slug,
            'gallery_order' => json_encode(["media:{$second->id}", 'upload:0']),
            'gallery_uploads' => [UploadedFile::fake()->image('new-cover.png')],
        ], ['Accept' => 'application/json']);

        $response
            ->assertOk()
            ->assertJsonPath('record.images.0.id', $second->id)
            ->assertJsonPath('record.images.1.name', 'new-cover');

        $product->refresh();
        $this->assertCount(2, $product->getMedia('images'));
        $this->assertNull($product->getMedia('images')->firstWhere('id', $first->id));
        Storage::disk('public')->assertMissing($firstPath);
    }

    public function test_product_gallery_rejects_media_owned_by_another_product(): void
    {
        Storage::fake('public');
        $this->actingAsAdmin();
        $category = Category::factory()->create();
        $product = Product::factory()->for($category)->create();
        $otherProduct = Product::factory()->for($category)->create();
        $otherMedia = $otherProduct->addMedia(UploadedFile::fake()->image('other.jpg'))->toMediaCollection('images');

        $this->patchJson("/api/products/{$product->id}", [
            ...$this->validProductData($category),
            'slug' => $product->slug,
            'gallery_order' => ["media:{$otherMedia->id}"],
        ])->assertUnprocessable()->assertJsonValidationErrors('gallery_order');

        $this->assertTrue($otherProduct->fresh()->hasMedia('images'));
    }

    public function test_gallery_is_limited_to_five_images(): void
    {
        Storage::fake('public');
        $this->actingAsAdmin();
        $category = Category::factory()->create();
        $uploads = collect(range(0, 5))
            ->map(fn (int $index): UploadedFile => UploadedFile::fake()->image("image-{$index}.jpg"))
            ->all();

        $this->post('/api/products', [
            ...$this->validProductData($category),
            'gallery_order' => json_encode(collect(range(0, 5))->map(fn (int $index): string => "upload:{$index}")->all()),
            'gallery_uploads' => $uploads,
        ], ['Accept' => 'application/json'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['gallery_order', 'gallery_uploads']);
    }

    public function test_admin_can_delete_a_product_and_its_media(): void
    {
        Storage::fake('public');
        $this->actingAsAdmin();
        $product = Product::factory()->create();
        $media = $product->addMedia(UploadedFile::fake()->image('product.jpg'))->toMediaCollection('images');
        $path = $media->getPathRelativeToRoot();

        $this->deleteJson("/api/products/{$product->id}")->assertOk();

        $this->assertModelMissing($product);
        Storage::disk('public')->assertMissing($path);
    }

    /**
     * @return array<string, mixed>
     */
    private function validProductData(Category $category): array
    {
        return [
            'category_id' => $category->id,
            'name' => 'Raw Honey',
            'slug' => 'raw-honey',
            'sku' => 'HONEY-001',
            'description' => 'Small-batch local honey.',
            'price' => '15.00',
            'sale_price' => '12.50',
            'quantity' => 20,
            'size_value' => '500',
            'size_unit' => 'gm',
            'featured' => true,
            'is_active' => true,
        ];
    }

    private function actingAsAdmin(): User
    {
        $admin = User::factory()->create();
        Bouncer::allow($admin)->everything();
        Sanctum::actingAs($admin);

        return $admin;
    }
}
