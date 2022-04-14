<?php

namespace App\Repositories\CategoryRepository;

use App\Models\Category;
use App\Repositories\AbstractRepository;

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

