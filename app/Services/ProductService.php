<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository\ProductRepository;

class ProductService extends Controller
{

    /**
     * @var ProductRepository
     */
    private ProductRepository $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): bool
    {
        $this->productRepository
            ->create($data)->categories()->sync($data['category_ids']);

        return true;
    }

    /**
     * @param array $data
     * @param int $productId
     * @return mixed
     */
    public function update(array $data, int $productId): bool
    {
        $this->productRepository
            ->update($data, $productId);
        $this->productRepository->getOneById($productId)->categories()->sync($data['category_ids']);

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->productRepository
            ->delete($id);
    }

    /**
     * @param array $queryOptions
     * @return array
     */
    public function getProducts(array $queryOptions): array
    {
        $queryOptions['table'] = $this
            ->productRepository
            ->getTableName();

        return $this->productRepository
            ->get($queryOptions);
    }
}
