<?php

namespace App\Services\MeiliSearch;

use MeiliSearch\Client;

class FaqSearchService {
    private $client;
    private $index;

    public function __construct() {
        $this->client = new Client(env('MEILISEARCH_HOST'), env('MEILISEARCH_KEY'));
        $this->index = $this->client->index('faqlists');
        (new FilterableIndexerService())->reindexAllFaqs();
    }

    public function searchFaqs(array $entities = []):array {
        $query = $entities['query'] ?? '';

        $searchOptions = [
            'filter' => ['faq_status = true']
        ];

        $results = $this->index->search($query, $searchOptions);
        $hits = $results->getHits();

        return $hits ?: [];
    }
}
