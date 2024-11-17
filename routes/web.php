<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


Route::get('set-locale/{locale}', [LanguageController::class, 'setLocale'])->name('setLocale');

Auth::routes();

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrForm'])->name('register');
Route::get('/allgroups', action: [GroupController::class, 'index'])->name('allgroups');
Route::get('/code-verification', [EmailController::class, 'verification'])->name('code-verification');
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/home',  [HomeController::class, 'index'])->name('home');

// Route::get('/profile', function () {
//     return view('profile');
// })->name('profile');

Route::get('/profile', [UserController::class, 'indexx'])->name('profile');
Route::get('/JoinRequests', [GroupController::class, 'showJoinRequests'])->name('showJoinRequests');
Route::get('/fileRequests', [GroupController::class, 'showaddfileRequests'])->name('showaddfileRequests');
Route::get('/inviteRequests', [GroupController::class, 'showinviteRequests'])->name('showinviteRequests');


Route::group([], function () {
    Route::get('/adminHome', [AdminController::class, 'index'])->name('adminHome');
    Route::get('/adminSetting', [AdminController::class, 'setting'])->name('adminSetting');
    Route::get('/adminFile', [AdminController::class, 'file'])->name('adminFile');
    Route::get('/adminUser', [AdminController::class, 'user'])->name('adminUser');
    Route::get('/download-all-files', [AdminController::class, 'downloadAllFiles'])->name('download.all.files');
});
Route::group(['prefix' => 'groups'], function () {
    Route::get('/create', [GroupController::class, 'create'])->name('groups.create');
    Route::get('/', [GroupController::class, 'mygroup'])->name('mygroup');
    Route::get('/Amember', [GroupController::class, 'membergroup'])->name('membergroup');
    Route::post('/create', [GroupController::class, 'store'])->name('groups.store');
    Route::delete('/delete/{group_id}', [GroupController::class, 'deletegroup'])->name('deletegroup');
    Route::post('/sendrequest/{groupid}', [GroupController::class, 'sendrequest'])->name('sendrequest');
    Route::post('/acceptrequest/{userId}/{groupId}', [GroupController::class, 'acceptJoinRequest'])->name('acceptJoinRequest');
    Route::delete('/deleterequest/{userId}/{groupId}', [GroupController::class, 'deleteJoinRequest'])->name('deleteJoinRequest');
    Route::post('/accept/{fileId}/{groupId}', [GroupController::class, 'acceptRequest'])->name('acceptRequest');
    Route::delete('/delete/{fileId}/{groupId}', [GroupController::class, 'deleteRequest'])->name('deleteRequest');
});

Route::group(['prefix' => 'files'], function () {
    Route::get('/group/{id}', [FileController::class, 'showFiles'])->name('group.files');
    Route::get('/memberfile/{id}', [FileController::class, 'showmemberFiles'])->name('member.files');
    Route::get('/', [FileController::class, 'userFile'])->name('user.files');
    Route::get('/locked', [FileController::class, 'userlockedFile'])->name('user.lockedfiles');
    Route::get('/create', [FileController::class, 'createFile'])->name('files.create');
    Route::post('/add', [FileController::class, 'store'])->name('files.store');
    Route::post('/addToGroup', [FileController::class, 'addToGroup'])->name('addToGroup');
    Route::put('/update/{group_id}/{id}', [FileController::class, 'updatefile'])->name('updatefile');
    Route::delete('/delete/{group_id}/{file_id}', [FileController::class, 'deletefile'])->name('deletefile');
    Route::get('/blockfile/{groupid}/{fileid}', [FileController::class, 'blockfile'])->name('blockfile');
    Route::get('/unblockfile/{groupid}/{fileid}', [FileController::class, 'unblockfile'])->name('unblockfile');
    Route::post('/uploadfile/{file_id}', [FileController::class, 'uploadFile'])->name('uploadfile');
});

Route::get('/view-file/{filePath}', [FileController::class, 'viewFile'])->where('filePath', '.*');


Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index'])->name('users');
    Route::Post('/invite', [UserController::class, 'invite'])->name('invite');
    Route::get('/search', [UserController::class, 'search'])->name('search');
    Route::get('/invite', [UserController::class, 'inviteuser'])->name('inviteuser');
});
