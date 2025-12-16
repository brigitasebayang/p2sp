@extends('layouts.app')

@section('title', 'Laporan Pendapatan Bulanan')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <div class="bg-white rounded-lg shadow-lg p-8 no-print">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Laporan Pendapatan Bulanan</h1>
        
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <label for="bulan" class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                <select name="bulan" id="bulan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @php
                        $months = [
                            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                            '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                            '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                            '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                        ];
                    @endphp
                    @foreach ($months as $key => $month)
                        <option value="{{ $key }}" {{ $key == $currentMonth ? 'selected' : '' }}>{{ $month }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                <input type="number" name="tahun" id="tahun" value="{{ $currentYear }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                    Tampilkan
                </button>
            </div>
        </form>
    </div>

    @if($reports->count() > 0)
        @php
            $report = $reports->first();
            $tahun = request('tahun', $currentYear);
            $bulan = request('bulan', $currentMonth);
            $bulanNama = $months[$bulan] ?? 'Bulan Tidak Valid';
        @endphp

        <div class="mt-8">
            <a href="{{ route('laporan.print-bulanan', ['tahun' => $tahun, 'bulan' => $bulan]) }}" target="_blank" class="no-print mb-4 inline-block bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                <svg class="inline-block w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path>
                </svg>
                Cetak Laporan
            </a>
        </div>

        <div class="mt-6 bg-white rounded-lg shadow-lg p-8">
            <div class="border-b-4 border-gray-800 pb-6 mb-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.5 1.5H19V8h-8.5V1.5zM4.5 1.5h5v6.5h-5V1.5zM4.5 12.5h5V19h-5v-6.5zm6-11h8.5v6.5h-8.5V1.5zm0 11h8.5V19h-8.5v-6.5zM1 1.5h2.5V19H1V1.5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Kouvee Pet Shop</h2>
                            <p class="text-gray-600 text-sm">Jl. Moses Gatorkaka No. 22 Yogyakarta 55281</p>
                            <p class="text-gray-600 text-sm">Telp. (0274) 357735</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="text-2xl font-bold text-center mb-2 text-blue-600">LAPORAN PENDAPATAN BULANAN</h3>
            <p class="text-center text-gray-600 mb-6">Bulan - {{ $bulanNama }} | Tahun - {{ $tahun }}</p>

            <!-- Jasa Section -->
            <div class="mb-8">
                <h4 class="text-lg font-bold text-gray-800 mb-4 bg-blue-100 p-2 rounded">JASA LAYANAN</h4>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-blue-200">
                            <th class="border border-gray-300 p-3 text-left font-semibold">No</th>
                            <th class="border border-gray-300 p-3 text-left font-semibold">Nama Jasa Layanan</th>
                            <th class="border border-gray-300 p-3 text-right font-semibold">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $noJasa = 1; $totalJasa = 0; @endphp
                        @forelse($report->details->where('tipe_item', 'jasa') as $detail)
                            <tr>
                                <td class="border border-gray-300 p-3">{{ $noJasa++ }}</td>
                                <td class="border border-gray-300 p-3">{{ $detail->nama_item }}</td>
                                <td class="border border-gray-300 p-3 text-right">Rp {{ number_format($detail->total_pendapatan, 0, ',', '.') }}</td>
                            </tr>
                            @php $totalJasa += $detail->total_pendapatan; @endphp
                        @empty
                            <tr>
                                <td colspan="3" class="border border-gray-300 p-3 text-center text-gray-500">Tidak ada data jasa layanan</td>
                            </tr>
                        @endforelse
                        <tr class="bg-blue-100 font-bold">
                            <td colspan="2" class="border border-gray-300 p-3 text-right">Total</td>
                            <td class="border border-gray-300 p-3 text-right">Rp {{ number_format($totalJasa, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Produk Section -->
            <div class="mb-8">
                <h4 class="text-lg font-bold text-gray-800 mb-4 bg-green-100 p-2 rounded">PRODUK</h4>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-green-200">
                            <th class="border border-gray-300 p-3 text-left font-semibold">No</th>
                            <th class="border border-gray-300 p-3 text-left font-semibold">Nama Produk</th>
                            <th class="border border-gray-300 p-3 text-right font-semibold">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $noProduk = 1; $totalProduk = 0; @endphp
                        @forelse($report->details->where('tipe_item', 'produk') as $detail)
                            <tr>
                                <td class="border border-gray-300 p-3">{{ $noProduk++ }}</td>
                                <td class="border border-gray-300 p-3">{{ $detail->nama_item }}</td>
                                <td class="border border-gray-300 p-3 text-right">Rp {{ number_format($detail->total_pendapatan, 0, ',', '.') }}</td>
                            </tr>
                            @php $totalProduk += $detail->total_pendapatan; @endphp
                        @empty
                            <tr>
                                <td colspan="3" class="border border-gray-300 p-3 text-center text-gray-500">Tidak ada data produk</td>
                            </tr>
                        @endforelse
                        <tr class="bg-green-100 font-bold">
                            <td colspan="2" class="border border-gray-300 p-3 text-right">Total</td>
                            <td class="border border-gray-300 p-3 text-right">Rp {{ number_format($totalProduk, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Grand Total -->
            <div class="text-right mb-8">
                <p class="text-xl font-bold text-gray-800">
                    Grand Total: <span class="text-2xl text-blue-600">Rp {{ number_format($totalJasa + $totalProduk, 0, ',', '.') }}</span>
                </p>
            </div>
        </div>
    @else
        <div class="mt-8 bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded">
            <p class="text-yellow-800 font-medium">Tidak ada data laporan untuk periode yang dipilih. Silakan cek kembali filter bulan dan tahun.</p>
        </div>
    @endif
</div>

<script>
    document.getElementById('bulan').addEventListener('change', function() {
        document.querySelector('form').submit();
    });
    document.getElementById('tahun').addEventListener('change', function() {
        document.querySelector('form').submit();
    });
</script>
@endsection
