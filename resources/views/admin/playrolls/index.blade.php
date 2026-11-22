@extends('layouts.admin')

@section('title', 'Rekap Gaji & Absensi Karyawan')

@section('content')
@if (session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm">
        {{ session('success') }}
    </div>
@endif

<!-- Form Hitung Otomatis Gaji Bulanan -->
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <h2 class="text-base font-bold text-gray-900 mb-3">Hitung Otomatis Rekap Gaji Bulanan</h2>
    <form action="{{ route('admin.payrolls.generate') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end">
        @csrf
        <div>
            <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Bulan</label>
            <select name="month" class="w-full rounded-lg border-gray-300 text-sm">
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->locale('id')->translatedFormat('F') }}
                    </option>
                @endfor
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Tahun</label>
            <input type="number" name="year" value="{{ $year }}" class="w-full rounded-lg border-gray-300 text-sm">
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase text-gray-600 mb-1">Upah Per Hadir (Rp)</label>
            <input type="number" name="daily_rate" value="75000" min="0" class="w-full rounded-lg border-gray-300 text-sm">
        </div>

        <button type="submit" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
            Hitung & Rekap Gaji
        </button>
    </form>
</div>

<!-- Tabel Rekap Gaji -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-5 border-b border-gray-200">
        <h3 class="font-bold text-gray-900">Rekap Gaji Periode {{ \Carbon\Carbon::create()->month($month)->locale('id')->translatedFormat('F') }} {{ $year }}</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600">
                <tr>
                    <th class="py-3 px-5">Nama Karyawan</th>
                    <th class="py-3 px-5">Total Hadir</th>
                    <th class="py-3 px-5">Total Gaji</th>
                    <th class="py-3 px-5">Status</th>
                    <th class="py-3 px-5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($payrolls as $pay)
                    @php
                        $days   = $pay->total_days ?? $pay->present_days ?? $pay->total_hadir ?? $pay->hadir ?? 0;
                        $salary = $pay->total_salary ?? $pay->net_salary ?? $pay->final_salary ?? $pay->total_gaji ?? $pay->gaji_bersih ?? $pay->amount ?? 0;
                    @endphp
                    <tr>
                        <td class="py-3.5 px-5 font-semibold text-gray-900">{{ $pay->user->name ?? 'Karyawan' }}</td>
                        <td class="py-3.5 px-5">{{ $days }} Hari</td>
                        <td class="py-3.5 px-5 font-bold text-emerald-700">Rp {{ number_format($salary, 0, ',', '.') }}</td>
                        <td class="py-3.5 px-5">
                            @if (($pay->status ?? '') === 'paid')
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">LUNAS</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">PENDING</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-5 text-right">
                            @if (($pay->status ?? '') !== 'paid')
                                <form action="{{ route('admin.payrolls.pay', $pay->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1 rounded text-xs font-semibold">
                                        Tandai Lunas
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-gray-400">Sudah dibayar</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-500">
                            Belum ada data rekap gaji untuk periode ini. Klik <strong>Hitung & Rekap Gaji</strong> di atas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Log Presensi Karyawan -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-5 border-b border-gray-200">
        <h3 class="font-bold text-gray-900">Log Presensi Harian Karyawan</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-600">
                <tr>
                    <th class="py-3 px-5">Nama Karyawan</th>
                    <th class="py-3 px-5">Tanggal</th>
                    <th class="py-3 px-5">Jam Masuk</th>
                    <th class="py-3 px-5">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($attendances as $att)
                    @php
                        $rawDate = $att->attendance_date ?? $att->date ?? $att->tanggal ?? $att->check_in ?? $att->created_at;
                        $inTime  = $att->check_in ?? $att->clock_in ?? $att->jam_masuk ?? $att->created_at;
                    @endphp
                    <tr>
                        <td class="py-3 px-5 font-semibold text-gray-900">{{ $att->user->name ?? '-' }}</td>
                        <td class="py-3 px-5">{{ \Carbon\Carbon::parse($rawDate)->locale('id')->translatedFormat('d M Y') }}</td>
                        <td class="py-3 px-5">{{ \Carbon\Carbon::parse($inTime)->format('H:i') }} WIB</td>
                        <td class="py-3 px-5">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 uppercase">
                                {{ $att->attendance_status ?? $att->status ?? 'Hadir' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500">Belum ada riwayat presensi bulan ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection