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
    public function createGroup(array $data)
    {
        $user = Auth::user();

        // التحقق من صحة المستخدم
        if (!$user || !($user instanceof User)) {
            return ['status' => 'error', 'message' => __('messages.user_not_authenticated')];
        }

        // التحقق من وجود البيانات المطلوبة
        if (empty($data['name']) || empty($data['description'])) {
            return ['status' => 'error', 'message' => __('messages.missing_group_data')];
        }

        try {
            // إنشاء المجموعة
            $group = $this->groupRepository->create([
                'name' => $data['name'],
                'description' => $data['description'],
                'user_create' => $user->name,
            ]);

            // ربط المستخدم بالمجموعة
            $this->groupRepository->attachUserToGroup($user, $group);

            return ['status' => 'success', 'message' => __('messages.group_created')];
        } catch (\Exception $e) {
            // التعامل مع الأخطاء العامة
            return ['status' => 'error', 'message' => __('messages.group_creation_failed')];
        }
    }
    public function deleteGroupById($group_id)
    {
        $user = Auth::user();

        // التحقق من صحة المستخدم
        if (!$user || !($user instanceof User)) {
            return ['status' => 'error', 'message' => __('messages.user_not_authenticated')];
        }

        // التحقق من وجود المجموعة
        $group = $this->groupRepository->findg($group_id);
        if (!$group) {
            return ['status' => 'error', 'message' => __('messages.group_not_found')];
        }

        // التحقق من أن المستخدم هو منشئ المجموعة
        if ($group->user_create !== $user->name) {
            return ['status' => 'error', 'message' => __('messages.unauthorized_action')];
        }

        // التحقق من الملفات المحجوزة
        $hasBlockedFiles = $this->groupRepository->hasBlockedFiles($group_id);
        if ($hasBlockedFiles) {
            return ['status' => 'error', 'message' => __('messages.group_has_blocked_files')];
        }

        try {
            // حذف المجموعة
            $this->groupRepository->delete($group_id);
            return ['status' => 'success', 'message' => __('messages.group_deleted')];
        } catch (\Exception $e) {
            // التعامل مع الأخطاء غير المتوقعة
            return ['status' => 'error', 'message' => __('messages.group_deletion_failed')];
        }
    }
    public function sendJoinRequest($groupId)
    {
        $user = Auth::user();

        // التحقق من صحة المستخدم
        if (!$user || !($user instanceof User)) {
            return ['status' => 'error', 'message' => __('messages.user_not_authenticated')];
        }

        // التحقق من وجود المجموعة
        $group = $this->groupRepository->findg($groupId);
        if (!$group) {
            return ['status' => 'error', 'message' => __('messages.group_not_found')];
        }

        // التحقق من العضوية الحالية
        $isMember = $group->users()->where('users.id', $user->id)->exists();
        if ($isMember) {
            return ['status' => 'error', 'message' => __('messages.already_member')];
        }

        // التحقق من وجود طلب سابق
        $existingRequest = $this->groupRepository->findExistingRequest($user->id, $groupId);
        if ($existingRequest) {
            return ['status' => 'error', 'message' => __('messages.request_already_sent')];
        }

        // إرسال الطلب
        try {
            $this->groupRepository->createJoinRequest($user->id, $groupId);
            return ['status' => 'success', 'message' => __('messages.request_sent')];
        } catch (\Exception $e) {
            // التعامل مع الأخطاء غير المتوقعة
            return ['status' => 'error', 'message' => __('messages.request_failed')];
        }
    }
}
