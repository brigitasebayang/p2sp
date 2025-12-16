<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pegawai - Kouvee Pet Shop</title>
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
            color: var(--secondary-color);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

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

        #pegawaiForm {
            background: var(--bg-dark);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        #pegawaiForm h2 {
            grid-column: 1 / -1;
            margin-bottom: 10px;
        }

        input.error {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2) !important;
        }

        .form-group {
            margin-bottom: 0;
            position: relative;
        }

        .form-error {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 4px;
            display: none;
        }

        .form-error.show {
            display: block;
        }

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

        .btn-primary:hover:not(:disabled) {
            background: var(--primary-hover);
            box-shadow: 0 4px 10px rgba(217, 119, 6, 0.3);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
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

        /* TOAST NOTIFICATION */
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
            word-break: break-word;
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
            border-left: 4px solid var(--success-color);
        }

        .toast-error {
            background: #fee2e2;
            color: #7f1d1d;
            border-left: 4px solid var(--danger-color);
        }

        .toast-info {
            background: #dbeafe;
            color: #1e3a8a;
            border-left: 4px solid var(--info-color);
        }

        .toast-warning {
            background: #fef3c7;
            color: #78350f;
            border-left: 4px solid var(--warning-color);
        }

        .toast-icon {
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .toast-message {
            flex: 1;
        }

        .toast-close {
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 0;
            margin-left: 10px;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .toast-close:hover {
            opacity: 1;
        }

        /* MODAL CONFIRMATION */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 8000;
            animation: fadeIn 0.2s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal-overlay.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            animation: scaleIn 0.2s ease-out;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-header {
            margin-bottom: 15px;
        }

        .modal-header h3 {
            font-size: 1.25rem;
            color: var(--secondary-color);
        }

        .modal-body {
            margin-bottom: 25px;
            color: #6b7280;
            line-height: 1.6;
        }

        .modal-footer {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .modal-footer .btn {
            flex: 1;
        }

        @media (max-width: 768px) {
            #pegawaiForm {
                grid-template-columns: 1fr;
            }

            .action-cell .btn {
                display: block;
                width: 100%;
                margin-bottom: 5px;
                margin-right: 0;
            }

            .toast-container {
                left: 10px;
                right: 10px;
            }

            .toast {
                min-width: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🧑‍💻 Kelola Pegawai Kouvee Pet Shop</h1>
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
                    <button type="button" class="btn btn-danger" id="confirmButton">Hapus</button>
                </div>
            </div>
        </div>

        <!-- SEARCH BAR -->
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="🔍 Cari Pegawai" onkeyup="searchPegawai()">
        </div>

        <!-- FORM -->
        <form id="pegawaiForm" onsubmit="handleSubmit(event)">
            <h2>Tambah/Edit Data Pegawai</h2>
            <input type="hidden" id="pegawaiId" value="">

            <div class="form-group">
                <label for="nama">Nama Pegawai *</label>
                <input type="text" id="nama" required placeholder="Masukkan Nama" onchange="validateNama()">
                <small id="namaError" class="form-error"></small>
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan *</label>
                <select id="jabatan" required>
                    <option value="" disabled selected>Pilih Jabatan</option>
                    <option value="cs">Customer Service</option>
                    <option value="kasir">Kasir</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat *</label>
                <input type="text" id="alamat" required placeholder="Masukkan Alamat">
                <small id="alamatError" class="form-error" style="display:none;"></small>
            </div>

            <div class="form-group">
                <label for="tanggalLahir">Tanggal Lahir *</label>
                <input type="date" id="tanggalLahir" required>
                <small id="tanggalLahirError" class="form-error" style="display:none;"></small>
            </div>

            <div class="form-group">
                <label for="noTelp">Nomor Telpon *</label>
                <input type="text" id="noTelp" required placeholder="Masukkan Nomor Telpon" oninput="this.value = this.value.replace(/[^0-9]/g,''); validatePhone()">
                <small id="noTelpError" class="form-error"></small>
            </div>

            <div class="form-group">
                <label for="username">Username *</label>
                <input type="text" id="username" required placeholder="Masukkan Username">
                <small id="usernameError" class="form-error" style="display:none;"></small>
            </div>

            <div class="form-group">
                <label for="password">Password *</label>
                <input type="text" id="password" required placeholder="Masukkan Password">
                <small id="passwordError" class="form-error" style="display:none;"></small>
            </div>

            <div class="btn-action-container">
                <button type="button" class="btn btn-secondary" id="resetButton" onclick="resetForm()" style="display: none;">↺ Reset</button>
                <button type="submit" class="btn btn-primary" id="submitButton">💾 Simpan Pegawai</button>
            </div>
        </form>

        <!-- TABLE -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Nomor Telpon</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="pegawaiTable">
                    <tr>
                        <td colspan="9" class="loading">Memuat data...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

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
                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || `HTTP Error: ${response.status}`);
                    }

                    return data;
                } catch (error) {
                    console.error("[v0] API Error:", error);
                    throw error;
                }
            }

            async getPegawaiList() {
                return this.request("/pegawai");
            }

            async createPegawai(data) {
                return this.request("/pegawai", {
                    method: "POST",
                    body: JSON.stringify(data),
                });
            }

            async updatePegawai(id, data) {
                return this.request(`/pegawai/${id}`, {
                    method: "PUT",
                    body: JSON.stringify(data),
                });
            }

            async deletePegawai(id) {
                return this.request(`/pegawai/${id}`, {
                    method: "DELETE",
                });
            }
        }

        const apiClient = new ApiClient();
        let pegawaiData = [];
        let filteredData = [];
        let isEditing = false;
        let deleteTargetId = null;

        // Toast notification system
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
                    <span class="toast-icon">${icons[type]}</span>
                    <span class="toast-message">${message}</span>
                    <button type="button" class="toast-close" onclick="this.parentElement.remove()">×</button>
                `;

                container.appendChild(toast);

                if (duration > 0) {
                    setTimeout(() => {
                        toast.classList.add('remove');
                        setTimeout(() => toast.remove(), 300);
                    }, duration);
                }
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', async () => {
            await loadPegawaiData();
        });

        async function loadPegawaiData() {
            try {
                showLoading();
                const response = await apiClient.getPegawaiList();
                pegawaiData = response.data || response;
                filteredData = pegawaiData;
                renderTable();
            } catch (error) {
                Toast.show(`Gagal memuat data: ${error.message}`, 'error');
                console.error("[v0] Error loading data:", error);
            }
        }

        function validatePhone() {
            const noTelpInput = document.getElementById('noTelp');
            const errorField = document.getElementById('noTelpError');
            const phoneRegex = /^[0-9]{11,13}$/;

            if (noTelpInput.value === '') {
                errorField.classList.remove("show");
                noTelpInput.classList.remove("error");
                return true;
            }

            const currentId = document.getElementById('pegawaiId').value;
            const isDuplicate = pegawaiData.some(p =>
                p.no_telp === noTelpInput.value &&
                (!currentId || p.id_pegawai != currentId)
            );

            if (isDuplicate) {
                errorField.textContent = "Nomor telepon sudah digunakan pegawai lain";
                errorField.classList.add("show");
                noTelpInput.classList.add("error");
                return false;
            }

            if (!phoneRegex.test(noTelpInput.value)) {
                errorField.textContent = "Nomor telepon harus 11-13 digit";
                errorField.classList.add("show");
                noTelpInput.classList.add("error");
                return false;
            } else {
                errorField.classList.remove("show");
                noTelpInput.classList.remove("error");
                return true;
            }
        }

        function validateNama() {
            const namaInput = document.getElementById('nama');
            const errorField = document.getElementById('namaError');
            const nama = namaInput.value.trim();

            if (nama === '') {
                errorField.classList.remove("show");
                namaInput.classList.remove("error");
                return true;
            }

            const currentId = document.getElementById('pegawaiId').value;
            const isDuplicate = pegawaiData.some(p =>
                p.nama.toLowerCase() === nama.toLowerCase() &&
                (!currentId || p.id_pegawai != currentId)
            );

            if (isDuplicate) {
                errorField.textContent = "Nama pegawai sudah ada! Gunakan nama lain.";
                errorField.classList.add("show");
                namaInput.classList.add("error");
                return false;
            } else {
                errorField.classList.remove("show");
                namaInput.classList.remove("error");
                return true;
            }
        }

        async function handleSubmit(event) {
            event.preventDefault();

            if (!validateNama() || !validatePhone()) {
                Toast.show('Terdapat error pada form. Mohon perbaiki!', 'error');
                return;
            }

            const pegawaiId = document.getElementById('pegawaiId').value;
            const nama = document.getElementById('nama').value.trim();
            const jabatan = document.getElementById('jabatan').value.trim();
            const alamat = document.getElementById('alamat').value.trim();
            const tanggalLahir = document.getElementById('tanggalLahir').value.trim();
            const noTelp = document.getElementById('noTelp').value.trim();
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();

            const namaError = document.getElementById('namaError');
            const noTelpError = document.getElementById('noTelpError');
            const usernameError = document.getElementById('usernameError');

            if (!nama || !jabatan || !alamat || !tanggalLahir || !noTelp || !username || !password) {
                Toast.show('Semua field wajib diisi!', 'warning');
                return;
            }

            const pegawaiDataPayload = {
                nama,
                jabatan,
                alamat,
                tanggal_lahir: tanggalLahir,
                no_telp: noTelp,
                username,
                password
            };

            try {
                const submitButton = document.getElementById('submitButton');
                submitButton.disabled = true;
                submitButton.textContent = '⏳ Menyimpan...';

                if (pegawaiId) {
                    await apiClient.updatePegawai(pegawaiId, pegawaiDataPayload);
                    Toast.show('Data pegawai berhasil diperbarui!', 'success');
                } else {
                    await apiClient.createPegawai(pegawaiDataPayload);
                    Toast.show('Data pegawai berhasil ditambahkan!', 'success');
                }

                resetForm();
                await loadPegawaiData();
            } catch (error) {
                Toast.show(`Gagal menyimpan data: ${error.message}`, 'error');
                console.error("[v0] Error saving data:", error);
            } finally {
                const submitButton = document.getElementById('submitButton');
                submitButton.disabled = false;
                submitButton.textContent = pegawaiId ? '✅ Simpan Perubahan' : '💾 Simpan Pegawai';
            }
        }

        function renderTable() {
            const tbody = document.getElementById('pegawaiTable');
            tbody.innerHTML = '';

            if (filteredData.length === 0) {
                tbody.innerHTML = '<tr><td colspan="9" style="text-align: center; padding: 20px; color: #6b7280;">Belum ada data pegawai</td></tr>';
                return;
            }

            filteredData.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.id_pegawai}</td>
                    <td>${item.nama}</td>
                    <td>${item.jabatan}</td>
                    <td>${item.alamat}</td>
                    <td>${item.tanggal_lahir || item.tanggalLahir}</td>
                    <td>${item.no_telp || item.noTelp}</td>
                    <td>${item.username}</td>
                    <td>${item.password}</td>
                    <td class="action-cell">
                        <button type="button" class="btn btn-edit" onclick="editData(${item.id_pegawai})">✏️ Edit</button>
                        <button type="button" class="btn btn-delete" onclick="confirmDelete(${item.id_pegawai}, '${item.nama}')">🗑️ Hapus</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        async function editData(id) {
            try {
                const pegawai = pegawaiData.find(p => p.id_pegawai === id);
                if (!pegawai) {
                    Toast.show('Data pegawai tidak ditemukan', 'error');
                    return;
                }

                document.getElementById('pegawaiId').value = pegawai.id_pegawai;
                document.getElementById('nama').value = pegawai.nama;
                document.getElementById('jabatan').value = pegawai.jabatan;
                document.getElementById('alamat').value = pegawai.alamat;
                document.getElementById('tanggalLahir').value = pegawai.tanggal_lahir || pegawai.tanggalLahir;
                document.getElementById('noTelp').value = pegawai.no_telp || pegawai.noTelp;
                document.getElementById('username').value = pegawai.username;
                document.getElementById('password').value = pegawai.password;
                document.getElementById('submitButton').textContent = '✅ Simpan Perubahan';
                document.getElementById('resetButton').style.display = 'inline-flex';

                document.getElementById('pegawaiForm').scrollIntoView({
                    behavior: 'smooth'
                });
                Toast.show('Form siap untuk diubah', 'info');
            } catch (error) {
                Toast.show(`Gagal memuat data: ${error.message}`, 'error');
            }
        }

        function confirmDelete(id, name) {
            deleteTargetId = id;
            const modal = document.getElementById('confirmationModal');
            document.getElementById('modalTitle').textContent = 'Konfirmasi Penghapusan';
            document.getElementById('modalMessage').textContent = `Apakah Anda yakin ingin menghapus data pegawai "${name}"?`;
            document.getElementById('confirmButton').textContent = '🗑️ Hapus';
            document.getElementById('confirmButton').className = 'btn btn-delete';
            document.getElementById('confirmButton').onclick = deleteData;
            modal.classList.add('active');
        }

        function closeConfirmation() {
            const modal = document.getElementById('confirmationModal');
            modal.classList.remove('active');
            deleteTargetId = null;
        }

        async function deleteData() {
            if (!deleteTargetId) return;

            try {
                await apiClient.deletePegawai(deleteTargetId);
                Toast.show('Data pegawai berhasil dihapus!', 'success');
                closeConfirmation();
                await loadPegawaiData();
            } catch (error) {
                Toast.show(`Gagal menghapus data: ${error.message}`, 'error');
                console.error("[v0] Error deleting data:", error);
            }
        }

        function resetForm() {
            document.getElementById('pegawaiForm').reset();
            document.getElementById('pegawaiId').value = '';
            document.getElementById('submitButton').textContent = '💾 Simpan Pegawai';
            document.getElementById('resetButton').style.display = 'none';
            document.getElementById('noTelp').classList.remove("error");
            document.getElementById('noTelpError').classList.remove("show");
            document.getElementById('nama').classList.remove("error");
            document.getElementById('namaError').classList.remove("show");
            document.getElementById('username').classList.remove("error");
            document.getElementById('usernameError').classList.remove("show");
            document.getElementById('password').classList.remove("error");
            document.getElementById('passwordError').classList.remove("show");
        }

        function searchPegawai() {
            const keyword = document.getElementById('searchInput').value.toLowerCase();
            filteredData = pegawaiData.filter(item =>
                item.nama.toLowerCase().includes(keyword) ||
                item.alamat.toLowerCase().includes(keyword) ||
                item.jabatan.toLowerCase().includes(keyword) ||
                (item.no_telp || item.noTelp).includes(keyword)
            );
            renderTable();
        }

        function showLoading() {
            const tbody = document.getElementById('pegawaiTable');
            tbody.innerHTML = '<tr><td colspan="9" class="loading">⏳ Memuat data...</td></tr>';
        }
    </script>
</body>

</html>