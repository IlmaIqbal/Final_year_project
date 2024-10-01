<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Deliver;
use App\Models\Front_Office;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use function PHPUnit\Framework\returnCallback;

class RoleController extends Controller
{

    public function invoice()
    {

        $id = Auth::user()->id;
        $items = Cart::where('user_id', '=', $id)->get();
        return view('emails.invoice', compact('items'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    public function loginUser(Request $req)
    {
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


    }

    public function getAll()
    {
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
}
