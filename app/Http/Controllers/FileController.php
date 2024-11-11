<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\GroupFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
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


        // $existingFiles = DB::table('group_files')
        //     ->join('files', 'group_files.file_id', '=', 'files.id')
        //     ->join('groups', 'group_files.group_id', '=', 'groups.id')
        //     ->where('group_files.type', 'accepted')
        //     ->select('group_files.*', 'groups.name as group_name', 'files.name as file_name' , 'files.url as url' )
        //     ->get();
        // return $existingFiles;

        return view('memberfile', compact('group', 'existingFiles'));
    }

    public function userFile(Request $request)
    {
        $user = Auth::user();

        $groups = $user->groups;

        $group = $groups->first();

        // if (!$group) {
        //     return redirect()->back()->withErrors('No group found for the user');
        // }

        $Files = File::where('user_id', $user->id)
            // ->whereHas('groups', function ($query) use ($group) {
            //     $query->where('group_id', $group->id)
            // ->where('status', 'free');})
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

        // return $files;

        return view('lockedfile', compact('files'));

    }

    public function store(FileRequest $request)
    {
        $user = auth()->user();

        // $group = Group::where('id', $request->group_id)
        //     ->where('user_create', $user->name)
        //     ->first();
        // if (!$group) {
        //     return redirect()->back()->withErrors('YOU MUST CHOOSE YOUR GROUP');
        // }


        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = 'uploads/' . $fileName;
        $file->move(public_path('uploads'), $fileName);
        $file = File::create([
            'name' => $request->name,
            'url' => $filePath,
            'user_id' => $user->id,

        ]);

        // $file->groups()->attach(['status' => 'free']);

        return redirect()->back()->with('success', 'file created successfuly');
    }

    public function addToGroup(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'file_ids' => 'required|array',
            'file_ids.*' => 'exists:files,id',
            'group_id' => 'required|exists:groups,id',
        ]);

        $fileIds = $request->input('file_ids');
        $groupId = $request->input('group_id');

        $group = Group::find($groupId);

        foreach ($fileIds as $fileId) {
            if ($group->user_create === $user->name) {

                $group->files()->attach($fileId, ['type' => 'accepted']);
                return redirect()->back()->with('success', 'File added to group successfully.');
            } else {

                $group->files()->attach($groupId, [
                    'file_id' => $fileId,
                    'type' => 'pending'
                ]);
                return redirect()->back()->with('success', 'Request sent to group owner for file approval.');
            }
        }

        return redirect()->back()->with('success', 'Files added to group successfully.');
    }

    public function updatefile(FileRequest $request, $group_id, $id)
    {
        $user = Auth::id();

        $group = Group::find($group_id);
        if (!$group) {
            return redirect()->back()->with('error', 'Group not found');
        }

        $filee = File::where('id', $id)
            ->whereHas('groups', function ($query) use ($group_id, $user) {
                $query->where('groups.id', $group_id)
                    ->whereHas('users', function ($query) use ($user) {
                        $query->where('users.id', $user);
                    });
            })->first();

        if (!$filee) {
            return redirect()->back()->with('error', 'File not found');
        }

        $file = $request->file('file');

        $filee->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'File updated successfully');
    }

    public function deletefile($group_id, $file_id)
    {
        $user = Auth::user();
        $group = Group::find($group_id);

        if (!$group) {
            return redirect()->back()->withErrors('Group not found');
        }

        $file = File::where('id', $file_id)
            ->whereHas('groups', function ($query) use ($group_id, $user) {
                $query->where('groups.id', $group_id)
                    ->whereHas('users', function ($query) use ($user) {
                        $query->where('groups.user_create', $user->name);
                    });
            })
            ->first();

        if (!$file) {
            return redirect()->back()->withErrors('File not found and you\'re not the groupadmin ');
        }

        $pivot = $file->groups()->where('group_id', $group_id)->first()->pivot ?? null;

        if ($pivot && $pivot->status === 'blocked') {
            return redirect()->back()->withErrors('You cannot delete this file; it is either blocked or currently in use.');
        }

        if ($pivot && $pivot->status === 'free') {

            if ($user->id == $file->user_id) {
                $group->files()->detach($file);
                return redirect()->back()->with('success', 'File deleted from group');
            } else {
                return redirect()->back()->withErrors('Unauthorized');
            }
        }

        return redirect()->back()->withErrors('Unable to delete the file.');
    }

    public function blockfile(Request $request, $groupid, $fileid)
    {
        $user = Auth::user();

        $group = Group::find($groupid);
        if (!$group) {
            return redirect()->back()->with('error', 'Group not found');
        }

        $isMember = $group->users()->where('users.id', $user->id)->exists();
        if (!$isMember) {
            $isuser_create = $group->where('user_create', $user->name);
            if (!$isuser_create) {
                return redirect()->back()->withErrors('You are not a member or admin of this group.');
            }
        }

        $file = File::find($fileid);
        if (!$file) {
            return redirect()->back()->withErrors('File not found');
        }

        // $file = File::where('id', $fileid)
        //     ->whereHas('groups', function ($query) use ($group, $user) {
        //         $query->where('groups.id', $group->id)
        //             ->whereHas('users', function ($query) use ($user) {
        //                 $query->where('users.id', $user->id);
        //             });
        //     })
        //     ->first();

        // if (!$file) {
        //     return redirect()->back()->withErrors('File not found');
        // }

        $pivot = $file->groups()->where('group_id', $group->id)->first()->pivot ?? null;

        if ($pivot && $pivot->status === 'blocked') {
            return redirect()->back()->withErrors('It\'s already blocked');
        }

        if ($pivot && $pivot->status === 'free') {

            $file->groups()->updateExistingPivot($group->id, ['status' => 'blocked']);

            return redirect()->back()->with('success', 'The file was blocked successfully');
        }

        return redirect()->back()->withErrors('Unable to block the file.');
    }

    public function unblockfile(Request $request, $groupid, $fileid)
    {

        $user = Auth::user();

        $group = Group::find($groupid);
        if (!$group) {
            return redirect()->back()->with('error', 'Group not found');
        }

        $isMember = $group->users()->where('users.id', $user->id)->exists();
        if (!$isMember) {
            $isuser_create = $group->where('user_create', $user->name);
            if (!$isuser_create) {
                return redirect()->back()->withErrors('You are not a member or admin of this group.');
            }
        }

        $file = File::find($fileid);
        if (!$file) {
            return redirect()->back()->withErrors('File not found');
        }

        // $file = File::where('id', $fileid)
        //     ->whereHas('groups', function ($query) use ($group, $user) {
        //         $query->where('groups.id', $group->id)
        //             ->whereHas('users', function ($query) use ($user) {
        //                 $query->where('users.id', $user->id);
        //             });
        //     })
        //     ->first();

        // if (!$file) {
        //     return redirect()->back()->withErrors('File not found');
        // }

        $pivot = $file->groups()->where('group_id', $group->id)->first()->pivot ?? null;

        if ($pivot && $pivot->status === 'free') {
            return redirect()->back()->withErrors('It\'s already unblocked');
        }

        if ($pivot && $pivot->status === 'blocked') {

            $file->groups()->updateExistingPivot($group->id, ['status' => 'free']);

            return redirect()->back()->with('success', 'The file was unblocked successfully');
        }

        return redirect()->back()->withErrors('Unable to unblock the file.');
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
    public function uploadFile(Request $request, $file_id)
    {

        $request->validate([
            'file' => 'required|mimes:pdf,docx'
        ]);

        $fileRecord = File::find($file_id);

        if ($fileRecord && file_exists(public_path($fileRecord->url))) {

            unlink(public_path($fileRecord->url));
        }

        $originalName = pathinfo($fileRecord->url, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filename = $originalName . '.' . $extension;

        $filePath = 'uploads/' . $filename;
        $request->file('file')->move(public_path('uploads'), $filename);

        $fileRecord->url = $filePath;
        $fileRecord->save();

        return redirect()->back()->with('success', 'File replaced successfully!');
    }

}

