<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Jobs\LookFile;
use App\Models\GroupFile;
use App\Services\FileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    protected $fileService;
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }
    public function showFiles($id)
    {
        $user = Auth::user();
        $group = Group::findOrFail($id);
        if (!$group) {
            return redirect()->back()->withErrors('No group found for the user');
        }
        $existingFiles = $group->acceptedfiles;
        return view('indexfile', compact('group', 'existingFiles'));
    }
    public function showmemberFiles($id)
    {
        $user = Auth::user();
        $group = Group::findOrFail($id);
        if (!$group) {
            return redirect()->back()->withErrors('No group found for the user');
        }
        $existingFiles = $group->acceptedfiles;
        return view('memberfile', compact('group', 'existingFiles'));
    }
    public function userFile(Request $request)
    {
        $user = Auth::user();
        $groups = $user->groups;
        $group = $groups->first();
        $Files = File::where('user_id', $user->id)
            ->get();
        return view('indexuser', compact('Files', 'group'));
    }
    public function userlockedFile(Request $request)
    {
        $user = Auth::user();
        $files = File::where('user_id', $user->id)
            ->whereHas('groups', function ($query) {
                $query->where('status', 'blocked');
            })
            ->with([
                'groups' => function ($query) {
                    $query->where('status', 'blocked');
                }
            ])
            ->get();
        return view('lockedfile', compact('files'));
    }
    public function store(Request $request, FileService $fileService)
    {
        $this->validate($request, ['file' => 'required|mimes:pdf,docx']);
        $fileService->storeFile($request->file('file'), $request->all());
        return redirect()->back()->with('success', 'File created successfully');
    }
    public function addToGroup(Request $request, FileService $fileService)
    {
        $user = Auth::user();
        $request->validate([
            'file_ids' => 'required|array',
            'file_ids.*' => 'exists:files,id',
            'group_id' => 'required|exists:groups,id',
        ]);
        $fileIds = $request->input('file_ids');
        $groupId = $request->input('group_id');
        $result = $fileService->addFilesToGroup($user, $fileIds, $groupId);
        if ($result['status'] === 'success') {
            return redirect()->back()->with('success', $result['message']);
        } else {
            return redirect()->back()->withErrors($result['message']);
        }
    }
    public function updateFile(FileRequest $request, $groupId, $fileId)
    {
        try {
            $userId = Auth::id();
            $updated = $this->fileService->updateFile($request->validated(), $groupId, $fileId, $userId);

            if ($updated) {
                return redirect()->back()->with('success', 'File updated successfully');
            } else {
                return redirect()->back()->withErrors('File or Group not found');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function deleteFile($groupId, $fileId)
    {
        $user = Auth::user();
        try {
            $result = $this->fileService->deleteFileFromGroup($groupId, $fileId, $user);

            if ($result['status'] === 'success') {
                return redirect()->back()->with('success', $result['message']);
            }

            return redirect()->back()->withErrors($result['message']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('An error occurred while deleting the file.');
        }
    }
    public function blockFile(Request $request, $groupId, $fileId)
    {
        $response = $this->fileService->blockFile($groupId, $fileId);
        if ($response['status'] === 'success') {
            return redirect()->back()->with('success', $response['message']);
            $delayedjob = (new LookFile($fileId, $user->id, $groupId));
        }
        return redirect()->back()->withErrors($response['message']);
    }
    public function unblockFile(Request $request, $groupId, $fileId)
    {
        $response = $this->fileService->unblockFile($groupId, $fileId);
        if ($response['status'] === 'success') {
            return redirect()->back()->with('success', $response['message']);
        }
        return redirect()->back()->withErrors($response['message']);
    }
    public function viewFile($filePath)
    {

        $path = public_path($filePath);

        if (!file_exists($path)) {
            abort(404);
        }

        $file = file_get_contents($path);
        $type = mime_content_type($path);

        return response($file, 200)
            ->header('Content-Type', $type)
            ->header('Content-Disposition', 'inline; filename="' . basename($path) . '"');
    }
    public function uploadFile(Request $request, $fileId)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,docx'
        ]);

        try {
            $result = $this->fileService->uploadFille($request, $fileId);

            if ($result['status'] === 'success') {
                return redirect()->back()->with('success', $result['message']);
            }

            return redirect()->back()->withErrors($result['message']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('An error occurred while uploading the file.');
        }
    }
}
