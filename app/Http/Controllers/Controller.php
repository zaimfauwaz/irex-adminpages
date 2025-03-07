<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Authentication\AdminCredentials;
use App\Http\Controllers\Logs\LogReaderController;
use App\Http\Controllers\UserController;

class Controller
{
    // View Admin Logs view
    public function viewAdminLogs()
    {
        if (auth()->check()) {
            $adminCredentials = new AdminCredentials();
            if ($adminCredentials->isAdmin(auth()->id())) {
                return app(LogReaderController::class)->indexLogs();
            }
            abort(403, 'Incorrect privileges');
        }
        abort(403,'Incorrect privileges');
    }

}
