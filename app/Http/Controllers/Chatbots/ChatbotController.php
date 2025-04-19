<?php

namespace App\Http\Controllers\Chatbots;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Message;
use App\Services\OpenAI\IntroductionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OpenAI\Laravel\Facades\OpenAI;

class ChatbotController extends Controller
{
    private function generateBotReply(string $message):string{
        $conversationHistory = session('conversationHistory', []);
        $name = session('name');

        if (empty($conversationHistory)){

            $name = app(IntroductionService::class)->getUserInfo($message);
            session(['name'=>$name]);

            $onboard = app(IntroductionService::class)->sendOnboardingMessage($name);
            $conversationHistory[] = ['role'=>'assistant', 'content'=>$onboard];
        }

        $conversationHistory[] = ['role' => 'user', 'content' => $message];

        $response = OpenAI::chat()->create([
            'model'=>'gpt-4o-mini',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful customer support bot. You need to focus on personalizing customer\'s choices on products according to our database. And if user are asking general or FAQs, please answer it according to our database too. If escalation or tense occurs, connect to a human live agent. Reply politely and professionally, and inform the user if the inquiry is off topic.'],
                $conversationHistory
            ],
        ]);

        $botReply = $response->choices[0]->message->content ?? 'Apologies, I cannot respond to your inquiry.';
        $conversationHistory[] = ['role' => 'assistant', 'content' => $botReply];
        session(['conversationHistory' => $conversationHistory]);

        // This will include the intent section (will be in the services part)

        return $botReply;
    }

}
