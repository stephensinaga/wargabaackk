<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Report;

class DashboardController extends Controller
{
    public function index()
    {
        $total_users = User::count();
        $total_reports = Report::count();
        $total_admins = User::where('role', 'admin')->count();
        $total_superadmins = User::where('role', 'superadmin')->count();
        $pending_requests = Report::where('status', 'pending')->count();
        $total_rejected = Report::where('status', 'rejected')->count();
        $total_accepted = Report::where('status', 'accepted')->count();

        // Ambil 5 aktivitas terbaru dari tabel reports
        $recent_activities = Report::orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'total_users',
            'total_reports',
            'total_admins',
            'total_superadmins',
            'pending_requests',
            'total_rejected',
            'total_accepted',
            'recent_activities'
        ));
    }
}
