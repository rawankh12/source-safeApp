<?php

namespace App\Services;
use App\Repositories\FileRepository;
use App\Repositories\GroupRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return ['status' => 'error', 'message' => 'Group not found.'];
        }

        foreach ($fileIds as $fileId) {
            $file = $this->fileRepository->find($fileId);
            if (!$file) {
                return ['status' => 'error', 'message' => 'One of the files was not found.'];
            }

            if ($this->groupRepository->isFileAlreadyAttached($groupId, $fileId)) {
                return ['status' => 'error', 'message' => 'One or more files are already added.'];
            }
        }

        $attachmentType = $group->user_create === $user->name ? 'accepted' : 'pending';

        foreach ($fileIds as $fileId) {
            $this->groupRepository->attachFileToGroup($groupId, $fileId, $attachmentType);
        }

        return ['status' => 'success', 'message' => 'Files successfully added.'];
    }

    public function blockFile($groupId, $fileId)
    {
        $user = Auth::user();
        $group = $this->groupRepository->findg($groupId);

        if (!$group) {
            return ['status' => 'error', 'message' => 'Group not found'];
        }

        $isMember = $group->users()->where('users.id', $user->id)->exists();
        if (!$isMember && $group->user_create !== $user->name) {
            return ['status' => 'error', 'message' => 'You are not a member or admin of this group.'];
        }

        $file = $this->fileRepository->findFileWithGroup($fileId, $groupId);
        if (!$file) {
            return ['status' => 'error', 'message' => 'File not found'];
        }

        $pivot = $file->groups()->where('group_id', $group->id)->first()->pivot ?? null;

        if ($pivot && $pivot->status === 'blocked') {
            return ['status' => 'error', 'message' => 'It\'s already blocked'];
        }

        if ($pivot && $pivot->status === 'free') {
            $this->fileRepository->updateFileStatus($fileId, $groupId, 'blocked');
            return ['status' => 'success', 'message' => 'The file was blocked successfully'];
        }

        return ['status' => 'error', 'message' => 'Unable to block the file.'];
    }

    public function unblockFile($groupId, $fileId)
    {
        $user = Auth::user();
        $group = $this->groupRepository->findg($groupId);

        if (!$group) {
            return ['status' => 'error', 'message' => 'Group not found'];
        }

        $isMember = $group->users()->where('users.id', $user->id)->exists();
        if (!$isMember && $group->user_create !== $user->name) {
            return ['status' => 'error', 'message' => 'You are not a member or admin of this group.'];
        }

        $file = $this->fileRepository->findFileWithGroup($fileId, $groupId);
        if (!$file) {
            return ['status' => 'error', 'message' => 'File not found'];
        }

        $pivot = $file->groups()->where('group_id', $group->id)->first()->pivot ?? null;

        if ($pivot && $pivot->status === 'free') {
            return ['status' => 'error', 'message' => 'It\'s already unblocked'];
        }

        if ($pivot && $pivot->status === 'blocked') {
            $this->fileRepository->updateFileStatus($fileId, $groupId, 'free');
            return ['status' => 'success', 'message' => 'The file was unblocked successfully'];
        }

        return ['status' => 'error', 'message' => 'Unable to block the file.'];
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
            return ['status' => 'error', 'message' => 'Group not found'];
        }

        $file = $this->fileRepository->findFileInGroupForUser($fileId, $groupId, $user->name);
        if (!$file) {
            return ['status' => 'error', 'message' => 'File not found or you are not the group admin'];
        }

        $pivot = $this->groupRepository->getFilePivot($groupId, $fileId);
        if ($pivot && $pivot->status === 'blocked') {
            return ['status' => 'error', 'message' => 'You cannot delete this file; it is either blocked or currently in use.'];
        }

        if ($pivot && $pivot->status === 'free') {
            if ($user->id == $file->user_id) {
                $this->groupRepository->detachFileFromGroup($groupId, $fileId);
                return ['status' => 'success', 'message' => 'File deleted from group'];
            } else {
                return ['status' => 'error', 'message' => 'Unauthorized'];
            }
        }

        return ['status' => 'error', 'message' => 'Unable to delete the file'];
    }

    public function uploadFille(Request $request, $fileId)
    {
        $fileRecord = $this->fileRepository->find($fileId);

        if (!$fileRecord) {
            return ['status' => 'error', 'message' => 'File not found'];
        }

        $groupId = $request->input('group_id');
        $pivot = $this->groupRepository->getFilePivot($groupId, $fileId);

        // Handle file replacement if it exists
        if (file_exists(public_path($fileRecord->url))) {
            unlink(public_path($fileRecord->url));
        }

        // Generate new file name and save it
        $originalName = pathinfo($fileRecord->url, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filename = $originalName . '.' . $extension;
        $filePath = 'uploads/' . $filename;
        $request->file('file')->move(public_path('uploads'), $filename);

        $fileRecord->url = $filePath;
        $fileRecord->save();

        // Update pivot status if needed
        if ($pivot && $pivot->status === 'blocked') {
            $this->groupRepository->updateFilePivotStatus($groupId, $fileId, 'free');
        }

        return ['status' => 'success', 'message' => 'File replaced successfully!'];
    }

}
