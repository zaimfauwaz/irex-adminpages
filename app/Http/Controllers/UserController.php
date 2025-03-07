<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {

        $employees = User::orderBy('name', 'asc')->paginate(10);
        return view('adminemp.index', compact('employees'));
    }

    public function create()
    {
        return view('adminemp.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'is_active' => 'required|boolean',
            'is_admin' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active,
            'is_admin' => $request->is_admin,
        ]);
        return redirect()->route('adminemp.index')->with('success', 'Employee added successfully.');
    }


    public function show($employee_id)
    {
        $employee = User::findOrFail($employee_id);
        return view('adminemp.show', compact('employee'));
    }


    public function edit(Request $request, User $adminemp)
    {
        return view('adminemp.edit', compact('adminemp'));
    }


    public function update(Request $request, $employee_id)
    {
        $adminemp = User::where('employee_id', $employee_id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $adminemp->employee_id . ',employee_id',
            'username' => 'required|string|max:255|unique:users,username,' . $adminemp->employee_id . ',employee_id',
            'password' => 'required|string|min:8|confirmed',
           'is_active' =>  'required|boolean',
           'is_admin' =>  'required|boolean',
        ]);

        $adminemp->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active,
            'is_admin' => $request->is_admin,
        ]);

        return redirect()->route('adminemp.index')->with('success', 'Employee updated successfully.');
    }


    public function destroy(User $adminemp)
    {
        $adminemp->delete();
        return redirect()->route('adminemp.index');
    }
}
