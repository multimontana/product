<?php

namespace App\Services;

use App\Repositories\CategoryRepository\CategoryRepository;
use Illuminate\Database\Eloquent\Model;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $data
     * @return Model|string
     */
    public function create(array $data)
    {
        return $this->categoryRepository
            ->create($data);
    }

    /**
     * @param array $data
     * @param int $categoryId
     * @return bool
     */
    public function update(array $data, int $categoryId): bool
    {
        return $this->categoryRepository
            ->update($data, $categoryId);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->categoryRepository
            ->delete($id);
    }

    /**
     * @param array $queryOptions
     * @return array
     */
    public function getCategories(array $queryOptions): array
    {
        $queryOptions['table'] = $this
            ->categoryRepository
            ->getTableName();

        return $this->categoryRepository
            ->get($queryOptions);
    }
}
