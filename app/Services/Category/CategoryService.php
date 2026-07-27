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
use RuntimeException;
use Throwable;

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
            ->with('parent:id,name')
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
            $category->load('parent:id,name')->loadCount(['children', 'products'])
        );
    }

    /**
     * Create a category.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data, ?UploadedFile $image = null): Category
    {
        $imagePath = $this->storeImage($image);

        try {
            return Category::query()->create([
                ...$data,
                'image' => $imagePath,
            ]);
        } catch (Throwable $exception) {
            $this->deleteManagedImage($imagePath);

            throw $exception;
        }
    }

    /**
     * Update a category.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Category $category, array $data, ?UploadedFile $image = null): bool
    {
        $previousImagePath = $category->image;
        $newImagePath = $this->storeImage($image);

        if ($newImagePath !== null) {
            $data['image'] = $newImagePath;
        }

        try {
            $updated = $category->update($data);
        } catch (Throwable $exception) {
            $this->deleteManagedImage($newImagePath);

            throw $exception;
        }

        if (! $updated) {
            $this->deleteManagedImage($newImagePath);

            return false;
        }

        if ($newImagePath !== null) {
            $this->deleteManagedImage($previousImagePath);
        }

        return true;
    }

    public function delete(Category $category): bool
    {
        $imagePath = $category->image;
        $deleted = (bool) $category->delete();

        if ($deleted) {
            $this->deleteManagedImage($imagePath);
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

    private function storeImage(?UploadedFile $image): ?string
    {
        if ($image === null) {
            return null;
        }

        $path = $image->store('categories', 'public');

        if (! is_string($path)) {
            throw new RuntimeException('The category image could not be stored.');
        }

        return $path;
    }

    private function deleteManagedImage(?string $path): void
    {
        if ($path !== null && Str::startsWith($path, 'categories/')) {
            Storage::disk('public')->delete($path);
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
