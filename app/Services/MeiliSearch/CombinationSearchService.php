<?php

namespace App\Services\MeiliSearch;

use Meilisearch\Client as MeiliSearchClient;

class CombinationSearchService {

    protected $client;

    public function __construct() {
        $this->client = new MeiliSearchClient(env('MEILISEARCH_HOST'), env('MEILISEARCH_KEY'));
    }

    public function searchCombined($query) {
        $productsIndex = $this->client->index('products');
        $faqsIndex = $this->client->index('faqlists');

        $productsIndex->updateRankingRules(['words', 'typo', 'proximity', 'exactness', 'attribute']);
        $productsIndex->updateTypoTolerance(['enabled' => true,'minWordSizeForTypos' => ['oneTypo' => 3, 'twoTypos' => 5,],
            'disableOnWords' => [],
            'disableOnAttributes' => [],
        ]);
        $faqsIndex->updateRankingRules(['words', 'typo', 'proximity', 'exactness', 'attribute']);
        $faqsIndex->updateTypoTolerance(['enabled' => true,'minWordSizeForTypos' => ['oneTypo' => 3, 'twoTypos' => 5,],
            'disableOnWords' => [],
            'disableOnAttributes' => [],
        ]);
        $faqsIndex->updateSearchableAttributes(['faq_question', 'faq_answer', 'faq_tags']);

        $productsResults = $productsIndex->search($query)->getHits();
        $uniqueProducts = $this->removeDuplicates($productsResults, 'RSkuKey');
        $cleanedProducts = $this->removeZeroes($this->excludeResults($uniqueProducts, ['RSkuTags']), 'RSkuKey');


        $faqsResults = $faqsIndex->search($query)->getHits();
        $filteredFaqs = array_filter($faqsResults, function($faq) {return isset($faq['faq_status']) && $faq['faq_status'] === true;});
        $uniqueFaqs = $this->removeDuplicates($filteredFaqs, 'faq_question');
        $faqAnswers = array_map(function($faq) {return $faq['faq_answer'];}, $uniqueFaqs);

        return [
            'products' => $cleanedProducts,
            'faqs' => array_values($faqAnswers),
        ];
    }

    // Exclude unneeded column(s) from MeiliSearch
    public function excludeResults($results, $excludedFields) {
        return array_map(function($item) use ($excludedFields) {
            foreach ($excludedFields as $field) {
                unset($item[$field]);
            }
            return $item;
        }, $results);
    }

    // Exclude results with result value 0 - especially primary keys (due to indexing initialization)
    public function removeZeroes($results, $key) {
        return array_filter($results, function($item) use ($key) {
           return $item[$key] !== '0';
        });
    }

    // Remove redundant results returned by MeiliSearch
    private function removeDuplicates($results, $key) {
        $uniqueResults = [];
        $seenKeys = [];

        foreach ($results as $result) {
            if (!in_array($result[$key], $seenKeys)) {
                $seenKeys[] = $result[$key];
                $uniqueResults[] = $result;
            }
        }

        return $uniqueResults;
    }
}
