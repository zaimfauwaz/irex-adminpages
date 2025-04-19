<?php

namespace App\Services\OpenAI;

use App\Models\Customer;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use OpenAI\Laravel\Facades\OpenAI;

class IntroductionService
{
    // After WABA Implementation, the arguments will be added
    public function getUserInfo(string $phone, string $message): string
    {
        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful customer support bot. Extract the person’s name only from this sentence. Please detect also if the name is appropriate for use, if not invalid, do not save the name. Reply ONLY with the proper name, nothing else.'],
                ['role' => 'user', 'content' => $message],
            ],
        ]);

        $name = $response->choices[0]->message->content;

        Customer::updateOrCreate(
            ['phone' => $phone],
            [
                'name' => $name,
                'country' => 'Malaysia',
                'total_sessions' => DB::raw('total_sessions+1'),
            ]);

        return $name;
    }

    public function sendOnboardingMessage(string $name): string
    {

        $onboardingText = "Hi $name! 👋 Welcome to our service. I'm your assistant. You can ask me anything, or to get started, you may ask for the following:\n ";
        $listOfActions = "1. Asking for product\r\n2. Frequently Asked Questions (FAQs)\r\n3. Contact Live Agent";

        Message::create([
            'sender' => $name,
            'message' => $onboardingText . $listOfActions,
            'is_bot' => true,
            'is_escalated' => false,
        ]);

        return $onboardingText . $listOfActions;
    }
}
