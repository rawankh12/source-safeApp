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
            
            // $random_number = random_int(100000, 999999);
            // $mailData = [
            //     'title' => 'Code login',
            //     'code' => $random_number,
            // ];
            
            // try {
                
            //     Mail::to($request->email)->send(new VerfMail($mailData));
            // } catch (\Exception $e) {
            //     return $e->getMessage();

            //     return back()->withErrors(['error' => 'Something went wrong while sending the email, please try again.']);
            // }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            Auth::login($user);
            // $request->session()->put('email', $user->email);
            DB::commit();
            return redirect()->route('home')->with('success', 'youre loged in successfully.');
        } catch (\Exception $e) {
            // return false ;
            DB::rollBack();
            return back()->withErrors(['error' => 'Something went wrong, please try again.']);
        }
    }

}
