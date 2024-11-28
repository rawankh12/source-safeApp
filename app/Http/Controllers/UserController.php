<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\File;
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
                return back()->with('error', __('messages.no_users_found'))->withInput();
            }

            return view('usersearch', compact('users'));
        } else {
            return back()->with('error', __('messages.enter_search_term'))->withInput();
        }
    }

    public function inviteuser(Request $request)
    {
        // $me = Auth::user();
        $group = Group::find($request->group_id);
        // $user = User::where('id', $user_id)->first();
        $inviting = UserGroup::
            where('user_id', $request->user_id)
            ->where('group_id', $request->group_id)
            ->first();
        //  return $inviting ;
        if ($inviting) {

            return redirect()->back()->withErrors(__('messages.invitation_already_sent'));
        } else {

            $invite = UserGroup::create([
                'user_id' => $request->user_id,
                'group_id' => $request->group_id,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            // return $inviting ;
            return redirect()->back()->with('success', __('messages.invitation_sent_successfully'));
        }
    }
    
    public function indexx()
    {
        $user = Auth::user(); 
        $files = File::where('user_id', Auth::id())->get();
        $lockedFiles = File::where('user_id', $user->id)
            ->whereHas('groups', function ($query) {
                $query->where('status', 'blocked');
            })
            ->with([
                'groups' => function ($query) {
                    $query->where('status', 'blocked');
                }
            ])
            ->get();

        return view('profile', compact('user', 'files', 'lockedFiles'));
    }

}
