@extends('layouts.app')

@section('title', 'Laporan Pendapatan Tahunan')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <div class="bg-white rounded-lg shadow-lg p-8 no-print">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Laporan Pendapatan Tahunan</h1>
        
        <form method="GET" class="flex gap-4 mb-6">
            <div class="flex-1">
                <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                <input type="number" name="tahun" id="tahun" value="{{ $currentYear }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                    Tampilkan
                </button>
            </div>
        </form>
    </div>

    @if($reports->count() > 0)
        <div class="mt-8">
            <a href="{{ route('laporan.print-tahunan', ['tahun' => $currentYear]) }}" target="_blank" class="no-print mb-4 inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
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
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
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

            <h3 class="text-2xl font-bold text-center mb-2 text-green-600">LAPORAN PENDAPATAN TAHUNAN</h3>
            <p class="text-center text-gray-600 mb-6">Tahun - {{ $currentYear }}</p>

            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-green-200">
                        <th class="border border-gray-300 p-3 text-left font-semibold">No</th>
                        <th class="border border-gray-300 p-3 text-left font-semibold">Bulan</th>
                        <th class="border border-gray-300 p-3 text-right font-semibold">Jasa Layanan</th>
                        <th class="border border-gray-300 p-3 text-right font-semibold">Produk</th>
                        <th class="border border-gray-300 p-3 text-right font-semibold">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $months = [
                            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                            '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                            '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                            '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                        ];
                        $totalJasaTahunan = 0;
                        $totalProdukTahunan = 0;
                    @endphp
                    @forelse($reports as $index => $report)
                        @php
                            $jasaAmount = $report->details->where('tipe_item', 'jasa')->sum('total_pendapatan');
                            $produkAmount = $report->details->where('tipe_item', 'produk')->sum('total_pendapatan');
                            $subtotal = $jasaAmount + $produkAmount;
                            $totalJasaTahunan += $jasaAmount;
                            $totalProdukTahunan += $produkAmount;
                            $bulanKey = str_pad($report->bulan, 2, '0', STR_PAD_LEFT);
                            $bulanNama = $months[$bulanKey] ?? 'Bulan Tidak Valid';
                        @endphp
                        <tr>
                            <td class="border border-gray-300 p-3">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 p-3">{{ $bulanNama }}</td>
                            <td class="border border-gray-300 p-3 text-right">Rp {{ number_format($jasaAmount, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 p-3 text-right">{{ $produkAmount > 0 ? 'Rp ' . number_format($produkAmount, 0, ',', '.') : 'Rp 0' }}</td>
                            <td class="border border-gray-300 p-3 text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border border-gray-300 p-3 text-center text-gray-500">Tidak ada data untuk tahun ini</td>
                        </tr>
                    @endforelse
                    <tr class="bg-green-100 font-bold">
                        <td colspan="2" class="border border-gray-300 p-3 text-right">Total</td>
                        <td class="border border-gray-300 p-3 text-right">Rp {{ number_format($totalJasaTahunan, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 p-3 text-right">Rp {{ number_format($totalProdukTahunan, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 p-3 text-right">Rp {{ number_format($totalJasaTahunan + $totalProdukTahunan, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="text-right mt-8 mb-8">
                <p class="text-xl font-bold text-gray-800">
                    Grand Total: <span class="text-2xl text-green-600">Rp {{ number_format($totalJasaTahunan + $totalProdukTahunan, 0, ',', '.') }}</span>
                </p>
            </div>
        </div>
    @else
        <div class="mt-8 bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded">
            <p class="text-yellow-800 font-medium">Tidak ada data laporan untuk tahun yang dipilih.</p>
        </div>
    @endif
</div>

<script>
    document.getElementById('tahun').addEventListener('change', function() {
        document.querySelector('form').submit();
    });
</script>
@endsection
