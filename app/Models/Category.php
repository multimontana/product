<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * категория
 *
 * @property string $title  Название
 *
 * @property ProductCategories $productCategories
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    /**
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
}
