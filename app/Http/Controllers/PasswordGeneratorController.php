<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordGeneratorController extends Controller
{
    public function showForm()
    {
        return view('password_generator');
    }

    public function generatePassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'plaintext_password' => 'required|string|min:8', // Require a minimum length for security
        ]);

        // Get the plaintext password from the request
        $plaintextPassword = $request->input('plaintext_password');

        // Hash the password using Argon2 or bcrypt (based on your configuration)
        $hashedPassword = Hash::make($plaintextPassword);

        // Return the hashed password to the view
        return view('password_generator', [
            'hashedPassword' => $hashedPassword,
            'plaintextPassword' => $plaintextPassword,
        ]);
    }
}
