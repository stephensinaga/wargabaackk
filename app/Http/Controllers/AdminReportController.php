<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use App\Models\Assignment;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::query();

        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Ambil data setelah filter
        $reports = $query->get();

        // Ambil kategori unik dari database untuk dropdown
        $categories = Report::select('category')->distinct()->pluck('category');

        // Ambil semua petugas
        $officers = User::where('role', 'petugas')->get();

        return view('admin.index', compact('reports', 'officers', 'categories'));
    }


    // Menerima atau menolak laporan
    public function verify(Request $request, $id)
    {
        $report = Report::findOrFail($id);

        if ($request->status == 'accepted') {
            // Tampilkan modal pemilihan petugas
            return redirect()->route('admin.reports.assignForm', $id);
        } else {
            // Jika ditolak, langsung update status
            $report->status = 'rejected';
            $report->save();
            return redirect()->route('admin.reports.index')->with('success', 'Laporan ditolak!');
        }
    }


    // Menampilkan halaman untuk assign petugas
    public function assignForm($id)
    {
        $report = Report::findOrFail($id);
        $officers = User::where('role', 'officer')->get();
        return view('admin.assign', compact('report', 'officers'));
    }

    // Meneruskan laporan ke petugas
    public function assign(Request $request, $id)
    {
        $request->validate(['officer_id' => 'required|exists:users,id']);

        Assignment::create([
            'report_id' => $id,
            'officer_id' => $request->officer_id,
            'status' => 'assigned'
        ]);

        $report = Report::findOrFail($id);
        $report->status = 'accepted';
        $report->save();

        return redirect()->route('admin.reports.index')->with('success', 'Laporan diteruskan ke petugas!');
    }
}
