<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogUserController extends Controller
{
    public function logLoginSuccess(Request $request)
    {
        $user = Auth::user();
        DB::table('logs')->insert([
            'employee_id' => $user->employee_id,
            'action' => 'Login Success',
            'description' => 'User logged in successfully',
            'writer' => class_basename(__CLASS__),
            'method' => $request->method(),
            'timestamp' => now(),
        ]);
    }

    public function logLoginFailure($username, $result, Request $request)
    {
        DB::table('logs')->insert([
            'employee_id' => null,
            'action' => 'Login Failed',
            'description' => $result,
            'writer' => class_basename(__CLASS__),
            'method' => $request->method(),
            'timestamp' => now(),
        ]);
    }

    public function logLogout(Request $request)
    {
        $user = Auth::user();
        DB::table('logs')->insert([
            'employee_id' => $user->employee_id,
            'action' => 'Logout ChatSession',
            'description' => 'User logged out successfully',
            'writer' => class_basename(__CLASS__),
            'method' => $request->method(),
            'timestamp' => now(),
        ]);
    }
}
