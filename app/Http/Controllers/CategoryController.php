<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyCategoryRequest;
use App\Http\Requests\IndexCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(IndexCategoryRequest $request): AnonymousResourceCollection
    {
        $this->authorize('list', Category::class);

        return $this->categoryService->index($request->validated());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        $this->authorize('create', Category::class);

        return $this->responseDataSuccess(['properties' => $this->properties()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $this->authorize('create', Category::class);

        $category = $this->categoryService->create(
            $request->safe()->except('image'),
            $request->file('image'),
        );

        return $this->responseStoreSuccess(['record' => new CategoryResource($category)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): JsonResponse
    {
        $this->authorize('view', Category::class);

        return $this->responseDataSuccess(['model' => $this->categoryService->get($category)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): JsonResponse
    {
        $this->authorize('edit', Category::class);

        return $this->responseDataSuccess([
            'model' => $this->categoryService->get($category),
            'properties' => $this->properties($category),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $this->authorize('edit', Category::class);

        if ($this->categoryService->update(
            $category,
            $request->safe()->except('image'),
            $request->file('image'),
        )) {
            return $this->responseUpdateSuccess([
                'record' => $this->categoryService->get($category->fresh()),
            ]);
        }

        return $this->responseUpdateFail();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyCategoryRequest $request, Category $category): JsonResponse
    {
        $this->authorize('delete', Category::class);

        if ($category->products()->exists()) {
            return $this->responseFail(
                trans('frontend.categories.validation.has_products'),
                code: 422,
            );
        }

        if ($this->categoryService->delete($category)) {
            return $this->responseDeleteSuccess();
        }

        return $this->responseDeleteFail();
    }

    /**
     * Get category form properties.
     *
     * @return array{parents: Collection<int, array{id: int, title: string}>}
     */
    private function properties(?Category $category = null): array
    {
        return [
            'parents' => $this->categoryService->parentOptions($category),
        ];
    }
}
