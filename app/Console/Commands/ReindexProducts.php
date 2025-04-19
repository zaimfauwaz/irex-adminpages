<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Meilisearch\Client as MeiliSearchClient;
use Illuminate\Support\Facades\Log;

class ReindexProducts extends Command
{
    protected $signature = 'meili:reindex-products';
    protected $description = 'Reindex all products to Meilisearch';

    protected $client;

    public function __construct()
    {
        parent::__construct();
        $this->client = new MeiliSearchClient(env('MEILISEARCH_HOST'), env('MEILISEARCH_KEY'));
    }

    public function handle()
    {
        $this->info('Reindexing products...');

        try {
            // Drop and recreate index (optional: comment this if you just want to update)
            $this->client->deleteIndex('products');
            $this->client->createIndex('products', ['primaryKey' => 'RSkuKey']);

            $index = $this->client->index('products');

            $batchSize = 500;
            Product::chunk($batchSize, function ($products) use ($index) {
                $documents = $products->map(function ($product) {
                    return [
                        'RSkuKey' => $product->RSkuKey,
                        'RSkuNo' => $product->RSkuNo,
                        'RSkuName1' => $product->RSkuName1,
                        'RSkuPrName' => $product->RSkuPrName,
                        'RSkuBrnName' => $product->RSkuBrnName,
                        'RUom' => $product->RUom,
                        'RSkuMoq' => $product->RSkuMoq,
                        'RSkuPrice' => $product->RSkuPrice,
                        'RQoh' => $product->RQoh,
                        'RSkuType' => $product->RSkuType,
                        'RSkuAttributes' => $product->RSkuAttributes,
                        'RSkuTags' => $product->RSkuTags,
                        'RSkuImage1' => $product->RSkuImage1,
                        'RSkuImage2' => $product->RSkuImage2,
                        'RSkulink' => $product->RSkulink,
                    ];
                })->toArray();

                $index->addDocuments($documents);
                Log::info("Indexed batch of products: " . count($documents));
            });

            $this->info('Products reindexed successfully.');
            Log::info('✅ Products reindexed successfully to Meilisearch.');
        } catch (\Exception $e) {
            $this->error('Failed to reindex products: ' . $e->getMessage());
            Log::error('❌ Meilisearch reindex error: ' . $e->getMessage());
        }
    }
}
