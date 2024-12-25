<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\UserVerification;
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
            $user->role_id = 3;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->fullName = $request->name;
            $profile->save();
            return redirect()->route('dashboard')->with('message', 'User created successfully');
        }else{
            return back()->with("message", "Password doesn't matches");
        }
    }

    public function signupapi(Request $request)
    {
        if ($this->checkEmailExist($request->email)){
            return $this->returnError("Email already exist",401);
        }
        if($request->password == $request->confirm_password){
            $user = new User;
            $user->name = $request->name;
            $user->phone_number = $request->phone_number;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 3;
            if($user->save()){
                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->fullName = $request->name;
                $profile->save();
            }

            if($user && Hash::check($request->password,$user->password)){
                $token = $user->createToken('api');
                $user->token = $token->plainTextToken;
                return $this->returnSuccess("Signup Successful",$user);
            }

        }else{
            return $this->returnError("User signup failed",401);
        }
    }

    public function loginapi(Request $request){
        $user = User::where('email',$request->email)->first();
        if(!$user){
            return $this->returnError("Email or password is invalid",401);
        }
        if($user && Hash::check($request->password,$user->password)){
            $token = $user->createToken('api');
            $user->token = $token->plainTextToken;
            return $this->returnSuccess("User Logged in Successfully",$user);
        }else{
            return $this->returnError("Email or password is invalid",401);
        }
    }

    public function logoutapi(Request $request){
        $user = $request->user();
        $user->tokens()->delete();
        return $this->returnSuccess("User logged out successfully!",[]);
    }

    /* Email Phone Number Send for getting verification Code */
    public function send_verification_code(Request $request)
    {
        if ($this->checkEmailExist($request->email)){
            return $this->returnError("Email already exists!",401);
        }
    }

    function checkEmailExist($email)
    {
        $user = User::where('email', $email)->first();
        return $user?true:false;
    }

    public function returnError($message,$code): \Illuminate\Http\JsonResponse
    {
        $message = [
            "error"=>$message,
            "code"=>$code
        ];
        return response()->json($message);
    }

    public function returnSuccess($message,$data): \Illuminate\Http\JsonResponse
    {
        $message = [
            "message"=>$message,
            "code"=>200,
            "success"=>true,
            "data"=>$data
        ];
        return response()->json($message);
    }


}
