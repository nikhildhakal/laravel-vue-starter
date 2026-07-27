<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class IndexCategoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'search' => ['sometimes', 'nullable', 'string', 'max:255'],
            'sort_by' => [
                'sometimes',
                'nullable',
                Rule::in(['name', 'slug', 'sort_order', 'featured', 'is_active', 'created_at']),
            ],
            'sort' => ['sometimes', 'nullable', Rule::in(['asc', 'desc', 'ASC', 'DESC'])],
            'filters' => ['sometimes', 'array:name,slug,featured,is_active'],
            'filters.name' => ['sometimes', 'string', 'max:512'],
            'filters.slug' => ['sometimes', 'string', 'max:512'],
            'filters.featured' => ['sometimes', 'string', 'max:64'],
            'filters.is_active' => ['sometimes', 'string', 'max:64'],
        ];
    }
}
