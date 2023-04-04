<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    // ---------------------- show register form
    public function create()
    {
        return view('users.register');
    }


    // ---------------------- create new user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // ! hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // ! create user
        $user = User::create($formFields);

        // ! user auto authentication
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in successfully');

        // dd($request);
    }
    // ---------------------- user logout
    public function logout(Request $user)
    {
        auth()->logout($user);
        $user->session()->invalidate();
        $user->session()->regenerate();

        return redirect('/')->with('message', 'You are logged out!');
    }



    // ---------------------- login form
    public function login()
    {
        return view('users.signIn');
    }
    // ---------------------- user authenticate
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'logged successfully');
        }
        return back()->withErrors(['email' => 'Invalid credentials, please try again'])->onlyInput('email');
    }
}
