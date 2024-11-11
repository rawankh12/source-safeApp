<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function verification(Request $request)
{
    $email = $request->session()->get('email');
    $user = User::where('email', $email)->first();

    if (!$user) {
        return redirect()->route('home')->withErrors(['error' => 'User not found.']);
    }
    return view('varificationemail.CodeVer', compact('user'));
}


}
