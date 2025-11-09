<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pegawai - Kouvee Pet Shop</title>
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
        #pegawaiForm {
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

        #pegawaiForm h2 {
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
            /* Biru */
            color: white;
        }

        .btn-edit:hover {
            background: #2563eb;
        }

        .btn-delete {
            background: var(--danger-color);
            /* Merah */
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

        /* Badge Status */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .badge-aktif {
            background-color: #d1fae5;
            color: var(--success-color);
        }

        .badge-tidak-aktif {
            background-color: #fee2e2;
            color: var(--danger-color);
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
            #pegawaiForm {
                grid-template-columns: 1fr;
            }

            .action-cell .btn {
                display: block;
                width: 100%;
                margin-bottom: 5px;
                margin-right: 0;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>🧑‍💻 Kelola Pegawai Kouvee Pet Shop</h1>
        </div>

        <!-- Add success and error message containers -->
        <div id="successMessage" class="success-message"></div>
        <div id="errorMessage" class="error-message"></div>

        <!-- 🔍 SEARCH BAR -->
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="🔍 Cari Pegawai" onkeyup="searchPegawai()">
        </div>

        <form id="pegawaiForm" onsubmit="handleSubmit(event)">
            <h2>Tambah/Edit Data Pegawai</h2>
            <input type="hidden" id="pegawaiId" value="">

            <div class="form-group">
                <label for="nama">Nama Pegawai *</label>
                <input type="text" id="nama" required placeholder="Masukkan Nama">
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
            </div>

            <div class="form-group">
                <label for="tanggalLahir">Tanggal Lahir *</label>
                <input type="date" id="tanggalLahir" required>
            </div>

            <div class="form-group">
                <label for="noTelp">Nomor Telpon *</label>
                <input type="text" id="noTelp" required placeholder="Masukkan Nomor Telpon">
            </div>

            <div class="form-group">
                <label for="username">Username *</label>
                <input type="text" id="username" required placeholder="Masukkan Username">
            </div>

            <div class="form-group">
                <label for="password">Password *</label>
                <input type="text" id="password" required placeholder="Masukkan Password">
            </div>

            <div class="btn-action-container">
                <button type="button" class="btn btn-secondary" id="resetButton" onclick="resetForm()" style="display: none;">↺ Reset</button>
                <button type="submit" class="btn btn-primary" id="submitButton">💾 Simpan Pegawai</button>
            </div>
        </form>

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
                    <tr><td colspan="8" class="loading">Memuat data...</td></tr>
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

                const config = { ...defaultOptions, ...options };

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

            async getPegawaiList() {
                return this.request("/pegawai");
            }

            async getPegawaiById(id) {
                return this.request(`/pegawai/${id}`);
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
    </script>

    <script>
        let pegawaiData = [];
        let filteredData = [];
        let isEditing = false;

        document.addEventListener('DOMContentLoaded', async () => {
            await loadPegawaiData();
        });

        async function loadPegawaiData() {
            try {
                showLoading();
                console.log("[v0] Loading pegawai data...");
                const response = await apiClient.getPegawaiList();
                console.log("[v0] Response received:", response);
                pegawaiData = response.data || response;
                filteredData = pegawaiData;
                renderTable();
                hideMessage();
            } catch (error) {
                showError('Gagal memuat data pegawai: ' + error.message);
                console.error("[v0] Error loading data:", error);
            }
        }

        async function handleSubmit(event) {
            event.preventDefault();

            const pegawaiId = document.getElementById('pegawaiId').value;
            const nama = document.getElementById('nama').value.trim();
            const jabatan = document.getElementById('jabatan').value.trim();
            const alamat = document.getElementById('alamat').value.trim();
            const tanggalLahir = document.getElementById('tanggalLahir').value.trim();
            const noTelp = document.getElementById('noTelp').value.trim();
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!nama || !jabatan || !alamat || !tanggalLahir || !noTelp || !username || !password) {
                showError('Semua field wajib diisi!');
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
                if (pegawaiId) {
                    await apiClient.updatePegawai(pegawaiId, pegawaiDataPayload);
                    showSuccess('Data pegawai berhasil diperbarui!');
                } else {
                    await apiClient.createPegawai(pegawaiDataPayload);
                    showSuccess('Data pegawai berhasil ditambahkan!');
                }
                resetForm();
                await loadPegawaiData();
            } catch (error) {
                showError('Gagal menyimpan data: ' + error.message);
                console.error("[v0] Error saving data:", error);
            }
        }

        function renderTable() {
            const tbody = document.getElementById('pegawaiTable');
            tbody.innerHTML = '';

            if (filteredData.length === 0) {
                tbody.innerHTML = '<tr><td colspan="8" style="text-align: center; padding: 20px; color: #6b7280;">Belum ada data pegawai</td></tr>';
                return;
            }

            filteredData.forEach((item, index) => {
                const statusClass = item.status === 'Aktif' ? 'badge-aktif' : 'badge-tidak-aktif';
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.id_pegawai}</td>
                    <td>${item.nama}</td>
                    <td>${item.jabatan}</td>
                    <td>${item.alamat}</td>
                    <td>${item.tanggal_lahir || item.tanggalLahir}</td>
                    <td>${item.no_telp || item.noTelp}</td>
                    <td>${item.username || item.username}</td>
                    <td>${item.password || item.password}</td>
                    <td class="action-cell">
                        <button class="btn btn-edit" onclick="editData(${item.id_pegawai})">✏️ Edit</button>
                        <button class="btn btn-delete" onclick="deleteData(${item.id_pegawai})">🗑️ Hapus</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        async function editData(id) {
            try {
                const pegawai = pegawaiData.find(p => p.id_pegawai === id);
                if (!pegawai) {
                    showError('Data pegawai tidak ditemukan');
                    return;
                }

                document.getElementById('pegawaiId').value = pegawai.id_pegawai;
                document.getElementById('nama').value = pegawai.nama;
                document.getElementById('jabatan').value = pegawai.jabatan;
                document.getElementById('alamat').value = pegawai.alamat;
                document.getElementById('tanggalLahir').value = pegawai.tanggal_lahir || pegawai.tanggalLahir;
                document.getElementById('noTelp').value = pegawai.no_telp || pegawai.noTelp;
                document.getElementById('username').value = pegawai.username || pegawai.username;
                document.getElementById('password').value = pegawai.password || pegawai.password;

                document.getElementById('submitButton').textContent = '✅ Simpan Perubahan';
                document.getElementById('resetButton').style.display = 'inline-flex';
                isEditing = true;

                document.getElementById('pegawaiForm').scrollIntoView({ behavior: 'smooth' });
            } catch (error) {
                showError('Gagal memuat data: ' + error.message);
            }
        }

        async function deleteData(id) {
            if (confirm('Yakin ingin menghapus data pegawai ini?')) {
                try {
                    await apiClient.deletePegawai(id);
                    showSuccess('Data pegawai berhasil dihapus!');
                    await loadPegawaiData();
                } catch (error) {
                    showError('Gagal menghapus data: ' + error.message);
                    console.error("[v0] Error deleting data:", error);
                }
            }
        }

        function resetForm() {
            document.getElementById('pegawaiForm').reset();
            document.getElementById('pegawaiId').value = '';
            document.getElementById('submitButton').textContent = '💾 Simpan Pegawai';
            document.getElementById('resetButton').style.display = 'none';
            isEditing = false;
        }

        function searchPegawai() {
            const keyword = document.getElementById('searchInput').value.toLowerCase();
            filteredData = pegawaiData.filter(item =>
                item.nama.toLowerCase().includes(keyword) ||
                item.alamat.toLowerCase().includes(keyword) ||
                item.jabatan.toLowerCase().includes(keyword)
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
            const tbody = document.getElementById('pegawaiTable');
            tbody.innerHTML = '<tr><td colspan="8" class="loading">Memuat data...</td></tr>';
        }
    </script>
</body>

</html>
