<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function login(LoginRequest $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            $user = User::where('email', $validatedData['email'])->first();

            if (!$user || !Hash::check($validatedData['password'], $user->password)) {
                return redirect()->back()->with('error', __('messages.invalid_credentials'));
            }

            $accessToken = $user->createToken('auth_token')->plainTextToken;

            $refreshToken = Str::random(64);
            $expiresAt = now()->addDays(30);

            DB::table('refresh_tokens')->insert([
                'user_id' => $user->id,
                'token' => $refreshToken,
                'expires_at' => $expiresAt
            ]);

            Auth::login($user);
            DB::commit();

            if ($user->role == 1) {
                return redirect()->route('home')->with([
                    'success' => __('messages.login_success'),
                    'access_token' => $accessToken,
                    'refresh_token' => $refreshToken
                ]);
            } else {
                return redirect()->route('adminHome')->with([
                    'success' => __('messages.login_success'),
                    'access_token' => $accessToken,
                    'refresh_token' => $refreshToken
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return back()->withErrors(['error' => __('messages.error_message')]);
        }
    }




    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('auth')->only('logout');
    // }
}
