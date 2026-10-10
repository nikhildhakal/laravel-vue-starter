<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Bouncer;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CategoryCrudTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_unauthenticated_users_cannot_list_categories(): void
    {
        $this->getJson('/api/categories')->assertUnauthorized();
    }

    public function test_users_without_category_abilities_are_forbidden(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->getJson('/api/categories')->assertForbidden();
    }

    public function test_admin_can_list_filter_and_sort_categories(): void
    {
        $this->actingAsAdmin();

        Category::factory()->create([
            'name' => 'Active Category',
            'slug' => 'active-category',
            'is_active' => true,
        ]);
        Category::factory()->create([
            'name' => 'Inactive Category',
            'slug' => 'inactive-category',
            'is_active' => false,
        ]);

        $query = http_build_query([
            'sort_by' => 'name',
            'sort' => 'desc',
            'filters' => [
                'is_active' => 'is_active;=;1',
            ],
        ]);

        $this->getJson('/api/categories?'.$query)
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.name', 'Active Category')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'slug',
                        'parent',
                        'featured',
                        'is_active',
                        'sort_order',
                        'children_count',
                        'products_count',
                    ],
                ],
                'links',
                'meta',
            ]);
    }

    public function test_admin_can_create_a_category_with_a_generated_slug(): void
    {
        Storage::fake('public');
        $this->actingAsAdmin();
        $parent = Category::factory()->create();
        $image = UploadedFile::fake()->image('produce.jpg', 600, 400);

        $response = $this->post('/api/categories', [
            'parent_id' => $parent->id,
            'name' => 'Fresh Produce',
            'slug' => '',
            'description' => 'Seasonal produce',
            'image' => $image,
            'featured' => true,
            'is_active' => true,
            'sort_order' => 5,
        ], ['Accept' => 'application/json']);

        $response
            ->assertOk()
            ->assertJsonPath('record.name', 'Fresh Produce')
            ->assertJsonPath('record.slug', 'fresh-produce');

        $category = Category::query()->where('slug', 'fresh-produce')->firstOrFail();

        $media = $category->getFirstMedia('image');

        $this->assertNull($category->image);
        $this->assertNotNull($media);
        Storage::disk('public')->assertExists($media->getPathRelativeToRoot());
        Storage::disk('public')->assertExists($media->getPathRelativeToRoot('thumb'));
        $response->assertJsonPath('record.image', $media->getUrl());
        $response->assertJsonPath('record.image_thumb', $media->getUrl('thumb'));

        $this->assertDatabaseHas('categories', [
            'parent_id' => $parent->id,
            'name' => 'Fresh Produce',
            'slug' => 'fresh-produce',
            'featured' => true,
            'is_active' => true,
            'sort_order' => 5,
        ]);
    }

    public function test_category_validation_rejects_duplicate_slugs_and_invalid_values(): void
    {
        $this->actingAsAdmin();
        Category::factory()->create(['slug' => 'duplicate']);

        $this->postJson('/api/categories', [
            'name' => 'Duplicate',
            'slug' => 'duplicate',
            'featured' => 'not-a-boolean',
            'is_active' => true,
            'sort_order' => -1,
            'image' => 'not-a-url',
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['slug', 'featured', 'sort_order', 'image']);
    }

    public function test_admin_can_edit_and_update_a_category(): void
    {
        Storage::fake('public');
        $this->actingAsAdmin();
        $parent = Category::factory()->create(['name' => 'Parent']);
        $category = Category::factory()->create();
        $existingImagePath = UploadedFile::fake()->image('existing.jpg')->store('categories', 'public');
        $category->update(['image' => $existingImagePath]);

        $this->getJson("/api/categories/{$category->id}/edit")
            ->assertOk()
            ->assertJsonPath('model.id', $category->id)
            ->assertJsonFragment([
                'id' => $parent->id,
                'title' => 'Parent',
            ]);

        $this->patchJson("/api/categories/{$category->id}", [
            'parent_id' => $parent->id,
            'name' => 'Updated Category',
            'slug' => 'updated-category',
            'description' => null,
            'image' => null,
            'featured' => false,
            'is_active' => false,
            'sort_order' => 12,
        ])
            ->assertOk()
            ->assertJsonPath('record.name', 'Updated Category')
            ->assertJsonPath('record.is_active', false);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'parent_id' => $parent->id,
            'name' => 'Updated Category',
            'is_active' => false,
            'sort_order' => 12,
        ]);
        $this->assertSame($existingImagePath, $category->fresh()->image);
        Storage::disk('public')->assertExists($existingImagePath);
    }

    public function test_updating_a_category_image_replaces_the_previous_file(): void
    {
        Storage::fake('public');
        $this->actingAsAdmin();
        $category = Category::factory()->create();
        $oldImagePath = UploadedFile::fake()->image('old.jpg')->store('categories', 'public');
        $category->update(['image' => $oldImagePath]);

        $response = $this->post("/api/categories/{$category->id}", [
            '_method' => 'PATCH',
            'name' => $category->name,
            'slug' => $category->slug,
            'description' => $category->description,
            'image' => UploadedFile::fake()->image('new.png'),
            'featured' => $category->featured,
            'is_active' => $category->is_active,
            'sort_order' => $category->sort_order,
        ], ['Accept' => 'application/json']);

        $response->assertOk();

        $category->refresh();

        $media = $category->getFirstMedia('image');

        $this->assertNull($category->image);
        $this->assertNotNull($media);
        Storage::disk('public')->assertMissing($oldImagePath);
        Storage::disk('public')->assertExists($media->getPathRelativeToRoot());
        $response->assertJsonPath('record.image', $media->getUrl());
    }

    public function test_category_cannot_be_moved_below_its_descendant(): void
    {
        $this->actingAsAdmin();
        $root = Category::factory()->create();
        $child = Category::factory()->create(['parent_id' => $root->id]);
        $grandchild = Category::factory()->create(['parent_id' => $child->id]);

        $this->patchJson("/api/categories/{$root->id}", [
            'parent_id' => $grandchild->id,
            'name' => $root->name,
            'slug' => $root->slug,
            'description' => $root->description,
            'featured' => $root->featured,
            'is_active' => $root->is_active,
            'sort_order' => $root->sort_order,
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('parent_id');
    }

    public function test_admin_can_delete_an_empty_category(): void
    {
        Storage::fake('public');
        $this->actingAsAdmin();
        $category = Category::factory()->create();
        $imagePath = UploadedFile::fake()->image('category.jpg')->store('categories', 'public');
        $category->update(['image' => $imagePath]);

        $this->deleteJson("/api/categories/{$category->id}")->assertOk();

        $this->assertModelMissing($category);
        Storage::disk('public')->assertMissing($imagePath);
    }

    public function test_category_with_products_cannot_be_deleted(): void
    {
        $this->actingAsAdmin();
        $category = Category::factory()->create();
        Product::query()->create([
            'category_id' => $category->id,
            'name' => 'Protected Product',
            'slug' => 'protected-product',
            'price' => 10,
        ]);

        $this->deleteJson("/api/categories/{$category->id}")->assertUnprocessable();

        $this->assertModelExists($category);
    }

    public function test_category_with_children_cannot_be_deleted(): void
    {
        $this->actingAsAdmin();
        $category = Category::factory()->create();
        Category::factory()->create(['parent_id' => $category->id]);

        $this->deleteJson("/api/categories/{$category->id}")
            ->assertUnprocessable()
            ->assertJsonPath('message', trans('frontend.categories.validation.has_children'));

        $this->assertModelExists($category);
    }

    public function test_database_restricts_deleting_a_category_with_children(): void
    {
        $category = Category::factory()->create();
        Category::factory()->create(['parent_id' => $category->id]);

        $this->expectException(QueryException::class);

        $category->delete();
    }

    public function test_database_restricts_deleting_a_category_with_products(): void
    {
        $category = Category::factory()->create();
        Product::factory()->for($category)->create();

        $this->expectException(QueryException::class);

        $category->delete();
    }

    public function test_category_record_abilities_are_scoped_to_the_bound_category(): void
    {
        $user = User::factory()->create();
        $allowedCategory = Category::factory()->create();
        $otherCategory = Category::factory()->create();
        Bouncer::allow($user)->to('view', $allowedCategory);
        Sanctum::actingAs($user);

        $this->getJson("/api/categories/{$allowedCategory->id}")->assertOk();
        $this->getJson("/api/categories/{$otherCategory->id}")->assertForbidden();
    }

    public function test_updating_without_a_slug_preserves_the_existing_slug(): void
    {
        $this->actingAsAdmin();
        $category = Category::factory()->create(['slug' => 'stable-slug']);

        $this->patchJson("/api/categories/{$category->id}", [
            'name' => 'Renamed Category',
            'featured' => false,
            'is_active' => true,
            'sort_order' => 0,
        ])->assertOk()->assertJsonPath('record.slug', 'stable-slug');

        $this->assertSame('stable-slug', $category->fresh()->slug);
    }

    public function test_admin_can_remove_a_category_image(): void
    {
        Storage::fake('public');
        $this->actingAsAdmin();
        $category = Category::factory()->create();
        $category->addMedia(UploadedFile::fake()->image('category.jpg'))->toMediaCollection('image');
        $mediaPath = $category->getFirstMedia('image')->getPathRelativeToRoot();

        $this->patchJson("/api/categories/{$category->id}", [
            'name' => $category->name,
            'slug' => $category->slug,
            'featured' => $category->featured,
            'is_active' => $category->is_active,
            'sort_order' => $category->sort_order,
            'remove_image' => true,
        ])->assertOk()->assertJsonPath('record.image', null);

        $this->assertFalse($category->fresh()->hasMedia('image'));
        Storage::disk('public')->assertMissing($mediaPath);
    }

    public function test_category_image_cannot_be_replaced_and_removed_together(): void
    {
        Storage::fake('public');
        $this->actingAsAdmin();
        $category = Category::factory()->create();

        $this->post("/api/categories/{$category->id}", [
            '_method' => 'PATCH',
            'name' => $category->name,
            'slug' => $category->slug,
            'image' => UploadedFile::fake()->image('new.jpg'),
            'remove_image' => '1',
            'featured' => '0',
            'is_active' => '1',
            'sort_order' => '0',
        ], ['Accept' => 'application/json'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('image');
    }

    private function actingAsAdmin(): User
    {
        $admin = User::factory()->create();
        Bouncer::allow($admin)->everything();
        Sanctum::actingAs($admin);

        return $admin;
    }
}
