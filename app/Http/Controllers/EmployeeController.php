<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class EmployeeController extends Controller
{
    private function nowWib(): Carbon
    {
        return Carbon::now('Asia/Jakarta');
    }

    private function getDateColumn(): string
    {
        return collect(['attendance_date', 'date', 'tanggal', 'check_in', 'created_at'])
            ->first(fn ($col) => Schema::hasColumn('attendances', $col)) ?? 'created_at';
    }

    private function getCheckInColumn(): ?string
    {
        return collect(['check_in', 'clock_in', 'jam_masuk', 'waktu_masuk'])
            ->first(fn ($col) => Schema::hasColumn('attendances', $col));
    }

    private function getCheckOutColumn(): ?string
    {
        return collect(['check_out', 'clock_out', 'jam_pulang', 'waktu_pulang'])
            ->first(fn ($col) => Schema::hasColumn('attendances', $col));
    }

    private function resolveAttendanceStatusValue(array $colMeta): string
    {
        $typeStr = $colMeta['type'] ?? '';

        if (preg_match("/^enum\((.*)\)$/i", $typeStr, $matches)) {
            $options = array_map(
                fn ($val) => trim($val, " '\"`"),
                explode(',', $matches[1])
            );

            foreach (['present', 'hadir', 'masuk'] as $preferred) {
                foreach ($options as $opt) {
                    if (strcasecmp($opt, $preferred) === 0) {
                        return $opt;
                    }
                }
            }

            return $options[0] ?? 'present';
        }

        return 'present';
    }

    public function dashboard()
    {
        $user    = Auth::user();
        $now     = $this->nowWib();
        $dateCol = $this->getDateColumn();

        $todayAttendance = Attendance::where('user_id', $user->id)
            ->whereDate($dateCol, $now->toDateString())
            ->first();

        $attendances = Attendance::where('user_id', $user->id)
            ->whereMonth($dateCol, $now->month)
            ->whereYear($dateCol, $now->year)
            ->latest($dateCol)
            ->get();

        $latestPay = null;
        if (Schema::hasTable('payrolls')) {
            $payQuery = Payroll::where('user_id', $user->id);

            if (Schema::hasColumn('payrolls', 'month') && Schema::hasColumn('payrolls', 'year')) {
                $latestPay = $payQuery->where('month', $now->month)->where('year', $now->year)->first();
            } elseif (Schema::hasColumn('payrolls', 'bulan') && Schema::hasColumn('payrolls', 'tahun')) {
                $latestPay = $payQuery->where('bulan', $now->month)->where('tahun', $now->year)->first();
            } elseif (Schema::hasColumn('payrolls', 'period')) {
                $latestPay = $payQuery->where('period', $now->format('Y-m'))->first();
            } elseif (Schema::hasColumn('payrolls', 'periode')) {
                $latestPay = $payQuery->where('periode', $now->format('Y-m'))->first();
            } else {
                $payDateCol = collect(['payroll_date', 'date', 'tanggal', 'created_at'])
                    ->first(fn ($col) => Schema::hasColumn('payrolls', $col)) ?? 'created_at';

                $latestPay = $payQuery->whereMonth($payDateCol, $now->month)
                    ->whereYear($payDateCol, $now->year)
                    ->first();
            }
        }

        return view('employee.dashboard', compact('user', 'todayAttendance', 'attendances', 'latestPay'));
    }

    public function checkIn(Request $request)
    {
        $user    = Auth::user();
        $now     = $this->nowWib();
        $dateCol = $this->getDateColumn();

        $alreadyPresent = Attendance::where('user_id', $user->id)
            ->whereDate($dateCol, $now->toDateString())
            ->exists();

        if ($alreadyPresent) {
            return redirect()->route('employee.dashboard')
                ->with('info', 'Anda sudah melakukan presensi masuk hari ini.');
        }

        $data = ['user_id' => $user->id];

        if (in_array($dateCol, ['attendance_date', 'date', 'tanggal'])) {
            $data[$dateCol] = $now->toDateString();
        }

        $checkInCol = $this->getCheckInColumn();
        if ($checkInCol) {
            $colType = Schema::getColumnType('attendances', $checkInCol);
            $data[$checkInCol] = ($colType === 'time') ? $now->format('H:i:s') : $now->toDateTimeString();
        }

        $columnsMeta = collect(Schema::getColumns('attendances'));
        $statusCol   = $columnsMeta->first(fn ($col) => in_array($col['name'], ['attendance_status', 'status']));

        if ($statusCol) {
            $data[$statusCol['name']] = $this->resolveAttendanceStatusValue($statusCol);
        }

        Attendance::create($data);

        return redirect()->route('employee.dashboard')
            ->with('success', 'Presensi masuk berhasil dicatat pada pukul ' . $now->format('H:i') . ' WIB.');
    }

    public function checkOut(Request $request)
    {
        $user        = Auth::user();
        $now         = $this->nowWib();
        $dateCol     = $this->getDateColumn();
        $checkOutCol = $this->getCheckOutColumn();

        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate($dateCol, $now->toDateString())
            ->first();

        if (!$attendance) {
            return redirect()->route('employee.dashboard')
                ->with('info', 'Silakan lakukan presensi masuk terlebih dahulu.');
        }

        if ($checkOutCol && empty($attendance->{$checkOutCol})) {
            $colType = Schema::getColumnType('attendances', $checkOutCol);
            $val     = ($colType === 'time') ? $now->format('H:i:s') : $now->toDateTimeString();
            $attendance->update([$checkOutCol => $val]);
        }

        return redirect()->route('employee.dashboard')
            ->with('success', 'Presensi pulang berhasil dicatat pada pukul ' . $now->format('H:i') . ' WIB.');
    }
}