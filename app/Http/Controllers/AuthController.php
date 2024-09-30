<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to log in
        if (Auth::attempt($credentials)) {
            // Authentication was successful
            $user = Auth::user();
            // Check the user's role
            return redirect()->route('dashboard');
        } else {
            // Authentication failed; check which credential is incorrect
            $user = Auth::getProvider()->retrieveByCredentials($credentials);

            if ($user && !Auth::validate(['email' => $user->email, 'password' => $credentials['password']])) {
                // Password is incorrect
                throw ValidationException::withMessages([
                    'password' => trans('auth.password_incorrect'),
                ])->redirectTo(route('login'));
            } elseif ($user) {
                // Email is incorrect
                throw ValidationException::withMessages([
                    'email' => trans('auth.email_incorrect'),
                ])->redirectTo(route('login'));
            } else {
                // Both email and password are incorrect
                throw ValidationException::withMessages([
                    'failed' => trans('auth.failed'),
                ])->redirectTo(route('login'));
            }
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return view('auth.login');
    }

    public function showRegistration(){
        return view('auth.registration');
    }

    public function signup(Request $request)
    {
        if($request->password == $request->confirm_password){
            $user = new User;
            $user->name = $request->name;
            $user->role_id = 1;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $profile = new Profile();
            $profile->userId = $user->id;
            $profile->fullName = $request->name;
            $profile->save();
            return redirect()->route('dashboard')->with('message', 'User created successfully');
        }else{
            return back()->with("message", "Password doesn't matches");
        }
    }
}
