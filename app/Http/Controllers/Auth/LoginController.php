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
    public function login(LoginRequest $Request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $Request->validated();
            $user = User::where('email', $validatedData['email'])->first();

            if (!$user || !Hash::check($validatedData['password'], $user->password)) {
                return redirect()->back()->withErrors('Invalid credentials.');
            }

            $token = $user->createToken('auth_token')->plainTextToken;
            Auth::login($user);
            DB::commit();
            return redirect()->route('home')->with('success', 'Login successful.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            return back()->withErrors(['error'=>'Something went wrong, please try again.']);
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
