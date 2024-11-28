<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\RefreshToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function showLoginForm()
    {

        return view('auth/login');
    }

    public function showRegistrForm()
    {

        return view('auth/register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function refreshToken(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required'
        ]);

        // تحقق من صحة الـ refresh token
        $refreshToken = RefreshToken::where('token', $request->refresh_token)->first();

        if (!$refreshToken || $refreshToken->expires_at < Carbon::now()) {
            return response()->json(['message' => __('messages.invalid_refresh_token')], 401);
        }

        // إصدار توكين جديد باستخدام Sanctum
        $user = $refreshToken->user;
        $newToken = $user->createToken('auth_token')->plainTextToken;

        // إصدار Refresh Token جديد (اختياري)
        $refreshToken->delete();
        $newRefreshToken = $user->refreshTokens()->create([
            'token' => Str::random(64),
            'expires_at' => Carbon::now()->addDays(30)
        ]);

        return response()->json([
            'access_token' => $newToken,
            'refresh_token' => $newRefreshToken->token
        ]);
    }

}
