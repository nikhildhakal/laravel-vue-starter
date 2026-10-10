<?php

namespace App\Services\Product;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function index(array $data): AnonymousResourceCollection
    {
        $query = Product::query()->with(['category:id,name', 'media']);

        $this->applySearch($query, $data['search'] ?? null);
        $this->applyFilters($query, $data['filters'] ?? []);

        if (! empty($data['sort_by']) && ! empty($data['sort'])) {
            $query->orderBy($data['sort_by'], strtolower($data['sort']));
        } else {
            $query->latest();
        }

        return ProductResource::collection($query->paginate($data['per_page'] ?? 10));
    }

    public function get(Product $product): ProductResource
    {
        return new ProductResource($product->load(['category:id,name', 'media']));
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  array<int, string>  $galleryOrder
     * @param  array<int, UploadedFile>  $galleryUploads
     */
    public function create(array $data, array $galleryOrder = [], array $galleryUploads = []): Product
    {
        return DB::transaction(function () use ($data, $galleryOrder, $galleryUploads): Product {
            $product = Product::query()->create($data);
            $this->syncGallery($product, $galleryOrder, $galleryUploads);

            return $product->load(['category:id,name', 'media']);
        });
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  array<int, string>|null  $galleryOrder
     * @param  array<int, UploadedFile>  $galleryUploads
     */
    public function update(
        Product $product,
        array $data,
        ?array $galleryOrder = null,
        array $galleryUploads = [],
    ): bool {
        return DB::transaction(function () use ($product, $data, $galleryOrder, $galleryUploads): bool {
            if (! $product->update($data)) {
                return false;
            }

            if ($galleryOrder !== null) {
                $this->syncGallery($product, $galleryOrder, $galleryUploads);
            }

            return true;
        });
    }

    public function delete(Product $product): bool
    {
        $legacyImagePath = $product->image;
        $deleted = (bool) $product->delete();

        if ($deleted && $legacyImagePath !== null && Str::startsWith($legacyImagePath, 'products/')) {
            Storage::disk('public')->delete($legacyImagePath);
        }

        return $deleted;
    }

    private function applySearch(Builder $query, ?string $search): void
    {
        if (blank($search)) {
            return;
        }

        $query->where(function (Builder $searchQuery) use ($search): void {
            $searchQuery
                ->where('name', 'like', '%'.$search.'%')
                ->orWhere('slug', 'like', '%'.$search.'%')
                ->orWhere('sku', 'like', '%'.$search.'%');
        });
    }

    /**
     * @param  array<string, string>  $filters
     */
    private function applyFilters(Builder $query, array $filters): void
    {
        $categoryId = $this->filterValue($filters['category_id'] ?? null);

        if (ctype_digit((string) $categoryId)) {
            $query->where('category_id', (int) $categoryId);
        }

        foreach (['featured', 'is_active'] as $field) {
            $value = $this->filterValue($filters[$field] ?? null);

            if (in_array($value, ['0', '1'], true)) {
                $query->where($field, (bool) $value);
            }
        }

        $inStock = $this->filterValue($filters['in_stock'] ?? null);

        if ($inStock === '1') {
            $query->where('quantity', '>', 0);
        } elseif ($inStock === '0') {
            $query->where('quantity', 0);
        }
    }

    private function filterValue(?string $filter): ?string
    {
        if ($filter === null) {
            return null;
        }

        $parts = explode(';', $filter, 3);

        return count($parts) === 3 ? $parts[2] : null;
    }

    /**
     * @param  array<int, string>  $galleryOrder
     * @param  array<int, UploadedFile>  $galleryUploads
     */
    private function syncGallery(Product $product, array $galleryOrder, array $galleryUploads): void
    {
        $existingMedia = $product->getMedia('images')->keyBy('id');
        $uploadedMedia = [];

        foreach ($galleryUploads as $index => $upload) {
            $uploadedMedia[(int) $index] = $product->addMedia($upload)->toMediaCollection('images');
        }

        $orderedIds = collect($galleryOrder)->map(function (string $token) use ($existingMedia, $uploadedMedia): int {
            [$type, $identifier] = explode(':', $token, 2);

            return $type === 'media'
                ? (int) $existingMedia->get((int) $identifier)->id
                : (int) $uploadedMedia[(int) $identifier]->id;
        })->all();

        $existingMedia
            ->reject(fn (Media $media): bool => in_array($media->id, $orderedIds, true))
            ->each->delete();

        Media::setNewOrder($orderedIds);
        $this->removeLegacyImage($product);
        $product->unsetRelation('media');
    }

    private function removeLegacyImage(Product $product): void
    {
        if ($product->image !== null && Str::startsWith($product->image, 'products/')) {
            Storage::disk('public')->delete($product->image);
        }

        if ($product->image !== null) {
            $product->forceFill(['image' => null])->saveQuietly();
        }
    }
}
