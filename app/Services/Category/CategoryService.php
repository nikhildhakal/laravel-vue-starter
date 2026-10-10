<?php

namespace App\Services\Category;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryService
{
    /**
     * Get a paginated category listing.
     *
     * @param  array<string, mixed>  $data
     */
    public function index(array $data): AnonymousResourceCollection
    {
        $query = Category::query()
            ->with(['media', 'parent:id,name'])
            ->withCount(['children', 'products']);

        $this->applySearch($query, $data['search'] ?? null);
        $this->applyFilters($query, $data['filters'] ?? []);

        if (! empty($data['sort_by']) && ! empty($data['sort'])) {
            $query->orderBy($data['sort_by'], strtolower($data['sort']));
        } else {
            $query->orderBy('sort_order')->orderBy('name');
        }

        return CategoryResource::collection($query->paginate($data['per_page'] ?? 10));
    }

    public function get(Category $category): CategoryResource
    {
        return new CategoryResource(
            $category->load(['media', 'parent:id,name'])->loadCount(['children', 'products'])
        );
    }

    /**
     * Create a category.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data, ?UploadedFile $image = null): Category
    {
        $category = Category::query()->create($data);

        if ($image !== null) {
            $category->addMedia($image)->toMediaCollection('image');
        }

        return $category->load('media');
    }

    /**
     * Update a category.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(
        Category $category,
        array $data,
        ?UploadedFile $image = null,
        bool $removeImage = false,
    ): bool
    {
        if (! $category->update($data)) {
            return false;
        }

        if ($removeImage) {
            $category->clearMediaCollection('image');
            $this->removeLegacyImage($category);
        } elseif ($image !== null) {
            $category->addMedia($image)->toMediaCollection('image');
            $this->removeLegacyImage($category);
        }

        return true;
    }

    public function delete(Category $category): bool
    {
        $legacyImagePath = $category->image;
        $deleted = (bool) $category->delete();

        if ($deleted && $legacyImagePath !== null && Str::startsWith($legacyImagePath, 'categories/')) {
            Storage::disk('public')->delete($legacyImagePath);
        }

        return $deleted;
    }

    /**
     * Get valid parent category options.
     *
     * @return Collection<int, array{id: int, title: string}>
     */
    public function parentOptions(?Category $category = null): Collection
    {
        $excludedIds = $category === null ? [] : $this->descendantIds($category);

        return Category::query()
            ->when($excludedIds !== [], fn (Builder $query) => $query->whereNotIn('id', $excludedIds))
            ->orderBy('name')
            ->get(['id', 'name'])
            ->map(fn (Category $option): array => [
                'id' => $option->id,
                'title' => $option->name,
            ]);
    }

    private function applySearch(Builder $query, ?string $search): void
    {
        if (blank($search)) {
            return;
        }

        $query->where(function (Builder $searchQuery) use ($search): void {
            $searchQuery
                ->where('name', 'like', '%'.$search.'%')
                ->orWhere('slug', 'like', '%'.$search.'%');
        });
    }

    /**
     * @param  array<string, string>  $filters
     */
    private function applyFilters(Builder $query, array $filters): void
    {
        foreach (['name', 'slug'] as $field) {
            $value = $this->filterValue($filters[$field] ?? null);

            if (filled($value)) {
                $query->where($field, 'like', '%'.$value.'%');
            }
        }

        foreach (['featured', 'is_active'] as $field) {
            $value = $this->filterValue($filters[$field] ?? null);

            if (in_array($value, ['0', '1'], true)) {
                $query->where($field, (bool) $value);
            }
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

    private function removeLegacyImage(Category $category): void
    {
        if ($category->image !== null && Str::startsWith($category->image, 'categories/')) {
            Storage::disk('public')->delete($category->image);
        }

        if ($category->image !== null) {
            $category->forceFill(['image' => null])->saveQuietly();
        }
    }

    /**
     * @return array<int, int>
     */
    private function descendantIds(Category $category): array
    {
        $excludedIds = [$category->getKey()];
        $parentIds = [$category->getKey()];

        while ($parentIds !== []) {
            $parentIds = Category::query()
                ->whereIn('parent_id', $parentIds)
                ->pluck('id')
                ->all();
            $excludedIds = [...$excludedIds, ...$parentIds];
        }

        return $excludedIds;
    }
}
