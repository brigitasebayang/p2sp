<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Customer - Kouvee Pet Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Variabel CSS (Disesuaikan untuk konsistensi Kouvee) */
        :root {
            --primary-color: #d97706;
            /* Emas/Jingga */
            --primary-hover: #b45309;
            --secondary-color: #1f2937;
            /* Biru Gelap/Hitam */
            --bg-light: #fef3c7;
            /* Latar Belakang sangat terang */
            --bg-dark: #ffffff;
            --border-color: #e5e7eb;
            --success-color: #10b981;
            /* Hijau untuk Aktif */
            --danger-color: #ef4444;
            /* Merah untuk Tidak Aktif */
        }

        /* RESET & Dasar */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-light);
            color: var(--secondary-color);
            line-height: 1.6;
            min-height: 100vh;
        }

        /* CONTAINER UTAMA */
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-color);
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        /* SEARCH BAR */
        .search-container {
            margin-bottom: 25px;
            display: flex;
            justify-content: flex-end;
        }

        #searchInput {
            width: 300px;
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        #searchInput:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.2);
        }

        /* FORM STYLING */
        #customerForm {
            background: var(--bg-dark);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
            /* Layout Form 2 kolom */
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        #customerForm h2 {
            grid-column: 1 / -1;
            /* Judul membentang di semua kolom */
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 0;
            /* Jarak sudah diatur oleh gap grid */
        }

        /* Input yang harus mencakup 2 kolom */
        .full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s;
            font-size: 1rem;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.2);
        }

        /* BUTTON STYLING */
        .btn-action-container {
            grid-column: 1 / -1;
            text-align: right;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            box-shadow: 0 4px 10px rgba(217, 119, 6, 0.3);
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background: #4b5563;
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

        /* TABLE STYLING */
        .table-wrapper {
            background: var(--bg-dark);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background: #f3f4f6;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            color: #6b7280;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tbody tr:hover {
            background-color: #fefcf3;
        }

        .action-cell {
            white-space: nowrap;
        }

        .action-cell .btn {
            padding: 8px 12px;
            font-size: 0.85rem;
            margin-right: 5px;
        }

        .loading {
            text-align: center;
            padding: 20px;
            color: #6b7280;
        }

        .error-message {
            background-color: #fee2e2;
            color: var(--danger-color);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }

        .error-text {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }


        .success-message {
            background-color: #d1fae5;
            color: var(--success-color);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #customerForm {
                grid-template-columns: 1fr;
            }

            .action-cell .btn {
                display: block;
                width: 100%;
                margin-bottom: 5px;
                margin-right: 0;
            }
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 300px;
            animation: slideIn 0.3s ease-out;
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

        .toast.remove {
            animation: slideOut 0.3s ease-out forwards;
        }

        .toast-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .toast-error {
            background: #fee2e2;
            color: #7f1d1d;
            border-left: 4px solid #ef4444;
        }

        .toast-info {
            background: #dbeafe;
            color: #1e3a8a;
            border-left: 4px solid #3b82f6;
        }

        .toast-warning {
            background: #fef3c7;
            color: #78350f;
            border-left: 4px solid #f59e0b;
        }

        .toast-close {
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            font-size: 1.2rem;
        }

        /* MODAL */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 8000;
            justify-content: center;
            align-items: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            max-width: 400px;
            width: 90%;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>👥 Kelola Customer Kouvee Pet Shop</h1>
        </div>

        <!-- TOAST CONTAINER -->
        <div class="toast-container" id="toastContainer"></div>

        <!-- CONFIRMATION MODAL -->
        <div class="modal-overlay" id="confirmationModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitle">Konfirmasi</h3>
                </div>
                <div class="modal-body" id="modalMessage"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeConfirmation()">Batal</button>
                    <button type="button" class="btn btn-delete" id="confirmButton">Hapus</button>
                </div>
            </div>
        </div>


        <!-- Add success and error message containers -->
        <div id="successMessage" class="success-message"></div>
        <div id="errorMessage" class="error-message"></div>

        <!-- 🔍 SEARCH BAR -->
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="🔍 Cari Customer" onkeyup="searchCustomer()">
        </div>

        <form id="customerForm" onsubmit="handleSubmit(event)">
            <h2>Tambah/Edit Data Customer</h2>
            <input type="hidden" id="customerId" value="">

            <div class="form-group">
                <label for="nama">Nama Customer *</label>
                <input type="text" id="nama" required placeholder="Masukkan Nama">
                <small id="error-nama" class="error-text"></small>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat *</label>
                <input type="text" id="alamat" required placeholder="Masukkan Alamat">
                <small id="error-alamat" class="error-text"></small>
            </div>

            <div class="form-group">
                <label for="tanggalLahir">Tanggal Lahir *</label>
                <input type="date" id="tanggalLahir" required>
                <small id="error-tanggal" class="error-text"></small>
            </div>

            <div class="form-group">
                <label for="noTelp">Nomor Telpon *</label>
                <input type="text" id="noTelp" required placeholder="Masukkan Nomor Telpon"
                    oninput="
        this.value = this.value.replace(/[^0-9]/g,'');
        if (this.value.length > 13) this.value = this.value.slice(0, 13);
    ">
                <small id="error-noTelp" class="error-text"></small>
            </div>


            <div class="btn-action-container">
                <button type="button" class="btn btn-secondary" id="resetButton" onclick="resetForm()" style="display: none;">↺ Reset</button>
                <button type="submit" class="btn btn-primary" id="submitButton">💾 Simpan Customer</button>
            </div>
        </form>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Nomor Telpon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="customerTable">
                    <tr>
                        <td colspan="6" class="loading">Memuat data...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Inline API Client untuk menghindari loading issue -->
    <script>
        const API_BASE_URL = "http://localhost:8000/api";

        class ApiClient {
            constructor(baseURL = API_BASE_URL) {
                this.baseURL = baseURL;
            }

            async request(endpoint, options = {}) {
                const url = `${this.baseURL}${endpoint}`;
                const defaultOptions = {
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                };

                const config = {
                    ...defaultOptions,
                    ...options
                };

                try {
                    const response = await fetch(url, config);

                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(errorData.message || `HTTP Error: ${response.status}`);
                    }

                    return await response.json();
                } catch (error) {
                    console.error("[v0] API Error:", error);
                    throw error;
                }
            }

            async getCustomerList() {
                return this.request("/customer");
            }

            async getCustomerById(id) {
                return this.request(`/customer/${id}`);
            }

            async createCustomer(data) {
                return this.request("/customer", {
                    method: "POST",
                    body: JSON.stringify(data),
                });
            }

            async updateCustomer(id, data) {
                return this.request(`/customer/${id}`, {
                    method: "PUT",
                    body: JSON.stringify(data),
                });
            }

            async deleteCustomer(id) {
                return this.request(`/customer/${id}`, {
                    method: "DELETE",
                });
            }
        }

        const apiClient = new ApiClient();
    </script>

    <script>
        let customerData = [];
        let filteredData = [];
        let isEditing = false;
        let deleteTargetId = null;

        class Toast {
            static show(message, type = 'info', duration = 4000) {
                const container = document.getElementById('toastContainer');
                const toast = document.createElement('div');
                toast.className = `toast toast-${type}`;

                const icons = {
                    success: '✓',
                    error: '✕',
                    info: 'ℹ',
                    warning: '⚠'
                };

                toast.innerHTML = `
            <span>${icons[type]}</span>
            <span>${message}</span>
            <button class="toast-close" onclick="this.parentElement.remove()">×</button>
        `;

                container.appendChild(toast);

                setTimeout(() => {
                    toast.classList.add('remove');
                    setTimeout(() => toast.remove(), 300);
                }, duration);
            }
        }


        document.addEventListener('DOMContentLoaded', async () => {
            await loadCustomerData();
        });

        async function loadCustomerData() {
            try {
                showLoading();
                console.log("[v0] Loading customer data...");
                const response = await apiClient.getCustomerList();
                console.log("[v0] Response received:", response);
                customerData = response.data || response;
                filteredData = customerData;
                renderTable();
                hideMessage();
            } catch (error) {
                showError('Gagal memuat data customer: ' + error.message);
                console.error("[v0] Error loading data:", error);
            }
        }

        async function handleSubmit(event) {
            event.preventDefault();
            clearFieldErrors();

            const customerId = document.getElementById('customerId').value;
            const nama = document.getElementById('nama').value.trim();
            const alamat = document.getElementById('alamat').value.trim();
            const tanggalLahir = document.getElementById('tanggalLahir').value.trim();
            const noTelp = document.getElementById('noTelp').value.trim();

            let isValid = true;

            if (!nama || !alamat || !tanggalLahir || !noTelp) {
                Toast.show('Semua field wajib diisi!', 'warning');
                return;
            }

            if (!/^[0-9]{11,13}$/.test(noTelp)) {
                showFieldError("error-noTelp", "Nomor telpon harus 11-13 digit!");
                return;
            }

            // CEK NAMA DUPLIKAT (SAAT TAMBAH, BUKAN EDIT)
            if (!customerId) {
                const isDuplicate = customerData.some(item =>
                    item.nama.toLowerCase() === nama.toLowerCase()
                );

                if (isDuplicate) {
                    showFieldError("error-nama", "Nama customer sudah ada! Gunakan nama lain.");
                    return;
                }
            }

            const isDuplicatePhone = customerData.some(item =>
                (item.no_telp || item.noTelp) === noTelp &&
                item.id_customer != customerId
            );

            if (isDuplicatePhone) {
                showFieldError("error-noTelp", "Nomor telepon sudah terdaftar!");
                return;
            }
            const payload = {
                nama,
                alamat,
                tanggal_lahir: tanggalLahir,
                no_telp: noTelp
            };

            try {
                if (customerId) {
                    await apiClient.updateCustomer(customerId, payload);
                    Toast.show('Data customer berhasil diperbarui!', 'success');
                } else {
                    await apiClient.createCustomer(payload);
                    Toast.show('Data customer berhasil ditambahkan!', 'success');
                }

                resetForm();
                await loadCustomerData();

            } catch (error) {
                Toast.show('Gagal menyimpan data!', 'error');
            }
        }

        function renderTable() {
            const tbody = document.getElementById('customerTable');
            tbody.innerHTML = '';

            if (filteredData.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 20px; color: #6b7280;">Belum ada data customer</td></tr>';
                return;
            }

            filteredData.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.id_customer}</td>
                    <td>${item.nama}</td>
                    <td>${item.alamat}</td>
                    <td>${item.tanggal_lahir || item.tanggalLahir}</td>
                    <td>${item.no_telp || item.noTelp}</td>
                    <td class="action-cell">
                        <button class="btn btn-edit" onclick="editData(${item.id_customer})">✏️ Edit</button>
                        <button class="btn btn-delete" onclick="confirmDelete(${item.id_customer}, '${item.nama}')">🗑️ Hapus</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function showFieldError(id, message) {
            const elem = document.getElementById(id);
            elem.textContent = message;
            elem.style.display = "block";
        }

        function clearFieldErrors() {
            document.querySelectorAll('.error-text').forEach(e => {
                e.style.display = "none";
                e.textContent = "";
            });
        }


        async function editData(id) {
            try {
                const customer = customerData.find(c => c.id_customer === id);
                if (!customer) {
                    showError('Data customer tidak ditemukan');
                    return;
                }

                document.getElementById('customerId').value = customer.id_customer;
                document.getElementById('nama').value = customer.nama;
                document.getElementById('alamat').value = customer.alamat;
                document.getElementById('tanggalLahir').value = customer.tanggal_lahir || customer.tanggalLahir;
                document.getElementById('noTelp').value = customer.no_telp || customer.noTelp;

                document.getElementById('submitButton').textContent = '✅ Simpan Perubahan';
                document.getElementById('resetButton').style.display = 'inline-flex';
                isEditing = true;

                document.getElementById('customerForm').scrollIntoView({
                    behavior: 'smooth'
                });
            } catch (error) {
                showError('Gagal memuat data: ' + error.message);
            }
        }

        async function deleteData() {
            if (!deleteTargetId) return;

            try {
                await apiClient.deleteCustomer(deleteTargetId);
                Toast.show('Customer berhasil dihapus!', 'success');
                closeConfirmation();
                await loadCustomerData();
            } catch (error) {
                Toast.show('Gagal menghapus data customer!', 'error');
            }
        }


        function resetForm() {
            document.getElementById('customerForm').reset();
            document.getElementById('customerId').value = '';
            document.getElementById('submitButton').textContent = '💾 Simpan Customer';
            document.getElementById('resetButton').style.display = 'none';
            isEditing = false;
        }

        function searchCustomer() {
            const keyword = document.getElementById('searchInput').value.toLowerCase();
            filteredData = customerData.filter(item =>
                item.nama.toLowerCase().includes(keyword) ||
                item.alamat.toLowerCase().includes(keyword)
            );
            renderTable();
        }

        function showError(message) {
            const errorDiv = document.getElementById('errorMessage');
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
            setTimeout(() => {
                errorDiv.style.display = 'none';
            }, 5000);
        }

        function confirmDelete(id, name) {
            deleteTargetId = id;
            document.getElementById('modalTitle').textContent = 'Konfirmasi Penghapusan';
            document.getElementById('modalMessage').textContent = `Hapus customer "${name}"?`;
            document.getElementById('confirmButton').onclick = deleteData;
            document.getElementById('confirmationModal').classList.add('active');
        }

        function closeConfirmation() {
            document.getElementById('confirmationModal').classList.remove('active');
            deleteTargetId = null;
        }

        async function deleteData() {
            try {
                await apiClient.deleteCustomer(deleteTargetId);
                Toast.show('Customer berhasil dihapus!', 'success');
                closeConfirmation();
                await loadCustomerData();
            } catch (error) {
                Toast.show('Gagal menghapus data!', 'error');
            }
        }


        function showSuccess(message) {
            const successDiv = document.getElementById('successMessage');
            successDiv.textContent = message;
            successDiv.style.display = 'block';
            setTimeout(() => {
                successDiv.style.display = 'none';
            }, 5000);
        }

        function hideMessage() {
            document.getElementById('errorMessage').style.display = 'none';
            document.getElementById('successMessage').style.display = 'none';
        }

        function showLoading() {
            const tbody = document.getElementById('customerTable');
            tbody.innerHTML = '<tr><td colspan="6" class="loading">Memuat data...</td></tr>';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>