<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $groups = Group::where('user_create', '!=', $user->name)->get();
        $files = File::where('user_id', $user->id)
            ->get();
        $users = User::all();

        return view('home', compact('groups', 'files', 'users'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $files = File::where('name', 'LIKE', "%$query%")->get();
        $groups = Group::where('name', 'LIKE', "%$query%")->get();
        $users = User::where('name', 'LIKE', "%$query%")->get();

        return view('usersearch', compact('files', 'groups', 'users'));
    }

}
