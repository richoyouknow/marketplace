<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'stock' => 'integer',
            'additional_price' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function isAvailable(): bool
    {
        return $this->is_active && $this->stock > 0;
    }

    public function getEffectivePriceAttribute(): int
    {
        $base = $this->product?->price ?? 0;

        return $base + $this->additional_price;
    }
}
