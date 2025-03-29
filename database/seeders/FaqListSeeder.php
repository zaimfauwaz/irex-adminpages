<?php

namespace Database\Seeders;

use App\Models\FaqList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
