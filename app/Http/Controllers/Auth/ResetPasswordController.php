<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\ResetCodePassword;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */


    /**
     * Change the password (Setp 3)
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        if ($passwordReset->isExpire()) {
            return $this->jsonResponse(null, trans('passwords.code_is_expire'), 422);
        }

        $user = User::firstWhere('email', $passwordReset->email);

        $user->update($request->only('password'));

        $passwordReset->delete();

        return $this->jsonResponse(null, trans('site.password_has_been_successfully_reset'), 200);
    }

    public function __construct()
    {
        // if (Auth::check() && Auth::user()->role_id == 1) {
        //     $this->redirectTo = route("admin.home");
        // } elseif (Auth::check() && Auth::user()->role_id == 2) {
        //     $this->redirectTo = route("user.home");
        // }
        // $this->middleware("guest")->except("logout");
    }
}
