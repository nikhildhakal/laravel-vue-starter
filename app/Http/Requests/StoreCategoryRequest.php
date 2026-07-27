<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends BaseRequest
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
        return [
            'parent_id' => ['nullable', Rule::exists(Category::class, 'id')],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique(Category::class, 'slug')],
            'description' => ['nullable', 'string'],
            'image' => [
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
}
