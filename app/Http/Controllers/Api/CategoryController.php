<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function createAction(CategoryRequest $request): JsonResponse
    {
        try {
            $requestData = [
                'title' => $request->get('title')
            ];

            $data = $this->categoryService
                ->create($requestData);

            return response()
                ->json(['data' => $data], JsonResponse::HTTP_CREATED);
        } catch (Exception $err) {
            return response()
                ->json(['error' => 'Bad request'], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param CategoryRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateAction(CategoryRequest $request, int $id): JsonResponse
    {
        try {
            $requestData = [
                'title' => $request->get('title'),
            ];

            $data = $this->categoryService
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
            $data = $this->categoryService
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
    public function getCategoriesAction(Request $request): JsonResponse
    {
        $queryOptions = $this->setQueries($request->query());

        $data = $this->categoryService
            ->getCategories($queryOptions);

        return response()
            ->json(['data' => $data], JsonResponse::HTTP_OK);
    }

}
