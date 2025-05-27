<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetCodeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Profile;
use App\Models\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
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
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 3;
            if($user->save()){
                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->fullName = $request->name;
                $profile->phoneNumber = $request->phone_number;
                $profile->save();
                $user->profile = $profile;
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
        $user = User::with('profile')->where('email',$request->email)->first();
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

    public function googleAuth(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'google_token' => 'required|string',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
            ]);

            // Check if a user with the provided Google token exists
            $user = User::where('google_token', $request->google_token)->first();

            if (!$user) {
                // If user does not exist, check if email is already used
                $existingUser = User::where('email', $request->email)->first();
                if ($existingUser) {
                    $existingUser->google_token = $request->google_token;
                    $existingUser->save();
                    $token = $existingUser->createToken('api')->plainTextToken;
                    $existingUser->token = $token;

                    $existingUser->profile_photo_url = null;
                    $existingUser->makeHidden(['profile_photo_url']);

                    $baseUrl = env('APP_URL', 'http://localhost:8000');

                    // Generate the full URL for the profile picture
                    if($existingUser->profile_photo_path) {
                        $existingUser->profile_photo_path = $baseUrl . '/storage/' . $existingUser->profile_photo_path;
                    } else {
                        $existingUser->profile_photo_path = "";
                    }
                    // Return the success response
                    return $this->returnSuccess(true, 'Authentication Successful', $existingUser, 200);
                }

                // Create a new user if not found
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->google_token = $request->google_token;
                $user->password = Hash::make('123456'); // Default password
                $user->role_id = 3;
                if($user->save()){
                    $profile = new Profile();
                    $profile->user_id = $user->id;
                    $profile->fullName = $request->name;
                    $profile->phoneNumber = $request->phone_number;
                    $profile->save();
                    $user->profile = $profile;
                }

                $user->save();
            }

            // Generate a Sanctum token
            $token = $user->createToken('api')->plainTextToken;

            // Add the token to the user response
            $user->token = $token;

            $user->profile_photo_url = null;
            $user->makeHidden(['profile_photo_url']);

            $baseUrl = env('APP_URL', 'http://localhost:8000');

            // Generate the full URL for the profile picture
            if($user->profile_photo_path) {
                $user->profile_photo_path = $baseUrl . '/storage/' . $user->profile_photo_path;
            } else {
                $user->profile_photo_path = "";
            }



            // Return the success response
            return $this->returnSuccess('Authentication Successful', $user);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return $this->returnError('Validation error', $e->errors());

        } catch (\Exception $e) {
            // Handle unexpected errors
            return $this->returnError($e->getMessage(), []);
        }
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

    public function sendResetCode(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email']);

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return $this->returnError('No account exists with this email',404);
            }

            // Generate verification code
            $verificationCode = sprintf("%06d", mt_rand(1, 999999));
            $expiredAt = Carbon::now()->addMinutes(5);

            //Save verification data with user_id
            UserVerification::updateOrCreate(
                ['email' => $user->email],
                [
                    'user_id' => $user->id, // Add the user_id field
                    'verification_code' => $verificationCode,
                    'expired_at' => $expiredAt
                ]
            );

            // Send email
            try {
                $res = Mail::to($user->email)->send(new PasswordResetCodeMail($verificationCode));
                return $this->returnSuccess('Reset code sent to your email',null);
            } catch (\Exception $e) {
                echo "Mail sending failed: " . $e->getMessage();
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->returnError('Validation error',422);
        } catch (\Exception $e) {
            return $this->returnError('An error occurred while sending reset code', 500);
        }
    }


    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'verification_code' => 'required|string',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // Check verification code
            $verification = UserVerification::where('email', $request->email)
                ->where('verification_code', $request->verification_code)
                ->where('expired_at', '>', Carbon::now())
                ->first();

            if (!$verification) {
                return $this->returnError(false, 'Invalid or expired verification code', [], 400);
            }

            // Update user's password
            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();

            // Delete verification record
            $verification->delete();

            return $this->returnError(true, 'Password reset successful', [], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->returnError(false, 'Validation error', $e->errors(), 422);
        } catch (\Exception $e) {
            return $this->returnError(false, 'An error occurred during password reset', $e->getMessage(), 500);
        }
    }

}
