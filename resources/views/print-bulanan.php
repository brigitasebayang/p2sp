<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan Bulanan - {{ $bulanNama }} {{ $tahun }}</title>
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
                    <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.5 1.5H19V8h-8.5V1.5zM4.5 1.5h5v6.5h-5V1.5zM4.5 12.5h5V19h-5v-6.5zm6-11h8.5v6.5h-8.5V1.5zm0 11h8.5V19h-8.5v-6.5zM1 1.5h2.5V19H1V1.5z"></path>
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

        <h2 class="text-2xl font-bold text-center mb-6 text-blue-600">LAPORAN PENDAPATAN BULANAN</h2>
        <p class="text-center text-gray-700 mb-8 font-semibold">Bulan - {{ $bulanNama }} | Tahun - {{ $tahun }}</p>

        @php
            $report = $reports->first();
            $totalJasa = 0;
            $totalProduk = 0;
        @endphp

        <!-- Jasa Layanan Section -->
        <div class="mb-8">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-t-2 border-b-2 border-gray-800">
                        <th class="p-2 text-left font-bold text-sm">No</th>
                        <th class="p-2 text-left font-bold text-sm">Nama Jasa Layanan</th>
                        <th class="p-2 text-right font-bold text-sm">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php $noJasa = 1; @endphp
                    @forelse($report->details->where('tipe_item', 'jasa') as $detail)
                        <tr class="border-b border-gray-300">
                            <td class="p-2 text-sm">{{ $noJasa++ }}</td>
                            <td class="p-2 text-sm">{{ $detail->nama_item }}</td>
                            <td class="p-2 text-right text-sm">Rp {{ number_format($detail->total_pendapatan, 0, ',', '.') }}</td>
                        </tr>
                        @php $totalJasa += $detail->total_pendapatan; @endphp
                    @empty
                        <tr>
                            <td colspan="3" class="p-2 text-center text-gray-500 text-sm">Tidak ada data</td>
                        </tr>
                    @endforelse
                    <tr class="border-t-2 border-gray-800 font-bold">
                        <td colspan="2" class="p-2 text-right">Total</td>
                        <td class="p-2 text-right">Rp {{ number_format($totalJasa, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Produk Section -->
        <div class="mb-8">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-t-2 border-b-2 border-gray-800">
                        <th class="p-2 text-left font-bold text-sm">No</th>
                        <th class="p-2 text-left font-bold text-sm">Nama Produk</th>
                        <th class="p-2 text-right font-bold text-sm">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php $noProduk = 1; @endphp
                    @forelse($report->details->where('tipe_item', 'produk') as $detail)
                        <tr class="border-b border-gray-300">
                            <td class="p-2 text-sm">{{ $noProduk++ }}</td>
                            <td class="p-2 text-sm">{{ $detail->nama_item }}</td>
                            <td class="p-2 text-right text-sm">Rp {{ number_format($detail->total_pendapatan, 0, ',', '.') }}</td>
                        </tr>
                        @php $totalProduk += $detail->total_pendapatan; @endphp
                    @empty
                        <tr>
                            <td colspan="3" class="p-2 text-center text-gray-500 text-sm">Tidak ada data</td>
                        </tr>
                    @endforelse
                    <tr class="border-t-2 border-gray-800 font-bold">
                        <td colspan="2" class="p-2 text-right">Total</td>
                        <td class="p-2 text-right">Rp {{ number_format($totalProduk, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-12 font-bold">
            <p class="text-lg">Total: <span class="text-xl">Rp {{ number_format($totalJasa + $totalProduk, 0, ',', '.') }}</span></p>
        </div>
    </div>

    <div class="no-print flex gap-4 justify-center mt-8">
        <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg">
            Cetak / Print PDF
        </button>
        <button onclick="window.close()" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg">
            Tutup
        </button>
    </div>
</body>
</html>
