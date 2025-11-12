<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entri Data Penjualan Produk - Kouvee Pet Shop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: #1f2937;
            background: #f9fafb;
        }

        /* Navigation */
        .navbar {
            background: #ffffff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 64px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.25rem;
            font-weight: bold;
            color: #1f2937;
            text-decoration: none;
        }

        .nav-breadcrumb {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            color: #4b5563;
            font-size: 0.875rem;
        }

        /* Main Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #4b5563;
            font-size: 0.875rem;
        }

        /* Form Section */
        .form-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .form-label .required {
            color: #dc2626;
        }

        .form-input,
        .form-select,
        .form-textarea {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-family: inherit;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #d97706;
            box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.1);
        }

        .form-input:disabled {
            background: #f3f4f6;
            cursor: not-allowed;
        }

        /* Product Table Section */
        .product-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-table thead {
            background: #f3f4f6;
            border-bottom: 2px solid #e5e7eb;
        }

        .product-table th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #1f2937;
            font-size: 0.875rem;
        }

        .product-table td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.875rem;
        }

        .product-table tbody tr:hover {
            background: #f9fafb;
        }

        .product-table tbody tr:last-child td {
            border-bottom: none;
        }

        .product-table input[type="number"],
        .product-table select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }

        .product-table input[type="number"]:focus,
        .product-table select:focus {
            outline: none;
            border-color: #d97706;
            box-shadow: 0 0 0 2px rgba(217, 119, 6, 0.1);
        }

        /* Buttons */
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: #d97706;
            color: white;
        }

        .btn-primary:hover {
            background: #b45309;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(217, 119, 6, 0.2);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
            padding: 0.5rem 1rem;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .btn-small {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }

        /* Summary Section */
        .summary-section {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-radius: 1rem;
            padding: 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #fcd34d;
        }

        .summary-item {
            display: flex;
            flex-direction: column;
        }

        .summary-label {
            font-size: 0.875rem;
            color: #78350f;
            margin-bottom: 0.5rem;
        }

        .summary-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #4b5563;
        }

        .empty-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.6;
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            font-size: 0.875rem;
            font-weight: 500;
            animation: slideIn 0.3s ease-out;
            z-index: 2000;
        }

        .toast-success {
            background: #10b981;
            color: white;
        }

        .toast-error {
            background: #ef4444;
            color: white;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }

        .toast.hide {
            animation: slideOut 0.3s ease-out forwards;
        }

        /* Footer Actions */
        .footer-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
            margin-top: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .product-header {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }

            .product-table {
                font-size: 0.75rem;
            }

            .product-table th,
            .product-table td {
                padding: 0.75rem 0.5rem;
            }

            .footer-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* Utility Classes */
        .text-muted {
            color: #4b5563;
        }

        .text-sm {
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-brand">🐾 Kouvee Pet Shop</a>
            <div class="nav-breadcrumb">
                <span>Dashboard</span> / <span>Entri Data Penjualan Produk</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">📋 Entri Data Penjualan Produk</h1>
            <p class="page-subtitle">Kelola transaksi penjualan produk dengan mudah dan cepat</p>
        </div>

        <!-- Form Section -->
        <form id="transaksiForm" class="form-section">
            <div class="section-title">📝 Informasi Transaksi</div>

            <!-- First Row -->
            <div class="form-grid">
                

                <div class="form-group">
                    <label class="form-label">Tanggal Transaksi <span class="required">*</span></label>
                    <input type="datetime-local" class="form-input" id="tanggalTransaksi" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Status Pembayaran <span class="required">*</span></label>
                    <select class="form-select" id="statusPembayaran" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Lunas">✓ Lunas</option>
                        <option value="Belum Lunas">⏳ Belum Lunas</option>
                    </select>
                </div>
            </div>

            <!-- Second Row -->
            <div class="form-grid">
                <!-- Customer -->
                <div class="form-group">
                    <label class="form-label">Customer <span class="required">*</span></label>
                    <select class="form-select" id="idCustomer" name="idCustomer" required>
                        <option value="">-- Pilih Customer --</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id_customer }}">{{ $customer->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Pegawai CS -->
                <div class="form-group">
                    <label class="form-label">Pegawai CS <span class="required">*</span></label>
                    <select class="form-select" id="idPegawaiCs" name="idPegawaiCs" required>
                        <option value="">-- Pilih Pegawai CS --</option>
                        @foreach ($pegawaiCS as $cs)
                            <option value="{{ $cs->id_pegawai }}">{{ $cs->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Pegawai Kasir -->
                <div class="form-group">
                    <label class="form-label">Pegawai Kasir <span class="required">*</span></label>
                    <select class="form-select" id="idPegawaiKasir" name="idPegawaiKasir" required>
                        <option value="">-- Pilih Pegawai Kasir --</option>
                        @foreach ($pegawaiKasir as $kasir)
                            <option value="{{ $kasir->id_pegawai }}">{{ $kasir->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <!-- Product Table Section -->
        <div class="product-section">
            <div class="product-header">
                <div class="section-title" style="margin: 0;">📦 Daftar Produk Penjualan</div>
                <button type="button" class="btn btn-primary" onclick="tambahProduk()">+ Tambah Produk</button>
            </div>

            <div id="tableContainer">
                <div class="empty-state">
                    <div class="empty-icon">📦</div>
                    <p>Belum ada produk. Klik tombol "Tambah Produk" untuk memulai.</p>
                </div>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="summary-section">
            <div class="summary-item">
                <span class="summary-label">Subtotal</span>
                <span class="summary-value">Rp <span id="subtotalDisplay">0</span></span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Diskon</span>
                <span class="summary-value">Rp <span id="diskonDisplay">0</span></span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Total Bayar</span>
                <span class="summary-value" style="color: #d97706;">Rp <span id="totalBayarDisplay">0</span></span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Jumlah Item</span>
                <span class="summary-value"><span id="jumlahItemDisplay">0</span> Item</span>
            </div>
        </div>

        <!-- Diskon Section -->
        <div class="form-section">
            <div class="section-title">💰 Diskon & Total</div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Diskon (Rp)</label>
                    <input type="number" class="form-input" id="diskon" min="0" value="0" onchange="hitungTotal()" placeholder="0">
                    <small class="text-muted text-sm">Masukkan jumlah diskon</small>
                </div>
                <div class="form-group">
                    <label class="form-label">Total Bayar (Rp)</label>
                    <input type="text" class="form-input" id="totalBayar" disabled placeholder="0">
                    <small class="text-muted text-sm">Otomatis terhitung</small>
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="footer-actions">
            <button type="button" class="btn btn-secondary" onclick="resetForm()">🔄 Reset</button>
            <button type="button" class="btn btn-primary" onclick="simpanTransaksi()" id="simpanBtn">💾 Simpan Transaksi</button>
        </div>
    </div>

  <script>
    // ====== STATE GLOBAL ======
    let daftarProduk = [];
    let daftarCustomer = [];
    let daftarPegawaiCs = [];
    let daftarPegawaiKasir = [];
    let produkDitambahkan = [];

    // ====== SAAT HALAMAN DIMUAT ======
    document.addEventListener('DOMContentLoaded', async function() {
        const now = new Date();
        const isoString = new Date(now.getTime() - (now.getTimezoneOffset() * 60000))
            .toISOString().slice(0, 16);
        document.getElementById('tanggalTransaksi').value = isoString;

        

        // 🔹 Ambil semua data dari API Laravel
        await Promise.all([
            ambilDaftarProduk(),
            ambilDaftarCustomer(),
            ambilDaftarPegawai()
        ]);
    });

    // ====== AMBIL PRODUK DARI API ======
    async function ambilDaftarProduk() {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/products');
            if (!response.ok) throw new Error('Gagal memuat produk');
            const result = await response.json();
            daftarProduk = result.map(p => ({
                id: p.id_produk,
                nama: p.nama,
                harga: parseFloat(p.harga)
            }));
            console.log('✅ Produk dimuat:', daftarProduk);
        } catch (error) {
            console.error('❌ Error produk:', error);
            tampilkanToast('Gagal memuat data produk!', 'error');
        }
    }

    // ====== AMBIL CUSTOMER DARI API ======
    async function ambilDaftarCustomer() {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/customer');
            if (!response.ok) throw new Error('Gagal memuat customer');
            const result = await response.json();
            daftarCustomer = result.map(c => ({
                id: c.id_customer,
                nama: c.nama
            }));
            isiDropdownCustomer();
            console.log('✅ Customer dimuat:', daftarCustomer);
        } catch (error) {
            console.error('❌ Error customer:', error);
            tampilkanToast('Gagal memuat data customer!', 'error');
        }
    }

    // ====== AMBIL PEGAWAI DARI API ======
    async function ambilDaftarPegawai() {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/pegawai');
            if (!response.ok) throw new Error('Gagal memuat pegawai');
            const result = await response.json();

            // Filter berdasarkan jabatan
            daftarPegawaiCs = result.filter(p => p.jabatan === 'cs');
            daftarPegawaiKasir = result.filter(p => p.jabatan === 'kasir');

            isiDropdownPegawai();
            console.log('✅ Pegawai dimuat:', result);
        } catch (error) {
            console.error('❌ Error pegawai:', error);
            tampilkanToast('Gagal memuat data pegawai!', 'error');
        }
    }

    // ====== ISI DROPDOWN CUSTOMER ======
    function isiDropdownCustomer() {
        const selectCustomer = document.getElementById('idCustomer');
        selectCustomer.innerHTML = `<option value="">-- Pilih Customer --</option>`;
        daftarCustomer.forEach(c => {
            selectCustomer.innerHTML += `<option value="${c.id}">${c.nama}</option>`;
        });
    }

    // ====== ISI DROPDOWN PEGAWAI (CS & KASIR) ======
    function isiDropdownPegawai() {
        const selectCs = document.getElementById('idPegawaiCs');
        const selectKasir = document.getElementById('idPegawaiKasir');

        selectCs.innerHTML = `<option value="">-- Pilih Pegawai CS --</option>`;
        daftarPegawaiCs.forEach(p => {
            selectCs.innerHTML += `<option value="${p.id_pegawai}">${p.nama}</option>`;
        });

        selectKasir.innerHTML = `<option value="">-- Pilih Pegawai Kasir --</option>`;
        daftarPegawaiKasir.forEach(p => {
            selectKasir.innerHTML += `<option value="${p.id_pegawai}">${p.nama}</option>`;
        });
    }

   

    // ====== TAMBAH PRODUK ======
    function tambahProduk() {
        produkDitambahkan.push({
            id: null,
            namaProduk: '',
            hargaSatuan: 0,
            jumlah: 1,
            subtotal: 0
        });
        renderTabel();
    }

    // ====== RENDER TABEL PRODUK ======
    function renderTabel() {
        const container = document.getElementById('tableContainer');
        if (produkDitambahkan.length === 0) {
            container.innerHTML = `
                <div class="empty-state">
                    <div class="empty-icon">📦</div>
                    <p>Belum ada produk. Klik tombol "Tambah Produk" untuk memulai.</p>
                </div>
            `;
            hitungTotal();
            return;
        }

        let html = `
            <div class="table-wrapper">
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        produkDitambahkan.forEach((produk, idx) => {
            html += `
                <tr>
                    <td>${idx + 1}</td>
                    <td>
                        <select class="form-input" onchange="updateProduk(${idx}, this.value)">
                            <option value="">-- Pilih Produk --</option>
                            ${daftarProduk.map(p =>
                                `<option value="${p.id}" ${produk.namaProduk === p.nama ? 'selected' : ''}>${p.nama}</option>`
                            ).join('')}
                        </select>
                    </td>
                    <td>Rp ${produk.hargaSatuan.toLocaleString('id-ID')}</td>
                    <td><input type="number" class="form-input" min="1" value="${produk.jumlah}" onchange="updateJumlah(${idx}, this.value)"></td>
                    <td>Rp ${produk.subtotal.toLocaleString('id-ID')}</td>
                    <td><button class="btn btn-danger btn-small" onclick="hapusProduk(${idx})">Hapus</button></td>
                </tr>`;
        });

        html += `</tbody></table></div>`;
        container.innerHTML = html;
        hitungTotal();
    }

    // ====== UPDATE PRODUK ======
    function updateProduk(index, produkId) {
        const produk = daftarProduk.find(p => p.id === parseInt(produkId));
        if (produk) {
            produkDitambahkan[index] = {
                id: produk.id,
                namaProduk: produk.nama,
                hargaSatuan: produk.harga,
                jumlah: 1,
                subtotal: produk.harga
            };
        }
        renderTabel();
    }

    // ====== UPDATE JUMLAH ======
    function updateJumlah(index, jumlah) {
        const jml = parseInt(jumlah) || 0;
        if (jml > 0) {
            produkDitambahkan[index].jumlah = jml;
            produkDitambahkan[index].subtotal =
                produkDitambahkan[index].hargaSatuan * jml;
        }
        renderTabel();
    }

    // ====== HAPUS PRODUK ======
    function hapusProduk(index) {
        if (confirm('Yakin ingin menghapus produk ini?')) {
            produkDitambahkan.splice(index, 1);
            renderTabel();
        }
    }

    // ====== HITUNG TOTAL ======
    function hitungTotal() {
        const subtotal = produkDitambahkan.reduce((s, p) => s + p.subtotal, 0);
        const diskon = parseInt(document.getElementById('diskon').value) || 0;
        const totalBayar = subtotal - diskon;
        const jumlahItem = produkDitambahkan.reduce((s, p) => s + p.jumlah, 0);

        document.getElementById('subtotalDisplay').textContent = subtotal.toLocaleString('id-ID');
        document.getElementById('diskonDisplay').textContent = diskon.toLocaleString('id-ID');
        document.getElementById('totalBayarDisplay').textContent = totalBayar.toLocaleString('id-ID');
        document.getElementById('jumlahItemDisplay').textContent = jumlahItem;
        document.getElementById('totalBayar').value = totalBayar.toLocaleString('id-ID');
    }

    // ====== SIMPAN TRANSAKSI ======
    // ====== SIMPAN TRANSAKSI ======
async function simpanTransaksi() {
    // Validasi dasar
    if (!document.getElementById('idCustomer').value)
        return tampilkanToast('Pilih customer terlebih dahulu!', 'error');
    if (!document.getElementById('idPegawaiCs').value)
        return tampilkanToast('Pilih pegawai CS terlebih dahulu!', 'error');
    if (!document.getElementById('idPegawaiKasir').value)
        return tampilkanToast('Pilih pegawai kasir terlebih dahulu!', 'error');
    if (produkDitambahkan.length === 0)
        return tampilkanToast('Tambahkan minimal 1 produk!', 'error');
    if (!document.getElementById('statusPembayaran').value)
        return tampilkanToast('Pilih status pembayaran!', 'error');

    const simpanBtn = document.getElementById('simpanBtn');
    simpanBtn.disabled = true;
    simpanBtn.textContent = '⏳ Menyimpan...';

    const subtotal = produkDitambahkan.reduce((s, p) => s + p.subtotal, 0);
    const diskon = parseInt(document.getElementById('diskon').value) || 0;
    const totalBayar = subtotal - diskon;

    // ✅ Sesuaikan nama field dengan yang diminta backend
    const data = {
        id_customer: document.getElementById('idCustomer').value,
        id_pegawai: document.getElementById('idPegawaiCs').value, // bisa diganti jika backend butuh id pegawai utama
        id_pegawai_cs: document.getElementById('idPegawaiCs').value,
        id_pegawai_kasir: document.getElementById('idPegawaiKasir').value,
        tangal_transaksi: document.getElementById('tanggalTransaksi').value,
        subtotal: subtotal,
        diskon: diskon,
        total_bayar: totalBayar,
        status_pembayaran: document.getElementById('statusPembayaran').value,
        produk: produkDitambahkan.map(p => ({
            id_produk: p.id,
            jumlah: p.jumlah,
            subtotal: p.subtotal
        }))
    };

    console.log('📦 Data dikirim ke backend:', data);

    try {
        const response = await fetch('http://127.0.0.1:8000/api/transaksi-produk', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok) {
            tampilkanToast('✓ Transaksi berhasil disimpan!', 'success');
            resetForm();
        } else {
            console.error('❌ Validasi gagal:', result);
            tampilkanToast('Gagal: ' + result.message, 'error');
        }
    } catch (err) {
        tampilkanToast('Terjadi kesalahan: ' + err.message, 'error');
    } finally {
        simpanBtn.disabled = false;
        simpanBtn.textContent = '💾 Simpan Transaksi';
    }
}


    // ====== RESET FORM ======
    function resetForm() {
        document.getElementById('transaksiForm').reset();
        produkDitambahkan = [];
        document.getElementById('diskon').value = '0';
        renderTabel();
        

        const now = new Date();
        const isoString = new Date(now.getTime() - (now.getTimezoneOffset() * 60000))
            .toISOString().slice(0, 16);
        document.getElementById('tanggalTransaksi').value = isoString;
    }

    // ====== TOAST ======
    function tampilkanToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.classList.add('hide');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
</script>



</body>
</html>