<?php
// Report Dashboard with Charts and Print Functionality (Clean Version - No Tables)
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan - Kouvee Pet Shop</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
            background: #f9fafb;
            color: #1f2937;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            position: sticky; top: 0; z-index: 1000;
            padding: 0 2rem;
        }
        .nav-container {
            max-width: 1400px; margin: 0 auto;
            display: flex; justify-content: space-between; align-items: center;
            height: 64px;
        }
        .nav-brand { font-size: 1.5rem; font-weight: bold; }

        .btn-print {
            padding: 0.5rem 1rem;
            background: #d97706; 
            color: white;
            border-radius: 0.5rem; border: 1px solid #d97706;
            cursor: pointer; transition: 0.3s;
        }
        .btn-print:hover { background: #b45309; }

        .container { max-width: 1400px; margin: auto; padding: 2rem; }

        .page-header h1 { font-size: 2rem; font-weight: bold; margin-bottom: 0.5rem; }
        .page-header p { color: #6b7280; }

        /* Filter Section */
        .filter-section {
            background: white; padding: 1.5rem; border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
            display: grid; gap: 1rem;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
        .filter-group { display: flex; flex-direction: column; }
        .filter-group label { font-size: 0.9rem; margin-bottom: 0.5rem; }
        .filter-group input, .filter-group select {
            padding: 0.75rem; border-radius: 0.5rem; border: 1px solid #d1d5db;
        }

        .filter-actions { display: flex; gap: 0.5rem; align-items: end; }
        .btn-filter {
            background: #d97706; color: white;
            padding: 0.75rem 1.5rem; border-radius: 0.5rem;
        }
        .btn-reset {
            background: #e5e7eb; padding: 0.75rem 1.5rem; border-radius: 0.5rem;
        }

        /* Summary Cards */
        .summary-cards {
            display: grid; gap: 1.5rem;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            margin-bottom: 2rem;
        }
        .card {
            background: white; padding: 1.5rem; border-radius: 0.75rem;
            border-left: 4px solid #d97706;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .card .amount { font-size: 1.875rem; font-weight: bold; }

        /* Charts */
        .charts-grid {
            display: grid; gap: 2rem;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        }
        .chart-container {
            background: white; padding: 1.5rem; border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .chart-wrapper { height: 300px; }

        @media print {
            .navbar, .filter-section { display: none; }
            .container { padding: 0; }
            .chart-container { page-break-inside: avoid; }
        }
    </style>
</head>

<body>
    <!-- NAV -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">📊 Laporan Pendapatan</div>
           <button class="btn-print" onclick="printReport()">🖨️ Cetak</button>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="container">
        <div class="page-header">
            <h1>Laporan Pendapatan Kouvee Pet Shop</h1>
            <p>Laporan pendapatan bulanan dan tahunan</p>
        </div>

        <!-- FILTER -->
        <div class="filter-section">
            <div class="filter-group">
                <label>Jenis Laporan</label>
                <select id="reportType" onchange="changeReportType()">
                    <option value="monthly">Laporan Bulanan</option>
                    <option value="annual">Laporan Tahunan</option>
                </select>
            </div>

            <div class="filter-group" id="monthFilter">
            <label>Bulan</label>
            <select id="month">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
        </div>


            <div class="filter-group" id="yearFilter">
                <label>Tahun</label>
                <input type="number" id="year" value="2025" min="2020" max="2099">
            </div>

            <div class="filter-group" id="yearRangeFilter" style="display:none;">
                <label>Rentang Tahun</label>
                <div style="display:flex; gap:0.5rem;">
                    <input type="number" id="startYear" value="2020">
                    <input type="number" id="endYear" value="2025">
                </div>
            </div>

            <div class="filter-actions">
                <button class="btn-filter" onclick="loadData()">Tampilkan Data</button>
                <button class="btn-reset" onclick="resetFilters()">Reset</button>
            </div>
        </div>

        <!-- SUMMARY CARDS -->
        <div class="summary-cards">
            
            <div class="card"><h3>Pendapatan Layanan</h3><div id="totalServices" class="amount">Rp 0</div></div>
            <div class="card"><h3>Pendapatan Produk</h3><div id="totalProducts" class="amount">Rp 0</div></div>
            <div class="card"><h3>Total Pendapatan</h3><div id="totalRevenue" class="amount">Rp 0</div></div>
        </div>

        

        <div class="table-container" style="
            background:white;
            margin-top:2rem;
            padding:1.5rem;
            border-radius:.75rem;
            box-shadow:0 1px 3px rgba(0,0,0,0.05);
        ">
            <h2>Detail Pendapatan</h2>
            <table id="detailTable" style="width:100%; margin-top:1rem; border-collapse:collapse;">
                <thead>
                    <tr style="background:#f3f4f6;">
                        <th style="padding:8px; border:1px solid #d1d5db;">No</th>
                        <th style="padding:8px; border:1px solid #d1d5db;">Nama Item</th>
                        <th style="padding:8px; border:1px solid #d1d5db;">Jenis</th>
                        <th style="padding:8px; border:1px solid #d1d5db;">Qty</th>
                        <th style="padding:8px; border:1px solid #d1d5db;">Subtotal</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div id="tableAnnualContainer" style="
    background:white;
    margin-top:2rem;
    padding:1.5rem;
    border-radius:.75rem;
    box-shadow:0 1px 3px rgba(0,0,0,0.05);
    display:none;
">
    <table id="annualTable" style="width:100%; margin-top:1rem; border-collapse:collapse;">
        <thead>
            <tr style="background:#f3f4f6;">
                <th style="padding:8px; border:1px solid #d1d5db;">Bulan</th>
                <th style="padding:8px; border:1px solid #d1d5db;">Pendapatan Layanan</th>
                <th style="padding:8px; border:1px solid #d1d5db;">Pendapatan Produk</th>
                <th style="padding:8px; border:1px solid #d1d5db;">Total</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>


    </div>

    <script>
const API_BASE_URL = "http://localhost:8000/api/laporan";

// =============================
// FORMAT RUPIAH
// =============================
function formatCurrency(amount) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0
    }).format(amount);
}

// =============================
// UBAH JENIS LAPORAN
// =============================
function changeReportType() {
    let type = document.getElementById("reportType").value;

    if (type === "monthly") {
        document.getElementById("monthFilter").style.display = "block";
        document.getElementById("yearFilter").style.display = "block";
        document.getElementById("yearRangeFilter").style.display = "none";
    } else {
        document.getElementById("monthFilter").style.display = "none";
        document.getElementById("yearFilter").style.display = "block";
        document.getElementById("yearRangeFilter").style.display = "none";
    }
}

function resetFilters() {
    document.getElementById("year").value = 2025;
    document.getElementById("month").value = 1;
}

// =============================
// TABEL DETAIL
// =============================
function fillTable(detailData) {
    const tbody = document.querySelector("#detailTable tbody");
    tbody.innerHTML = "";

    if (!detailData || detailData.length === 0) {
        tbody.innerHTML = `
            <tr><td colspan="5" style="text-align:center; padding:10px;">Tidak ada data</td></tr>
        `;
        return;
    }

    detailData.forEach((item, index) => {
        tbody.innerHTML += `
            <tr>
                <td style="padding:8px; border:1px solid #d1d5db;">${index + 1}</td>
                <td style="padding:8px; border:1px solid #d1d5db;">${item.nama_item}</td>
                <td style="padding:8px; border:1px solid #d1d5db;">${item.jenis}</td>
                <td style="padding:8px; border:1px solid #d1d5db;">${item.qty}</td>
                <td style="padding:8px; border:1px solid #d1d5db;">${formatCurrency(item.subtotal)}</td>
            </tr>
        `;
    });
}

function fillAnnualTable(annualData) {
    const tbody = document.querySelector("#annualTable tbody");
    tbody.innerHTML = "";

    annualData.data.forEach(row => {
        tbody.innerHTML += `
            <tr>
                <td style="padding:8px; border:1px solid #d1d5db;">${row.bulan}</td>
                <td style="padding:8px; border:1px solid #d1d5db;">${formatCurrency(row.jasa_layanan)}</td>
                <td style="padding:8px; border:1px solid #d1d5db;">${formatCurrency(row.produk)}</td>
                <td style="padding:8px; border:1px solid #d1d5db;">${formatCurrency(row.total)}</td>
            </tr>
        `;
    });
}

// =============================
// LOAD DATA UTAMA
// =============================
async function loadData() {
    const type = document.getElementById("reportType").value;

    try {
        if (type === "monthly") {
            await loadMonthly();
        } else {
            await loadAnnual();
        }
    } catch (error) {
        alert("Gagal memuat data!");
        console.error(error);
    }
}

// =============================
// BULANAN
// =============================
async function loadMonthly() {
    const year = document.getElementById("year").value;
    const month = document.getElementById("month").value;

    const response = await fetch(`${API_BASE_URL}/bulanan/${year}/${month}`);
    const data = await response.json();

    fillSummaryMonthly(data.summary);
    fillTable(data.detail);

    // tampilkan tabel bulanan, sembunyikan tahunan
    document.querySelector(".table-container").style.display = "block";
    document.getElementById("tableAnnualContainer").style.display = "none";
}


// =============================
// TAHUNAN
// =============================
async function loadAnnual() {
    const year = document.getElementById("year").value;

    const response = await fetch(`${API_BASE_URL}/tahunan/${year}`);
    const data = await response.json();

    fillSummaryAnnual(data);
    fillAnnualTable(data);

    // tampilkan tabel tahunan, sembunyikan tabel bulanan
    document.getElementById("tableAnnualContainer").style.display = "block";
    document.querySelector(".table-container").style.display = "none";
}


// =============================
// SUMMARY - BULANAN
// =============================
function fillSummaryMonthly(summary) {
    document.getElementById("totalRevenue").textContent = formatCurrency(summary.total_pendapatan);
    document.getElementById("totalServices").textContent = formatCurrency(summary.total_layanan);
    document.getElementById("totalProducts").textContent = formatCurrency(summary.total_produk);
}

// =============================
// SUMMARY - TAHUNAN
// =============================
function fillSummaryAnnual(annualData) {
    let totalPendapatan = 0;
    let totalProduk = 0;
    let totalLayanan = 0;

    annualData.data.forEach(item => {
        totalPendapatan += item.total;
        totalProduk += item.produk;
        totalLayanan += item.jasa_layanan;
    });

    document.getElementById("totalRevenue").textContent = formatCurrency(totalPendapatan);
    document.getElementById("totalServices").textContent = formatCurrency(totalLayanan);
    document.getElementById("totalProducts").textContent = formatCurrency(totalProduk);
}

// AUTO LOAD SAAT PAGE BUKA
loadData();
</script>

<script>
function printReport() {
    let type = document.getElementById("reportType").value;
    let year = document.getElementById("year").value;

    // Jika laporan BULANAN, wajib ada month
    if (type === "monthly") {
        let month = document.getElementById("month").value;

        // Redirect ke halaman print bulanan
        window.print();
        return;
    }

    // Jika laporan TAHUNAN
    if (type === "annual") {
        window.location.href =
            `/laporan/print?type=annual&year=${year}`;
        return;
    }
}
</script>


</body>
</html>
