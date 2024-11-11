<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function index()
    {
        $user = Auth::user()->name;

        $groups = Group::where('user_create', '!=', $user)
            ->whereDoesntHave('users', function ($query) use ($user) {
                $query->where('user_id', $user);
            })
            // ->whereDoesntHave('users', function ($query) use ($user) {
            //     $query->where('user_id', $user)->where('user_groups.status', 'Not accepted');
            // })
            ->get();

        return view('home', compact('groups'));
    }

    public function mygroup()
    {

        $userr = Auth::user();
        $user = User::first();
        $groups = Group::where('user_create', $userr->name)->get();

        return view('mygroup', compact('groups', 'user'));
    }

    public function membergroup()
    {

        $userr = User::find(Auth::user()->id);

        // $groups = DB::table('groups')
        //     ->join('user_groups', 'groups.id', '=', 'user_groups.group_id')
        //     ->where('user_groups.user_id', $user->id)
        //     ->where('user_groups.status', 'accepted')
        //     ->select('groups.*')
        //     ->get();

        $groups = $userr->groups;
        return view('membergroup', compact('groups'));
    }

    public function showJoinRequests()
    {
        $user = Auth::user();

        $ownedGroups = Group::where('user_create', $user->name)->pluck('id');

        // $pendingRequests = DB::table('user_groups')
        //     ->join('users', 'user_groups.user_id', '=', 'users.id')
        //     ->join('groups', 'user_groups.group_id', '=', 'groups.id')
        //     ->whereIn('user_groups.group_id', $ownedGroups)
        //     ->where('user_groups.status', 'pending')
        //     ->where('users.name', '!=', Auth::user()->name)
        //     ->select('user_groups.*', 'users.name as user_name', 'groups.name as group_name')
        //     ->get();

        $pendingRequests = Group::where('user_create', $user->name)
            ->whereHas('users', function ($query) {
                $query->where('user_groups.status', 'pending');
            })
            ->with([
                'users' => function ($query) {
                    $query->where('user_groups.status', 'pending');
                }
            ])
            ->get();

        return view('joinrequest', compact('pendingRequests'));
    }
    public function showaddfileRequests()
    {
        $user = Auth::user();

        $ownedGroups = Group::where('user_create', $user->name)->pluck('id');

        // $pendingRequests = DB::table('group_files')
        //     ->join('files', 'group_files.file_id', '=', 'files.id')
        //     ->join('groups', 'group_files.group_id', '=', 'groups.id')
        //     ->whereIn('group_files.group_id', $ownedGroups)
        //     ->where('group_files.type', 'pending')
        //     ->select('group_files.*', 'groups.name as group_name', 'files.name as file_name')
        //     ->get();

        $pendingRequests = Group::where('user_create', $user->name)
            ->whereHas('pendingfiles', function ($query) {
                $query->where('group_files.type', 'pending');
            })
            ->with([
                'pendingfiles' => function ($query) {
                    $query->where('group_files.type', 'pending');
                }
            ])
            ->get();

        return view('addfileRequests', compact('pendingRequests'));
    }

    public function create()
    {
        return view('groupscreate');
    }

    public function store(GroupRequest $request)
    {

        $user = Auth::user();
        if (!$user) {

            return redirect()->route('home')->with('error', 'User not authenticated');
        }

        $group = Group::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_create' => $user->name,
        ]);

        $user->groups()->attach($group);
        return redirect()->route('home')->with('success', 'Group created successfully.');
    }

    public function deletegroup($group_id)
    {
        $user = Auth::user();
        $group = Group::find($group_id);

        if (!$group) {
            return redirect()->back()->withErrors('Group not found');
        }

        $hasFreeFiles = $group->files()->where('status', 'blocked')->exists();

        if ($hasFreeFiles) {
            return redirect()->back()->withErrors('there\'s a blocked file you can\'t delete the group ');
        } else {
            $group->delete();
            return redirect()->back()->with('success', 'File deleted successfuly');
        }
    }

    public function sendrequest($groupId)
    {
        $user = Auth::user();

        $existingRequest = DB::table('user_groups')
            ->where('user_id', $user->id)
            ->where('group_id', $groupId)
            ->first();

        if ($existingRequest) {

            return redirect()->back()->withErrors('You are already send a request of this group, wait for the responce!');
        }

        DB::table('user_groups')->insert([
            'user_id' => $user->id,
            'group_id' => $groupId,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Join request sent successfully.');
    }

    public function deleteJoinRequest($userId, $groupId)
    {
        DB::table('user_groups')
            ->where('user_id', $userId)
            ->where('group_id', $groupId)
            ->delete();

        return redirect()->back()->with('success', 'Join request deleted successfully.');
    }

    public function acceptJoinRequest($userId, $groupId)
    {
        DB::table('user_groups')
            ->where('user_id', $userId)
            ->where('group_id', $groupId)
            ->update(['status' => 'accepted']);

        return redirect()->back()->with('success', 'Join request accepted successfully.');
    }

    public function deleteRequest($fileId, $groupId)
    {
        DB::table('group_files')
            ->where('file_id', $fileId)
            ->where('group_id', $groupId)
            ->delete();

        return redirect()->back()->with('success', ' request deleted successfully.');
    }

    public function acceptRequest($fileId, $groupId)
    {
        DB::table('group_files')
            ->where('file_id', $fileId)
            ->where('group_id', $groupId)
            ->update(['type' => 'accepted']);

        return redirect()->back()->with('success', ' request accepted successfully.');
    }
}
