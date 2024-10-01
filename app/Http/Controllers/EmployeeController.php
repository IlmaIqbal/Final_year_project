<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employee.
     */
    public function index()
    {
        $employee_table = User::where('role', '!=', 'user')->get();

        return view('employee.index', compact('employee_table'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {

        return view('employee.create');
    }

    /**
     * Store a newly created employees data in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'nic' => 'required|string|max:25',


        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'nic' => $request->nic,

        ]);
        // want add error message according to the final project report 5Th chapter
        return redirect('/employee/index'); // Redirect to admin dashboard after registration
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function countUsers()
    {
        $count = User::count();

        return view('admin.home', compact('count'));
    }
}
