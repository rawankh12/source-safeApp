<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GroupRepository;
use App\Models\User;

class GroupService
{
    protected $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function createGroup($data)
    {
        $user = Auth::user();

        if (!$user || !($user instanceof User)) {
            return ['status' => 'error', 'message' => 'User not authenticated'];
        }

        $group = $this->groupRepository->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'user_create' => $user->name,
        ]);

        $this->groupRepository->attachUserToGroup($user, $group);

        return ['status' => 'success', 'message' => 'Group created successfully.'];
    }

    public function deleteGroupById($group_id)
    {
        $user = Auth::user();

        $group = $this->groupRepository->findg($group_id);
        if (!$group) {
            return ['status' => 'error', 'message' => 'Group not found'];
        }

        $hasBlockedFiles = $this->groupRepository->hasBlockedFiles($group_id);
        if ($hasBlockedFiles) {
            return ['status' => 'error', 'message' => 'There is a blocked file; you cannot delete the group'];
        }

        $this->groupRepository->delete($group_id);
        return ['status' => 'success', 'message' => 'Group deleted successfully'];
    }

    public function sendJoinRequest($groupId)
    {
        $user = Auth::user();
        $existingRequest = $this->groupRepository->findExistingRequest($user->id, $groupId);
        if ($existingRequest) {
            return ['status' => 'error', 'message' => 'You have already sent a request for this group. Please wait for a response.'];
        }
        $this->groupRepository->createJoinRequest($user->id, $groupId);
        return ['status' => 'success', 'message' => 'Join request sent successfully.'];
    }

}
