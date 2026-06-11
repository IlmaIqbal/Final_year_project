<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\province;
use App\Models\Province as ModelsProvince;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{

    // Province functions

    public function index()
    {
        $province = Province::all();
        return view('admin.province', compact('province'));
    }

    public function create()
    {
        return view('province.store');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:provinces,name',

        ]);

        $province = Province::create([
            'name' => $request->name
        ]);

        return redirect()->route('province.district', $province->province_id)->with('Success', "Saved");
    }

    public function edit($province_id)
    {
        $province = province::find($province_id);

        return view('province.provinceEdit', compact('province'));
    }

    public function update(Request $request, province $province)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $input = $request->all();

        $province->update($input);

        return redirect()->route('admin.province')->with('Province Successfully Updated');
    }

    public function disable($province_id)
    {

        $province = province::findOrFail($province_id);

        $province->update(['status' => false]);

        return redirect()->back()->with('success', "Province disable Successfully!");
    }

    public function enable($province_id)
    {

        $province = province::findOrFail($province_id);

        $province->update(['status' => true]);

        return redirect()->back()->with('success', "Province Enable Successfully!");
    }

    // District function

    public function indexDistrict($province_id)
    {
        $province = province::find($province_id);

        $districts = District::where('province_id', $province_id)->get();

        return view('province.districtTable', compact('districts', 'province'));
    }

    public function createDistrict($province_id)
    {
        $province = province::find($province_id);

        return view('province.district', compact('province'));
    }


    public function storeDistrict(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:districts,name',
        ]);

        $district = District::create([
            'name' => $request->name,
            'province_id' => $request->province_id
        ]);

        return redirect()->route('province.division', $district->district_id)->with('success', "District saved successfully");
    }

    public function editDistrict($district_id)
    {
        $district = District::find($district_id);

        return view('province.districtEdit', compact('district'));
    }

    public function updateDistrict(Request $request, District $district)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $input = $request->all();

        $district->update($input);

        return redirect()->route('province.districtTable', $district->province->province_id)->with('Province Successfully Updated');
    }

    public function disableDistrict($district_id)
    {

        $district = District::findOrFail($district_id);

        $district->update(['status' => false]);

        return redirect()->back()->with('success', "district disable Successfully!");
    }

    public function enableDistrict($district_id)
    {

        $district = District::findOrFail($district_id);

        $district->update(['status' => true]);

        return redirect()->back()->with('success', "district Enable Successfully!");
    }

    // Division function

    public function indexDivision($district_id)
    {

        $district = District::find($district_id);

        $division = Division::where('district_id', $district_id)->get();

        return view('province.divisionTable', compact('district', 'division'));
    }

    public function createDivision($district_id)
    {
        $district = District::find($district_id);

        return view('province.division', compact('district'));
    }


    public function storeDivision(Request $request)
    {

        Division::create([
            'name' => $request->name,
            'district_id' => $request->district_id

        ]);

        return redirect()->back();
    }

    public function editDivision($division_id)
    {
        $division = Division::find($division_id);

        return view('province.divisionEdit', compact('division'));
    }

    public function updateDivision(Request $request, Division $division)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $input = $request->all();

        $division->update($input);

        return redirect()->route('province.divisionTable', $division->district->district_id)->with('Province Successfully Updated');
    }

    public function disableDivision($division_id)
    {

        $division = Division::findOrFail($division_id);

        $division->update(['status' => false]);

        return redirect()->back()->with('success', "Division disable Successfully!");
    }

    public function enableDivision($division_id)
    {

        $division = Division::findOrFail($division_id);

        $division->update(['status' => true]);

        return redirect()->back()->with('success', "Division Enable Successfully!");
    }
}
