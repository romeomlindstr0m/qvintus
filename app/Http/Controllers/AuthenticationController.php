<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rules\Password;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function showLoginForm(): View
    {
        return view('login');
    }

    public function showRegisterForm(): View
    {
        return view('register');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Successfully signed out.');
    }

    public function login(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required'],
            'password' => ['required'],
        ];

        $messages = [
            'required' => 'Please fill out all required fields.',
        ];

        $validator = Validator::make($request->only('name', 'password'), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt($request->only('name', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended();
        }

        return back()->withErrors(['name' => 'Username and/or password is incorrect.']);
    }
    
    public function register(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'max:255', 'string'],
            'password' => ['required', 'confirmed', Password::min(6)->letters()->uncompromised()],
        ];

        $messages = [
            'required' => 'Please fill out all required fields.',

            'name.max' => 'The :attribute field must be max 255 characters long.',
            'name.string' => 'The :attribute field must be of type string.',

            'password.confirmed' => 'The :attribute and password confirmation fields must match.',
            'password.min' => 'The :attribute field must contain at least 6 charaters.',
            'password.letters' => 'The :attribute field must contain at least one letter.',
            'password.uncompromised' => 'The selected password was found in at least one data breach, please choose another password.',
        ];

        $validator = Validator::make($request->only('name', 'password', 'password_confirmation'), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = new User;

        $user->name = $request->name;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('login')->with('status', 'Successfully created an account.');
    }
}
