<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaksi Penjualan - Kouvee Pet Shop</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #d97706;
      --primary-hover: #b45309;
      --secondary-color: #1f2937;
      --bg-light: #fef3c7;
      --bg-dark: #ffffff;
      --border-color: #e5e7eb;
      --success-color: #10b981;
      --warning-color: #f59e0b;
      --danger-color: #ef4444;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg-light);
      color: var(--secondary-color);
      line-height: 1.6;
      min-height: 100vh;
    }

    .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }

    .header {
      display: flex; justify-content: space-between; align-items: center;
      margin-bottom: 30px; padding-bottom: 10px; border-bottom: 2px solid var(--primary-color);
    }

    .header h1 { font-size: 2rem; font-weight: 700; color: var(--primary-color); }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: var(--bg-dark);
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      border-left: 4px solid var(--primary-color);
    }

    .stat-card.success { border-left-color: var(--success-color); }
    .stat-card.warning { border-left-color: var(--warning-color); }
    .stat-card.danger { border-left-color: var(--danger-color); }

    .stat-label { font-size: 0.875rem; color: #6b7280; margin-bottom: 5px; }
    .stat-value { font-size: 1.75rem; font-weight: 700; color: var(--secondary-color); }

    .filters-container {
      background: var(--bg-dark);
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      margin-bottom: 30px;
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
      align-items: center;
    }

    .filter-group { display: flex; flex-direction: column; flex: 1; min-width: 200px; }
    .filter-group label { font-size: 0.875rem; font-weight: 600; margin-bottom: 5px; }

    select, input[type="text"] {
      padding: 10px 12px;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      font-size: 1rem;
      width: 100%;
    }

    select:focus, input:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(217,119,6,0.2);
    }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 0.95rem;
      white-space: nowrap;
    }

    .btn-primary { background: var(--primary-color); color: white; }
    .btn-primary:hover { background: var(--primary-hover); }
    .btn-success { background: var(--success-color); color: white; }

    table {
      width: 100%;
      border-collapse: collapse;
      background: var(--bg-dark);
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    th, td { text-align: left; padding: 14px 16px; }
    th { background: var(--primary-color); color: white; font-weight: 600; font-size: 0.95rem; }
    tr:nth-child(even) { background: #f9fafb; }
    tr:hover { background: #fef3c7; }

    .status-badge {
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
      display: inline-block;
    }

    .status-lunas { background: #d1fae5; color: #065f46; }
    .status-belum { background: #fee2e2; color: #991b1b; }

    .actions { display: flex; gap: 8px; }

    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      align-items: center;
      justify-content: center;
    }

    .modal-content {
      background: var(--bg-dark);
      padding: 30px;
      border-radius: 12px;
      max-width: 500px;
      width: 90%;
      max-height: 80vh;
      overflow-y: auto;
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 2px solid var(--border-color);
    }

    .close-btn {
      font-size: 1.5rem;
      cursor: pointer;
      color: #6b7280;
      background: none;
      border: none;
    }

    .detail-row {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px solid var(--border-color);
    }

    .detail-label { font-weight: 600; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>💰 Transaksi Penjualan</h1>
      <!-- Tombol Export Excel Dihapus -->
    </div>

    <!-- STATISTIK -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-label">Total Transaksi</div>
        <div class="stat-value" id="totalTransactions">0</div>
      </div>
      <div class="stat-card success">
        <div class="stat-label">Total Pendapatan</div>
        <div class="stat-value" id="totalRevenue">Rp 0</div>
      </div>
      <div class="stat-card warning">
        <div class="stat-label">Transaksi Lunas</div>
        <div class="stat-value" id="paidTransactions">0</div>
      </div>
      <div class="stat-card danger">
        <div class="stat-label">Belum Lunas</div>
        <div class="stat-value" id="unpaidTransactions">0</div>
      </div>
    </div>

    <!-- FILTER -->
    <div class="filters-container">
      <div class="filter-group">
        <label>Status Pembayaran</label>
        <select id="statusFilter" onchange="filterTransactions()">
          <option value="semua">Semua</option>
          <option value="lunas">Lunas</option>
          <option value="belum">Belum Lunas</option>
        </select>
      </div>
      <div class="filter-group">
        <label>Cari Nama Pelanggan</label>
        <input type="text" id="searchCustomer" placeholder="Ketik nama..." onkeyup="filterTransactions()">
      </div>
      <!-- Filter Tanggal Dihapus -->
      <div class="filter-group" style="justify-content: flex-end;">
        <button class="btn btn-primary" onclick="resetFilters()" style="margin-top: 20px;">🔄 Reset</button>
      </div>
    </div>

    <!-- TABEL -->
    <table id="transactionTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Pelanggan</th>
          <th>Total Belanja</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <!-- MODAL DETAIL -->
  <div id="detailModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Detail Transaksi</h2>
        <button class="close-btn" onclick="closeModal()">&times;</button>
      </div>
      <div id="modalBody"></div>
    </div>
  </div>

 <script>
  let allTransactions = [];
  let filteredTransactions = [];
  const tbody = document.querySelector("#transactionTable tbody");

  // Ambil data dari API Laravel
  async function fetchTransactions() {
    try {
      const response = await fetch("http://localhost:8000/api/sales")
;
      if (!response.ok) throw new Error('Gagal mengambil data');

      const data = await response.json();

      // Simpan data transaksi
      allTransactions = data.transactions;
      filteredTransactions = [...allTransactions];

      // Update statistik
      document.getElementById('totalTransactions').textContent = data.stats.totalTransactions;
      document.getElementById('totalRevenue').textContent = 'Rp ' + Number(data.stats.totalRevenue).toLocaleString("id-ID");
      document.getElementById('paidTransactions').textContent = data.stats.paidTransactions;
      document.getElementById('unpaidTransactions').textContent = data.stats.unpaidTransactions;

      renderTransactions();
    } catch (error) {
      console.error('Error:', error);
      tbody.innerHTML = `<tr><td colspan="5" style="text-align:center;color:red;">Gagal memuat data. Pastikan backend Laravel berjalan.</td></tr>`;
    }
  }

  function renderTransactions() {
    tbody.innerHTML = "";
    if (filteredTransactions.length === 0) {
      tbody.innerHTML = `<tr><td colspan="5" style="text-align:center;">Tidak ada transaksi ditemukan.</td></tr>`;
      return;
    }

    filteredTransactions.forEach(trx => {
      const statusClass = trx.status === 'lunas' ? 'status-lunas' : 'status-belum';
      const statusText = trx.status === 'lunas' ? '✓ Lunas' : '⏳ Belum Lunas';

      const row = document.createElement("tr");
      row.innerHTML = `
        <td><strong>${trx.id}</strong></td>
        <td>${trx.customer}</td>
        <td><strong>Rp ${trx.total.toLocaleString("id-ID")}</strong></td>
        <td><span class="status-badge ${statusClass}">${statusText}</span></td>
        <td>
          <div class="actions">
            <button class="btn btn-primary" onclick="showDetail(${trx.id})">👁 Detail</button>
            ${trx.status === 'belum' ? `<button class="btn btn-success" onclick="markAsPaid(${trx.id})">✓ Lunas</button>` : ''}
          </div>
        </td>`;
      tbody.appendChild(row);
    });
  }

  function filterTransactions() {
    const status = document.getElementById('statusFilter').value;
    const search = document.getElementById('searchCustomer').value.toLowerCase();

    filteredTransactions = allTransactions.filter(trx => {
      const matchStatus = status === 'semua' || trx.status === status;
      const matchSearch = trx.customer.toLowerCase().includes(search);
      return matchStatus && matchSearch;
    });

    renderTransactions();
  }

  function resetFilters() {
    document.getElementById('statusFilter').value = 'semua';
    document.getElementById('searchCustomer').value = '';
    filterTransactions();
  }

  async function markAsPaid(id) {
    if (!confirm('Tandai transaksi ini sebagai LUNAS?')) return;

    try {
      const response = await fetch(`/api/sales/${id}/mark-paid`, {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Content-Type': 'application/json',
          // CSRF token hanya diperlukan jika route di Laravel menggunakan middleware web (bukan pure API)
          // Jika pakai Sanctum atau tidak butuh CSRF, boleh dihapus
        }
      });

      if (response.ok) {
        alert('✅ Transaksi berhasil ditandai sebagai LUNAS!');
        await fetchTransactions(); // refresh data
      } else {
        const err = await response.json().catch(() => ({}));
        alert('Gagal: ' + (err.message || 'Terjadi kesalahan'));
      }
    } catch (error) {
      console.error('Error:', error);
      alert('❌ Gagal menghubungi server. Pastikan Laravel berjalan.');
    }
  }

  function showDetail(id) {
    const trx = allTransactions.find(t => t.id === id);
    if (!trx) return;

    const statusClass = trx.status === 'lunas' ? 'status-lunas' : 'status-belum';
    const statusText = trx.status === 'lunas' ? '✓ Lunas' : '⏳ Belum Lunas';

    let itemsHTML = '<h3 style="margin-top:20px; margin-bottom:10px;">Detail Produk:</h3>';
    trx.items.forEach(item => {
      itemsHTML += `
        <div class="detail-row">
          <span>${item.name} (${item.qty}x)</span>
          <strong>Rp ${(item.price * item.qty).toLocaleString("id-ID")}</strong>
        </div>`;
    });

    const modalBody = `
      <div class="detail-row">
        <span class="detail-label">ID Transaksi:</span>
        <span><strong>${trx.id}</strong></span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Pelanggan:</span>
        <span>${trx.customer}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Status:</span>
        <span class="status-badge ${statusClass}">${statusText}</span>
      </div>
      ${trx.paymentDate ? `<div class="detail-row">
        <span class="detail-label">Tgl Bayar:</span>
        <span>${formatDate(trx.paymentDate)}</span>
      </div>` : ''}
      ${itemsHTML}
      <div class="detail-row" style="margin-top:15px; padding-top:15px; border-top:2px solid var(--primary-color);">
        <span class="detail-label" style="font-size:1.1rem;">TOTAL:</span>
        <strong style="font-size:1.2rem; color:var(--primary-color);">Rp ${trx.total.toLocaleString("id-ID")}</strong>
      </div>
    `;

    document.getElementById('modalBody').innerHTML = modalBody;
    document.getElementById('detailModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('detailModal').style.display = 'none';
  }

  function formatDate(dateStr) {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
    const d = new Date(dateStr);
    return `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
  }

  window.onclick = function(event) {
    const modal = document.getElementById('detailModal');
    if (event.target === modal) {
      closeModal();
    }
  }

  // Jalankan saat halaman dimuat
  document.addEventListener('DOMContentLoaded', fetchTransactions);
</script>
</body>
</html>