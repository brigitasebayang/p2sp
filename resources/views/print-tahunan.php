<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan Tahunan - {{ $tahun }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        @media print {
            body {
                margin: 0;
                padding: 20px;
            }
            .no-print {
                display: none;
            }
            page-break-after avoid
            * {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body class="bg-white p-8">
    <div class="max-w-4xl mx-auto">
        <div class="border-b-2 border-gray-800 pb-6 mb-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">KOUVEE PET SHOP</h1>
                        <p class="text-sm text-gray-600">Jl. Moses Gatorkaka No. 22 Yogyakarta 55281</p>
                        <p class="text-sm text-gray-600">Telp. (0274) 357735</p>
                        <p class="text-sm text-gray-600">http://www.sayangherwan.com</p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-center mb-2 text-green-600">LAPORAN PENDAPATAN TAHUNAN</h2>
        <p class="text-center text-gray-700 mb-8 font-semibold">Tahun - {{ $tahun }}</p>

        <table class="w-full border-collapse">
            <thead>
                <tr class="border-t-2 border-b-2 border-gray-800">
                    <th class="p-2 text-left font-bold text-sm border border-gray-300">No</th>
                    <th class="p-2 text-left font-bold text-sm border border-gray-300">Bulan</th>
                    <th class="p-2 text-right font-bold text-sm border border-gray-300">Jasa Layanan</th>
                    <th class="p-2 text-right font-bold text-sm border border-gray-300">Produk</th>
                    <th class="p-2 text-right font-bold text-sm border border-gray-300">Total</th>
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
                    <tr class="border-b border-gray-300">
                        <td class="p-2 text-sm border border-gray-300">{{ $index + 1 }}</td>
                        <td class="p-2 text-sm border border-gray-300">{{ $bulanNama }}</td>
                        <td class="p-2 text-right text-sm border border-gray-300">Rp {{ number_format($jasaAmount, 0, ',', '.') }}</td>
                        <td class="p-2 text-right text-sm border border-gray-300">{{ $produkAmount > 0 ? 'Rp ' . number_format($produkAmount, 0, ',', '.') : 'Rp 0' }}</td>
                        <td class="p-2 text-right text-sm border border-gray-300">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2 text-center text-gray-500 text-sm">Tidak ada data</td>
                    </tr>
                @endforelse
                <tr class="border-t-2 border-gray-800 font-bold">
                    <td colspan="2" class="p-2 text-right border border-gray-300">Total</td>
                    <td class="p-2 text-right border border-gray-300">Rp {{ number_format($totalJasaTahunan, 0, ',', '.') }}</td>
                    <td class="p-2 text-right border border-gray-300">Rp {{ number_format($totalProdukTahunan, 0, ',', '.') }}</td>
                    <td class="p-2 text-right border border-gray-300">Rp {{ number_format($totalJasaTahunan + $totalProdukTahunan, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-12 font-bold">
            <p class="text-lg">Total: <span class="text-xl">Rp {{ number_format($totalJasaTahunan + $totalProdukTahunan, 0, ',', '.') }}</span></p>
        </div>
    </div>

    <div class="no-print flex gap-4 justify-center mt-8">
        <button onclick="window.print()" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg">
            Cetak / Print PDF
        </button>
        <button onclick="window.close()" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg">
            Tutup
        </button>
    </div>
</body>
</html>
