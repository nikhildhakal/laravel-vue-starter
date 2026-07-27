<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateCategoryRequest extends BaseRequest
{
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $nullableFields = ['parent_id', 'description'];
        $normalized = [];

        foreach ($nullableFields as $field) {
            if ($this->input($field) === 'null') {
                $normalized[$field] = null;
            }
        }

        $normalized['slug'] = Str::slug((string) ($this->input('slug') ?: $this->input('name')));
        $this->merge($normalized);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        /** @var Category $category */
        $category = $this->route('category');

        return [
            'parent_id' => [
                'nullable',
                Rule::exists(Category::class, 'id'),
                Rule::notIn([$category->getKey()]),
            ],
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Category::class, 'slug')->ignore($category),
            ],
            'description' => ['nullable', 'string'],
            'image' => [
                'sometimes',
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'extensions:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'featured' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ];
    }

    /**
     * Get the post-validation callbacks for the request.
     *
     * @return array<callable>
     */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                if ($validator->errors()->has('parent_id') || ! $this->filled('parent_id')) {
                    return;
                }

                /** @var Category $category */
                $category = $this->route('category');
                $parent = Category::query()->find($this->integer('parent_id'));

                while ($parent !== null) {
                    if ($parent->is($category)) {
                        $validator->errors()->add('parent_id', trans('frontend.categories.validation.parent_cycle'));

                        return;
                    }

                    $parent = $parent->parent()->first();
                }
            },
        ];
    }
}
