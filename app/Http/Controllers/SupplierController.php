<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of employee.
     */
    public function index()
    {
        $supplier = User::where('role', 'supplier')->get();

        return view('supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {

        return view('supplier.create');
    }

    /**
     * Store a newly created employees data in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address1' => 'required|string|max:250',
            'address2' => 'required|string|max:250',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|max:255',
            'phone' => 'required|string|max:15',



        ]);

        $user = User::create([
            'name' => $request->name,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'phone' => $request->phone,

        ]);

        if ($user->role === 'supplier') {
            Supplier::create([
                'user_id' => $user->id,
                'name' => $validated['name'],
                'address1' => $validated['address1'],
                'address2' => $validated['address2'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
            ]);
        }
        return redirect()->route('supplier.index')->with('success', 'Supplier registered successfully!');
    }

    public function edit(User $user)
    {
        return view('supplier.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        $input = $request->all();

        $user->update($input);

        return redirect()->route('supplier.index')
            ->with('success', 'Supplier updated successfully');
    }

    public function disable(User $user)
    {
        $user->update(['active' => false]);
        return redirect()->route('supplier.index');
    }

    public function Enable(User $user)
    {
        $user->update(['active' => true]);
        return redirect()->route('supplier.index');
    }
}
