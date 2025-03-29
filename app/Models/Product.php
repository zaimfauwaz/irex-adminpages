<?php

namespace App\Models;

use App\Services\OpenAI\TaggerService;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'RSkuKey';


    protected $fillable = [
        'RSkuKey', 'RSkuNo', 'RUom', 'RSkuName1', 'RSkuName2', 'RSkuMoq', 'RSkuPr', 'RSkuPrName', 'RSkuBrn', 'RSkuBrnName',  'RSkuPrice', 'RQoh', 'RSkuType', 'RSkuAttributes', 'RSkuTags'
    ];

    protected $casts = [
        'RSkuKey' => 'string',
        'RSkuAttributes' => 'array',
        'RSkuTags' => 'array',
        'RSkuPrice' => 'float',
        'RSkuMoq' => 'integer',
        'RQoh' => 'integer',
    ];

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($product){
            $product->RSkuKey = self::generateRSkuKey();

            $product->RSkuTags = self::generateTags($product->RSkuName1, $product->RSkuBrnName, $product->RSkuType, $product->RUom, $product->RSkuAttributes);
        });

        static::updating(function ($product){
            if ($product->isDirty('RSkuName1') || $product->isDirty('RSkuBrnName') || $product->isDirty('RSkuType') || $product->isDirty('RUom') || $product->isDirty('RSkuAttributes')){
                $product->RSkuTags = self::generateTags($product->RSkuName1, $product->RSkuBrnName, $product->RSkuType, $product->RUom, $product->RSkuAttributes);
            }
        });
    }

    public static function generateRSkuKey()
    {
        $dateTime = now()->format('YmdHis');
        $randomDigits = self::generateRandomDigits(2); // Call to a new method

        return $dateTime . $randomDigits;
    }

    private static function generateRandomDigits($length)
    {
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9); // Generate a random digit between 0 and 9
        }

        return $result;
    }

    private static function generateTags($productname, $productbrand, $producttype, $productuom = null, $productattributes = null){
        $tagger = app(TaggerService::class);
        $tags = $tagger->generateProductTags($productname, $productbrand, $producttype, $productuom, $productattributes);

        return array_map(function ($tag) {
            return str_replace('\\', '', $tag);
        }, $tags ?? []);
    }
}
