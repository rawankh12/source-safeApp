<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getAllReportFile($file_id, $group_id)
    {
        // التحقق من أن المستخدم لديه صلاحية الوصول إلى هذه المجموعة
        $group = Group::findOrFail($group_id);
        if (!$group->users->contains(auth()->user())) {
            return redirect()->back()->with('error', __('messages.unauthorized_access'));
        }

        // جلب السجلات المرتبطة بالملف داخل المجموعة
        $reports = Report::where('group_id', $group_id)
            ->where('file_id', $file_id)
            ->with(['user', 'file']) // إضافة العلاقة مع المستخدم والملف
            ->get();
        $users = $reports->map(function ($report) {
            return $report->user;
        });
        return view('viewreport', compact('reports', 'group', 'users'));
    }
    public function getAllReportGroup($group_id)
    {
        $reports = Report::where('group_id', $group_id)->get();
        $users = $reports->map(function ($report) {
            return $report->user;
        });
        return view('viewreport', compact('reports', 'users'));
    }

    public function getAllReportUser($user_id)
    {
        $reports = Report::where('user_id', $user_id)->get();
        $users = $reports->map(function ($report) {
            return $report->user;
        });
        return $reports;
    }
}
