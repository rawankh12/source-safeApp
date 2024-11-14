<?php

namespace App\Repositories;
use App\Models\User;
use App\Models\File;
use App\Models\Group;

interface GroupRepositoryInterface
{
    public function findg($groupId);
    public function isFileAlreadyAttached($groupId, $fileId);
    public function attachFileToGroup($groupId, $fileId, $type);
    public function getFilePivot($groupId, $fileId);
    public function detachFileFromGroup($groupId, $fileId);
    public function updateFilePivotStatus($groupId, $fileId, $status);
    public function create(array $data);
    public function attachUserToGroup(User $user, Group $group);
    public function hasBlockedFiles($group_id);
    public function delete($group_id);
    public function findExistingRequest($userId, $groupId);
    public function createJoinRequest($userId, $groupId);
    
}
