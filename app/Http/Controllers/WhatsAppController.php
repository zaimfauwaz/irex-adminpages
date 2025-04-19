<?php

namespace App\Http\Controllers;

use App\Services\OpenAI\IntroductionService;
use App\Services\Twilio\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Twilio\Exceptions\TwilioException;

class WhatsAppController extends Controller
{
    protected TwilioService $twilio;

    public function __construct(TwilioService $twilio)
    {
        $this->twilio = $twilio;
    }

    /**
     * Send a test message via WhatsApp (manual trigger)
     * @throws TwilioException
     */
    public function sendWhatsAppMessage()
    {
        $to = '+60162510042';
        $message = 'Trying to send attachment using locally uploaded file.';

        $result = $this->twilio->sendWhatsAppMessage($to, $message);

        Log::info('WhatsApp test message sent', [
            'sid' => $result->sid,
            'status' => $result->status,
            'to' => $result->to,
            'from' => $result->from,
        ]);

        return 'Test WhatsApp message sent!';
    }

    /**
     * Inbound webhook from Twilio (user sends message)
     */
    public function webhookIn(Request $request)
    {
        $phone = $request->input('From');
        $body = $request->input('Body');
        $sid = $request->input('MessageSid');

        Log::info('Inbound WhatsApp message', compact('phone', 'body', 'sid'));

        $userName = (new IntroductionService())->getUserInfo($phone, $body);

        Cache::put("whatsapp:session:$sid", [
            'phone' => $phone,
            'user' => $userName,
        ], now()->addMinutes(10));

        $responseMessage = (new IntroductionService())->sendOnboardingMessage($userName);

        $this->twilio->sendWhatsAppMessage($phone, $responseMessage, null, [
            'statusCallback' => route('whatsapp.webhook.out')
        ]);

        return response('OK', 200);
    }

    /**
     * Outbound status callback from Twilio
     */
    public function webhookOut(Request $request)
    {
        $sid = $request->input('MessageSid');
        $status = $request->input('MessageStatus');

        $session = Cache::get("whatsapp:session:$sid");

        Log::info('Outbound WhatsApp delivery status', [
            'sid' => $sid,
            'status' => $status,
            'user_session' => $session,
        ]);

        return response('OK', 200);
    }
}
