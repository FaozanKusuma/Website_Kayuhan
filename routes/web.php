<?php

use App\Http\Controllers\AdminLocationController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminPackageController;
use App\Http\Controllers\AdminPayrollController;
use App\Http\Controllers\AdminTeamController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Models\Attendance;
use App\Models\Category;
use App\Models\Location;
use App\Models\Menu;
use App\Models\Package;
use App\Models\Schedule;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

// 1. Halaman Beranda Publik
Route::get('/', function () {
    $categories = Schema::hasTable('categories') ? Category::all() : collect();
    $menus      = Schema::hasTable('menus') ? Menu::with('category')->latest()->get() : collect();
    $teams      = Schema::hasTable('team_members') ? TeamMember::all() : collect();
    $locations  = Schema::hasTable('locations') ? Location::all() : collect();
    $schedules  = Schema::hasTable('schedules') ? Schedule::all() : collect();
    $packages   = Schema::hasTable('packages') ? Package::all() : collect();

    return view('public.index', compact('categories', 'menus', 'teams', 'locations', 'schedules', 'packages'));
})->name('home');

// 2. Pengarah Otomatis Rute /dashboard
Route::get('/dashboard', function () {
    $role = strtolower(trim(Auth::user()->role ?? ''));

    if (in_array($role, ['employee', 'karyawan', 'barista'])) {
        return redirect()->route('employee.dashboard');
    }

    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

// 3. Profil Akun Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Rute Khusus Panel Admin & Owner (Terlindungi Middleware EnsureUserIsAdmin)
Route::middleware(['auth', EnsureUserIsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $totalMenus      = Schema::hasTable('menus') ? Menu::count() : 0;
        $totalEmployees  = Schema::hasTable('users') ? User::where('role', 'employee')->count() : 0;
        $totalCategories = Schema::hasTable('categories') ? Category::count() : 0;

        $presentToday = 0;
        if (Schema::hasTable('attendances')) {
            $dateCol = collect(['date', 'attendance_date', 'tanggal', 'check_in', 'created_at'])
                ->first(fn ($col) => Schema::hasColumn('attendances', $col)) ?? 'created_at';

            $presentToday = Attendance::whereDate($dateCol, today())->count();
        }

        return view('admin.dashboard', compact('totalMenus', 'totalEmployees', 'presentToday', 'totalCategories'));
    })->name('dashboard');

    // Menu & Harga
    Route::resource('menus', AdminMenuController::class)->except(['show']);

    // Tim & Barista
    Route::resource('teams', AdminTeamController::class)->except(['show', 'create']);

    // Lokasi & Jadwal
    Route::resource('locations', AdminLocationController::class)->except(['show', 'create']);
    Route::post('/schedules', [AdminLocationController::class, 'storeSchedule'])->name('schedules.store');
    Route::delete('/schedules/{schedule}', [AdminLocationController::class, 'destroySchedule'])->name('schedules.destroy');

    // Paket Layanan
    Route::resource('packages', AdminPackageController::class)->except(['show', 'create']);

    // Akun Admin & Karyawan
    Route::resource('users', AdminUserController::class)->except(['show', 'create']);

    // Rekap Gaji & Absensi
    Route::get('/payrolls', [AdminPayrollController::class, 'index'])->name('payrolls.index');
    Route::post('/payrolls/generate', [AdminPayrollController::class, 'generate'])->name('payrolls.generate');
    Route::patch('/payrolls/{payroll}/pay', [AdminPayrollController::class, 'markPaid'])->name('payrolls.pay');
});

// 5. Rute Khusus Portal Karyawan / Barista
Route::middleware(['auth'])->prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('dashboard');
    Route::post('/attendance/check-in', [EmployeeController::class, 'checkIn'])->name('attendance.checkin');
    Route::post('/attendance/check-out', [EmployeeController::class, 'checkOut'])->name('attendance.checkout');
});

require __DIR__.'/auth.php';