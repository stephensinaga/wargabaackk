<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminPetugasController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperAdminReportController;
use App\Http\Controllers\DashboardController;
use App\Models\User;
use App\Models\Report;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $total_users = User::count();
        $total_reports = Report::count();
        $total_admins = User::where('role', 'admin')->count();
        $pending_requests = Report::where('status', 'pending')->count();

        return view('dashboard', compact('total_users', 'total_reports', 'total_admins', 'pending_requests'));
    })->name('dashboard');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); // ✅ Pastikan nama route benar


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        return view('dashboard', compact('user'));
    })->name('dashboard');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('', 'loginview')->name('login.view');
    Route::post('login', 'loginWeb')->name('login.action');
    Route::post('logout', 'logoutWeb')->middleware('auth')->name('logout.web');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'Dashboard'])->name('Dashboard');


    Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
        Route::get('/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');
        Route::post('/reports/{id}/verify', [AdminReportController::class, 'verify'])->name('admin.reports.verify');
        Route::get('/reports/{id}/assign', [AdminReportController::class, 'assignForm'])->name('admin.reports.assignForm');
        Route::post('/reports/{id}/assign', [AdminReportController::class, 'assign'])->name('admin.reports.assign');

        Route::get('/petugas', [AdminPetugasController::class, 'index'])->name('admin.petugas.index');
        Route::get('/petugas/create', [AdminPetugasController::class, 'create'])->name('admin.petugas.create');
        Route::post('/petugas/store', [AdminPetugasController::class, 'store'])->name('admin.petugas.store');
        Route::get('/petugas/{id}/edit', [AdminPetugasController::class, 'edit'])->name('admin.petugas.edit');
        Route::put('/petugas/{id}', [AdminPetugasController::class, 'update'])->name('admin.petugas.update');
        Route::delete('/petugas/{id}', [AdminPetugasController::class, 'destroy'])->name('admin.petugas.destroy');
    });
});

Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');

    // Kelola Admin
    Route::get('/admin', [SuperAdminController::class, 'index'])->name('superadmin.admin.index');
    Route::get('/admin/create', [SuperAdminController::class, 'create'])->name('superadmin.admin.create');
    Route::post('/admin/store', [SuperAdminController::class, 'store'])->name('superadmin.admin.store');
    Route::get('/admin/{id}/edit', [SuperAdminController::class, 'edit'])->name('superadmin.admin.edit');
    Route::put('/admin/{id}', [SuperAdminController::class, 'update'])->name('superadmin.admin.update');
    Route::delete('/admin/{id}', [SuperAdminController::class, 'destroy'])->name('superadmin.admin.destroy');

    // Laporan Pengaduan
    Route::get('/reports', [SuperAdminReportController::class, 'index'])->name('superadmin.reports.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
