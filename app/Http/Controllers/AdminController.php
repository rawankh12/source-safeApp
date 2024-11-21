<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $allUser = User::count();
        $files = File::count();
        $groups = Group::count();
        return view('Admin.main', compact(['user', 'allUser', 'files', 'groups']));
    }
    public function setting()
    {
        $user = Auth::user();
        return view('Admin.setting', compact(['user']));
    }
    public function file()
    {
        $user = Auth::user();
        $countFiles = File::count();
        $directory = public_path('uploads');
        $files = scandir($directory);
        $filesWithDetails = [];
        $totalSize = 0;
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $filePath = $directory . '/' . $file;
            $fileCreationTime = filectime($filePath);
            $formattedDate = date('d-m-Y', $fileCreationTime);
            $fileSize = filesize($filePath);
            $totalSize += $fileSize;
            $filesWithDetails[] = [
                'file' => $file,
                'size' => $fileSize,
                'size_in_kb' => $fileSize / 1024,
                'size_in_mb' => $fileSize / 1048576,
                'created_at' => $formattedDate
            ];
        }
        // return  $totalSize;
        $totalSizeInMb = round($totalSize / 1048576, 2);
        return view('Admin.file', compact(['user', 'filesWithDetails', 'countFiles', 'totalSizeInMb']));
    }
    public function user()
    {
        $user = Auth::user();
        // = User::get();
        $allUsers = User::withCount([
            'files',    // عدد الملفات التي أضافها كل مستخدم
            'groups',
            'createdGroups'   // عدد المجموعات التي انضم إليها كل مستخدم
        ])->get();
        return view('Admin.friend', compact(['user', 'allUsers']));
    }

    public function downloadAllFiles()
    {
        $directory = public_path('uploads');
        $files = scandir($directory);
        $zip = new ZipArchive();
        $zipFileName = 'all_files_' . time() . '.zip';
        $zipFilePath = public_path($zipFileName);
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    $zip->addFile($directory . '/' . $file, $file);
                }
            }
            $zip->close();
            return response()->download($zipFilePath)->deleteFileAfterSend(true);
        }
        return response()->json(['error' => 'Failed to create ZIP file'], 500);
    }
}