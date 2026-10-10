<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class IndexProductRequest extends BaseRequest
{
    /**
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
                Rule::in(['name', 'sku', 'price', 'sale_price', 'quantity', 'featured', 'is_active', 'created_at']),
            ],
            'sort' => ['sometimes', 'nullable', Rule::in(['asc', 'desc', 'ASC', 'DESC'])],
            'filters' => ['sometimes', 'array:category_id,featured,is_active,in_stock'],
            'filters.category_id' => ['sometimes', 'string', 'max:64'],
            'filters.featured' => ['sometimes', 'string', 'max:64'],
            'filters.is_active' => ['sometimes', 'string', 'max:64'],
            'filters.in_stock' => ['sometimes', 'string', 'max:64'],
        ];
    }
}
