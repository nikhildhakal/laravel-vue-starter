<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const SIZE_UNITS = ['mg', 'gm', 'kg', 'ml', 'l', 'cm', 'm', 'pcs'];

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'description',
        'image',
        'price',
        'sale_price',
        'quantity',
        'size_value',
        'size_unit',
        'featured',
        'is_active',
    ];
 
    protected $attributes = [
        'quantity' => 0,
        'featured' => false,
        'is_active' => true,
    ];

    protected static function booted(): void
    {
        static::creating(function (Product $product): void {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'sale_price' => 'decimal:2',
            'quantity' => 'integer',
            'size_value' => 'decimal:2',
            'featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getSizeAttribute(): ?string
    {
        if ($this->size_value === null || $this->size_unit === null) {
            return null;
        }

        return rtrim(rtrim((string) $this->size_value, '0'), '.').' '.$this->size_unit;
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('quantity', '>', 0);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->useDisk('public')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Crop, 300, 300)
            ->performOnCollections('images')
            ->nonQueued();
    }
}
