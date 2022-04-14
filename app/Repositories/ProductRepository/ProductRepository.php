<?php

namespace App\Repositories\ProductRepository;

use App\Models\Product;
use App\Repositories\AbstractRepository;

class ProductRepository extends AbstractRepository
{
    /**
     * ProductRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Product();
    }
}
