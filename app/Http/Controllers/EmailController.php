<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function fetchNotifications(Request $request)
    {
        $notifications = $request->user()->notifications()->get();

        return response()->json($notifications);
    }

    public function unreadCount()
    {
        $count = Auth::user()->unreadNotifications()->count();
        return response()->json(['unreadCount' => $count]);
    }

    public function markAsRead(Request $request)
    {
        $user = $request->user();
        $user->unreadNotifications->markAsRead();
        return response()->json(['success' => 'تم تحديث الإشعارات إلى مقروءة']);
    }

}
