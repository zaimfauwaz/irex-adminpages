<?php

use App\Http\Controllers\WhatsAppController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/wa-in', [WhatsAppController::class, 'webhookIn'])->withoutMiddleware(['web','auth', 'csrf']);
Route::post('/wa-out', [WhatsAppController::class, 'webhookOut'])->name('whatsapp.webhook.out')->withoutMiddleware(['web', 'auth', 'csrf']);
