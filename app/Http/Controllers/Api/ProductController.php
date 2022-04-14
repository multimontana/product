<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function createAction(ProductRequest $request): JsonResponse
    {
        try {
            $requestData = [
                'title' => $request->get('title'),
                'details' => $request->get('details', ''),
                'description' => $request->get('description'),
                'is_published' => $request->get('is_published', 0),
                'price' => $request->get('price'),
                'category_ids' => $request->get('category_ids'),
            ];

            $data = $this->productService
                ->create($requestData);

            return response()
                ->json(['data' => $data], JsonResponse::HTTP_CREATED);
        } catch (Exception $err) {
            return response()
                ->json(['error' => 'Bad request'], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param ProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateAction(ProductRequest $request, int $id): JsonResponse
    {
        try {
            $requestData = [
                'title' => $request->get('title'),
                'details' => $request->get('details', ''),
                'description' => $request->get('description'),
                'is_published' => $request->get('is_published', 0),
                'price' => $request->get('price'),
                'category_ids' => $request->get('category_ids'),
            ];

            $data = $this->productService
                ->update($requestData, $id);

            return response()
                ->json(['data' => $data], JsonResponse::HTTP_OK);
        } catch (Exception $err) {
            return response()
                ->json(['error' => 'Bad request'], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function deleteAction(Request $request, int $id): JsonResponse
    {
        try {
            $data = $this->productService
                ->delete($id);

            return response()
                ->json(['data' => $data], JsonResponse::HTTP_OK);
        } catch (Exception $err) {
            return response()
                ->json(['error' => 'Bad request'], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getProductsAction(Request $request): JsonResponse
    {
        $queryOptions = $this->setQueries($request->query());

        $data = $this->productService
            ->getProducts($queryOptions);

        return response()
            ->json(['data' => $data], JsonResponse::HTTP_OK);
    }
}
