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
      max-width: 1800px; 
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

    .debug-toggle {
      padding: 4px 12px;
      background: #f3f4f6;
      border: 1px solid var(--border-color);
      border-radius: 4px;
      font-size: 0.75rem;
      cursor: pointer;
    }

    .debug-panel {
      display: none;
      padding: 12px 24px;
      background: #1f2937;
      color: #10b981;
      font-family: 'Courier New', monospace;
      font-size: 0.75rem;
      max-height: 200px;
      overflow-y: auto;
      border-bottom: 1px solid var(--border-color);
    }

    .debug-panel.show {
      display: block;
    }

    .debug-line {
      margin: 2px 0;
    }

    .stats-bar {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
      padding: 16px 24px;
      background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
      border-bottom: 1px solid var(--border-color);
    }

    .stat-item {
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

    select, input {
      padding: 6px 12px;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      font-size: 0.875rem;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
    }

    select:focus, input:focus {
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

    .status-dropdown {
      padding: 6px 8px;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 600;
      cursor: pointer;
      background: white;
      min-width: 120px;
      transition: all 0.2s;
    }

    .status-dropdown:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(217,119,6,0.1);
    }

    .status-dropdown:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }

    .status-dropdown.lunas {
      background: #d1fae5;
      color: #065f46;
      border-color: var(--success-color);
    }

    .status-dropdown.belum-lunas {
      background: #fef3c7;
      color: #92400e;
      border-color: var(--warning-color);
    }

    .table-container {
      overflow-x: auto;
      overflow-y: auto;
      max-height: calc(100vh - 450px);
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
    }

    tbody tr {
      background: var(--bg-white);
    }

    tbody tr:hover {
      background: #fef3c7;
      cursor: pointer;
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

    .loading.spinner {
      font-size: 2rem;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
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
      animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
      from {
        transform: translateY(-10px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
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

    .detail-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 16px;
      margin-bottom: 24px;
    }

    .detail-item label {
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
      word-break: break-word;
      padding: 8px;
      background: var(--bg-light);
      border-radius: 4px;
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

    .modal-footer {
      padding: 16px 24px;
      border-top: 1px solid var(--border-color);
      display: flex;
      justify-content: flex-end;
      gap: 8px;
    }

    .pagination {
      display: flex;
      justify-content: center;
      gap: 4px;
      padding: 16px 24px;
      border-top: 1px solid var(--border-color);
    }

    .pagination button {
      padding: 6px 12px;
      border: 1px solid var(--border-color);
      border-radius: 4px;
      cursor: pointer;
      font-size: 0.875rem;
    }

    .pagination button.active {
      background: var(--primary-color);
      color: white;
      border-color: var(--primary-color);
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

    .info-box {
      padding: 12px 16px;
      background: #dbeafe;
      border-left: 4px solid var(--info-color);
      border-radius: 4px;
      font-size: 0.875rem;
      margin-bottom: 16px;
    }

    .info-box strong {
      color: var(--text-primary);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>🐾 Transaksi Layanan</h1>
      <button class="debug-toggle" onclick="toggleDebug()">🔍 Debug</button>
    </div>

    <div id="debugPanel" class="debug-panel"></div>

    <div id="alertBox" class="alert"></div>

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
      <div class="stat-item">
        <label>Rata-rata Transaksi</label>
        <div class="value" id="statAverage">Rp 0</div>
      </div>
    </div>

    <div class="toolbar">
      <div class="filter-group">
        <label>🔍 Status:</label>
        <select id="filterStatus" onchange="applyFilter()">
          <option value="">Semua</option>
          <option value="Lunas">Lunas</option>
          <option value="Belum Lunas">Belum Lunas</option>
        </select>
      </div>

      <div class="search-box">
        <input type="text" id="searchInput" placeholder="Cari..." onkeyup="applyFilter()">
      </div>

      <button class="btn" onclick="resetFilter()">🔄 Reset</button>
      <button class="btn btn-primary" onclick="reloadData()">🔃 Reload</button>
    </div>

    <div class="table-container">
      <table id="transactionTable">
        <thead>
          <tr>
            <th>#</th>
            <th>No. Transaksi</th>
            <th>Customer ID</th>
            <th>CS ID</th>
            <th>Kasir ID</th>
            <th>Tanggal</th>
            <th>Subtotal</th>
            <th>Diskon</th>
            <th>Total Bayar</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="tableBody">
          <tr>
            <td colspan="10" class="loading"><span class="spinner">⏳</span> Memuat data...</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="pagination" id="pagination"></div>
  </div>

  <!-- Modal Detail -->
  <div id="detailModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Detail Transaksi Layanan</h2>
        <button class="close" onclick="closeModal('detailModal')">×</button>
      </div>
      <div class="modal-body">
        <div class="detail-grid" id="detailGrid"></div>
      </div>
      <div class="modal-footer">
        <button class="btn" onclick="closeModal('detailModal')">Tutup</button>
        <button class="btn btn-primary" onclick="window.print()">🖨️ Cetak</button>
      </div>
    </div>
  </div>

  <script>
    const API_BASE_URL = 'http://localhost:8000/api';
    const ITEMS_PER_PAGE = 10;
    const DEBUG = true;

    let allData = [];
    let filteredData = [];
    let currentPage = 1;

    function debugLog(message, data = null) {
      const panel = document.getElementById('debugPanel');
      const timestamp = new Date().toLocaleTimeString();
      const log = `[${timestamp}] ${message}${data ? ': ' + JSON.stringify(data).substring(0, 100) : ''}`;
      
      if (DEBUG) {
        console.log('[v0]', message, data);
        const line = document.createElement('div');
        line.className = 'debug-line';
        line.textContent = log;
        panel.appendChild(line);
        panel.scrollTop = panel.scrollHeight;
      }
    }

    function toggleDebug() {
      const panel = document.getElementById('debugPanel');
      panel.classList.toggle('show');
    }

    async function loadData() {
      const tableBody = document.getElementById('tableBody');
      
      try {
        debugLog('Memulai fetch data', API_BASE_URL);
        
        const response = await fetch(`${API_BASE_URL}/transaksi-layanan`);
        
        debugLog('Response status', response.status);
        
        if (!response.ok) {
          throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        const rawData = await response.json();
        debugLog('Data diterima', { type: typeof rawData, length: rawData.length || 'N/A' });
        
        // Validasi format data
        if (!Array.isArray(rawData)) {
          if (rawData.data && Array.isArray(rawData.data)) {
            allData = rawData.data;
          } else {
            throw new Error('Data bukan array. Format: ' + typeof rawData);
          }
        } else {
          allData = rawData;
        }
        
        debugLog('Data berhasil diproses', `Total: ${allData.length} items`);
        
        // Validasi setiap item
        allData = allData.map((item, idx) => {
          if (!item.id_transaksi_layanan) {
            debugLog(`Warning: Item ${idx} tidak punya id_transaksi_layanan`, item);
          }
          return {
            id: item.id || idx, // Primary key (auto increment)
            id_transaksi_layanan: item.id_transaksi_layanan || `UNKNOWN_${idx}`,
            id_customer: item.id_customer || 'N/A',
            id_pegawai_cs: item.id_pegawai_cs || 'N/A',
            id_pegawai_kasir: item.id_pegawai_kasir || 'N/A',
            tanggal_transaksi: item.tanggal_transaksi || new Date().toISOString(),
            subtotal: parseFloat(item.subtotal) || 0,
            diskon: parseFloat(item.diskon) || 0,
            total_bayar: parseFloat(item.total_bayar) || 0,
            status_pembayaran: item.status_pembayaran || 'Belum Lunas'
          };
        });
        
        filteredData = [...allData];
        currentPage = 1;
        updateStats();
        renderTable();
        showAlert(`Berhasil memuat ${allData.length} transaksi`, 'success');
        
      } catch (error) {
        debugLog('Error loading data', error.message);
        console.error('[v0] Full error:', error);
        
        tableBody.innerHTML = `
          <tr>
            <td colspan="10" class="no-data" style="color: var(--danger-color); text-align: left; white-space: normal;">
              <strong>❌ Error:</strong> ${error.message}<br>
              <small>API URL: ${API_BASE_URL}<br>
              Tips: Pastikan server backend berjalan dan CORS diizinkan</small>
            </td>
          </tr>
        `;
        
        showAlert(`Error: ${error.message}`, 'error');
      }
    }

    function updateStats() {
      const total = allData.length;
      const lunas = allData.filter(t => t.status_pembayaran === 'Lunas').length;
      const belumLunas = allData.filter(t => t.status_pembayaran === 'Belum Lunas').length;
      const pendapatan = allData
        .filter(t => t.status_pembayaran === 'Lunas')
        .reduce((sum, t) => sum + (t.total_bayar || 0), 0);
      const rata2 = total > 0 ? allData.reduce((sum, t) => sum + (t.total_bayar || 0), 0) / total : 0;

      document.getElementById('statTotal').textContent = total;
      document.getElementById('statLunas').textContent = lunas;
      document.getElementById('statBelumLunas').textContent = belumLunas;
      document.getElementById('statPendapatan').textContent = formatCurrency(pendapatan);
      document.getElementById('statAverage').textContent = formatCurrency(rata2);

      debugLog('Stats updated', { total, lunas, belumLunas, pendapatan, rata2 });
    }

    function renderTable() {
      const tableBody = document.getElementById('tableBody');
      const start = (currentPage - 1) * ITEMS_PER_PAGE;
      const end = start + ITEMS_PER_PAGE;
      const pageData = filteredData.slice(start, end);
      
      if (pageData.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="10" class="no-data">Tidak ada data</td></tr>';
        renderPagination();
        return;
      }

      tableBody.innerHTML = '';
      
      pageData.forEach((row, index) => {
        const tr = document.createElement('tr');
        const statusClass = row.status_pembayaran === 'Lunas' ? 'lunas' : 'belum-lunas';
        
        tr.innerHTML = `
          <td>${start + index + 1}</td>
          <td><strong>${row.id_transaksi_layanan}</strong></td>
          <td>${row.id_customer}</td>
          <td>${row.id_pegawai_cs}</td>
          <td>${row.id_pegawai_kasir}</td>
          <td>${formatDateTime(row.tanggal_transaksi)}</td>
          <td>${formatCurrency(row.subtotal)}</td>
          <td>${formatCurrency(row.diskon)}</td>
          <td><strong>${formatCurrency(row.total_bayar)}</strong></td>
          <td>
            <select class="status-dropdown ${statusClass}" 
                    data-id="${row.id}" 
                    data-transaction-code="${row.id_transaksi_layanan}"
                    onchange="updateStatus(this, ${row.id}, '${row.id_transaksi_layanan}')"
                    onclick="event.stopPropagation()">
              <option value="Lunas" ${row.status_pembayaran === 'Lunas' ? 'selected' : ''}>✅ Lunas</option>
              <option value="Belum Lunas" ${row.status_pembayaran === 'Belum Lunas' ? 'selected' : ''}>⏳ Belum Lunas</option>
            </select>
          </td>
        `;
        
        // Event untuk view detail hanya pada row, bukan dropdown
        tr.onclick = (e) => {
          if (!e.target.classList.contains('status-dropdown')) {
            viewDetail(row);
          }
        };
        tableBody.appendChild(tr);
      });

      renderPagination();
    }

    function renderPagination() {
      const pagination = document.getElementById('pagination');
      const totalPages = Math.ceil(filteredData.length / ITEMS_PER_PAGE);
      
      if (totalPages <= 1) {
        pagination.innerHTML = '';
        return;
      }

      pagination.innerHTML = '';
      
      for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement('button');
        btn.textContent = i;
        btn.className = i === currentPage ? 'active' : '';
        btn.onclick = () => {
          currentPage = i;
          renderTable();
          window.scrollTo({ top: 0, behavior: 'smooth' });
        };
        pagination.appendChild(btn);
      }
    }

    function applyFilter() {
      const statusFilter = document.getElementById('filterStatus').value;
      const searchValue = document.getElementById('searchInput').value.toLowerCase();
      
      filteredData = allData.filter(row => {
        const matchStatus = !statusFilter || row.status_pembayaran === statusFilter;
        const matchSearch = !searchValue || 
          [
            row.id_transaksi_layanan,
            row.id_customer,
            row.id_pegawai_cs,
            row.id_pegawai_kasir
          ].some(val => String(val).toLowerCase().includes(searchValue));
        
        return matchStatus && matchSearch;
      });
      
      currentPage = 1;
      renderTable();
      debugLog('Filter applied', { statusFilter, searchValue, result: filteredData.length });
    }

    function resetFilter() {
      document.getElementById('filterStatus').value = '';
      document.getElementById('searchInput').value = '';
      filteredData = [...allData];
      currentPage = 1;
      renderTable();
      showAlert('Filter direset', 'success');
    }

    function reloadData() {
      document.getElementById('tableBody').innerHTML = '<tr><td colspan="10" class="loading">Reload data...</td></tr>';
      loadData();
    }

    async function updateStatus(selectElement, id, transactionCode) {
      const newStatus = selectElement.value;
      const oldStatus = selectElement.className.includes('lunas') ? 'Lunas' : 'Belum Lunas';
      const oldClass = selectElement.className;
      
      try {
        debugLog('Updating status', { id, transactionCode, oldStatus, newStatus });
        
        // Update UI immediately for better UX
        selectElement.disabled = true;
        selectElement.className = 'status-dropdown ' + (newStatus === 'Lunas' ? 'lunas' : 'belum-lunas');
        
        // Find the transaction data from allData using ID (primary key)
        const transaction = allData.find(item => item.id === id);
        
        if (!transaction) {
          throw new Error('Data transaksi tidak ditemukan di cache lokal');
        }
        
        // Prepare full data for PUT request (required by backend)
        const updateData = {
          id_customer: parseInt(transaction.id_customer) || 0,
          id_pegawai_cs: parseInt(transaction.id_pegawai_cs) || 0,
          id_pegawai_kasir: parseInt(transaction.id_pegawai_kasir) || 0,
          tanggal_transaksi: transaction.tanggal_transaksi,
          subtotal: parseFloat(transaction.subtotal) || 0,
          diskon: parseFloat(transaction.diskon) || 0,
          total_bayar: parseFloat(transaction.total_bayar) || 0,
          status_pembayaran: newStatus
        };
        
        debugLog('Sending PUT request', { url: `${API_BASE_URL}/transaksi-layanan/${id}`, data: updateData });
        
        const response = await fetch(`${API_BASE_URL}/transaksi-layanan/${id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
          },
          body: JSON.stringify(updateData)
        });
        
        debugLog('Response received', { status: response.status, ok: response.ok, statusText: response.statusText });
        
        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
          const errorText = await response.text();
          debugLog('Non-JSON response', { status: response.status, contentType, body: errorText.substring(0, 300) });
          throw new Error(`Backend mengembalikan HTML, bukan JSON. Status: ${response.status}. Periksa debug panel.`);
        }
        
        const result = await response.json();
        
        if (!response.ok) {
          debugLog('API error response', result);
          // Handle validation errors
          if (result.errors) {
            const errorMessages = Object.values(result.errors).flat().join(', ');
            throw new Error(`Validasi gagal: ${errorMessages}`);
          }
          throw new Error(result.message || `HTTP ${response.status}`);
        }
        
        debugLog('Status updated successfully', result);
        
        // Update data di array lokal
        const dataIndex = allData.findIndex(item => item.id === id);
        if (dataIndex !== -1) {
          allData[dataIndex].status_pembayaran = newStatus;
          
          // Update juga di filteredData
          const filteredIndex = filteredData.findIndex(item => item.id === id);
          if (filteredIndex !== -1) {
            filteredData[filteredIndex].status_pembayaran = newStatus;
          }
        }
        
        // Update statistics
        updateStats();
        
        showAlert(`✅ Status transaksi ${transactionCode} berhasil diubah menjadi "${newStatus}"`, 'success');
        
      } catch (error) {
        debugLog('Error updating status', error.message);
        console.error('[v0] Update error:', error);
        
        // Rollback UI jika gagal
        selectElement.className = oldClass;
        selectElement.value = oldStatus;
        
        showAlert(`❌ Gagal mengubah status: ${error.message}`, 'error');
      } finally {
        selectElement.disabled = false;
      }
    }

    function viewDetail(row) {
      const grid = document.getElementById('detailGrid');
      
      const fields = [
        { label: 'No. Transaksi', key: 'id_transaksi_layanan' },
        { label: 'Tanggal Transaksi', key: 'tanggal_transaksi', format: formatDateTime },
        { label: 'Customer ID', key: 'id_customer' },
        { label: 'Pegawai CS ID', key: 'id_pegawai_cs' },
        { label: 'Pegawai Kasir ID', key: 'id_pegawai_kasir' },
        { label: 'Subtotal', key: 'subtotal', format: formatCurrency },
        { label: 'Diskon', key: 'diskon', format: formatCurrency },
        { label: 'Total Bayar', key: 'total_bayar', format: formatCurrency },
        { label: 'Status Pembayaran', key: 'status_pembayaran' }
      ];

      grid.innerHTML = fields.map(field => {
        const value = row[field.key];
        const displayValue = field.format ? field.format(value) : (value || 'N/A');
        return `
          <div class="detail-item">
            <label>${field.label}</label>
            <div class="value">${displayValue}</div>
          </div>
        `;
      }).join('');

      document.getElementById('detailModal').style.display = 'block';
    }

    function closeModal(modalId) {
      document.getElementById(modalId).style.display = 'none';
    }

    function formatDateTime(dateString) {
      if (!dateString) return 'N/A';
      try {
        const date = new Date(dateString);
        return date.toLocaleString('id-ID', { 
          year: 'numeric', 
          month: '2-digit', 
          day: '2-digit',
          hour: '2-digit',
          minute: '2-digit'
        });
      } catch (e) {
        return String(dateString);
      }
    }

    function formatCurrency(amount) {
      if (amount === null || amount === undefined || isNaN(amount)) return 'Rp 0';
      return 'Rp ' + new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
      }).format(amount);
    }

    function showAlert(message, type) {
      const alertBox = document.getElementById('alertBox');
      alertBox.textContent = message;
      alertBox.className = `alert show ${type}`;
      setTimeout(() => alertBox.classList.remove('show'), 4000);
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
      const modals = document.querySelectorAll('.modal');
      modals.forEach(modal => {
        if (event.target === modal) {
          modal.style.display = 'none';
        }
      });
    };

    // Load data pada saat page load
    debugLog('Page loaded, starting data fetch...');
    loadData();
  </script>
</body>
</html>