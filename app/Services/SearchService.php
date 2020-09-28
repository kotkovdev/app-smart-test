<?php
declare(strict_types=1);

namespace App\Services;

use App\DTOs\ProductDto;
use App\Exceptions\ApiResponseException;
use Illuminate\Support\Facades\Http;

class SearchService
{
    const API_PATH = 'https://world.openfoodfacts.org/cgi/search.pl?action=process&sort_by=unique_scans_n&page_size=20&json=1';

    /**
     * Returns products.
     *
     * @param string $query
     *
     * @return array
     *
     * @throws \App\Exceptions\ApiResponseException
     */
    public function getProducts(string $query): array
    {
        $requestString = $this->buildRequestUri([
            'action' => 'process',
            'sort_by' => 'unique_scans_n',
            'page_size' => '20',
            'json' => 1,
        ]);
        $products = Http::get($requestString)->json()['products'];

        if (empty($products)) {
            throw new ApiResponseException('API not returned products');
        }

        $products = $this->assignProducts($products);

        return $products;
    }

    /**
     * Builds query.
     *
     * @param array $params
     *
     * @return string
     */
    private function buildRequestUri(array $params): string
    {
        return self::API_PATH . http_build_query($params);
    }

    /**
     * Assigns products to DTOs.
     *
     * @param array $products
     *
     * @return \App\DTOs\ProductDto[]
     */
    private function assignProducts(array $products): array
    {
        $productsDTOs = [];
        foreach ($products as $product) {
            $productsDTOs[] = new ProductDto($product);
        }

        return $productsDTOs;
    }
}
