@extends('layouts.admin')

@section('title', 'Rekap Gaji & Absensi Bulanan')

@section('content')
@if (session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg text-sm">
        {{ session('success') }}
    </div>
@endif

<!-- Filter Bulan & Tombol Hitung Otomatis -->
<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <form method="GET" action="{{ route('admin.payrolls.index') }}" class="flex flex-wrap items-end gap-3">
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">Bulan</label>
            <select name="month" class="rounded-lg border-gray-300 text-sm">
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>Bulan {{ $m }}</option>
                @endfor
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">Tahun</label>
            <input type="number" name="year" value="{{ $year }}" class="w-28 rounded-lg border-gray-300 text-sm">
        </div>
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium">Filter</button>
    </form>

    <form method="POST" action="{{ route('admin.payrolls.generate') }}" class="flex flex-wrap items-end gap-3">
        @csrf
        <input type="hidden" name="month" value="{{ $month }}">
        <input type="hidden" name="year" value="{{ $year }}">
        <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">Upah Harian (Rp)</label>
            <input type="number" name="daily_rate" value="75000" class="w-36 rounded-lg border-gray-300 text-sm">
        </div>
        <button type="submit" class="bg-[#1b3b2b] hover:bg-[#132a1e] text-white px-4 py-2 rounded-lg text-sm font-semibold">
            Hitung Gaji Bulan Ini
        </button>
    </form>
</div>

<!-- Tabel Rekap Gaji -->
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-5 border-b border-gray-200">
        <h3 class="font-bold text-gray-900">Slip Rekap Gaji (Periode {{ $month }}/{{ $year }})</h3>
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
                    <tr>
                        <td class="py-3 px-5 font-semibold text-gray-900">{{ $pay->user->name ?? '-' }}</td>
                        <td class="py-3 px-5">{{ $pay->total_days }} Hari</td>
                        <td class="py-3 px-5 font-bold text-emerald-700">Rp {{ number_format($pay->total_salary, 0, ',', '.') }}</td>
                        <td class="py-3 px-5">
                            @if ($pay->status === 'paid')
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">Lunas</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">Belum Dibayar</span>
                            @endif
                        </td>
                        <td class="py-3 px-5 text-right">
                            @if ($pay->status !== 'paid')
                                <form action="{{ route('admin.payrolls.pay', $pay->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="bg-[#1b3b2b] text-white px-3 py-1 rounded text-xs font-semibold">Tandai Lunas</button>
                                </form>
                            @else
                                <span class="text-xs text-gray-400">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-8 text-center text-gray-500">Belum ada rekap gaji pada periode ini. Klik <strong>Hitung Gaji Bulan Ini</strong>.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection