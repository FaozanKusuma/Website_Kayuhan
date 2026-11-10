<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payroll;
use App\Models\Attendance;
use Carbon\Carbon;

class PayrollController extends Controller
{
    // Fungsi ini akan dipanggil saat Admin menekan tombol "Hitung Gaji Bulanan"
    public function calculateMonthlySalary()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Ambil semua pengguna yang berstatus karyawan aktif
        $karyawans = User::where('role', 'karyawan')->where('is_active', true)->get();

        foreach ($karyawans as $karyawan) {
            // Hitung jumlah hari potongan di bulan ini (kolom is_salary_deductible bernilai true)
            $deductionDays = Attendance::where('user_id', $karyawan->id)
                ->whereMonth('attendance_date', $currentMonth)
                ->whereYear('attendance_date', $currentYear)
                ->where('is_salary_deductible', true)
                ->count();

            // Aturan sesuai proposal: Gaji pokok Rp 1.200.000 dan potongan Rp 40.000/hari
            $baseSalary = $karyawan->monthly_salary ?? 1200000;
            $deductionPerDay = 40000;
            
            // Rumus perhitungan
            $totalDeduction = $deductionDays * $deductionPerDay;
            $netSalary = $baseSalary - $totalDeduction;

            // Simpan ke database (updateOrCreate agar tidak ada data ganda di bulan yang sama)
            Payroll::updateOrCreate(
                [
                    'user_id' => $karyawan->id,
                    'period_month' => $currentMonth,
                    'period_year' => $currentYear,
                ],
                [
                    'base_salary' => $baseSalary,
                    'deduction_days' => $deductionDays,
                    'deduction_per_day' => $deductionPerDay,
                    'total_deduction' => $totalDeduction,
                    'net_salary' => $netSalary,
                ]
            );
        }

        return redirect()->back()->with('success', 'Berhasil! Gaji bulanan seluruh karyawan telah dihitung dan direkap ke database.');
    }
}