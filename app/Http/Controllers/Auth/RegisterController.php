<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Mail\VerfMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 1
            ]);

            Auth::login($user);

            $accessToken = $user->createToken('auth_token')->plainTextToken;

            $refreshToken = Str::random(64);
            $expiresAt = now()->addDays(30);

            DB::table('refresh_tokens')->insert([
                'user_id' => $user->id,
                'token' => $refreshToken,
                'expires_at' => $expiresAt
            ]);

            DB::commit();
            return redirect()->route('home')->with([
                'success' => __('messages.registration_success'),
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => __('messages.error_messages')]);
        }
    }


}
