<?php
namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogAccessController extends Controller
{
    public function logAccessWeb(Request $request)
    {
        if (Auth::check()){
            $user = Auth::user();
            $employeeId = $user->employee_id;
        } else {
            $employeeId = null;
        }
        DB::table('logs')->insert([
            'employee_id' => $employeeId,
            'action' => 'Access Web',
            'description' => 'Accessed Route ' . $request->path(),
            'writer' => class_basename(__CLASS__),
            'method' => $request->method(),
            'timestamp' => now(),
        ]);
    }
}
