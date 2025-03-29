<?php

namespace App\Services\OpenAI;

use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;

class TaggerService
{

    public function generateFaqTags(string $faq_question, string $faq_answer): array
    {
        $response = OpenAI::chat()->create([
            'model'=>'gpt-4o-mini',
            'messages'=>[
                ['role'=>'system', 'content'=>"Properly read the given input. Then generate a comma-separated list of ONE-WORD tags, according to customer's frequent mentioned keyword (include synonyms)."],
                ['role'=>'user','content'=> "Q: {$faq_question} A: {$faq_answer}"],],
            'max_tokens'=>150,
            'temperature'=>0.2
        ]);

        $tags = explode(',', $response->choices[0]->message->content);

        return array_filter(array_map('trim', $tags), function ($tag) {
            return !empty($tag);
        });
    }

    public function generateProductTags(string $product_name, string $product_brand, string $product_type, ?string $product_uom = null, $product_attributes = null):array
    {
        $attributes = is_string($product_attributes) ? json_decode($product_attributes, true) : $product_attributes;
        $attributes = is_array($attributes) ? $attributes : [];
        Log::info('Product Attributes:', [$attributes]);

        $promptParts = [
            "Name: $product_name",
            "Brand: $product_brand",
            "Type: $product_type",
        ];

        if ($product_uom) {
            $promptParts[] = "Unit of Measurement: $product_uom";
        }

        if (!empty($attributes)) {
            $attributesString = implode(', ', array_map(
                function ($key, $value) {
                    if (is_array($value) || is_object($value)) {
                        $value = is_array($value) ? implode(', ', array_map('strval', $value)) : json_encode($value);
                    }
                    return "$key: $value";
                },
                array_keys($attributes),
                $attributes
            ));
            $promptParts[] = "Attributes: $attributesString";
        }

        $prompt = implode(', ', $promptParts);

        $response = OpenAI::chat()->create([
            'model'=>'gpt-4o-mini',
            'messages'=>[
                ['role'=>'system', 'content'=>"Properly generate a list of relevant ONE-WORD tags (with synonymous adjectives or nouns included) according to the given product by its name, type, and attributes., in comma-separated list."],
                ['role'=>'user','content'=>$prompt],

            ],
            'max_tokens'=>150,
            'temperature'=>0.2
        ]);

        $tags = explode(',', $response->choices[0]->message->content);
        return array_filter(array_map('trim', $tags), function ($tag) {
            return !empty($tag);
        });
    }

}
