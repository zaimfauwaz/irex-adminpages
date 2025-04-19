<?php

namespace App\Services\OpenAI;

use OpenAI\Laravel\Facades\OpenAI;
use App\Services\MeiliSearch\CombinationSearchService as CombinationalSearch;

class MessageProcessorService {

    protected $combinationalSearch;
    public function __construct(CombinationalSearch $combinationalSearch) {
        $this->combinationalSearch = $combinationalSearch;
    }

    public function extractSearchKeywords(string $query, string $model = 'gpt-4o-mini'){
        $instruction = 'Extract the key search terms from the user query. Keep it short, 2-8 words max. No explanation needed. Extract relevant keywords from the search, exclude stopwords.';

        $response = OpenAI::chat()->create([
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => $instruction],
                ['role' => 'user', 'content' => $query],
            ],
            'temperature' => 0.2,
            'max_tokens' => 20,
        ]);

        return trim($response['choices'][0]['message']['content'] ?? '');
    }

    public function processMessageSearch(array $message): string {
        $text = $message['text'];
        $instruction = $message['instruction'];
        $model = $message['model'] ?? 'gpt-4o-mini';

        $searchKeywords = $this->extractSearchKeywords($text, $model);
        $searchResult = $this->combinationalSearch->searchCombined($searchKeywords);
        $formattedSearchResult = json_encode($searchResult, JSON_PRETTY_PRINT);

        $response = OpenAI::chat()->create([
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => $instruction],
                ['role' => 'user', 'content' => 'Based on following data:\n'.$formattedSearchResult.'\n\nUser asked: '.$text],
            ],
            'temperature' => 0.4,
            'max_tokens' => 1000,
        ]);

        return $response['choices'][0]['message']['content'] ?? 'No data is returned from database.';
    }
}
