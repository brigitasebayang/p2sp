<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Transaksi - Kouvee Pet Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #d97706;
            --primary-hover: #b45309;
            --secondary-color: #1f2937;
            --bg-light: #fef3c7;
            --bg-dark: #ffffff;
            --border-color: #e5e7eb;
            --danger-color: #ef4444;
            --success-color: #10b981;
            --warning-color: #f59e0b;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-light);
            color: var(--secondary-color);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 40px 0 30px 0;
            padding-bottom: 20px;
            border-bottom: 3px solid var(--primary-color);
        }

        .header h1 { font-size: 2rem; font-weight: 700; color: var(--primary-color); }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--border-color);
        }

        .tab-btn {
            padding: 12px 24px;
            border: none;
            background: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            color: #6b7280;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        .tab-btn:hover { color: var(--primary-color); }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .search-bar {
            background: var(--bg-dark);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            display: flex;
            gap: 15px;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .search-bar input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 1rem;
        }

        .search-bar input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(217,119,6,0.1);
        }

        .table-wrapper {
            background: var(--bg-dark);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--primary-color);
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        tbody tr:hover {
            background: var(--bg-light);
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-edit {
            background: #3b82f6;
            color: white;
        }

        .btn-edit:hover {
            background: #2563eb;
        }

        .btn-delete {
            background: var(--danger-color);
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-align: center;
            display: inline-block;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-progress {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--bg-dark);
            padding: 30px;
            border-radius: 12px;
            max-width: 600px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border-color);
        }

        .modal-header h2 {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 1rem;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(217,119,6,0.1);
        }

        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid var(--border-color);
        }

        .btn-cancel {
            background: #e5e7eb;
            color: var(--secondary-color);
        }

        .btn-cancel:hover {
            background: #d1d5db;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }

        .alert.show { display: block; }
        .alert.success { background: #dcfce7; color: #166534; border-left: 4px solid var(--success-color); }
        .alert.error { background: #fee2e2; color: #991b1b; border-left: 4px solid var(--danger-color); }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .item-card {
            background: var(--bg-light);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid var(--primary-color);
        }

        .item-card-title {
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 10px;
        }

        .item-card-detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            font-size: 0.9rem;
            color: #6b7280;
        }

        .loading {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #e5e7eb;
            border-top-color: var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .header { flex-direction: column; align-items: flex-start; gap: 15px; }
            .tabs { flex-wrap: wrap; }
            .search-bar { flex-direction: column; }
            .table-wrapper { font-size: 0.85rem; }
            th, td { padding: 10px; }
            .btn { padding: 6px 12px; font-size: 0.8rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Kelola Transaksi</h1>
        </div>

        <div id="alertBox" class="alert"></div>

        <!-- Tab Navigation -->
        <div class="tabs">
            <button class="tab-btn active" onclick="switchTab(event, 'produk')">
                📦 Transaksi Produk
            </button>
            <button class="tab-btn" onclick="switchTab(event, 'layanan')">
                💼 Transaksi Layanan
            </button>
        </div>

        <!-- TAB: Transaksi Produk -->
        <div id="produk" class="tab-content active">
            <div class="search-bar">
                <input type="text" id="searchProduk" placeholder="Cari transaksi produk..." 
                    onkeyup="filterTransaksiProduk()">
            </div>

            <div class="table-wrapper">
                <table id="tabelProduk">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>ID Detail</th>
                            <th>Nama Produk</th>
                            <th>Qty</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTabelProduk">
                        <tr class="loading"><td colspan="7"><div class="spinner"></div> Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TAB: Transaksi Layanan -->
        <div id="layanan" class="tab-content">
            <div class="search-bar">
                <input type="text" id="searchLayanan" placeholder="Cari transaksi layanan..." 
                    onkeyup="filterTransaksiLayanan()">
            </div>

            <div class="table-wrapper">
                <table id="tabelLayanan">
                    <thead>
                        <tr>
                            <th>ID Layanan</th>
                            <th>Nama Layanan</th>
                            <th>Harga</th>

                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTabelLayanan">
                        <tr class="loading"><td colspan="6"><div class="spinner"></div> Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit Item Produk -->
    <div id="modalEditProduk" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Item Transaksi Produk</h2>
                <button class="modal-close" onclick="closeModal('modalEditProduk')">×</button>
            </div>
            <form id="formEditProduk" onsubmit="submitEditProduk(event)">
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" id="produkNama" readonly style="background: #f3f4f6;">
                </div>
                <div class="form-group">
                    <label>Qty</label>
                    <input type="number" id="produkQty" min="1" required>
                </div>
                <div class="form-group">
                    <label>Harga Satuan (Rp)</label>
                    <input type="number" id="produkHarga" min="0" required>
                </div>
                <div class="form-group">
                    <label>Subtotal (Rp)</label>
                    <input type="number" id="produkSubtotal" readonly style="background: #f3f4f6; color: var(--primary-color); font-weight: 600;">
                </div>
                <input type="hidden" id="produkId">
                <div class="form-actions">
                    <button type="button" class="btn btn-cancel" onclick="closeModal('modalEditProduk')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Item Layanan -->
    <div id="modalEditLayanan" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Item Transaksi Layanan</h2>
                <button class="modal-close" onclick="closeModal('modalEditLayanan')">×</button>
            </div>
            <form id="formEditLayanan" onsubmit="submitEditLayanan(event)">
                <div class="form-group">
                    <label>Nama Layanan</label>
                    <input type="text" id="layananNama" required>
                </div>
                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" id="layananHarga" min="0" required>
                </div>
          
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea id="layananDeskripsi" rows="4"></textarea>
                </div>
                <input type="hidden" id="layananId">
                <div class="form-actions">
                    <button type="button" class="btn btn-cancel" onclick="closeModal('modalEditLayanan')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Status Layanan -->
    <div id="modalEditStatus" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Update Status Layanan</h2>
                <button class="modal-close" onclick="closeModal('modalEditStatus')">×</button>
            </div>
            <form id="formEditStatus" onsubmit="submitEditStatus(event)">
                <div class="form-group">
                    <label>Nama Layanan</label>
                    <input type="text" id="statusLayananNama" readonly style="background: #f3f4f6;">
                </div>
                <div class="form-group">
                    <label>Status *</label>
                    <select id="statusValue" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="pending">⏳ Pending</option>
                        <option value="in_progress">🔄 In Progress</option>
                        <option value="completed">✅ Completed</option>
                        <option value="cancelled">❌ Cancelled</option>
                    </select>
                </div>
                <input type="hidden" id="statusLayananId">
                <div class="form-actions">
                    <button type="button" class="btn btn-cancel" onclick="closeModal('modalEditStatus')">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const API_URL = 'http://127.0.0.1:8000/api';
        let dataProduk = [];
        let dataLayanan = [];
        let filteredProduk = [];
        let filteredLayanan = [];

        // Load Data
        async function loadData() {
            await loadTransaksiProduk();
            await loadTransaksiLayanan();
        }

        async function loadTransaksiProduk() {
            try {
                const response = await fetch(`${API_URL}/detailproducts`);
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                const result = await response.json();
                if (Array.isArray(result)) {
                    dataProduk = result;
                } else if (result.data && Array.isArray(result.data)) {
                    dataProduk = result.data;
                } else if (result.results && Array.isArray(result.results)) {
                    dataProduk = result.results;
                } else {
                    dataProduk = [];
                }
                
                console.log("[v0] Loaded products data:", dataProduk);
                
                filteredProduk = [...dataProduk];
                renderTableProduk();
            } catch (error) {
                console.error('Error loading transaksi produk:', error);
                showAlert('Gagal memuat data transaksi produk: ' + error.message, 'error');
                document.getElementById('bodyTabelProduk').innerHTML = 
                    '<tr><td colspan="7" class="empty-state">Gagal memuat data. Pastikan backend running di http://127.0.0.1:8000</td></tr>';
            }
        }

        async function loadTransaksiLayanan() {
            try {
                const response = await fetch(`${API_URL}/layanans`);
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                const result = await response.json();
                if (Array.isArray(result)) {
                    dataLayanan = result;
                } else if (result.data && Array.isArray(result.data)) {
                    dataLayanan = result.data;
                } else if (result.results && Array.isArray(result.results)) {
                    dataLayanan = result.results;
                } else {
                    dataLayanan = [];
                }
                
                console.log("[v0] Loaded services data:", dataLayanan);
                
                filteredLayanan = [...dataLayanan];
                renderTableLayanan();
            } catch (error) {
                console.error('Error loading transaksi layanan:', error);
                showAlert('Gagal memuat data transaksi layanan: ' + error.message, 'error');
                document.getElementById('bodyTabelLayanan').innerHTML = 
                    '<tr><td colspan="6" class="empty-state">Gagal memuat data. Pastikan backend running di http://127.0.0.1:8000</td></tr>';
            }
        }

        function renderTableProduk() {
            const tbody = document.getElementById('bodyTabelProduk');
            if (!dataProduk || dataProduk.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="empty-state"><div class="empty-state-icon">📭</div>Tidak ada data transaksi produk</td></tr>';
                return;
            }

            tbody.innerHTML = dataProduk.map(item => {
                const idTransaksi = item.id_transaksi_produk || item.id || '-';
                const idDetail = item.id || '-';
                const namaProduk = item.nama_produk || item.product?.nama || item.nama || 'N/A';
                const qty = parseInt(item.jumlah || item.qty || 0);
                const hargaSatuan = parseInt(item.harga_satuan || item.harga || 0);
                const subtotal = qty * hargaSatuan;
                
                return `
                    <tr>
                        <td><strong>${idTransaksi}</strong></td>
                        <td>${idDetail}</td>
                        <td>${namaProduk}</td>
                        <td>${qty}</td>
                        <td>Rp ${hargaSatuan.toLocaleString('id-ID')}</td>
                        <td><strong>Rp ${subtotal.toLocaleString('id-ID')}</strong></td>
                        <td>
                            <button class="btn btn-edit" onclick="openEditProduk(${idDetail})">✏ Edit</button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        function renderTableLayanan() {
            const tbody = document.getElementById('bodyTabelLayanan');
            if (!dataLayanan || dataLayanan.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="empty-state"><div class="empty-state-icon">📭</div>Tidak ada data transaksi layanan</td></tr>';
                return;
            }

            tbody.innerHTML = dataLayanan.map(item => {
                const layananId = item.id_layanan || item.id || '-';
                const namayanan = item.nama || 'N/A';
                const harga = parseInt(item.harga || 0);
     
                const status = item.status || 'pending'; // Default to pending if undefined
                
                const statusMap = {
                    'pending': 'status-pending',
                    'in_progress': 'status-progress',
                    'in-progress': 'status-progress',
                    'completed': 'status-completed',
                    'cancelled': 'status-cancelled'
                };
                const statusClass = statusMap[status] || 'status-pending';
                const statusText = {
                    'pending': '⏳ Pending',
                    'in_progress': '🔄 In Progress',
                    'in-progress': '🔄 In Progress',
                    'completed': '✅ Completed',
                    'cancelled': '❌ Cancelled'
                };

                return `
                    <tr>
                        <td><strong>${layananId}</strong></td>
                        <td>${namayanan}</td>
                        <td>Rp ${harga.toLocaleString('id-ID')}</td>
                      
                        <td><span class="status-badge ${statusClass}">${statusText[status] || status}</span></td>
                        <td>
                            <button class="btn btn-edit" onclick="openEditLayanan(${layananId})">✏ Edit</button>
                            <button class="btn btn-edit" onclick="openEditStatus(${layananId})" style="background: #8b5cf6;">🔄 Status</button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        function openEditProduk(id) {
            const item = dataProduk.find(p => p.id === id);
            if (!item) {
                showAlert('Item produk tidak ditemukan', 'error');
                return;
            }

            document.getElementById('produkId').value = item.id;
            document.getElementById('produkNama').value = item.nama_produk || item.product?.nama || 'N/A';
            document.getElementById('produkQty').value = item.jumlah || item.qty || 0;
            document.getElementById('produkHarga').value = item.harga_satuan || item.harga || 0;
            
            const subtotal = (item.jumlah || item.qty || 0) * (item.harga_satuan || item.harga || 0);
            document.getElementById('produkSubtotal').value = subtotal;

            document.getElementById('produkQty').addEventListener('change', updateSubtotal);
            document.getElementById('produkHarga').addEventListener('change', updateSubtotal);

            openModal('modalEditProduk');
        }

        function openEditLayanan(id) {
            const item = dataLayanan.find(l => l.id_layanan === id || l.id === id);
            if (!item) {
                showAlert('Item layanan tidak ditemukan', 'error');
                return;
            }

            document.getElementById('layananId').value = item.id_layanan || item.id;
            document.getElementById('layananNama').value = item.nama || '';
            document.getElementById('layananHarga').value = item.harga || 0;
         
            document.getElementById('layananDeskripsi').value = item.deskripsi || '';

            openModal('modalEditLayanan');
        }

        function openEditStatus(id) {
            const item = dataLayanan.find(l => l.id_layanan === id || l.id === id);
            if (!item) {
                showAlert('Item layanan tidak ditemukan', 'error');
                return;
            }

            document.getElementById('statusLayananId').value = item.id_layanan || item.id;
            document.getElementById('statusLayananNama').value = item.nama || '';
            document.getElementById('statusValue').value = item.status || 'pending';

            openModal('modalEditStatus');
        }

        async function submitEditProduk(e) {
            e.preventDefault();

            const id = document.getElementById('produkId').value;
            const jumlah = parseInt(document.getElementById('produkQty').value);
            const harga_satuan = parseInt(document.getElementById('produkHarga').value);

            if (!id || jumlah < 1 || harga_satuan < 0) {
                showAlert('Data tidak valid', 'error');
                return;
            }

            try {
                const response = await fetch(`${API_URL}/detailproducts/${id}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        jumlah: jumlah,
                        harga_satuan: harga_satuan
                    })
                });

                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

                showAlert('✅ Item produk berhasil diperbarui!', 'success');
                closeModal('modalEditProduk');
                await loadTransaksiProduk();
            } catch (error) {
                console.error('Error:', error);
                showAlert('Gagal memperbarui item produk: ' + error.message, 'error');
            }
        }

        async function submitEditLayanan(e) {
            e.preventDefault();

            const id = document.getElementById('layananId').value;
            const nama = document.getElementById('layananNama').value;
            const harga = parseInt(document.getElementById('layananHarga').value);

            if (!id || !nama || harga < 0) {
                showAlert('Data tidak valid', 'error');
                return;
            }

            try {
                const response = await fetch(`${API_URL}/layanans/${id}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        nama: nama,
                        harga: harga,
                      
                        deskripsi: document.getElementById('layananDeskripsi').value || ''
                    })
                });

                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

                showAlert('✅ Item layanan berhasil diperbarui!', 'success');
                closeModal('modalEditLayanan');
                await loadTransaksiLayanan();
            } catch (error) {
                console.error('Error:', error);
                showAlert('Gagal memperbarui item layanan: ' + error.message, 'error');
            }
        }

        async function submitEditStatus(e) {
            e.preventDefault();

            const id = document.getElementById('statusLayananId').value;
            const status = document.getElementById('statusValue').value;

            if (!id || !status) {
                showAlert('Status tidak valid', 'error');
                return;
            }

            try {
                const response = await fetch(`${API_URL}/layanans/${id}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ status: status })
                });

                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

                showAlert('✅ Status layanan berhasil diperbarui!', 'success');
                closeModal('modalEditStatus');
                await loadTransaksiLayanan();
            } catch (error) {
                console.error('Error:', error);
                showAlert('Gagal memperbarui status layanan: ' + error.message, 'error');
            }
        }

        function switchTab(e, tab) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            
            e.target.classList.add('active');
            document.getElementById(tab).classList.add('active');
        }

        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        function showAlert(message, type) {
            const alertBox = document.getElementById('alertBox');
            alertBox.textContent = message;
            alertBox.className = `alert show ${type}`;
            setTimeout(() => alertBox.classList.remove('show'), 3000);
        }

        function updateSubtotal() {
            const qty = parseInt(document.getElementById('produkQty').value) || 0;
            const harga = parseInt(document.getElementById('produkHarga').value) || 0;
            const subtotal = qty * harga;
            document.getElementById('produkSubtotal').value = subtotal;
        }

        // Load data saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadData);

        // Close modal ketika klik di luar
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        };
    </script>
</body>
</html>
