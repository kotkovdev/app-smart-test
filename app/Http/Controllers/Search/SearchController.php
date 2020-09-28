<?php
declare(strict_types=1);

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Services\SearchService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @var \App\Services\SearchService
     */
    private SearchService $searchService;

    /**
     * @var \Illuminate\Contracts\Routing\ResponseFactory
     */
    private ResponseFactory $responseFactory;

    /**
     * SearchController constructor.
     *
     * @param \App\Services\SearchService $searchService
     *
     * @param \Illuminate\Contracts\Routing\ResponseFactory $responseFactory
     */
    public function __construct(SearchService $searchService, ResponseFactory $responseFactory)
    {
        $this->searchService = $searchService;
        $this->responseFactory = $responseFactory;
    }

    /**
     * Finds products by request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \App\Exceptions\ApiResponseException
     */
    public function search(Request $request): JsonResponse
    {
        $products = $this->searchService->getProducts($request->get('query'));

        return $this->responseFactory->json(['products' => $products]);
    }
}
