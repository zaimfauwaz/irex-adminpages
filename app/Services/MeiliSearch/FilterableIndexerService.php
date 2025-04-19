<?php

namespace App\Services\MeiliSearch;

use Illuminate\Support\Facades\Schema;
use Meilisearch\Client;
use App\Models\FaqList;
use App\Models\Product;

class FilterableIndexerService
{
    protected $client;
    public function __construct()
    {
        // Constructor logic
        $this->client = new Client(env('MEILISEARCH_HOST'), env('MEILISEARCH_KEY'));
    }

    public function setupFaqIndex(){
        $this->client->index('faqlists')->updateFilterableAttributes([
            'faq_category',
            'faq_status',
        ]);
    }

    public function setupProductIndex(){
        $this->client->index('products')->updateFilterableAttributes([
            'RSkuKey',
            'RUom',
            'RSkuMoq',
            'RSkuPrice',
            'RQoh',
            'RSkuType',
        ]);
    }

    public function getColumns($table): string {
        $columns = Schema::getColumnListing($table);
        return implode(",", $columns);
    }

    public function reindexAllFaqs(){
        FaqList::query()->searchable();
    }

    public function reindexAllProducts(){
        Product::query()->searchable();
    }

    public function reindexSingleFaq(FaqList $faq){
        if ($faq->faq_status) {
            $faq->searchable();
        } elseif ($faq->faq_category) {
            $faq->searchable();
        } else {
            $faq->unsearchable();
        }
    }

    public function reindexSingleProduct(Product $product){
        if ($product->RSkuKey) {
            $product->searchable();
        } elseif ($product->RUom) {
            $product->searchable();
        } elseif ($product->RSkuMoq) {
            $product->searchable();
        } elseif ($product->RSkuPrice) {
            $product->searchable();
        } elseif ($product->RQoh) {
            $product->searchable();
        } elseif ($product->RSkuType) {
            $product->searchable();
        } else {
            $product->unsearchable();
        }
    }
}
