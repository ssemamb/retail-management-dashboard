<?php

namespace App\Models;

use App\Eums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'status',
        'category_id',
        'is_active'
    ];

    protected $casts = [
        'status' => ProductStatusEnum::class
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
