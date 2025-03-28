<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'RSkuKey';


    protected $fillable = [
        'RSkuKey', 'RSkuNo', 'RUom', 'RSkuName1', 'RSkuName2', 'RSkuMoq', 'RSkuPr', 'RSkuPrName', 'RSkuBrn', 'RSkuBrnName',  'RSkuPrice', 'RQoh', 'RSkuType', 'RSkuAttributes', 'RSkuTags'
    ];

    protected $casts = [
        'RSkuKey' => 'string',
        'RSkuAttributes' => 'json',
        'RSkuTags' => 'json',
        'RSkuPrice' => 'float',
        'RSkuMoq' => 'integer',
        'RQoh' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->RSkuKey = self::generateRSkuKey();
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
}
