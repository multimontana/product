<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * продукт
 *
 * @property string $title  название
 * @property string|null $details    информация о продукте
 * @property string $description  описание
 * @property bool|null $is_published  опубликован
 * @property int $price цена
 *
 * @property ProductCategories $productCategories
 */
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'details', 'description', 'price'];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

}
