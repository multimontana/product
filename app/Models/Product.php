<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * продукт
 *
 * @property string $title  название
 * @property string|null $details    информация о продукте
 * @property string $description  описание
 * @property boolean|null $is_published  опубликован
 * @property integer $price цена
 *
 * @property ProductCategories $productCategories
 */
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'details', 'description', 'price'];

    public function categories()
    {
        return $this->belongsToMany(Category::class,'product_categories');
    }

}
