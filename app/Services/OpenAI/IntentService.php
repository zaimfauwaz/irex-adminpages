<?php

namespace App\Services\OpenAI;

use App\Services\MeiliSearch\FaqSearchService;
use App\Services\MeiliSearch\ProductSearchService;
use OpenAI\Laravel\Facades\OpenAI;
use App\Services\MeiliSearch\FilterableIndexerService;

class IntentService {
    private $productColumns;
    private $faqColumns;

    public function __construct() {
        $filterableIndexerService = new FilterableIndexerService();
        $this->productColumns = $filterableIndexerService->getColumns('products');
    }

    public function handleIntent( string $message): string {
        $intentData = $this->detectIntent($message);
        return $this->executeIntent($intentData);
    }

    private function detectIntent(string $message): array {
        $response = OpenAI::chat()->create([
           'model' => 'gpt-4o-mini',
           'messages' => [
               ['role' => 'system', 'content' => "You are an intent classifier that can determine whether the message is related to 'product' or 'faq'. Specify directly in one word, no sentences."],
               ['role' => 'user', 'content' => $message],
           ],
        ]);

        $content = $response->choices[0]->message->content;

        $intent = trim(strtolower($content));
        if ($intent === "product") {
            return $this->productIntent($message);
        } elseif ($intent === "faq") {
            return $this->faqIntent($message);
        }

        return ['intent' => 'unknown', 'query' => null];
    }

    private function productIntent(string $message): array {

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "You are an intent classifier for product... Respond in JSON like this example:
                    {
                      \"intent\": \"product\",
                      \"query\": \"search term here\",
                      \"filters\": [\"column = value\", \"RSkuPrice < 500\"],
                      \"sub_intent\": \"get_image\" or \"get_url\" (optional - only if user request its image or URL)
                    }
                    Make sure the filters are mapped according to the column names logically: ". $this->productColumns
                ],
                ['role' => 'user', 'content' => $message],
            ],
            'temperature' => 0.7,
            'top_p' => 0.9,
            'frequency_penalty' => 0.5,
            'presence_penalty' => 0.5
        ]);

        return $this->decodeResponse($response);
    }

    private function faqIntent(string $message): array {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "You are an intent classifier for FAQ... Respond in JSON like this example:
                    {
                        \"intent\": \"faq\",
                        \"query\": \"search term here\",
                    }
                    "
                ],
                ['role' => 'user', 'content' => $message],
            ],
            'temperature' => 0.3,
            'top_p' => 0.85,
            'max_tokens' => 150,
            'frequency_penalty' => 0.5,
            'presence_penalty' => 0.5
        ]);

        return $this->decodeResponse($response);
    }

    private function decodeResponse($response): array {
        try {
            $content = $response->choices[0]->message->content;
            $json = json_decode($content, true);
            return is_array($json) ? $json : ['intent' => 'unknown', 'entities' => []];
        } catch (\Exception $e) {
            return ['intent' => 'unknown', 'entities' => []];
        }
    }

    private function executeIntent(array $intentData): string {
        $intent = $intentData['intent'] ?? 'unknown';
        $entities = $intentData['entities'] ?? [];

        return match ($intent) {
            'product' => json_encode((new ProductSearchService())->searchProducts($entities)),
            'faq' => json_encode((new FaqSearchService())->searchFaqs($entities)),
            'liveagent' => 'Sure, we are connecting you to one of our live agents. Thank you for your patience!',
            default => "I'm here to help, but I couldn't quite understand your request. Could you rephrase it, please?",
        };
    }
}
