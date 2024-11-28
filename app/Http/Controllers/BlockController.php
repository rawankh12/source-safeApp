<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\User;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        $user = User::findOrFail($id);

        if (Block::where('user_id', $id)->exists()) {
            return response()->json(['message' => __('messages.user_already_banned')], 400);
        }

        Block::create(['user_id' => $id]);

        return response()->json(['message' => __('messages.user_banned_success')]);
    }

    public function unblockUser($userId)
    {
        $bannedUser = Block::where('user_id', $userId)->first();

        if (!$bannedUser) {
            return response()->json(['message' => __('messages.user_not_banned')], 400);
        }

        $bannedUser->delete();

        return response()->json(['message' => __('messages.user_unbanned_success')]);
    }

}
