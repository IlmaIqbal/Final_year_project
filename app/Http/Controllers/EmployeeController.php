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
            'role' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:users',
            'nic' => 'required|string|max:25|unique:users',
            'dob' => 'required',
            'gender' => 'required',
            'address1' => 'required',
            'address2' => 'required',




        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->nic),
            'role' => $request->role,
            'phone' => $request->phone,
            'nic' => $request->nic,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address1' => $request->address1,
            'address2' => $request->address2,

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

    public function ajaxpage(Request $request)
    {
        if ($request->frompage == "dob") {
            $selnic = $request->dobcal;

            if (strlen($selnic) == 10) {
                $bdayyear = substr($selnic, 0, 2);
                $bdayyear = $bdayyear + 1900;
                $bdaynum = substr($selnic, 2, 3);
            } else {
                $bdayyear = substr($selnic, 0, 4);
                $bdaynum = substr($selnic, 4, 3);
            }

            if ($bdaynum > 500) {
                $bdaynum = $bdaynum - 500;
            }

            $month = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

            $day_cal = 0;

            for ($x = 0; $x < count($month); $x++) {
                $day_cal += $month[$x];

                if ($day_cal >= $bdaynum) {
                    $bdayday = $bdaynum - (($day_cal) - ($month[$x]));
                    $bdaymonth = $x + 1;
                    break;
                }
            }

            $bdaydate = $bdayyear . "-" . $bdaymonth . "-" . $bdayday;

            return date("Y-m-d", strtotime($bdaydate));
        }
    }
}
