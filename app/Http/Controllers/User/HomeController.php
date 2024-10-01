<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SebastianBergmann\Type\VoidType;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.home');
    }
}
