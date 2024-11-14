<?php

namespace App\Repositories;

use App\Models\File;
use App\Models\Group;
use Illuminate\Support\Facades\DB;

class FileRepository implements FileRepositoryInterface
{
    public function create(array $data)
    {
        return File::create($data);
    }

    public function find($fileId)
    {
        return File::find($fileId);
    }

    public function findFileWithGroup($fileId, $groupId)
    {
        return File::where('id', $fileId)
            ->whereHas('groups', function ($query) use ($groupId) {
                $query->where('groups.id', $groupId);
            })
            ->first();
    }

    public function updateFileStatus($fileId, $groupId, $status)
    {
        return DB::table('group_files')
            ->where('file_id', $fileId)
            ->where('group_id', $groupId)
            ->update(['status' => $status]);
    }
    
    public function findFileForGroupAndUser($fileId, $groupId, $userId)
    {
        return File::where('id', $fileId)
            ->whereHas('groups', function ($query) use ($groupId, $userId) {
                $query->where('groups.id', $groupId)
                    ->whereHas('users', function ($query) use ($userId) {
                        $query->where('users.id', $userId);
                    });
            })->first();
    }

    public function updateFile($file, array $data)
    {
        return $file->update([
            'name' => $data['name'],
            'status' => $data['status']
        ]);
    }

    public function findFileInGroupForUser($fileId, $groupId, $username)
    {
        return File::where('id', $fileId)
            ->whereHas('groups', function ($query) use ($groupId, $username) {
                $query->where('groups.id', $groupId)
                    ->where('groups.user_create', $username);
            })->first();
    }

}