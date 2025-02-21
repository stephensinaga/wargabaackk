<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use App\Models\Assignment;

class AdminReportController extends Controller
{
    public function index() {
        $reports = Report::where('status', 'pending')->get();
        return view('admin.index', compact('reports'));
    }

    // Menerima atau menolak laporan
    public function verify(Request $request, $id) {
        $report = Report::findOrFail($id);
        $report->status = $request->status; // accepted atau rejected
        $report->save();

        return redirect()->route('admin.reports.index')->with('success', 'Laporan diperbarui!');
    }

    // Menampilkan halaman untuk assign petugas
    public function assignForm($id) {
        $report = Report::findOrFail($id);
        $officers = User::where('role', 'officer')->get();
        return view('admin.assign', compact('report', 'officers'));
    }

    // Meneruskan laporan ke petugas
    public function assign(Request $request, $id) {
        $request->validate(['officer_id' => 'required|exists:users,id']);

        Assignment::create([
            'report_id' => $id,
            'officer_id' => $request->officer_id,
            'status' => 'assigned'
        ]);

        $report = Report::findOrFail($id);
        $report->status = 'in_progress';
        $report->save();

        return redirect()->route('admin.reports.index')->with('success', 'Laporan diteruskan ke petugas!');
    }
}
