<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends Controller
{
    public function show(Request $request)
    {
        return view('auth.2fa');
    }


    public function verify(Request $request)
    {
        $request->validate([
            'one_time_password' => 'required|string',
        ]);
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->two_factor_otp != $request->one_time_password) {
            throw ValidationException::withMessages([
                'one_time_password' => [__('The one time password is invalid.')],
            ]);
        }

        $user->update([
            'two_factor_otp' => null
        ]);
        return redirect()->intended('/');

    }
}
