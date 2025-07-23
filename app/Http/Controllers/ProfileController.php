<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{
    // profile view

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function page01()
    {
        return view('pages.page1');
    }

    public function index()
    {
        return view('profiles.index');
    }


    public function updateProfile(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address1' => ['required', 'string', 'max:255'],
            'address2' => ['required', 'string', 'max:255'],

        ]);
        # check if user profile image is null, then validate
        if (auth()->user()->profile_image == null) {
            $validate_image = Validator::make($request->all(), [
                'profile_image' => ['required', 'image', 'max:1000']
            ]);
            # check if their is any error in image validation
            if ($validate_image->fails()) {
                return response()->json(['code' => 400, 'msg' => $validate_image->errors()->first()]);
            }
        }
        # check if their is any error
        if ($validated->fails()) {
            return response()->json(['code' => 400, 'msg' => $validated->errors()->first()]);
        }

        $profile_image = auth()->user()->profile_image; // default to old

        # check if the request has profile image
        if ($request->hasFile('profile_image')) {
            $imagePath = public_path('profile_images/' . auth()->user()->profile_image);
            # check whether the image exists in the directory
            if (File::exists($imagePath)) {
                # delete image
                File::delete($imagePath);
            }
            $image = $request->file('profile_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('profile_images'), $filename);
            $profile_image = $filename;
        }
        # update the user info
        auth()->user()->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'profile_image' => $profile_image
        ]);
        return response()->json(['code' => 200, 'msg' => 'profile updated successfully.']);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Optionally, you can redirect or return a response
        return redirect()->route('profile.index')->with('status', 'User deleted successfully.');
    }

    public function showChangePasswordForm()
    {
        return view('profiles.index');
    }

    public function changePassword(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.password.change')
                ->withErrors($validator)
                ->withInput();
        }

        // Check current password
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->route('user.password.change')
                ->withErrors(['current_password' => 'Current password is incorrect'])
                ->withInput();
        }

        // Change password
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.password.change')->with('success', 'Password changed successfully');
    }
}
