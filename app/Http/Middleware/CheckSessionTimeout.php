<?php

namespace App\Http\Middleware;

use App\Models\Playground;
use App\Services\Laravel\SessionManagerService as SessionManager;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionTimeout
{

    public function handle(Request $request, Closure $next): Response
    {
        $session = Playground::where('employee_id', Auth::id())->whereNull('deleted_at')->with('latestInquiry')->latest('created_at')->first();

        if (!$session || !$session->latestInquiry) {
            return response()->json(['message' => 'Your session has timed out due to inactivity.'], 440);
        }

        if ($session->latestInquiry->created_at->diffInMinutes(now()) >= 30) {
            app(SessionManager::class)->stopSession($session->playgroundId);
            return response()->json(['message' => 'Your session has timed out due to inactivity.'], 440);
        }

        return $next($request);
    }
}
