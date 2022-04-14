<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * продукт категория
 *
 * @property int product_id
 * @property int category_id
 *
 */
class ProductCategories extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'category_id'];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
