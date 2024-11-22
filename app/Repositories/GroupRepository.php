<?php

namespace App\Repositories;

use App\Models\File;
use App\Models\Group;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\DB;

class GroupRepository implements GroupRepositoryInterface
{

    public function findg($groupId)
    {
        return Group::find($groupId);
    }

    public function isFileAlreadyAttached($groupId, $fileId)
    {
        return Group::find($groupId)->files()->wherePivot('file_id', $fileId)->exists();
    }

    public function attachFileToGroup($groupId, $fileId, $type)
    {
        $group = Group::find($groupId);
        $group->files()->attach($fileId, ['type' => $type]);
    }
    public function getFilePivot($groupId, $fileId)
    {
        $group = $this->findg($groupId);
        return $group ? $group->files()->where('file_id', $fileId)->first()->pivot ?? null : null;
    }

    public function detachFileFromGroup($groupId, $fileId)
    {
        $group = $this->findg($groupId);
        if ($group) {
            $group->files()->detach($fileId);
        }
    }

    public function updateFilePivotStatus($groupId, $fileId, $status)
    {
        $group = Group::find($groupId);
        if ($group) {
            $group->files()->updateExistingPivot($fileId, ['status' => $status]);
        }
    }

    public function create(array $data)
    {
        return Group::create($data);
    }

    public function attachUserToGroup(User $user, Group $group)
    {
        $user->groups()->attach($group);
    }

    public function hasBlockedFiles($group_id)
    {
        $group = Group::find($group_id);
        if (!$group) {
            return false;
        }
        return $group->files()->where('status', 'blocked')->exists();
    }

    public function delete($group_id)
    {
        $group = Group::find($group_id);
        if ($group) {
            $group->delete();
        }
    }

    public function findExistingRequest($userId, $groupId)
    {
        return DB::table('user_groups')
            ->where('user_id', $userId)
            ->where('group_id', $groupId)
            ->first();
    }

    public function createJoinRequest($userId, $groupId)
    {

        return UserGroup::create([
            'user_id' => $userId,
            'group_id' => $groupId,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}