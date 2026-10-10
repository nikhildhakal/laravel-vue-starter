<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $media = $this->getFirstMedia('image');

        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'parent' => $this->whenLoaded('parent', fn (): ?array => $this->parent === null ? null : [
                'id' => $this->parent->id,
                'title' => $this->parent->name,
            ]),
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $media?->getUrl() ?: $this->legacyImageUrl(),
            'image_thumb' => $media?->getUrl('thumb') ?: $this->legacyImageUrl(),
            'featured' => $this->featured,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
            'children_count' => $this->whenCounted('children'),
            'products_count' => $this->whenCounted('products'),
            'created_at' => $this->created_at?->diffForHumans(),
            'updated_at' => $this->updated_at?->diffForHumans(),
        ];
    }

    private function legacyImageUrl(): ?string
    {
        if (blank($this->image)) {
            return null;
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        return Storage::disk('public')->url($this->image);
    }
}
