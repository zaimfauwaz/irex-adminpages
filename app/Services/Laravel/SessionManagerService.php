<?php

namespace App\Services\Laravel;

use App\Models\Playground;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SessionManagerService {

    public function startSession($playgroundId = null) {
        $employeeId = Auth::id();

        // If there are session active within the inactivity time interval count, return to the session (as long it is not deleted yet).
        $existing = Playground::where('employee_id', $employeeId)->whereNull('deleted_at')->latest()->first();
        if ($existing) return $existing;

         return Playground::create([
            'employee_id' => $employeeId,
         ]);
    }

    public function stopSession($playgroundId) {

        // Close the active session. Note that in this case, deleted_at will represent when the session is closed. Closed sessions cannot be reopened.
        return Playground::where('employee_id', Auth::id())->where('playground_id', $playgroundId)->update(['deleted_at' => Carbon::now()]);
    }

    public function getSession($playgroundId) {
        // Obtain the current session ID and its related information.
        return Playground::where('employee_id', Auth::id())->where('playground_id', $playgroundId)->whereNull('deleted_at')->latest()->first();
    }

    public function getLatestSession() {
        return Playground::where('employee_id', Auth::id())->whereNull('deleted_at')->latest()->first();
    }


    public function checkTimeout($playgroundId): bool {
        $session = Playground::where('employee_id', Auth::id())
            ->where('playground_id', $playgroundId)
            ->whereNull('deleted_at')
            ->with('latestInquiry')
            ->first();

        if (!$session || !$session->latestInquiry) {
            return true;
        }

        return $session->latestInquiry->created_at->diffInMinutes(now()) >= 30;
    }

}
