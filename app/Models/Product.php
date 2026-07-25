<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
     use HasFactory;
 
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
 
    protected $casts = [
        'price'      => 'decimal:2',
        'sale_price' => 'decimal:2',
        'size_value' => 'decimal:2',
        'featured'   => 'boolean',
        'is_active'  => 'boolean',
    ];
 
    protected static function booted(): void
    {
        static::saving(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
 
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
 
    // e.g. "500 gm" or "1.5 kg"
    public function getSizeAttribute(): ?string
    {
        if (is_null($this->size_value) || is_null($this->size_unit)) {
            return null;
        }
 
        return rtrim(rtrim($this->size_value, '0'), '.') . ' ' . $this->size_unit;
    }
 
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
 
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
 
    public function scopeInStock($query)
    {
        return $query->where('quantity', '>', 0);
    }
}
