@extends('layouts.app')

@section('title', 'Dashboard - Laporan Pendapatan')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Laporan Bulanan Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
            <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                <svg class="w-24 h-24 text-white opacity-80" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                </svg>
            </div>
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Laporan Pendapatan Bulanan</h2>
                <p class="text-gray-600 mb-6">Lihat detail pendapatan jasa dan produk per bulan dengan breakdown yang terperinci.</p>
                <a href="{{ route('laporan.bulanan') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                    Buka Laporan
                </a>
            </div>
        </div>

        <!-- Laporan Tahunan Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
            <div class="h-48 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                <svg class="w-24 h-24 text-white opacity-80" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Laporan Pendapatan Tahunan</h2>
                <p class="text-gray-600 mb-6">Lihat ringkasan pendapatan untuk setiap bulan dalam satu tahun dengan total keseluruhan.</p>
                <a href="{{ route('laporan.tahunan') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                    Buka Laporan
                </a>
            </div>
        </div>
    </div>

    <!-- Info Box -->
    <div class="mt-8 bg-blue-50 border-l-4 border-blue-500 p-6 rounded">
        <h3 class="text-lg font-semibold text-blue-900 mb-2">Informasi Penggunaan</h3>
        <ul class="text-blue-800 space-y-2">
            <li class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                Pilih bulan dan tahun untuk melihat laporan pendapatan bulanan
            </li>
            <li class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                Laporan tahunan menampilkan ikhtisar 12 bulan dalam satu tampilan
            </li>
            <li class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                Gunakan tombol Cetak untuk mencetak laporan ke PDF atau kertas
            </li>
        </ul>
    </div>
</div>
@endsection
