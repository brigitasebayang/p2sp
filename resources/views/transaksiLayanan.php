<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaksi Layanan - Kouvee Pet Shop</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #d97706;
      --primary-hover: #b45309;
      --bg-light: #f9fafb;
      --bg-white: #ffffff;
      --border-color: #e5e7eb;
      --text-primary: #111827;
      --text-secondary: #6b7280;
      --success-color: #10b981;
      --danger-color: #ef4444;
      --warning-color: #f59e0b;
      --info-color: #3b82f6;
    }

    * { 
      box-sizing: border-box; 
      margin: 0; 
      padding: 0; 
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg-light);
      color: var(--text-primary);
      line-height: 1.5;
      padding: 20px;
    }

    .container { 
      max-width: 1600px; 
      margin: 0 auto; 
      background: var(--bg-white);
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .header {
      padding: 20px 24px;
      border-bottom: 1px solid var(--border-color);
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: var(--bg-white);
    }

    .header h1 {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--text-primary);
    }

    .stats-bar {
      display: flex;
      gap: 16px;
      padding: 16px 24px;
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      border-bottom: 1px solid var(--border-color);
    }

    .stat-item {
      flex: 1;
      padding: 12px;
      background: var(--bg-white);
      border-radius: 6px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .stat-item label {
      display: block;
      font-size: 0.75rem;
      color: var(--text-secondary);
      margin-bottom: 4px;
      text-transform: uppercase;
      font-weight: 600;
    }

    .stat-item .value {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--primary-color);
    }

    .stat-item.success .value {
      color: var(--success-color);
    }

    .stat-item.warning .value {
      color: var(--warning-color);
    }

    .toolbar {
      padding: 16px 24px;
      border-bottom: 1px solid var(--border-color);
      display: flex;
      gap: 8px;
      align-items: center;
      background: var(--bg-white);
      flex-wrap: wrap;
    }

    .btn {
      padding: 8px 16px;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--bg-white);
      color: var(--text-primary);
    }

    .btn:hover {
      background: var(--bg-light);
      border-color: var(--primary-color);
    }

    .btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    .btn-primary {
      background: var(--primary-color);
      color: white;
      border-color: var(--primary-color);
    }

    .btn-primary:hover {
      background: var(--primary-hover);
    }

    .btn-success {
      background: var(--success-color);
      color: white;
      border-color: var(--success-color);
    }

    .btn-warning {
      background: var(--warning-color);
      color: white;
      border-color: var(--warning-color);
    }

    .btn-edit { color: var(--primary-color); }
    .btn-delete { color: var(--danger-color); }

    .btn-icon {
      width: 32px;
      height: 32px;
      padding: 6px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .filter-group {
      display: flex;
      gap: 8px;
      align-items: center;
      padding: 8px 12px;
      background: var(--bg-light);
      border-radius: 6px;
    }

    .filter-group label {
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--text-secondary);
    }

    select {
      padding: 6px 12px;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      font-size: 0.875rem;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
    }

    select:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(217,119,6,0.1);
    }

    .badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 12px;
      font-size: 0.75rem;
      font-weight: 600;
    }

    .badge-success {
      background: #d1fae5;
      color: #065f46;
    }

    .badge-warning {
      background: #fef3c7;
      color: #92400e;
    }

    .table-container {
      overflow-x: auto;
      overflow-y: auto;
      max-height: calc(100vh - 350px);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.875rem;
    }

    thead {
      position: sticky;
      top: 0;
      z-index: 10;
      background: var(--bg-light);
    }

    th {
      padding: 12px 16px;
      text-align: left;
      font-weight: 600;
      color: var(--text-secondary);
      border-bottom: 1px solid var(--border-color);
      white-space: nowrap;
      font-size: 0.8125rem;
      text-transform: lowercase;
    }

    td {
      padding: 12px 16px;
      border-bottom: 1px solid var(--border-color);
      color: var(--text-primary);
      white-space: nowrap;
    }

    tbody tr {
      background: var(--bg-white);
    }

    tbody tr:hover {
      background: #fef3c7;
    }

    tbody tr:nth-child(even) {
      background: #f9fafb;
    }

    tbody tr:nth-child(even):hover {
      background: #fef3c7;
    }

    .actions-cell {
      display: flex;
      gap: 4px;
      align-items: center;
    }

    .loading {
      text-align: center;
      padding: 40px;
      color: var(--text-secondary);
    }

    .no-data {
      text-align: center;
      padding: 40px;
      color: var(--text-secondary);
      font-style: italic;
    }

    .alert {
      padding: 12px 24px;
      margin: 16px 24px;
      border-radius: 6px;
      display: none;
    }

    .alert.show { display: block; }
    .alert.success { 
      background: #d1fae5; 
      color: #065f46; 
      border: 1px solid var(--success-color); 
    }
    .alert.error { 
      background: #fee2e2; 
      color: #991b1b; 
      border: 1px solid var(--danger-color); 
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      overflow-y: auto;
    }

    .modal-content {
      background-color: var(--bg-white);
      margin: 50px auto;
      padding: 0;
      border-radius: 8px;
      width: 90%;
      max-width: 900px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 24px;
      border-bottom: 1px solid var(--border-color);
    }

    .modal-header h2 {
      font-size: 1.25rem;
      font-weight: 600;
    }

    .modal-body {
      padding: 24px;
      max-height: 70vh;
      overflow-y: auto;
    }

    .detail-grid, .form-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 16px;
      margin-bottom: 24px;
    }

    .detail-item label, .form-group label {
      display: block;
      font-size: 0.75rem;
      color: var(--text-secondary);
      margin-bottom: 4px;
      text-transform: uppercase;
      font-weight: 600;
    }

    .detail-item .value {
      font-size: 0.875rem;
      color: var(--text-primary);
      font-weight: 500;
    }

    .form-group {
      margin-bottom: 16px;
    }

    .form-group input, .form-group select {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      font-size: 0.875rem;
      font-family: 'Inter', sans-serif;
    }

    .form-group input:focus, .form-group select:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(217,119,6,0.1);
    }

    .error-msg {
      color: var(--danger-color);
      font-size: 0.75rem;
      margin-top: 4px;
    }

    .close {
      font-size: 24px;
      font-weight: 400;
      color: var(--text-secondary);
      cursor: pointer;
      border: none;
      background: none;
      padding: 0;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 4px;
    }

    .close:hover {
      background: var(--bg-light);
      color: var(--text-primary);
    }

    .summary-box {
      margin-top: 16px;
      padding: 16px;
      background: var(--bg-light);
      border-radius: 6px;
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 8px;
      font-size: 0.875rem;
    }

    .summary-row.total {
      font-size: 1rem;
      font-weight: 700;
      padding-top: 8px;
      border-top: 2px solid var(--border-color);
      margin-top: 8px;
    }

    .modal-footer {
      padding: 16px 24px;
      border-top: 1px solid var(--border-color);
      display: flex;
      justify-content: flex-end;
      gap: 8px;
    }

    .full-width {
      grid-column: 1 / -1;
    }

    .search-box {
      flex: 1;
      max-width: 300px;
      position: relative;
    }

    .search-box input {
      width: 100%;
      padding: 8px 12px 8px 36px;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      font-size: 0.875rem;
    }

    .search-box input:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(217,119,6,0.1);
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-secondary);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>🐾 Transaksi Layanan</h1>
    </div>

    <div class="stats-bar">
      <div class="stat-item">
        <label>Total Transaksi</label>
        <div class="value" id="statTotal">0</div>
      </div>
      <div class="stat-item success">
        <label>Lunas</label>
        <div class="value" id="statLunas">0</div>
      </div>
      <div class="stat-item warning">
        <label>Belum Lunas</label>
        <div class="value" id="statBelumLunas">0</div>
      </div>
      <div class="stat-item">
        <label>Total Pendapatan</label>
        <div class="value" id="statPendapatan">Rp 0</div>
      </div>
    </div>

    <div id="alertBox" class="alert"></div>

    <div class="toolbar">
      <div class="filter-group">
        <label>🔍 Filter Status:</label>
        <select id="filterStatus" onchange="applyFilter()">
          <option value="">Semua Status</option>
          <option value="Lunas">Lunas</option>
          <option value="Belum Lunas">Belum Lunas</option>
        </select>
      </div>

      

      <div style="flex: 1;"></div>

      <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" id="searchInput" placeholder="Cari transaksi..." onkeyup="applyFilter()">
      </div>
    </div>

    <div class="table-container">
      <table id="transactionTable">
        <thead>
          <tr>
            <th></th>
            <th>id_transaksi_layanan</th>
            <th>id_customer</th>
            <th>id_pegawai_cs</th>
            <th>id_pegawai_kasir</th>
            <th>tanggal_transaksi</th>
            <th>subtotal</th>
            <th>diskon</th>
            <th>total_bayar</th>
            <th>status_pembayaran</th>
            <th>status_layanan</th>
          </tr>
        </thead>
        <tbody id="tableBody">
          <tr>
            <td colspan="10" class="loading">Memuat data...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Detail -->
  <div id="detailModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Detail Transaksi Layanan</h2>
        <button class="close" onclick="closeModal('detailModal')">×</button>
      </div>
      <div class="modal-body">
        <div class="detail-grid">
          <div class="detail-item">
            <label>No. Transaksi</label>
            <div class="value" id="detailNoTransaksi">-</div>
          </div>
          <div class="detail-item">
            <label>Tanggal Transaksi</label>
            <div class="value" id="detailTanggal">-</div>
          </div>
          <div class="detail-item">
            <label>Customer</label>
            <div class="value" id="detailCustomer">-</div>
          </div>
          <div class="detail-item">
            <label>Customer Service</label>
            <div class="value" id="detailCS">-</div>
          </div>
          <div class="detail-item">
            <label>Kasir</label>
            <div class="value" id="detailKasir">-</div>
          </div>
          <div class="detail-item">
            <label>Status Pembayaran</label>
            <div class="value" id="detailStatus">-</div>
          </div>
        </div>

        <h3 style="margin-bottom: 12px; font-size: 1rem;">Detail Layanan</h3>
        <div style="overflow-x: auto;">
          <table style="font-size: 0.875rem;">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Layanan</th>
                <th>Hewan</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody id="detailServiceTable"></tbody>
          </table>
        </div>

        <div class="summary-box">
          <div class="summary-row">
            <span>Subtotal:</span>
            <strong id="detailSubtotal">Rp 0</strong>
          </div>
          <div class="summary-row">
            <span>Diskon:</span>
            <strong id="detailDiskon" style="color: var(--danger-color);">Rp 0</strong>
          </div>
          <div class="summary-row total">
            <span>TOTAL:</span>
            <strong id="detailTotal" style="color: var(--primary-color);">Rp 0</strong>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn" onclick="closeModal('detailModal')">Tutup</button>
        <button class="btn btn-primary" onclick="window.print()">🖨️ Cetak</button>
      </div>
    </div>
  </div>

  <!-- Modal Edit -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Edit Transaksi Layanan</h2>
        <button class="close" onclick="closeModal('editModal')">×</button>
      </div>
      <form id="editForm" onsubmit="saveEdit(event)">
        <div class="modal-body">
          <input type="hidden" id="editId">
          
          <div class="form-grid">
            <div class="form-group">
              <label for="editCustomer">Customer ID *</label>
              <input type="number" id="editCustomer" required>
              <div class="error-msg" id="errorCustomer"></div>
            </div>

            <div class="form-group">
              <label for="editCS">CS (Pegawai ID) *</label>
              <input type="number" id="editCS" required>
              <div class="error-msg" id="errorCS"></div>
            </div>

            <div class="form-group">
              <label for="editKasir">Kasir (Pegawai ID) *</label>
              <input type="number" id="editKasir" required>
              <div class="error-msg" id="errorKasir"></div>
            </div>

            <div class="form-group">
              <label for="editTanggal">Tanggal Transaksi *</label>
              <input type="datetime-local" id="editTanggal" required>
              <div class="error-msg" id="errorTanggal"></div>
            </div>

            <div class="form-group">
              <label for="editSubtotal">Subtotal (Rp) *</label>
              <input type="number" id="editSubtotal" step="0.01" required>
              <div class="error-msg" id="errorSubtotal"></div>
            </div>

            <div class="form-group">
              <label for="editDiskon">Diskon (Rp)</label>
              <input type="number" id="editDiskon" step="0.01" value="0">
              <div class="error-msg" id="errorDiskon"></div>
            </div>

            <div class="form-group">
              <label for="editTotalBayar">Total Bayar (Rp) *</label>
              <input type="number" id="editTotalBayar" step="0.01" required>
              <div class="error-msg" id="errorTotalBayar"></div>
            </div>

            <div class="form-group">
              <label for="editStatus">Status Pembayaran *</label>
              <select id="editStatus" required>
                <option value="Lunas">Lunas</option>
                <option value="Belum Lunas">Belum Lunas</option>
              </select>
              <div class="error-msg" id="errorStatus"></div>
            </div>
          </div>

          <div class="form-group full-width">
            <label>
              <input type="checkbox" id="autoCalculate" checked onchange="toggleAutoCalculate()">
              Hitung otomatis Total Bayar (Subtotal - Diskon)
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" onclick="closeModal('editModal')">Batal</button>
          <button type="submit" class="btn btn-primary" id="saveBtn">
            💾 Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const API_BASE_URL = 'http://localhost:8000/api';
    let allData = [];
    let filteredData = [];
    let currentFilter = '';

    async function loadData() {
      const tableBody = document.getElementById('tableBody');
      
      try {
        const response = await fetch(`${API_BASE_URL}/transaksi-layanan`);
        
        if (!response.ok) {
          throw new Error('Gagal memuat data dari server');
        }
        
        allData = await response.json();
        filteredData = [...allData];
        updateStats();
        renderTable(filteredData);
        
      } catch (error) {
        console.error('Error:', error);
        tableBody.innerHTML = `
          <tr>
            <td colspan="10" class="no-data" style="color: var(--danger-color);">
              ⚠️ ${error.message}<br>
              <small>Pastikan server backend sudah berjalan di ${API_BASE_URL}</small>
            </td>
          </tr>
        `;
      }
    }

    function updateStats() {
      const total = allData.length;
      const lunas = allData.filter(t => t.status_pembayaran === 'Lunas').length;
      const belumLunas = allData.filter(t => t.status_pembayaran === 'Belum Lunas').length;
      const pendapatan = allData
        .filter(t => t.status_pembayaran === 'Lunas')
        .reduce((sum, t) => sum + parseFloat(t.total_bayar || 0), 0);

      document.getElementById('statTotal').textContent = total;
      document.getElementById('statLunas').textContent = lunas;
      document.getElementById('statBelumLunas').textContent = belumLunas;
      document.getElementById('statPendapatan').textContent = formatCurrency(pendapatan);
    }

    function renderTable(data) {
      const tableBody = document.getElementById('tableBody');
      
      if (data.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="10" class="no-data">Tidak ada data transaksi</td></tr>';
        return;
      }

      tableBody.innerHTML = '';
      
      data.forEach((row, index) => {
        const tr = document.createElement('tr');
        const statusBadge = row.status_pembayaran === 'Lunas' 
          ? '<span class="badge badge-success">✅ Lunas</span>'
          : '<span class="badge badge-warning">⏳ Belum Lunas</span>';
        
        tr.innerHTML = `
          <td>
            <div class="actions-cell">
              <button class="btn btn-icon btn-edit" onclick="editRow('${row.id_transaksi_layanan}')" title="Edit">
                ✏️
              </button>
              <button class="btn btn-icon btn-delete" onclick="deleteRow('${row.id_transaksi_layanan}')" title="Delete">
                🗑️
              </button>
            </div>
          </td>
          <td><strong>${row.id_transaksi_layanan || '-'}</strong></td>
          <td>${row.id_customer || '-'}</td>
          <td>${row.id_pegawai_cs || '-'}</td>
          <td>${row.id_pegawai_kasir || '-'}</td>
          <td>${formatDateTime(row.tanggal_transaksi)}</td>
          <td>${formatCurrency(row.subtotal)}</td>
          <td>${formatCurrency(row.diskon)}</td>
          <td><strong>${formatCurrency(row.total_bayar)}</strong></td>
          <td>${statusBadge}</td>
          <td>${statusBadge}</td>
        `;
        
        tr.ondblclick = () => viewDetail(row.id_transaksi_layanan);
        
        tableBody.appendChild(tr);
      });
    }

    function applyFilter() {
      const statusFilter = document.getElementById('filterStatus').value;
      const searchValue = document.getElementById('searchInput').value.toLowerCase();
      
      filteredData = allData.filter(row => {
        const matchStatus = !statusFilter || row.status_pembayaran === statusFilter;
        const matchSearch = !searchValue || 
          Object.values(row).some(val => 
            String(val).toLowerCase().includes(searchValue)
          );
        
        return matchStatus && matchSearch;
      });
      
      currentFilter = statusFilter;
      renderTable(filteredData);
    }

    function filterByStatus(status) {
      document.getElementById('filterStatus').value = status;
      applyFilter();
      showAlert(`Filter: Menampilkan transaksi ${status}`, 'success');
    }

    function resetFilter() {
      document.getElementById('filterStatus').value = '';
      document.getElementById('searchInput').value = '';
      filteredData = [...allData];
      currentFilter = '';
      renderTable(filteredData);
      showAlert('Filter direset', 'success');
    }

    function formatDateTime(dateString) {
      if (!dateString) return '-';
      const date = new Date(dateString);
      const year = date.getFullYear();
      const month = String(date.getMonth() + 1).padStart(2, '0');
      const day = String(date.getDate()).padStart(2, '0');
      const hours = String(date.getHours()).padStart(2, '0');
      const minutes = String(date.getMinutes()).padStart(2, '0');
      return `${year}-${month}-${day} ${hours}:${minutes}:00`;
    }

    function formatCurrency(amount) {
      if (amount === null || amount === undefined) return 'Rp 0';
      return 'Rp ' + new Intl.NumberFormat('id-ID', {
        style: 'decimal',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      }).format(amount);
    }

    function formatDateTimeForInput(dateString) {
      if (!dateString) return '';
      const date = new Date(dateString);
      const year = date.getFullYear();
      const month = String(date.getMonth() + 1).padStart(2, '0');
      const day = String(date.getDate()).padStart(2, '0');
      const hours = String(date.getHours()).padStart(2, '0');
      const minutes = String(date.getMinutes()).padStart(2, '0');
      return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    async function viewDetail(id) {
      try {
        const response = await fetch(`${API_BASE_URL}/transaksi-layanan/${id}`);
        if (!response.ok) throw new Error('Gagal memuat detail transaksi');
        
        const data = await response.json();
        
        document.getElementById('detailNoTransaksi').textContent = data.id_transaksi_layanan || '-';
        document.getElementById('detailTanggal').textContent = formatDateTime(data.tanggal_transaksi);
        document.getElementById('detailCustomer').textContent = data.nama_customer || data.id_customer || '-';
        document.getElementById('detailCS').textContent = data.nama_cs || data.id_pegawai_cs || '-';
        document.getElementById('detailKasir').textContent = data.nama_kasir || data.id_pegawai_kasir || '-';
        
        const statusBadge = data.status_pembayaran === 'Lunas' 
          ? '<span class="badge badge-success">✅ Lunas</span>'
          : '<span class="badge badge-warning">⏳ Belum Lunas</span>';
        document.getElementById('detailStatus').innerHTML = statusBadge;

        const detailTable = document.getElementById('detailServiceTable');
        detailTable.innerHTML = '';
        
        if (data.detail_layanan && data.detail_layanan.length > 0) {
          data.detail_layanan.forEach((item, index) => {
            const row = `
              <tr>
                <td>${index + 1}</td>
                <td>${item.nama_layanan || '-'}</td>
                <td>${item.nama_hewan || '-'}</td>
                <td>${formatCurrency(item.harga)}</td>
                <td>${item.jumlah || 1}</td>
                <td>${formatCurrency(item.subtotal)}</td>
              </tr>
            `;
            detailTable.innerHTML += row;
          });
        } else {
          detailTable.innerHTML = '<tr><td colspan="6" style="text-align:center;">Tidak ada detail layanan</td></tr>';
        }

        document.getElementById('detailSubtotal').textContent = formatCurrency(data.subtotal);
        document.getElementById('detailDiskon').textContent = '- ' + formatCurrency(data.diskon);
        document.getElementById('detailTotal').textContent = formatCurrency(data.total_bayar);

        document.getElementById('detailModal').style.display = 'block';
        
      } catch (error) {
        showAlert('Error: ' + error.message, 'error');
      }
    }

    async function editRow(id) {
      try {
        const transaction = allData.find(t => t.id_transaksi_layanan === id);
        if (!transaction) {
          throw new Error('Data transaksi tidak ditemukan');
        }

        document.getElementById('editId').value = transaction.id_transaksi_layanan;
        document.getElementById('editCustomer').value = transaction.id_customer;
        document.getElementById('editCS').value = transaction.id_pegawai_cs;
        document.getElementById('editKasir').value = transaction.id_pegawai_kasir;
        document.getElementById('editTanggal').value = formatDateTimeForInput(transaction.tanggal_transaksi);
        document.getElementById('editSubtotal').value = transaction.subtotal;
        document.getElementById('editDiskon').value = transaction.diskon || 0;
        document.getElementById('editTotalBayar').value = transaction.total_bayar;
        document.getElementById('editStatus').value = transaction.status_pembayaran || 'Lunas';
        document.getElementById('editStatus').value = transaction.status_layanan || 'Selesai';

        clearFormErrors();
        document.getElementById('editModal').style.display = 'block';
        
      } catch (error) {
        showAlert('Error: ' + error.message, 'error');
      }
    }

    async function saveEdit(event) {
      event.preventDefault();
      
      clearFormErrors();
      
      const id = document.getElementById('editId').value;
      const data = {
        id_customer: parseInt(document.getElementById('editCustomer').value),
        id_pegawai_cs: parseInt(document.getElementById('editCS').value),
        id_pegawai_kasir: parseInt(document.getElementById('editKasir').value),
        tanggal_transaksi: document.getElementById('editTanggal').value,
        subtotal: parseFloat(document.getElementById('editSubtotal').value),
        diskon: parseFloat(document.getElementById('editDiskon').value) || 0,
        total_bayar: parseFloat(document.getElementById('editTotalBayar').value),
        status_pembayaran: document.getElementById('editStatus').value
      };

      const saveBtn = document.getElementById('saveBtn');
      saveBtn.disabled = true;
      saveBtn.textContent = '⏳ Menyimpan...';

      try {
        const response = await fetch(`${API_BASE_URL}/transaksi-layanan/${id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify(data)
        });

        if (!response.ok) {
          const errorData = await response.json();
          throw new Error(errorData.message || 'Gagal menyimpan perubahan');
        }

        showAlert('✅ Transaksi berhasil diperbarui!', 'success');
        closeModal('editModal');
        await loadData();
        
      } catch (error) {
        showAlert('❌ Error: ' + error.message, 'error');
      } finally {
        saveBtn.disabled = false;
        saveBtn.textContent = '💾 Simpan Perubahan';
      }
    }

    async function deleteRow(id) {
      const transaction = allData.find(t => t.id_transaksi_layanan === id);
      if (!transaction) {
        showAlert('Data transaksi tidak ditemukan', 'error');
        return;
      }

      if (!confirm(`⚠️ Yakin ingin menghapus transaksi:\n${id}?\n\nTindakan ini tidak dapat dibatalkan!`)) {
        return;
      }
      
      try {
        const response = await fetch(`${API_BASE_URL}/transaksi-layanan/${id}`, {
          method: 'DELETE',
          headers: {
            'Accept': 'application/json'
          }
        });
        
        if (!response.ok) {
          const errorData = await response.json();
          throw new Error(errorData.message || 'Gagal menghapus transaksi');
        }
        
        showAlert('✅ Transaksi berhasil dihapus!', 'success');
        await loadData();
        
      } catch (error) {
        showAlert('❌ Error: ' + error.message, 'error');
      }
    }

    function toggleAutoCalculate() {
      const autoCalc = document.getElementById('autoCalculate').checked;
      const totalInput = document.getElementById('editTotalBayar');
      
      if (autoCalc) {
        totalInput.readOnly = true;
        totalInput.style.backgroundColor = '#f3f4f6';
        calculateTotal();
      } else {
        totalInput.readOnly = false;
        totalInput.style.backgroundColor = '';
      }
    }

    function calculateTotal() {
      const autoCalc = document.getElementById('autoCalculate').checked;
      if (!autoCalc) return;

      const subtotal = parseFloat(document.getElementById('editSubtotal').value) || 0;
      const diskon = parseFloat(document.getElementById('editDiskon').value) || 0;
      const total = Math.max(0, subtotal - diskon);
      
      document.getElementById('editTotalBayar').value = total.toFixed(2);
    }

    document.getElementById('editSubtotal').addEventListener('input', calculateTotal);
    document.getElementById('editDiskon').addEventListener('input', calculateTotal);

    function clearFormErrors() {
      document.querySelectorAll('.error-msg').forEach(el => el.textContent = '');
      document.querySelectorAll('.form-group').forEach(el => el.classList.remove('error'));
    }

    function closeModal(modalId) {
      document.getElementById(modalId).style.display = 'none';
      if (modalId === 'editModal') {
        document.getElementById('editForm').reset();
        clearFormErrors();
      }
    }

    function showAlert(message, type) {
      const alertBox = document.getElementById('alertBox');
      alertBox.textContent = message;
      alertBox.className = `alert show ${type}`;
      setTimeout(() => alertBox.classList.remove('show'), 4000);
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
      if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
      }
    }

    // Initialize auto calculate on page load
    window.addEventListener('DOMContentLoaded', () => {
      toggleAutoCalculate();
      loadData();
    });
  </script>
</body>
</html>