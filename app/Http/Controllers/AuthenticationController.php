<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function showLoginForm(): View
    {
        return view('login');
    }

    public function login(Request $request): RedirectResponse
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
        ];

        $auth_validator = Validator::make($request->all(), $rules, $messages);

        if ($auth_validator->fails()) {
            return back()->withErrors($auth_validator)->withInput();
        }

        if (Auth::attempt($request->only(['email', 'password']))) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'User name or password is wrong.',
        ])->withInput();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'You have been successfully logged out.');
    }
}
