<?php

namespace App\Http\Controllers;

use App\Models\Decoration;
use App\Models\Entertainment;
use App\Models\invitation;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class Front_officeController extends Controller
{
    public function show_emp()
    {
        $employee = User::where('role', '!=', 'user')->get();

        return view('front_office.employee', compact('employee'));
    }

    public function show_cus()
    {
        $customer_view = User::where('role', 'user')->paginate(10);
        return view('front_office.customer', compact('customer_view'));
    }

    public function catering_view()
    {
        $services = Service::where('active', true)->get(); // Assuming you have a gift model
        return view('front_office.catering', compact('services'));
    }

    public function invitation_view()
    {
        $catering = invitation::where('active', true)->get(); // Assuming you have a gift model
        return view('front_office.invitation', compact('catering'));
    }
    public function decoration_view()
    {
        $decoration = Decoration::where('active', true)->get(); // Assuming you have a gift model
        return view('front_office.decoration', compact('decoration'));
    }
    public function entertainment_view()
    {
        $entertainment = Entertainment::where('active', true)->get(); // Assuming you have a gift model
        return view('front_office.entertainment', compact('entertainment'));
    }
}
