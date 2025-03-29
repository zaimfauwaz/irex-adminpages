<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'RSkuNo'=>'ST 132 46-2B',
            'RUom'=>'PKT',
            'RSkuName1'=> 'PENCIL NORICA 2B ERAS.TIP FSC 100% X12PC',
            'RSkuName2'=> '132 46-2B',
            'RSkuMoq'=> 24,
            'RSkuPr'=> 'STAEDTLE',
            'RSkuPrName'=> 'STAEDTLE',
            'RSkuBrn'=> 'STAEDTLER',
            'RSkuBrnName'=> 'STAEDTLER',
            'RSkuPrice'=> 50,
            'RQoh'=> 0,
            'RSkuType'=> 'Stationaries',
            'RSkuAttributes'=> [
                'RSkuInkName'=>'Blue',
                'RSkuAdditionalItems'=> ['Extra Sharpener', 'Extra Ruler'],
            ]
        ]);

        Product::create([
            'RSkuNo' => 'ST 145 78-1H',
            'RUom' => 'BOX',
            'RSkuName1' => 'HIGH QUALITY BALLPOINT PEN 1.0MM BLUE X20PC',
            'RSkuName2' => '145 78-1H',
            'RSkuMoq' => 12,
            'RSkuPr' => 'PILOT',
            'RSkuPrName' => 'PILOT',
            'RSkuBrn' => 'PILOT',
            'RSkuBrnName' => 'PILOT',
            'RSkuPrice' => 150,
            'RQoh' => 50,
            'RSkuType' => 'Stationaries',
            'RSkuAttributes' => [
                'RSkuInkName' => 'Blue',
                'RSkuAdditionalItems' => ['Refill Ink Cartridges', 'Pen Stand'],
            ]
        ]);

        Product::create([
            'RSkuNo' => 'ST 160 99-3C',
            'RUom' => 'PCS',
            'RSkuName1' => 'PREMIUM GEL PEN 0.7MM BLACK X10PC',
            'RSkuName2' => '160 99-3C',
            'RSkuMoq' => 30,
            'RSkuPr' => 'UNI-BALL',
            'RSkuPrName' => 'UNI-BALL',
            'RSkuBrn' => 'UNI-BALL',
            'RSkuBrnName' => 'UNI-BALL',
            'RSkuPrice' => 120,
            'RQoh' => 12,
            'RSkuType' => 'Stationaries',
            'RSkuAttributes' => [
                'RSkuInkName' => 'Black',
                'RSkuAdditionalItems' => ['Gel Refills', 'Pen Case'],
            ]
        ]);

        Product::create([
            'RSkuNo' => 'ST 175 22-4Y',
            'RUom' => 'SET',
            'RSkuName1' => 'DUAL-TIP HIGHLIGHTER SET X6PC',
            'RSkuName2' => '175 22-4Y',
            'RSkuMoq' => 20,
            'RSkuPr' => 'ZEBRA',
            'RSkuPrName' => 'ZEBRA',
            'RSkuBrn' => 'ZEBRA',
            'RSkuBrnName' => 'ZEBRA',
            'RSkuPrice' => 30,
            'RQoh' => 75,
            'RSkuType' => 'Stationaries',
            'RSkuAttributes' => [
                'RSkuInkName' => 'Assorted Colors',
                'RSkuAdditionalItems' => ['Refillable Ink', 'Storage Pouch'],
            ]
        ]);
    }
}
