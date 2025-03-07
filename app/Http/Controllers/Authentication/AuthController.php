<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Logs\LogUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function showIndexPage()
    {
        return view('index');
    }


    // Function for login
    public function goToLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $adminCredentials = new AdminCredentials();
        $result = $adminCredentials->verifyUser($username, $password);
        $logController = app(LogUserController::class);

        if (isset($result['error'])) {
            // If there's an error, redirect back with the error message
            $logController->logLoginFailure($username, $result['error'], $request);
            return redirect()->back()->withErrors([$result['error']]);
        }

        // Log the user in with Auth
        Auth::loginUsingId($result['employee_id']);

        if ($adminCredentials->isAdmin($result['employee_id'])) {
            // If admin, redirect to the admin dash
            $logController->logLoginSuccess($request);
            return redirect()->route('admindash');
        } else {
            // If not admin, redirect to the CRM dash
            $logController->logLoginSuccess($request);
            return redirect()->route('crmdash');
        }
    }

    public function checkSession(){
        $user = Auth::user();
        $adminCredentials = new AdminCredentials();
        $logController = app(LogUserController::class);
        if ($adminCredentials->isAdmin($user->employee_id)) {
            return view('admindash');
            $logController->logLoginSuccess($request);
        } else {
            return view('crmdash');
            $logController->logLoginSuccess($request);
        }
    }

    public function logout(Request $request){


        $logController = app(LogUserController::class);
        $logController->logLogout($request);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
