<?php

namespace App\Services\Twilio;

use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioService {
    protected $client;
    protected $from;

    public function __construct(){
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        $this->from = env('TWILIO_WHATSAPP_NUMBER');
    }

    /**
     * @throws TwilioException
     */
    public function sendWhatsAppMessage($sendTo, $message, $mediaUrl = null, $statusCallback = null){

        $data = ['from' => $this->from];

        if ($mediaUrl){
            $data['mediaUrl'] = $mediaUrl;
            $data['body'] = $message ?: '📎 Media message';
        } else {
            $data['body'] = $message;
        }

        if ($statusCallback) {
            $data['statusCallback'] = $statusCallback;
        }

        try {
            return $this->client->messages->create($sendTo, $data);
        } catch (\Twilio\Exceptions\TwilioException $e) {

            Log::error("Twilio error: " . $e->getMessage());
            return null;
        }
    }
}
