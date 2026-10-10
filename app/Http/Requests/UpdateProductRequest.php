<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateProductRequest extends BaseRequest
{
    protected function prepareForValidation(): void
    {
        /** @var Product $product */
        $product = $this->route('product');
        $normalized = [];

        foreach (['sku', 'description', 'sale_price', 'size_value', 'size_unit'] as $field) {
            if (in_array($this->input($field), ['null', ''], true)) {
                $normalized[$field] = null;
            }
        }

        if (is_string($this->input('sku'))) {
            $normalized['sku'] = blank(trim((string) $this->input('sku')))
                ? null
                : trim((string) $this->input('sku'));
        }

        $normalized['slug'] = $this->filled('slug')
            ? Str::slug((string) $this->input('slug'))
            : $product->slug;
        if ($this->has('gallery_order')) {
            $normalized['gallery_order'] = $this->decodedGalleryOrder();
        }
        $this->merge($normalized);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        /** @var Product $product */
        $product = $this->route('product');

        return [
            'category_id' => ['required', Rule::exists(Category::class, 'id')],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique(Product::class, 'slug')->ignore($product)],
            'sku' => ['nullable', 'string', 'max:255', Rule::unique(Product::class, 'sku')->ignore($product)],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0', 'decimal:0,2'],
            'sale_price' => ['nullable', 'numeric', 'min:0', 'decimal:0,2', 'lte:price'],
            'quantity' => ['required', 'integer', 'min:0'],
            'size_value' => ['nullable', 'numeric', 'gt:0', 'required_with:size_unit'],
            'size_unit' => ['nullable', Rule::in(Product::SIZE_UNITS), 'required_with:size_value'],
            'featured' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
            'gallery_order' => ['sometimes', 'array', 'max:5'],
            'gallery_order.*' => ['required', 'string', 'distinct', 'regex:/^(media|upload):\d+$/'],
            'gallery_uploads' => ['sometimes', 'array', 'max:5'],
            'gallery_uploads.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'extensions:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ];
    }

    /**
     * @return array<callable>
     */
    public function after(): array
    {
        return [fn (Validator $validator): mixed => $this->validateGalleryTokens($validator)];
    }

    private function decodedGalleryOrder(): mixed
    {
        $order = $this->input('gallery_order');

        if (! is_string($order)) {
            return $order;
        }

        $decoded = json_decode($order, true);

        return json_last_error() === JSON_ERROR_NONE ? $decoded : $order;
    }

    private function validateGalleryTokens(Validator $validator): void
    {
        if ($validator->errors()->hasAny(['gallery_order', 'gallery_order.*', 'gallery_uploads', 'gallery_uploads.*'])) {
            return;
        }

        $order = $this->input('gallery_order');
        $uploads = $this->file('gallery_uploads', []);

        if ($order === null && $uploads === []) {
            return;
        }

        $tokens = collect(is_array($order) ? $order : []);
        $uploadIndexes = $tokens
            ->filter(fn (string $token): bool => Str::startsWith($token, 'upload:'))
            ->map(fn (string $token): int => (int) Str::after($token, 'upload:'))
            ->sort()->values()->all();
        $fileIndexes = collect(array_keys($uploads))
            ->map(fn (int|string $index): int => (int) $index)
            ->sort()->values()->all();

        if ($uploadIndexes !== $fileIndexes) {
            $validator->errors()->add('gallery_order', trans('frontend.products.validation.gallery_order'));
        }

        /** @var Product $product */
        $product = $this->route('product');
        $allowedMediaIds = $product->getMedia('images')->modelKeys();
        $submittedMediaIds = $tokens
            ->filter(fn (string $token): bool => Str::startsWith($token, 'media:'))
            ->map(fn (string $token): int => (int) Str::after($token, 'media:'));

        if (
            $submittedMediaIds->diff($allowedMediaIds)->isNotEmpty()
            || $submittedMediaIds->unique()->count() !== $submittedMediaIds->count()
        ) {
            $validator->errors()->add('gallery_order', trans('frontend.products.validation.gallery_order'));
        }
    }
}
