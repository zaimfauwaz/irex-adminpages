<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Logs\LogReaderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::group([], function () {
    Route::get('/login', function () {
        if (auth()->check()) {
            $adminCredentials = new Authentication\AdminCredentials();
            if ($adminCredentials->isAdmin(auth()->id())) {
                return redirect()->route('admindash');
            } else {
                return redirect()->route('crmdash');
            }
        }
        return app(AuthController::class)->showLoginForm();
    })->name('login');
});

Route::post('/login', [AuthController::class, 'goToLogin'])->name('login');
Route::get('/admindash', [AuthController::class, 'checkSession'])->middleware('auth')->name('admindash');
Route::get('/crmdash', [AuthController::class, 'checkSession'])->middleware('auth')->name('crmdash');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin-based Routes
Route::get('/adminlogs', [Controller::class, 'viewAdminLogs'])->middleware('auth')->name('adminlogs');
Route::resource('/adminemp',UserController::class)->middleware('auth');
Route::get('/adminemp/{adminemp}/password', [UserController::class, 'editpassword'])->middleware('auth')->name('adminemp.editpassword');
Route::put('/adminemp/{adminemp}/password', [UserController::class, 'updatePassword'])->middleware('auth')->name('adminemp.updatepassword');
Route::resource('/product', ProductController::class)->middleware('auth');
Route::resource('/faqlist', FaqController::class)->middleware('auth');

//Service-based Routes (Third Party Connections)
