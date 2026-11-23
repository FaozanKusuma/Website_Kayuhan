<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portal Karyawan - Kayuhan Street Coffee</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-800">

    @php
        $nowWib = \Illuminate\Support\Carbon::now('Asia/Jakarta')->locale('id');
    @endphp

    <!-- Topbar Karyawan -->
    <header class="bg-[#1b3b2b] text-white shadow-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="font-bold text-lg tracking-wide">Kayuhan Barista Portal</span>
                <span class="text-[11px] bg-amber-400 text-[#1b3b2b] px-2.5 py-0.5 rounded-full font-bold uppercase">
                    {{ $user->role ?? 'Employee' }}
                </span>
            </div>

            <div class="flex items-center gap-4 text-sm">
                <span class="hidden sm:inline text-gray-200 font-medium">{{ $user->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-white/10 hover:bg-red-600 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 py-8 space-y-6">

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 font-bold">&times;</button>
            </div>
        @endif

        @if (session('info'))
            <div class="bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-lg text-sm flex items-center justify-between">
                <span>{{ session('info') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-amber-700 font-bold">&times;</button>
            </div>
        @endif

        <!-- Kartu Presensi Harian & Jam Real-Time WIB -->
        <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-200 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 border border-emerald-100 px-3 py-1 rounded-full">
                    <span>{{ $nowWib->translatedFormat('l, d F Y') }}</span>
                    <span>&bull;</span>
                    <span id="live-clock" class="tabular-nums">{{ $nowWib->format('H:i:s') }}</span>
                    <span>WIB</span>
                </div>

                <h1 class="text-2xl font-bold text-gray-900 mt-3">Halo, {{ $user->name }}!</h1>
                <p class="text-sm text-gray-600 mt-1">
                    @if ($todayAttendance)
                        @php
                            $todayIn = $todayAttendance->check_in ?? $todayAttendance->clock_in ?? $todayAttendance->jam_masuk ?? $todayAttendance->created_at;
                        @endphp
                        Status hari ini: <span class="font-semibold text-emerald-700">Sudah Absen Masuk ({{ \Carbon\Carbon::parse($todayIn)->format('H:i') }} WIB)</span>
                    @else
                        Anda belum melakukan presensi masuk hari ini.
                    @endif
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                @if (!$todayAttendance)
                    <form action="{{ route('employee.attendance.checkin') }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit" class="w-full sm:w-auto bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-6 py-3 rounded-lg text-sm font-semibold shadow-sm transition">
                            Absen Masuk Sekarang
                        </button>
                    </form>
                @else
                    <span class="px-4 py-2.5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold uppercase">
                        {{ $todayAttendance->attendance_status ?? $todayAttendance->status ?? 'Hadir' }}
                    </span>

                    @php
                        $checkOutVal = $todayAttendance->check_out ?? $todayAttendance->clock_out ?? $todayAttendance->jam_pulang ?? null;
                        $hasCheckOutCol = \Illuminate\Support\Facades\Schema::hasColumn('attendances', 'check_out')
                            || \Illuminate\Support\Facades\Schema::hasColumn('attendances', 'clock_out')
                            || \Illuminate\Support\Facades\Schema::hasColumn('attendances', 'jam_pulang');
                    @endphp

                    @if ($hasCheckOutCol && empty($checkOutVal))
                        <form action="{{ route('employee.attendance.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-amber-400 hover:bg-amber-500 text-[#1b3b2b] px-5 py-2.5 rounded-lg text-sm font-semibold transition">
                                Absen Pulang
                            </button>
                        </form>
                    @elseif (!empty($checkOutVal))
                        <span class="px-4 py-2.5 rounded-lg bg-gray-100 border border-gray-200 text-gray-700 text-xs font-semibold">
                            Pulang: {{ \Carbon\Carbon::parse($checkOutVal)->format('H:i') }} WIB
                        </span>
                    @endif
                @endif
            </div>
        </div>

        <!-- Ringkasan Kehadiran & Gaji Bulan Ini -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <p class="text-xs font-semibold uppercase text-gray-500">Total Hadir Bulan Ini</p>
                <p class="text-3xl font-extrabold text-gray-900 mt-2">{{ $attendances->count() }} Hari</p>
                <p class="text-xs text-emerald-600 mt-1">Periode {{ $nowWib->translatedFormat('F Y') }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <p class="text-xs font-semibold uppercase text-gray-500">Gaji Pokok / Rekap Bulan Ini</p>
                @php
                    $salaryAmount = $latestPay
                        ? ($latestPay->total_salary ?? $latestPay->net_salary ?? $latestPay->total_gaji ?? $latestPay->gaji_bersih ?? $user->monthly_salary ?? 0)
                        : ($user->monthly_salary ?? 0);
                @endphp
                <p class="text-2xl font-extrabold text-emerald-700 mt-2">
                    Rp {{ number_format($salaryAmount, 0, ',', '.') }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    {{ $latestPay ? 'Sudah direkap admin' : 'Gaji bulanan terdaftar' }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <p class="text-xs font-semibold uppercase text-gray-500">Status Pembayaran</p>
                <p class="text-xl font-bold text-gray-900 mt-2">
                    @if ($latestPay && ($latestPay->status ?? '') === 'paid')
                        <span class="text-emerald-700">Sudah Dibayar</span>
                    @else
                        <span class="text-amber-600">Menunggu Rekap</span>
                    @endif
                </p>
                <p class="text-xs text-gray-500 mt-1">Dikelola oleh Owner / Admin</p>
            </div>
        </div>

        <!-- Tabel Riwayat Presensi Bulan Ini -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-5 border-b border-gray-200 flex items-center justify-between">
                <h2 class="font-bold text-gray-900 text-base">Riwayat Presensi Bulan Ini</h2>
                <span class="text-xs text-gray-500">{{ $nowWib->translatedFormat('F Y') }}</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600">
                        <tr>
                            <th class="py-3 px-5">Tanggal</th>
                            <th class="py-3 px-5">Waktu Masuk</th>
                            <th class="py-3 px-5">Waktu Pulang</th>
                            <th class="py-3 px-5">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($attendances as $att)
                            @php
                                $rawDate = $att->attendance_date ?? $att->date ?? $att->tanggal ?? $att->check_in ?? $att->created_at;
                                $inTime  = $att->check_in ?? $att->clock_in ?? $att->jam_masuk ?? $att->created_at;
                                $outTime = $att->check_out ?? $att->clock_out ?? $att->jam_pulang ?? null;
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="py-3.5 px-5 font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($rawDate)->locale('id')->translatedFormat('d M Y') }}
                                </td>
                                <td class="py-3.5 px-5 text-gray-600">
                                    {{ $inTime ? \Carbon\Carbon::parse($inTime)->format('H:i') . ' WIB' : '-' }}
                                </td>
                                <td class="py-3.5 px-5 text-gray-600">
                                    {{ $outTime ? \Carbon\Carbon::parse($outTime)->format('H:i') . ' WIB' : '-' }}
                                </td>
                                <td class="py-3.5 px-5">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 uppercase">
                                        {{ $att->attendance_status ?? $att->status ?? 'Hadir' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-500">
                                    Belum ada catatan presensi pada bulan ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script>
        function updateLiveClock() {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('id-ID', {
                timeZone: 'Asia/Jakarta',
                hour12: false,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            }).replace(/\./g, ':');

            const clockEl = document.getElementById('live-clock');
            if (clockEl) {
                clockEl.textContent = timeStr;
            }
        }

        setInterval(updateLiveClock, 1000);
    </script>

</body>
</html>