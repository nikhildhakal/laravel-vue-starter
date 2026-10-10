<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyProductRequest;
use App\Http\Requests\IndexProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService) {}

    public function index(IndexProductRequest $request): AnonymousResourceCollection
    {
        $this->authorize('list', Product::class);

        return $this->productService
            ->index($request->validated())
            ->additional(['properties' => $this->properties()]);
    }

    public function create(): JsonResponse
    {
        $this->authorize('create', Product::class);

        return $this->responseDataSuccess(['properties' => $this->properties()]);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $this->authorize('create', Product::class);

        $product = $this->productService->create(
            $request->safe()->except(['gallery_order', 'gallery_uploads']),
            $request->validated('gallery_order', []),
            $request->file('gallery_uploads', []),
        );

        return $this->responseStoreSuccess(['record' => new ProductResource($product)]);
    }

    public function show(Product $product): JsonResponse
    {
        $this->authorize('view', $product);

        return $this->responseDataSuccess(['model' => $this->productService->get($product)]);
    }

    public function edit(Product $product): JsonResponse
    {
        $this->authorize('edit', $product);

        return $this->responseDataSuccess([
            'model' => $this->productService->get($product),
            'properties' => $this->properties(),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $this->authorize('edit', $product);

        if ($this->productService->update(
            $product,
            $request->safe()->except(['gallery_order', 'gallery_uploads']),
            $request->validated('gallery_order'),
            $request->file('gallery_uploads', []),
        )) {
            return $this->responseUpdateSuccess([
                'record' => $this->productService->get($product->fresh()),
            ]);
        }

        return $this->responseUpdateFail();
    }

    public function destroy(DestroyProductRequest $request, Product $product): JsonResponse
    {
        $this->authorize('delete', $product);

        return $this->productService->delete($product)
            ? $this->responseDeleteSuccess()
            : $this->responseDeleteFail();
    }

    /**
     * @return array{categories: Collection<int, array{id: int, title: string}>, size_units: Collection<int, array{id: string, title: string}>}
     */
    private function properties(): array
    {
        return [
            'categories' => Category::query()
                ->orderBy('name')
                ->get(['id', 'name'])
                ->map(fn (Category $category): array => [
                    'id' => $category->id,
                    'title' => $category->name,
                ]),
            'size_units' => collect(Product::SIZE_UNITS)
                ->map(fn (string $unit): array => ['id' => $unit, 'title' => $unit]),
        ];
    }
}
