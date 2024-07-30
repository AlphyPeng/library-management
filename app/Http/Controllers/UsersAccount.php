<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UsersAccount extends Controller
{
    // SignUp START

    public function showSignUp(): View
    {
        return view('user.signup.signup');
    }

    public function signUp(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mname' => 'required',
            'uname' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'contact' => 'required|digits:11|regex:/^09[0-9]{9}$/',
            'pass' => 'required|min:8|same:confirm-password',
            'confirm-password' => 'required',
        ], [
            'fname.required' => 'First Name is required.',
            'lname.required' => 'Last Name is required.',
            'mname.required' => 'Middle Name is required.',
            'uname.required' => 'Username is required.',
            'email.required' => 'Email is required.',
            'contact.required' => 'Contact is required.',
            'pass.required' => 'Password is required.',
            'pass.min' => 'Password must be at least 8 characters.',
            'confirm-password.required' => 'Confirm Password is required.',
            'pass.same' => 'Password is not same.',

        ]);


        User::create([
            'first_name' => $validatedData['fname'],
            'last_name' => $validatedData['lname'],
            'middle_name' => $validatedData['mname'],
            'username' => $validatedData['uname'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['pass']),
            'contact' => $validatedData['contact'],
            'account_type' => 1,
        ]);

        return redirect()->route('signup')->with('success', 'Account created successfully.');
    }

    // SignUp END
}
