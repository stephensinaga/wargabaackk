<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class SuperAdminReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();

        // Definisikan kategori yang tersedia
        $categories = ['Infrastruktur', 'Keamanan', 'Lingkungan', 'Sosial']; // Sesuaikan dengan kategori yang ada

        return view('superadmin.reports.index', compact('reports', 'categories'));
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        return view('superadmin.reports.show', compact('report'));
    }
}
