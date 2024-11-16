<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $groups = Group::all();
        $files = File::all();
        $users = User::all();
    
        return view('home', compact('groups', 'files', 'users'));
    }
    
}
