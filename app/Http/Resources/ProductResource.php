<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $images = $this->getMedia('images');
        $cover = $images->first();
        $legacyImageUrl = $this->legacyImageUrl();

        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'category' => $this->whenLoaded('category', fn (): ?array => $this->category === null ? null : [
                'id' => $this->category->id,
                'title' => $this->category->name,
            ]),
            'name' => $this->name,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'description' => $this->description,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'quantity' => $this->quantity,
            'size_value' => $this->size_value,
            'size_unit' => $this->size_unit,
            'size' => $this->size,
            'featured' => $this->featured,
            'is_active' => $this->is_active,
            'in_stock' => $this->quantity > 0,
            'image' => $cover?->getUrl() ?: $legacyImageUrl,
            'image_thumb' => $cover?->getUrl('thumb') ?: $legacyImageUrl,
            'images' => $images
                ->values()
                ->map(fn (Media $media, int $index): array => [
                    'id' => $media->id,
                    'url' => $media->getUrl(),
                    'thumb_url' => $media->getUrl('thumb'),
                    'name' => $media->name,
                    'order' => $index + 1,
                ]),
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
