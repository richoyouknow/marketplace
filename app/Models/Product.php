<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'original_price' => 'integer',
            'discount_percentage' => 'integer',
            'rating' => 'float',
            'review_count' => 'integer',
            'sold_count' => 'integer',
            'stock' => 'integer',
            'min_order' => 'integer',
            'gallery' => 'array',
            'specifications' => 'array',
            'tags' => 'array',
            'latitude' => 'float',
            'longitude' => 'float',
        ];
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->orderBy('id');
    }

    public function activeVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->where('is_active', true)->orderBy('id');
    }

    public function hasVariants(): bool
    {
        return $this->relationLoaded('variants')
            ? $this->variants->isNotEmpty()
            : $this->variants()->exists();
    }

    public function getTotalStockAttribute(): int
    {
        if ($this->hasVariants()) {
            return (int) ($this->relationLoaded('variants') ? $this->variants->sum('stock') : $this->variants()->sum('stock'));
        }

        return (int) $this->stock;
    }
}
