<?php
// Print-optimized report view
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan - Kouvee Pet Shop</title>
    <style>
    body {
        font-family: "Times New Roman", serif;
        background: white;
    }

    .print-container {
        width: 210mm;
        padding: 10mm 15mm;
        margin: 0 auto;
        background: white;
    }

    /* Header */
    .header-box {
        border: 2px solid black;
        padding: 10px 20px;
    }

    .header-top {
        display: flex;
        align-items: center;
    }

    .header-top img {
        width: 120px;
        margin-right: 15px;
    }

    .header-text {
        text-align: left;
        font-size: 14px;
        line-height: 1.3;
    }

    .title {
        text-align: center;
        margin: 15px 0 5px;
        font-weight: bold;
        font-size: 17px;
        text-transform: uppercase;
    }

    .subtitle {
        margin: 5px 0;
        font-size: 14px;
    }

    hr {
        border: none;
        border-top: 2px solid black;
        margin: 10px 0 15px;
    }

    /* Tahun */
    .tahun {
        font-size: 15px;
        margin-bottom: 10px;
    }

    /* Table */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    table th, table td {
        border: 1px solid black;
        padding: 6px;
    }

    table th {
        text-align: center;
        font-weight: bold;
        background: #f5f5f5;
    }

    .amount-cell {
        text-align: right;
        padding-right: 8px;
    }

    /* Total */
    .total-row {
        text-align: right;
        font-weight: bold;
        margin-top: 10px;
        font-size: 15px;
    }

    @media print {
        .no-print {
            display: none;
        }
        body {
            margin: 0;
        }
        .print-container {
            box-shadow: none;
            margin: 0;
            padding: 0;
        }
    }
</style>

</head>
<body>
    <div class="no-print">
        <button onclick="window.print()">🖨️ Cetak Laporan</button>
        <button onclick="window.history.back()">← Kembali</button>
    </div>

    <div class="print-container">

    <div class="header-box">
        <div class="header-top">
            <img src="/assets/logo.png" alt="Logo">
            <div class="header-text">
                <strong>KOUVEE PET SHOP</strong><br>
                Jl. Malioboro No. 123, Yogyakarta 55271 <br>
                Telp. (+62) 123-456 <br>
                www.kouveepetshop.com <br>
            </div>
        </div>
        <hr>
        <div class="title">LAPORAN PENDAPATAN TAHUNAN</div>
    </div>

    <div class="tahun">
        Tahun : <span id="reportPeriod">-</span>
    </div>

    <table id="printTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Jasa Layanan</th>
                <th>Produk</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="printTableBody">
        </tbody>
    </table>

    <div class="total-row">
        Total &nbsp; <span id="printTotalRevenue">Rp 0</span>
    </div>

</div>


     <script>
const urlParams = new URLSearchParams(window.location.search);
const type = urlParams.get("type");  
const year = urlParams.get("year");
const month = urlParams.get("month");
const API_BASE_URL = "http://localhost:8000/api/laporan";

function formatCurrency(amount) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0
    }).format(amount);
}

async function loadData() {
    try {
        if (type === "monthly") {
            await loadMonthly();
        } else {
            await loadAnnual();
        }
    } catch (err) {
        console.error(err);
        alert("Gagal memuat data laporan.");
    }
}

// =============================
// Laporan Bulanan
// =============================
async function loadMonthly() {
    const response = await fetch(`${API_BASE_URL}/bulanan/${year}/${month}`);
    const data = await response.json();

    document.getElementById("reportPeriod").textContent =
        `Bulan ${month} Tahun ${year}`;

    fillMonthlyRows(data.summary, data.detail);
}

function fillMonthlyRows(summary, detailData) {
    const tbody = document.getElementById("printTableBody");
    tbody.innerHTML = "";

    let total = 0;

    detailData.forEach((item, i) => {
        total += item.subtotal;

        tbody.innerHTML += `
            <tr>
                <td>${i + 1}</td>
                <td>-</td>
                <td>${formatCurrency(item.layanan || 0)}</td>
                <td>${formatCurrency(item.produk || 0)}</td>
                <td class="amount-cell">${formatCurrency(item.subtotal)}</td>
            </tr>
        `;
    });

    document.getElementById("printTotalRevenue").textContent = formatCurrency(total);
}

// =============================
// Laporan Tahunan
// =============================
async function loadAnnual() {
    const response = await fetch(`${API_BASE_URL}/tahunan/${year}`);
    const data = await response.json();

    document.getElementById("reportPeriod").textContent = year;

    fillAnnualRows(data.data);
}

function fillAnnualRows(rows) {
    const tbody = document.getElementById("printTableBody");
    tbody.innerHTML = "";

    let total = 0;

    rows.forEach((item, i) => {
        total += item.total;

        tbody.innerHTML += `
            <tr>
                <td>${i + 1}</td>
                <td>${item.bulan}</td>
                <td>${formatCurrency(item.jasa_layanan)}</td>
                <td>${formatCurrency(item.produk)}</td>
                <td class="amount-cell">${formatCurrency(item.total)}</td>
            </tr>
        `;
    });

    document.getElementById("printTotalRevenue").textContent = formatCurrency(total);
}

// Jalankan di awal
loadData();
</script>

</body>
</html>
