<?php

namespace App\Services\MeiliSearch;

use MeiliSearch\Client;
use Random\RandomException;

class ProductSearchService {
    private $domain;
    private $site;
    private $imgs;
    private $client;
    private $index;

    public function __construct() {
        $this->domain = env('SKU_DOMAIN');
        $this->site = env('SKU_ARGS_1');
        $this->imgs = env('SKU_ARGS_2');
        $this->client = new Client(env('MEILISEARCH_HOST'), env('MEILISEARCH_KEY'));
        $this->index = $this->client->index('products');
        (new FilterableIndexerService())->reindexAllProducts();
    }

    public function searchProducts(array $entities): string {
        $subIntent = $entities['sub_intent'] ?? null;
        $query = $entities['query'] ?? '';
        $filters = $entities['filters'] ?? [];

        $result = $this->performSearch($query, $filters);
        $sku = $this->extractSku($result);

        // Get URL based on SKU
        if ($subIntent === 'get_url' && $sku) {
            return $this->makeSkuUrl($query);
        }

        // Get image based on SKU
        if ($subIntent === 'get_image' && $sku) {
            return $this->makeSkuImage($query);
        }

        return json_encode($result);
    }


    private function performSearch(string $query, array $filters = []): array {
        $searchOptions = [];

        if (!empty($filters)) {
            // Ensure the filters are passed directly as an array of strings
            $searchOptions['filter'] = $filters;
        }

        $results = $this->index->search($query, $searchOptions);
        return $results->getHits() ?? [];
    }


    private function extractSku(array $results): ?string {
        foreach ($results as $hit) {
            if (isset($hit['RSkuKey'])) {
                return $hit['RSkuKey'];
            }
        }
        return null;
    }

    private function makeSkuUrl(string $sku): string {
        return $sku ? "Here is the SKU access link: $this->domain . $this->site . $sku" : "Please provide a valid SKU name.";
    }

    /**
     * @throws RandomException
     */
    private function makeSkuImage(string $sku): string {
        return $sku ? "Here is the product image: " . $this->domain . $this->imgs . $sku . "-SKU" . random_int(1, 2) . ".jpg" : "Please provide a valid SKU name.";
    }
}
