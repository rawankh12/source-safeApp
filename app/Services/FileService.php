<?php

namespace App\Services;
use App\Events\FileStatusUpdated;
use App\jobs\LookFile;
use App\Models\Group;
use App\Models\Notification;
use App\Repositories\FileRepository;
use App\Repositories\GroupRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\FileBlockedNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FileService
{
    protected $fileRepository;
    private $groupRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(FileRepository $fileRepository, GroupRepository $groupRepository)
    {
        $this->fileRepository = $fileRepository;
        $this->groupRepository = $groupRepository;
    }
    public function storeFile($uploadedFile, $data)
    {
        $path = $this->uploadFile($uploadedFile);
        return $this->fileRepository->create([
            'name' => $data['name'],
            'url' => $path,
            'user_id' => auth()->id()
        ]);
    }
    public function uploadFile($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('uploads');
        $file->move($destinationPath, $fileName);
        return 'uploads/' . $fileName;
    }
    public function addFilesToGroup($user, array $fileIds, $groupId)
    {
        $group = $this->groupRepository->findg($groupId);
        if (!$group) {
            return ['status' => 'error', 'message' => __('messages.group_not_found')];
        }

        foreach ($fileIds as $fileId) {
            $file = $this->fileRepository->find($fileId);
            if (!$file) {
                return ['status' => 'error', 'message' => __('messages.file_not_found')];
            }

            if ($this->groupRepository->isFileAlreadyAttached($groupId, $fileId)) {
                return ['status' => 'error', 'message' => __('messages.file_already_added')];
            }
        }

        $attachmentType = $group->user_create === $user->name ? 'accepted' : 'pending';

        foreach ($fileIds as $fileId) {
            $this->groupRepository->attachFileToGroup($groupId, $fileId, $attachmentType);
        }

        return ['status' => 'success', 'message' => __('messages.files_added_successfully')];
    }
    public function blockFile(Request $request, $groupId)
    {
        $user = Auth::user();
        $group = $this->groupRepository->findg($groupId);

        if (!$group) {
            return ['status' => 'error', 'message' => __('messages.group_not_found')];
        }

        $isMember = $group->users()->where('users.id', $user->id)->exists();
        if (!$isMember && $group->user_create !== $user->name) {
            return ['status' => 'error', 'message' => __('messages.not_member_or_admin')];
        }

        $fileIds = $request->input('file_ids', []);
        if (empty($fileIds) || !is_array($fileIds)) {
            return ['status' => 'error', 'message' => __('messages.no_files_selected')];
        }

        $files = $this->fileRepository->findFilesWithGroup($fileIds, $groupId);

        if (count($files) !== count($fileIds)) {
            return ['status' => 'error', 'message' => __('messages.some_files_not_found')];
        }

        foreach ($files as $file) {
            $pivot = $file->groups()->where('group_id', $group->id)->first()->pivot ?? null;
            if (!$pivot || $pivot->status !== 'free') {
                LookFile::dispatch($file->id, $user->id, $groupId);
                return ['status' => 'error', 'message' => __('messages.files_must_be_free')];
            }
        }

        foreach ($files as $file) {
            $lockKey = 'file:' . $file->id . ':field_lock';
            $lock = Cache::add($lockKey, true, 300);

            if (!$lock) {
                return ['status' => 'error', 'message' => __('messages.file_locked', ['file' => $file->name])];
            }

            $this->fileRepository->updateFileStatus($file->id, $groupId, 'blocked');
            LookFile::dispatch($file->id, $user->id, $groupId)->delay(now()->addMinutes(5));

            foreach ($group->users as $member) {
                $member->notify(new FileBlockedNotification($user->name, $file->name, __('messages.blocked')));
            }

            $file->reports()->create([
                'report' => 'check_in',
                'user_id' => $user->id,
                'group_id' => $groupId,
            ]);
        }

        return ['status' => 'success', 'message' => __('messages.files_blocked_successfully')];
    }
    public function unblockFile($groupId, $fileId)
    {
        $user = Auth::user();
        $group = $this->groupRepository->findg($groupId);

        if (!$group) {
            return ['status' => 'error', 'message' => __('messages.group_not_found')];
        }

        // التحقق إذا كان المستخدم عضوًا أو مسؤولًا عن المجموعة
        $isMember = $group->users()->where('users.id', $user->id)->exists();
        if (!$isMember && $group->user_create !== $user->name) {
            return ['status' => 'error', 'message' => __('messages.not_member_or_admin')];
        }

        $file = $this->fileRepository->findFileWithGroup($fileId, $groupId);
        if (!$file) {
            return ['status' => 'error', 'message' => __('messages.file_not_found')];
        }

        $pivot = $file->groups()->where('group_id', $group->id)->first()->pivot ?? null;

        if ($pivot && $pivot->status === 'free') {
            return ['status' => 'error', 'message' => __('messages.file_already_unblocked')];
        }

        if ($pivot && $pivot->status !== 'blocked') {
            return ['status' => 'error', 'message' => __('messages.file_not_in_blocked_state')];
        }

        // محاولة الحصول على القفل
        $lockKey = 'file:' . $file->id . ':field_lock';
        if ($file && Cache::has($lockKey)) {
            Cache::forget($lockKey);
            $this->fileRepository->updateFileStatus($fileId, $groupId, 'free');

            // إضافة سجل تقرير
            DB::table('reports')->insert([
                'report' => 'check_out',
                'user_id' => $user->id,
                'file_id' => $fileId,
                'group_id' => $groupId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $group = Group::with('users')->findOrFail($groupId);
            $userName = auth()->user()->name;

            foreach ($group->users as $groupUser) {
                $groupUser->notify(new FileBlockedNotification($userName, $file->name, __('messages.unblocked')));
            }

            return ['status' => 'success', 'message' => __('messages.file_unblocked_success')];
        }

        return ['status' => 'error', 'message' => __('messages.file_not_locked_or_expired')];
    }
    public function updateFile(array $data, $groupId, $fileId, $userId)
    {
        $group = $this->groupRepository->findg($groupId);
        if (!$group) {
            return false;
        }

        $file = $this->fileRepository->findFileForGroupAndUser($fileId, $groupId, $userId);
        if (!$file) {
            return false;
        }

        return $this->fileRepository->updateFile($file, $data);
    }
    public function deleteFileFromGroup($groupId, $fileId, $user)
    {
        $group = $this->groupRepository->findg($groupId);
        if (!$group) {
            return ['status' => 'error', 'message' => __('messages.group_not_found')];
        }

        $file = $this->fileRepository->findFileInGroupForUser($fileId, $groupId, $user->name);
        if (!$file) {
            return ['status' => 'error', 'message' => __('messages.file_not_found_or_not_admin')];
        }

        $pivot = $this->groupRepository->getFilePivot($groupId, $fileId);
        if ($pivot && $pivot->status === 'blocked') {
            return ['status' => 'error', 'message' => __('messages.file_blocked_or_in_use')];
        }

        if ($pivot && $pivot->status === 'free') {
            if ($user->id == $file->user_id) {
                $this->groupRepository->detachFileFromGroup($groupId, $fileId);
                return ['status' => 'success', 'message' => __('messages.file_deleted')];
            } else {
                return ['status' => 'error', 'message' => __('messages.unauthorized')];
            }
        }

        return ['status' => 'error', 'message' => __('messages.unable_to_delete_file')];
    }
    public function uploadFille(Request $request, $fileId)
    {
        // البحث عن الملف في السجل
        $fileRecord = $this->fileRepository->find($fileId);

        if (!$fileRecord) {
            return ['status' => 'error', 'message' => __('messages.file_not_found')];
        }

        $groupId = $request->input('group_id');
        $pivot = $this->groupRepository->getFilePivot($groupId, $fileId);

        // التحقق من وجود الملف في النظام وحذفه
        $existingFilePath = public_path($fileRecord->url);
        if (file_exists($existingFilePath)) {
            unlink($existingFilePath);
        }

        // التحقق من صحة الملف المرفوع
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return ['status' => 'error', 'message' => __('messages.invalid_file_upload')];
        }

        // إنشاء اسم جديد للملف وحفظه
        $originalName = pathinfo($fileRecord->url, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filename = $originalName . '.' . $extension;
        $filePath = 'uploads/' . $filename;

        // نقل الملف إلى مجلد التحميلات
        $request->file('file')->move(public_path('uploads'), $filename);

        // تحديث مسار الملف في السجل
        $fileRecord->url = $filePath;
        $fileRecord->save();

        // تحديث حالة الملف في الجدول الوسيط إذا كان محجوزًا
        if ($pivot && $pivot->status === 'blocked') {
            $this->groupRepository->updateFilePivotStatus($groupId, $fileId, 'free');
        }

        return ['status' => 'success', 'message' => __('messages.file_replaced')];
    }
}
