<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::
            where('users.id', '!=', Auth::user()->id)->get();
        if ($users) {
            return view('users', compact('users'));
        } else {
            return back()->withErrors(['error' => 'No users available.']);
        }
    }

    public function invite()
    {

        $users = User::all();

        return view('users', compact('users'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::query();

        if ($query) {
            $users = $users->where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->get();

            if ($users->isEmpty()) {
                return back()->with('error', 'No users found for your search.')->withInput();
            }

            return view('usersearch', compact('users'));
        } else {
            return back()->with('error', 'Please enter a search term.')->withInput();
        }
    }

    public function inviteuser(Request $request, $group_id, $user_id)
    {
        $me = Auth::user();
        $user = User::where('id', $user_id);
        $inviting = DB::table('user_groups')
            ->where('user_id', $user->id)
            ->where('group_id', $group_id)
            ->first();

        if ($inviting) {

            return redirect()->back()->withErrors('You are already send a invitation to this user, wait for the responce!');
        } else {
            DB::table('user_groups')->insert([
                'user_id' => $user_id,
                'group_id' => $group_id,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->back()->with('success', 'invitation request sent successfully.');
        }
    }

    //    return view('mygroup',compact('inviteuser'));
    // }
}
