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
        return collect(['attendance_date', 'date', 'tanggal', 'check_in', 'created_at'])
            ->first(fn ($col) => Schema::hasColumn('attendances', $col)) ?? 'created_at';
    }

    private function getPayrollColumnMap(): array
    {
        $columns = Schema::hasTable('payrolls') ? Schema::getColumnListing('payrolls') : [];

        $periodCol = collect(['period', 'periode', 'month_year'])->first(fn ($c) => in_array($c, $columns));
        $monthCol  = collect(['month', 'bulan'])->first(fn ($c) => in_array($c, $columns));
        $yearCol   = collect(['year', 'tahun'])->first(fn ($c) => in_array($c, $columns));
        $dateCol   = collect(['payroll_date', 'date', 'tanggal', 'created_at'])->first(fn ($c) => in_array($c, $columns)) ?? 'created_at';

        $daysCol   = collect(['total_days', 'present_days', 'total_hadir', 'hadir'])->first(fn ($c) => in_array($c, $columns));
        $salaryCol = collect(['total_salary', 'net_salary', 'final_salary', 'total_gaji', 'gaji_bersih', 'amount'])->first(fn ($c) => in_array($c, $columns));
        $baseCol   = collect(['base_salary', 'monthly_salary', 'gaji_pokok'])->first(fn ($c) => in_array($c, $columns));

        return compact('columns', 'periodCol', 'monthCol', 'yearCol', 'dateCol', 'daysCol', 'salaryCol', 'baseCol');
    }

    public function index(Request $request)
    {
        $month   = (int) $request->get('month', now()->month);
        $year    = (int) $request->get('year', now()->year);
        $dateCol = $this->getAttendanceDateColumn();
        $map     = $this->getPayrollColumnMap();

        $payrolls = collect();
        if (Schema::hasTable('payrolls')) {
            $payQuery = Payroll::with('user');
            if ($map['monthCol'] && $map['yearCol']) {
                $payQuery->where($map['monthCol'], $month)->where($map['yearCol'], $year);
            } elseif ($map['periodCol']) {
                $payQuery->where($map['periodCol'], sprintf('%04d-%02d', $year, $month));
            } else {
                $payQuery->whereMonth($map['dateCol'], $month)->whereYear($map['dateCol'], $year);
            }
            $payrolls = $payQuery->get();
        }

        $attendances = Schema::hasTable('attendances')
            ? Attendance::with('user')
                ->whereMonth($dateCol, $month)
                ->whereYear($dateCol, $year)
                ->latest($dateCol)
                ->get()
            : collect();

        return view('admin.payrolls.index', compact('payrolls', 'attendances', 'month', 'year'));
    }

    public function generate(Request $request)
    {
        $month     = (int) $request->input('month', now()->month);
        $year      = (int) $request->input('year', now()->year);
        $dailyRate = (int) $request->input('daily_rate', 75000);
        $dateCol   = $this->getAttendanceDateColumn();
        $map       = $this->getPayrollColumnMap();

        $users = User::where('role', 'employee')->get();
        if ($users->isEmpty()) {
            $users = User::all();
        }

        foreach ($users as $user) {
            $presentDays = Schema::hasTable('attendances')
                ? Attendance::where('user_id', $user->id)
                    ->whereMonth($dateCol, $month)
                    ->whereYear($dateCol, $year)
                    ->count()
                : 0;

            $totalSalary = $presentDays * $dailyRate;

            $match = ['user_id' => $user->id];
            if ($map['monthCol'] && $map['yearCol']) {
                $match[$map['monthCol']] = $month;
                $match[$map['yearCol']]  = $year;
            } elseif ($map['periodCol']) {
                $match[$map['periodCol']] = sprintf('%04d-%02d', $year, $month);
            }

            $values = [];
            if ($map['daysCol']) {
                $values[$map['daysCol']] = $presentDays;
            }
            if ($map['baseCol']) {
                $values[$map['baseCol']] = $user->monthly_salary ?? $totalSalary;
            }
            if ($map['salaryCol']) {
                $values[$map['salaryCol']] = $totalSalary;
            }
            if (in_array('status', $map['columns'])) {
                $values['status'] = 'pending';
            }

            Payroll::updateOrCreate($match, $values);
        }

        return redirect()->route('admin.payrolls.index', ['month' => $month, 'year' => $year])
            ->with('success', 'Rekap gaji bulanan berhasil dihitung otomatis dari data presensi!');
    }

    public function markPaid(Payroll $payroll)
    {
        if (Schema::hasColumn('payrolls', 'status')) {
            $payroll->update(['status' => 'paid']);
        }

        return redirect()->back()->with('success', 'Status pembayaran gaji diperbarui menjadi Lunas!');
    }
}