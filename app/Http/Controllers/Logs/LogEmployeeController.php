<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogEmployeeController extends Controller
{
    public function logCreateEmployee($name){
        $user = Auth::user();
        DB::table('logs')->insert([
            'employee_id' => $user->employee_id,
            'action' => 'Create Employee',
            'description' => 'Employee '.$name.' created successfully',
            'writer' => class_basename(__CLASS__),
            'method' => "POST",
            'timestamp' => now(),
        ]);
    }

    public function logModifyEmployee($name){
        $user = Auth::user();
        DB::table('logs')->insert([
            'employee_id' => $user->employee_id,
            'action' => 'Modify Employee',
            'description' => 'Employee '.$name.' information modified',
            'writer' => class_basename(__CLASS__),
            'method' => "PUT",
            'timestamp' => now(),
        ]);
    }

    public function logDeleteEmployee($name){
        $user = Auth::user();
        DB::table('logs')->insert([
            'employee_id' => $user->employee_id,
            'action' => 'Delete Employee',
            'description' => 'Employee '. $name . ' deleted successfully',
            'writer' => class_basename(__CLASS__),
            'method' => "DELETE",
            'timestamp' => now(),
        ]);
    }
}
