<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminPayrollController extends Controller
{
    private function getAttendanceDateColumn(): string
    {
        return collect(['date', 'attendance_date', 'tanggal', 'check_in', 'created_at'])
            ->first(fn ($col) => Schema::hasColumn('attendances', $col)) ?? 'created_at';
    }

    private function getPayrollColumns(): array
    {
        return [
            'month'  => Schema::hasColumn('payrolls', 'month') ? 'month' : 'bulan',
            'year'   => Schema::hasColumn('payrolls', 'year') ? 'year' : 'tahun',
            'days'   => collect(['total_days', 'total_hadir', 'hadir'])->first(fn ($col) => Schema::hasColumn('payrolls', $col)) ?? 'total_days',
            'salary' => collect(['total_salary', 'total_gaji', 'gaji_bersih'])->first(fn ($col) => Schema::hasColumn('payrolls', $col)) ?? 'total_salary',
        ];
    }

    public function index(Request $request)
    {
        $month   = (int) $request->get('month', now()->month);
        $year    = (int) $request->get('year', now()->year);
        $dateCol = $this->getAttendanceDateColumn();
        $cols    = $this->getPayrollColumns();

        $payrolls = Payroll::with('user')
            ->where($cols['month'], $month)
            ->where($cols['year'], $year)
            ->get();

        $attendances = Attendance::with('user')
            ->whereMonth($dateCol, $month)
            ->whereYear($dateCol, $year)
            ->latest($dateCol)
            ->get();

        return view('admin.payrolls.index', compact('payrolls', 'attendances', 'month', 'year'));
    }

    public function generate(Request $request)
    {
        $month     = (int) $request->input('month', now()->month);
        $year      = (int) $request->input('year', now()->year);
        $dailyRate = (int) $request->input('daily_rate', 75000);
        $dateCol   = $this->getAttendanceDateColumn();
        $cols      = $this->getPayrollColumns();

        $users = User::all();

        foreach ($users as $user) {
            $presentDays = Attendance::where('user_id', $user->id)
                ->whereMonth($dateCol, $month)
                ->whereYear($dateCol, $year)
                ->count();

            $totalSalary = $presentDays * $dailyRate;

            $data = [
                $cols['days']   => $presentDays,
                $cols['salary'] => $totalSalary,
            ];

            if (Schema::hasColumn('payrolls', 'status')) {
                $data['status'] = 'pending';
            }

            Payroll::updateOrCreate(
                [
                    'user_id'      => $user->id,
                    $cols['month'] => $month,
                    $cols['year']  => $year,
                ],
                $data
            );
        }

        return redirect()->route('admin.payrolls.index', ['month' => $month, 'year' => $year])
            ->with('success', 'Rekap gaji bulanan berhasil dihitung otomatis dari data presensi!');
    }

    public function markPaid(Payroll $payroll)
    {
        if (Schema::hasColumn('payrolls', 'status')) {
            $payroll->update(['status' => 'paid']);
        }

        return redirect()->back()->with('success', 'Status gaji diperbarui menjadi Lunas!');
    }
}