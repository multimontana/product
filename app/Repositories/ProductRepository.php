<?php

namespace App\Repositories;

use App\Models\Product;

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
