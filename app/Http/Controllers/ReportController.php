<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getAllReportFile($file_id, $group_id)
    {
        $reports = Report::where('group_id', $group_id)
            ->where('file_id', $file_id)
            ->with('user')
            ->get();
        // $users = $reports->map(function ($report) {
        //     return $report->user; // هذا سيعيد المستخدم المرتبط بكل تقرير
        // });
        return $reports;
    }
    public function getAllReportGroup($group_id)
    {
        $reports = Report::where('group_id', $group_id)->get();
        $users = $reports->map(function ($report) {
            return $report->user;
        });
        return view('viewreport',compact('reports','users'));
        // return $reports;
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
