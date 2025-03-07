<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminCredentials extends Controller
{
    const TABLE_NAME = 'users';

    public function verifyUser($username, $password)
    {
        // Retrieve the user from the database
        $user = DB::table(self::TABLE_NAME)
            ->where('username', $username)
            ->first();

        // Check if user exists
        if (!$user) {
            return ['error' => 'The employee is not found'];
        }

        // Verify the password
        if (!Hash::check($password, $user->password)) {
            return ['error' => 'Invalid password inserted'];
        }

        // Check if the user is active
        if ($user->is_active !== 1) {
            return ['error' => 'The employee is not active'];
        }

        // Return success if all checks pass
        return [
            'employee_id' => $user->employee_id,
            'username' => $user->username,
            'is_active' => true
        ];
    }

    public function isAdmin($employeeId){
        $user = DB::table(self::TABLE_NAME)
            ->where('employee_id', $employeeId)
            ->first();

        return $user && $user->is_admin === 1;
    }
}
