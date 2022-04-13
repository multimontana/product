<?php

namespace App\Repositories;


use App\Models\Category;

class CategoryRepository extends AbstractRepository
{
    /**
     * AdminCategoryRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Category();
    }
}

