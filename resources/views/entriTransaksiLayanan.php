<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entri Data Layanan - Kouvee Pet Shop</title>
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

        /* Service Table Section */
        .service-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .service-header {
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

        .service-table {
            width: 100%;
            border-collapse: collapse;
        }

        .service-table thead {
            background: #f3f4f6;
            border-bottom: 2px solid #e5e7eb;
        }

        .service-table th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #1f2937;
            font-size: 0.875rem;
        }

        .service-table td {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.875rem;
        }

        .service-table tbody tr:hover {
            background: #f9fafb;
        }

        .service-table tbody tr:last-child td {
            border-bottom: none;
        }

        .service-table input[type="number"],
        .service-table select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }

        .service-table input[type="number"]:focus,
        .service-table select:focus {
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

        /* Loading State */
        .loading {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .service-header {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }

            .service-table {
                font-size: 0.75rem;
            }

            .service-table th,
            .service-table td {
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
                <span>Dashboard</span> / <span>Entri Data Layanan</span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">📋 Entri Data Layanan Hewan</h1>
            <p class="page-subtitle">Kelola transaksi layanan perawatan hewan dengan mudah dan cepat</p>
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
                    <select class="form-select" id="idCustomer" name="idCustomer" required onchange="onCustomerChange()">
                        <option value="">-- Pilih Customer --</option>
                    </select>
                </div>

                <!-- Hewan owned by customer -->
                <div class="form-group">
                    <label class="form-label">Hewan <span class="required">*</span></label>
                    <select class="form-select" id="idHewan" name="idHewan" required>
                        <option value="">-- Pilih Hewan --</option>
                    </select>
                </div>

                <!-- Pegawai CS -->
                <div class="form-group">
                    <label class="form-label">Pegawai CS <span class="required">*</span></label>
                    <select class="form-select" id="idPegawaiCs" name="idPegawaiCs" required>
                        <option value="">-- Pilih Pegawai CS --</option>
                    </select>
                </div>
            </div>

            <!-- Third Row -->
            <div class="form-grid">
                <!-- Pegawai Kasir -->
                <div class="form-group">
                    <label class="form-label">Pegawai Kasir <span class="required">*</span></label>
                    <select class="form-select" id="idPegawaiKasir" name="idPegawaiKasir" required>
                        <option value="">-- Pilih Pegawai Kasir --</option>
                    </select>
                </div>
            </div>
        </form>

        <!-- Service Table Section -->
        <div class="service-section">
            <div class="service-header">
                <div class="section-title" style="margin: 0;">🏥 Daftar Layanan</div>
                <button type="button" class="btn btn-primary" onclick="tambahLayanan()">+ Tambah Layanan</button>
            </div>

            <div id="tableContainer">
                <div class="empty-state">
                    <div class="empty-icon">🏥</div>
                    <p>Belum ada layanan. Klik tombol "Tambah Layanan" untuk menambahkan.</p>
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
                <span class="summary-label">Jumlah Layanan</span>
                <span class="summary-value"><span id="jumlahLayananDisplay">0</span> Item</span>
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
        const API_BASE_URL = 'http://127.0.0.1:8000/api';
        
        // State untuk layanan yang ditambahkan
        let layananDitambahkan = [];
        let daftarLayanan = [];
        let daftarHewan = [];
        let allHewan = [];

        // Initialize
        document.addEventListener('DOMContentLoaded', async function() {
            const now = new Date();
            const isoString = new Date(now.getTime() - (now.getTimezoneOffset() * 60000)).toISOString().slice(0, 16);
            document.getElementById('tanggalTransaksi').value = isoString;
            
            // Load data from API
            await loadDataFromAPI();
          
        });

        async function loadDataFromAPI() {
            try {
                // Load customers
                const customersRes = await fetch(`${API_BASE_URL}/customer`);
                const customers = await customersRes.json();
                populateSelect('idCustomer', customers, 'id_customer', 'nama');

                // Load all hewan (for later filtering)
                const hewanRes = await fetch(`${API_BASE_URL}/hewans`);
                allHewan = await hewanRes.json();

                // Load layanan
                const layananRes = await fetch(`${API_BASE_URL}/layanan`);
                daftarLayanan = await layananRes.json();

                // Load pegawai CS
                const pegawaiRes = await fetch(`${API_BASE_URL}/pegawai`);
                const pegawai = await pegawaiRes.json();
                
                // Filter CS (customer service)
                const pegawaiCS = pegawai.filter(p => p.jabatan === 'cs');
                populateSelect('idPegawaiCs', pegawaiCS, 'id_pegawai', 'nama');

                // Filter Kasir
                const pegawaiKasir = pegawai.filter(p => p.jabatan === 'kasir');
                populateSelect('idPegawaiKasir', pegawaiKasir, 'id_pegawai', 'nama');

                tampilkanToast('✓ Data berhasil dimuat', 'success');
            } catch (error) {
                console.error('Error loading data:', error);
                tampilkanToast('✗ Error memuat data dari server', 'error');
            }
        }

        function populateSelect(selectId, data, valueField, labelField) {
            const select = document.getElementById(selectId);
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item[valueField];
                option.textContent = item[labelField];
                select.appendChild(option);
            });
        }

        function onCustomerChange() {
    const customerId = document.getElementById('idCustomer').value;
    const hewanSelect = document.getElementById('idHewan');
    
    // Kosongkan dropdown dulu
    hewanSelect.innerHTML = '<option value="">-- Pilih Hewan --</option>';

    if (!customerId) return;

    // Filter hewan berdasarkan customer
    const hewanCustomer = allHewan.filter(h => String(h.id_customer) === String(customerId));

    console.log('🎯 Hewan milik customer', customerId, hewanCustomer); // Debug log

    if (hewanCustomer.length === 0) {
        hewanSelect.innerHTML = '<option value="">(Tidak ada hewan untuk customer ini)</option>';
        return;
    }

    // Isi dropdown hewan
    hewanCustomer.forEach(h => {
        const option = document.createElement('option');
        option.value = h.id_hewan;
        option.textContent = `${h.nama} (${h.jenis_hewan})`;
        hewanSelect.appendChild(option);
    });
}


        

        // Tambah layanan baru
        function tambahLayanan() {
            const index = layananDitambahkan.length;
            layananDitambahkan.push({
                id: index,
                idLayanan: '',
                namaLayanan: '',
                hargaSatuan: 0,
                subtotal: 0
            });
            
            renderTabel();
        }

        function renderTabel() {
            const container = document.getElementById('tableContainer');
            
            if (layananDitambahkan.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-icon">💇</div>
                        <p>Belum ada layanan. Klik tombol "Tambah Layanan" untuk menambahkan.</p>
                    </div>
                `;
                hitungTotal();
                return;
            }

            let html = `
                <div class="table-wrapper">
                    <table class="service-table">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 50%;">Nama Layanan</th>
                                <th style="width: 20%;">Harga</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            layananDitambahkan.forEach((layanan, idx) => {
                const no = idx + 1;
                const hargaFormatted = layanan.hargaSatuan.toLocaleString('id-ID');

                html += `
                    <tr>
                        <td>${no}</td>
                        <td>
                            <select class="form-input" onchange="updateLayanan(${idx}, this.value)">
                                <option value="">-- Pilih Layanan --</option>
                                ${daftarLayanan.map(l => 
                                    `<option value="${l.id_layanan}" ${layanan.idLayanan == l.id_layanan ? 'selected' : ''}>${l.nama} (Rp ${l.harga.toLocaleString('id-ID')})</option>`
                                ).join('')}
                            </select>
                        </td>
                        <td>Rp ${hargaFormatted}</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-small" onclick="hapusLayanan(${idx})">Hapus</button>
                        </td>
                    </tr>
                `;
            });

            html += `
                        </tbody>
                    </table>
                </div>
            `;

            container.innerHTML = html;
            hitungTotal();
        }

        function updateLayanan(index, layananId) {
            const layanan = daftarLayanan.find(l => l.id_layanan === parseInt(layananId));
            if (layanan) {
                layananDitambahkan[index].idLayanan = layanan.id_layanan;
                layananDitambahkan[index].namaLayanan = layanan.nama;
                layananDitambahkan[index].hargaSatuan = parseFloat(layanan.harga);
                layananDitambahkan[index].subtotal = parseFloat(layanan.harga);
            }
            renderTabel();
        }

        // Hapus layanan dari daftar
        function hapusLayanan(index) {
            if (confirm('Yakin ingin menghapus layanan ini?')) {
                layananDitambahkan.splice(index, 1);
                renderTabel();
            }
        }

        // Hitung total
        function hitungTotal() {
            const subtotal = layananDitambahkan.reduce((sum, l) => sum + l.subtotal, 0);
            const diskon = parseInt(document.getElementById('diskon').value) || 0;
            const totalBayar = subtotal - diskon;
            const jumlahLayanan = layananDitambahkan.length;

            // Update display
            document.getElementById('subtotalDisplay').textContent = subtotal.toLocaleString('id-ID');
            document.getElementById('diskonDisplay').textContent = diskon.toLocaleString('id-ID');
            document.getElementById('totalBayarDisplay').textContent = totalBayar.toLocaleString('id-ID');
            document.getElementById('jumlahLayananDisplay').textContent = jumlahLayanan;
            document.getElementById('totalBayar').value = totalBayar.toLocaleString('id-ID');
        }

        async function simpanTransaksi() {
    // Validasi form dasar
    const idCustomer = document.getElementById('idCustomer').value;
    const idHewan = document.getElementById('idHewan').value;
    const idPegawaiCs = document.getElementById('idPegawaiCs').value;
    const idPegawaiKasir = document.getElementById('idPegawaiKasir').value;
    const statusPembayaran = document.getElementById('statusPembayaran').value;
    const tanggalTransaksi = document.getElementById('tanggalTransaksi').value;

    if (!idCustomer) return tampilkanToast('Pilih customer terlebih dahulu!', 'error');
    if (!idHewan) return tampilkanToast('Pilih hewan terlebih dahulu!', 'error');
    if (!idPegawaiCs) return tampilkanToast('Pilih pegawai CS terlebih dahulu!', 'error');
    if (!idPegawaiKasir) return tampilkanToast('Pilih pegawai kasir terlebih dahulu!', 'error');
    if (layananDitambahkan.length === 0) return tampilkanToast('Tambahkan minimal 1 layanan!', 'error');
    if (!statusPembayaran) return tampilkanToast('Pilih status pembayaran!', 'error');

    const simpanBtn = document.getElementById('simpanBtn');
    simpanBtn.disabled = true;
    simpanBtn.innerHTML = '<span class="loading"></span> Menyimpan...';

    const subtotal = layananDitambahkan.reduce((sum, l) => sum + l.subtotal, 0);
    const diskon = parseInt(document.getElementById('diskon').value) || 0;
    const totalBayar = subtotal - diskon;

    // Format daftar layanan ke bentuk siap kirim
    const detailLayanan = layananDitambahkan.map(l => ({
        id_layanan: l.idLayanan,
        id_hewan: idHewan,
        subtotal_per_layanan: l.subtotal
    }));

    try {
        const response = await fetch(`${API_BASE_URL}/transaksi-layanan`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id_customer: idCustomer,
                id_pegawai_cs: idPegawaiCs,
                id_pegawai_kasir: idPegawaiKasir,
                tanggal_transaksi: tanggalTransaksi,
                subtotal: subtotal,
                diskon: diskon,
                total_bayar: totalBayar,
                status_pembayaran: statusPembayaran,
                detail_layanan: detailLayanan // dikirim sekaligus ke backend
            })
        });

        if (!response.ok) {
            const text = await response.text();
            throw new Error(`Gagal menyimpan transaksi: ${text}`);
        }

        tampilkanToast('✓ Transaksi berhasil disimpan!', 'success');
        
        // Reset form setelah sukses
        setTimeout(() => {
            resetForm();
            simpanBtn.disabled = false;
            simpanBtn.textContent = '💾 Simpan Transaksi';
        }, 1500);
    } catch (error) {
        console.error('Error saving transaction:', error);
        tampilkanToast('✗ Error: ' + error.message, 'error');
        simpanBtn.disabled = false;
        simpanBtn.textContent = '💾 Simpan Transaksi';
    }
}


        // Reset form
        function resetForm() {
            document.getElementById('transaksiForm').reset();
            layananDitambahkan = [];
            document.getElementById('diskon').value = '0';
            renderTabel();
           
            
            // Reset tanggal ke hari ini
            const now = new Date();
            const isoString = new Date(now.getTime() - (now.getTimezoneOffset() * 60000)).toISOString().slice(0, 16);
            document.getElementById('tanggalTransaksi').value = isoString;
            
            // Reset hewan select
            document.getElementById('idHewan').innerHTML = '<option value="">-- Pilih Hewan --</option>';
        }

        // Tampilkan Toast Notification
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
