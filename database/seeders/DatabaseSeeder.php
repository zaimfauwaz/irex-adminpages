<?php

namespace Database\Seeders;

use App\Models\FaqList;
use App\Models\KnowledgeBase;
use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        $this->runUserSeeder();
        $this->runExampleProduct();
        $this->runExampleFAQ();
    }

    public function runUserSeeder(): void{
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'iREX First Admin',
            'username' => 'irex_firstadmin',
            'email' => 'test@irex.net',
            'is_active' => true,
            'is_admin' => true,
        ]);
    }

    public function runExampleProduct(): void{

        // Create instance of the model

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
            'RSkuPrice'=> 100,
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
            'RQoh' => 100,
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
            'RSkuPrice' => 200,
            'RQoh' => 75,
            'RSkuType' => 'Stationaries',
            'RSkuAttributes' => [
                'RSkuInkName' => 'Assorted Colors',
                'RSkuAdditionalItems' => ['Refillable Ink', 'Storage Pouch'],
            ]
        ]);

        Product::create([
            'RSkuNo' => 'ST 188 33-5N',
            'RUom' => 'PKT',
            'RSkuName1' => 'A5 SPIRAL NOTEBOOK 80GSM X5PC',
            'RSkuName2' => '188 33-5N',
            'RSkuMoq' => 15,
            'RSkuPr' => 'OXFORD',
            'RSkuPrName' => 'OXFORD',
            'RSkuBrn' => 'OXFORD',
            'RSkuBrnName' => 'OXFORD',
            'RSkuPrice' => 250,
            'RQoh' => 60,
            'RSkuType' => 'Stationaries',
            'RSkuAttributes' => [
                'RSkuPaperType' => '80GSM',
                'RSkuAdditionalItems' => ['Sticky Notes', 'Bookmark'],
            ]
        ]);
    }

    public function runExampleFAQ(): void{

        // Create instance of the model

        FaqList::create([
            'faq_question'=>'How do I reset my password?',
            'faq_answer'=>'Go to the login page, click on \'Forgot Password\', and follow the instructions.',
            'faq_category'=>'Account',
            'faq_status'=> true,
            'faq_tags'=> ["reset", "forgot", "password", "recovery", "account"]
        ]);

        FaqList::create([
            'faq_question' => 'How do I update my email address?',
            'faq_answer' => 'Log in to your account, go to the \'Account Settings\' page, and update your email address under the \'Contact Information\' section.',
            'faq_category' => 'Account',
            'faq_status' => true,
            'faq_tags' => ["email", "update", "account", "settings", "contact"]
        ]);

        FaqList::create([
            'faq_question' => 'How do I contact customer support?',
            'faq_answer' => 'You can reach our customer support team by visiting the \'Contact Us\' page on our website or by emailing support@example.com.',
            'faq_category' => 'Support',
            'faq_status' => true,
            'faq_tags' => ["contact", "support", "help", "customer", "email"]
        ]);
    }
}
