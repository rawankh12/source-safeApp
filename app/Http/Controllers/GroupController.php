<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\GroupService;

class GroupController extends Controller
{
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }
    public function index()
    {
        $user = Auth::user()->name;
        $groups = Group::where('user_create', '!=', $user)
            ->whereDoesntHave('users', function ($query) use ($user) {
                $query->where('user_id', $user);
            })
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
        $groups = $userr->groups;
        return view('membergroup', compact('groups'));
    }
    public function showJoinRequests()
    {
        $user = Auth::user();
        $ownedGroups = Group::where('user_create', $user->name)->pluck('id');
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
    public function showinviteRequests()
    {
        $user = Auth::user();
        $myinvite = User::where('id', $user->id)
            ->whereHas('groupss', function ($query) {
                $query->where('user_groups.status', 'pending');
            })
            ->with([
                'groupss' => function ($query) {
                    $query->where('user_groups.status', 'pending');
                }
            ])
            ->get();
        return view('inviterequest', compact('myinvite'));
    }
    public function create()
    {
        return view('groupscreate');
    }
    public function store(GroupRequest $request)
    {
        $response = $this->groupService->createGroup($request->all());

        if ($response['status'] === 'error') {
            return redirect()->route('home')->with('error', $response['message']);
        }

        return redirect()->route('home')->with('success', $response['message']);
    }
    public function deletegroup($group_id)
    {
        $result = $this->groupService->deleteGroupById($group_id);

        if ($result['status'] === 'error') {
            return redirect()->back()->withErrors($result['message']);
        }

        return redirect()->back()->with('success', $result['message']);
    }
    public function sendRequest($groupId)
    {
        $response = $this->groupService->sendJoinRequest($groupId);
        if ($response['status'] === 'success') {
            return redirect()->back()->with('success', $response['message']);
        }
        return redirect()->back()->withErrors($response['message']);
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
