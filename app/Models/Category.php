<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'image',
        'featured',
        'is_active',
        'sort_order',
    ];
 
    protected $casts = [
        'featured'  => 'boolean',
        'is_active' => 'boolean',
    ];
 
    protected static function booted(): void
    {
        static::saving(function (Category $category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
 
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
 
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
 
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
 
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
 
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
