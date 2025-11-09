<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaksi Produk - Kouvee Pet Shop</title>
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

    .toolbar {
      padding: 16px 24px;
      border-bottom: 1px solid var(--border-color);
      display: flex;
      gap: 8px;
      align-items: center;
      background: var(--bg-white);
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

    .btn-primary {
      background: var(--primary-color);
      color: white;
      border-color: var(--primary-color);
    }

    .btn-primary:hover {
      background: var(--primary-hover);
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

    .table-container {
      overflow-x: auto;
      overflow-y: auto;
      max-height: calc(100vh - 250px);
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

    .checkbox-cell {
      width: 40px;
      text-align: center;
    }

    .checkbox-cell input[type="checkbox"] {
      width: 16px;
      height: 16px;
      cursor: pointer;
    }

    .actions-cell {
      display: flex;
      gap: 4px;
      align-items: center;
    }

    .icon {
      width: 16px;
      height: 16px;
      display: inline-block;
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

    /* Modal Detail */
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
    }

    .detail-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
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
    }

    /* Added form input styles for edit modal */
    .detail-item input,
    .detail-item select,
    .detail-item textarea {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      font-size: 0.875rem;
      font-family: inherit;
      margin-top: 4px;
    }

    .detail-item input:focus,
    .detail-item select:focus,
    .detail-item textarea:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(217,119,6,0.1);
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

    /* Added loading state for buttons */
    .btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>📦 Transaksi Produk</h1>
    </div>

    <div id="alertBox" class="alert"></div>

    <div class="table-container">
      <table id="transactionTable">
        <thead>
          <tr>
            <th></th>
            <th>id_transaksi_produk</th>
            <th>id_customer</th>
            <th>id_pegawai_cs</th>
            <th>id_pegawai_kasir</th>
            <th>tanggal_transaksi</th>
            <th>subtotal</th>
            <th>diskon</th>
            <th>total_bayar</th>
            <th>status_pembayaran</th>
          </tr>
        </thead>
        <tbody id="tableBody">
          <tr>
            <td colspan="11" class="loading">Memuat data...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Detail -->
  <div id="detailModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Detail Transaksi</h2>
        <button class="close" onclick="closeModal()">×</button>
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

        <h3 style="margin-bottom: 12px; font-size: 1rem;">Detail Produk</h3>
        <div style="overflow-x: auto;">
          <table style="font-size: 0.875rem;">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody id="detailProductTable"></tbody>
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
        <button class="btn" onclick="closeModal()">Tutup</button>
        <button class="btn btn-primary" onclick="window.print()">🖨️ Cetak</button>
      </div>
    </div>
  </div>

  <!-- Added edit modal for updating transactions -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Edit Transaksi</h2>
        <button class="close" onclick="closeEditModal()">×</button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <div class="detail-grid">
            <div class="detail-item">
              <label for="editCustomer">ID Customer</label>
              <input type="number" id="editCustomer" name="id_customer" required>
            </div>
            <div class="detail-item">
              <label for="editCS">ID Pegawai CS</label>
              <input type="number" id="editCS" name="id_pegawai_cs" required>
            </div>
            <div class="detail-item">
              <label for="editKasir">ID Pegawai Kasir</label>
              <input type="number" id="editKasir" name="id_pegawai_kasir" required>
            </div>
            <div class="detail-item">
              <label for="editTanggal">Tanggal Transaksi</label>
              <input type="datetime-local" id="editTanggal" name="tanggal_transaksi" required>
            </div>
            <div class="detail-item">
              <label for="editSubtotal">Subtotal</label>
              <input type="number" id="editSubtotal" name="subtotal" step="0.01" required>
            </div>
            <div class="detail-item">
              <label for="editDiskon">Diskon</label>
              <input type="number" id="editDiskon" name="diskon" step="0.01" required>
            </div>
            <div class="detail-item">
              <label for="editTotal">Total Bayar</label>
              <input type="number" id="editTotal" name="total_bayar" step="0.01" required>
            </div>
            <div class="detail-item">
              <label for="editStatus">Status Pembayaran</label>
              <select id="editStatus" name="status_pembayaran" required>
                <option value="Lunas">Lunas</option>
                <option value="Belum Lunas">Belum Lunas</option>
                <option value="Cicilan">Cicilan</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn" onclick="closeEditModal()">Batal</button>
        <button class="btn btn-primary" id="submitEditBtn" onclick="submitEdit()">💾 Simpan Perubahan</button>
      </div>
    </div>
  </div>

  <script>
    const API_BASE_URL = 'http://localhost:8000/api';
    let allData = [];
    let selectedRows = new Set();
    let currentEditId = null;

    async function loadData() {
      const tableBody = document.getElementById('tableBody');
      
      try {
        const response = await fetch(`${API_BASE_URL}/transaksi-produk`);
        
        if (!response.ok) {
          throw new Error('Gagal memuat data dari server');
        }
        
        allData = await response.json();
        renderTable(allData);
        
      } catch (error) {
        console.error('Error:', error);
        tableBody.innerHTML = `
          <tr>
            <td colspan="11" class="no-data" style="color: var(--danger-color);">
              ⚠️ ${error.message}<br>
              <small>Pastikan server backend sudah berjalan di ${API_BASE_URL}</small>
            </td>
          </tr>
        `;
      }
    }

    function renderTable(data) {
      const tableBody = document.getElementById('tableBody');
      
      if (data.length === 0) {
        tableBody.innerHTML = '<tr><td colspan="11" class="no-data">Tidak ada data transaksi</td></tr>';
        return;
      }

      tableBody.innerHTML = '';
      
      data.forEach((row, index) => {
        const tr = document.createElement('tr');
        const isChecked = selectedRows.has(row.id_transaksi_produk);
        
        tr.innerHTML = `
          <td>
            <div class="actions-cell">
              <button class="btn btn-icon btn-edit" onclick="editRow('${row.id_transaksi_produk}')" title="Edit">
                ✏️
              </button>

              <button class="btn btn-icon btn-delete" onclick="deleteRow('${row.id_transaksi_produk}')" title="Delete">
                🗑️
              </button>
            </div>
          </td>
          <td><strong>${row.id_transaksi_produk || '-'}</strong></td>
          <td>${row.id_customer || '-'}</td>
          <td>${row.id_pegawai_cs || '-'}</td>
          <td>${row.id_pegawai_kasir || '-'}</td>
          <td>${formatDateTime(row.tanggal_transaksi)}</td>
          <td>${formatCurrency(row.subtotal)}</td>
          <td>${formatCurrency(row.diskon)}</td>
          <td><strong>${formatCurrency(row.total_bayar)}</strong></td>
          <td>${row.status_pembayaran || 'Lunas'}</td>
        `;
        
        tr.ondblclick = () => viewDetail(row.id_transaksi_produk);
        
        tableBody.appendChild(tr);
      });
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
      return new Intl.NumberFormat('id-ID', {
        style: 'decimal',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      }).format(amount);
    }

    function filterTable() {
      const searchValue = document.getElementById('searchInput').value.toLowerCase();
      
      if (!searchValue) {
        renderTable(allData);
        return;
      }

      const filtered = allData.filter(row => {
        return Object.values(row).some(val => 
          String(val).toLowerCase().includes(searchValue)
        );
      });

      renderTable(filtered);
    }

    async function viewDetail(id) {
      try {
        console.log("[v0] Loading detail for ID:", id);
        const response = await fetch(`${API_BASE_URL}/transaksi-produk/${id}`);
        
        if (!response.ok) {
          const errorText = await response.text();
          console.error("[v0] Response error:", response.status, errorText);
          throw new Error(`HTTP ${response.status}: Gagal memuat detail transaksi`);
        }
        
        const data = await response.json();
        console.log("[v0] Detail data received:", data);
        
        document.getElementById('detailNoTransaksi').textContent = data.id_transaksi_produk || data.id || '-';
        document.getElementById('detailTanggal').textContent = formatDateTime(data.tanggal_transaksi);
        document.getElementById('detailCustomer').textContent = data.nama_customer || data.id_customer || '-';
        document.getElementById('detailCS').textContent = data.nama_cs || data.id_pegawai_cs || '-';
        document.getElementById('detailKasir').textContent = data.nama_kasir || data.id_pegawai_kasir || '-';
        document.getElementById('detailStatus').textContent = data.status_pembayaran || 'Lunas';

        const detailTable = document.getElementById('detailProductTable');
        detailTable.innerHTML = '';
        
        const products = data.detail_produk || data.details || [];
        if (products && products.length > 0) {
          products.forEach((item, index) => {
            const row = `
              <tr>
                <td>${index + 1}</td>
                <td>${item.nama_produk || item.product_name || 'Produk'}</td>
                <td>${formatCurrency(item.harga || item.price || 0)}</td>
                <td>${item.jumlah || item.quantity || 0}</td>
                <td>${formatCurrency(item.subtotal || (item.harga * item.jumlah) || 0)}</td>
              </tr>
            `;
            detailTable.innerHTML += row;
          });
        }

        document.getElementById('detailSubtotal').textContent = formatCurrency(data.subtotal);
        document.getElementById('detailDiskon').textContent = '- ' + formatCurrency(data.diskon);
        document.getElementById('detailTotal').textContent = formatCurrency(data.total_bayar);

        document.getElementById('detailModal').style.display = 'block';
        
      } catch (error) {
        console.error("[v0] Error in viewDetail:", error);
        showAlert('Error: ' + error.message, 'error');
      }
    }

    function closeModal() {
      document.getElementById('detailModal').style.display = 'none';
    }

    async function editRow(id) {
      try {
        console.log("[v0] Loading edit form for ID:", id);
        const response = await fetch(`${API_BASE_URL}/transaksi-produk/${id}`);
        
        if (!response.ok) {
          const errorText = await response.text();
          console.error("[v0] Response error:", response.status, errorText);
          throw new Error(`HTTP ${response.status}: Gagal memuat detail transaksi`);
        }
        
        const data = await response.json();
        console.log("[v0] Edit data received:", data);
        
        currentEditId = id;

        let datetimeLocal = '';
        if (data.tanggal_transaksi) {
          const dateObj = new Date(data.tanggal_transaksi);
          if (!isNaN(dateObj)) {
            const year = dateObj.getFullYear();
            const month = String(dateObj.getMonth() + 1).padStart(2, '0');
            const day = String(dateObj.getDate()).padStart(2, '0');
            const hours = String(dateObj.getHours()).padStart(2, '0');
            const minutes = String(dateObj.getMinutes()).padStart(2, '0');
            datetimeLocal = `${year}-${month}-${day}T${hours}:${minutes}`;
          }
        }

        // Populate form with current data
        document.getElementById('editCustomer').value = data.id_customer || '';
        document.getElementById('editCS').value = data.id_pegawai_cs || '';
        document.getElementById('editKasir').value = data.id_pegawai_kasir || '';
        document.getElementById('editTanggal').value = datetimeLocal;
        document.getElementById('editSubtotal').value = data.subtotal || 0;
        document.getElementById('editDiskon').value = data.diskon || 0;
        document.getElementById('editTotal').value = data.total_bayar || 0;
        document.getElementById('editStatus').value = data.status_pembayaran || 'Lunas';

        console.log("[v0] Form populated, showing modal");
        document.getElementById('editModal').style.display = 'block';
        
      } catch (error) {
        console.error("[v0] Error in editRow:", error);
        showAlert('Error: ' + error.message, 'error');
      }
    }

    async function submitEdit() {
      if (!currentEditId) {
        showAlert('Error: ID tidak ditemukan', 'error');
        return;
      }

      const btn = document.getElementById('submitEditBtn');
      btn.disabled = true;

      try {
        console.log("[v0] Submitting edit for ID:", currentEditId);
        
        const formData = {
          id_customer: parseInt(document.getElementById('editCustomer').value),
          id_pegawai_cs: parseInt(document.getElementById('editCS').value),
          id_pegawai_kasir: parseInt(document.getElementById('editKasir').value),
          tanggal_transaksi: document.getElementById('editTanggal').value,
          subtotal: parseFloat(document.getElementById('editSubtotal').value),
          diskon: parseFloat(document.getElementById('editDiskon').value),
          total_bayar: parseFloat(document.getElementById('editTotal').value),
          status_pembayaran: document.getElementById('editStatus').value,
          details: []
        };

        console.log("[v0] Form data:", formData);

        const response = await fetch(`${API_BASE_URL}/transaksi-produk/${currentEditId}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(formData)
        });

        console.log("[v0] Response status:", response.status);

        if (!response.ok) {
          const errorData = await response.json();
          console.error("[v0] Error response:", errorData);
          throw new Error(errorData.message || 'Gagal menyimpan perubahan');
        }

        const result = await response.json();
        console.log("[v0] Success response:", result);

        showAlert('Transaksi berhasil diupdate', 'success');
        closeEditModal();
        loadData();
        
      } catch (error) {
        console.error("[v0] Error saving edit:", error);
        showAlert('Error: ' + error.message, 'error');
      } finally {
        btn.disabled = false;
      }
    }

    function closeEditModal() {
      document.getElementById('editModal').style.display = 'none';
      currentEditId = null;
    }

    async function deleteRow(id) {
      console.log("[v0] Delete row called with ID:", id);
      if (!confirm('Yakin ingin menghapus transaksi ini?')) return;
      
      try {
        const response = await fetch(`${API_BASE_URL}/transaksi-produk/${id}`, {
          method: 'DELETE'
        });
        
        console.log("[v0] Delete response status:", response.status);

        if (!response.ok) {
          const errorData = await response.json();
          console.error("[v0] Error response:", errorData);
          throw new Error(errorData.message || 'Gagal menghapus transaksi');
        }
        
        showAlert('Transaksi berhasil dihapus', 'success');
        loadData();
        
      } catch (error) {
        console.error("[v0] Error deleting:", error);
        showAlert('Error: ' + error.message, 'error');
      }
    }

    function showAlert(message, type) {
      const alertBox = document.getElementById('alertBox');
      alertBox.textContent = message;
      alertBox.className = `alert show ${type}`;
      setTimeout(() => alertBox.classList.remove('show'), 3000);
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
      const detailModal = document.getElementById('detailModal');
      const editModal = document.getElementById('editModal');
      if (event.target === detailModal) {
        closeModal();
      }
      if (event.target === editModal) {
        closeEditModal();
      }
    }

    // Load data on page load
    loadData();
  </script>
</body>
</html>
