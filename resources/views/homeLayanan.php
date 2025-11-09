<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Layanan - Kouvee Pet Shop</title>
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
        #layananForm {
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

        #layananForm h2 {
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
            #layananForm {
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
            <h1>🧑‍💻 Kelola Layanan Kouvee Pet Shop</h1>
        </div>

        <!-- Add success and error message containers -->
        <div id="successMessage" class="success-message"></div>
        <div id="errorMessage" class="error-message"></div>

        <!-- 🔍 SEARCH BAR -->
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="🔍 Cari Layanan" onkeyup="searchLayanan()">
        </div>

        <form id="layananForm" onsubmit="handleSubmit(event)">
            <h2>Tambah/Edit Data Layanan</h2>
            <input type="hidden" id="layananId" value="">

            <div class="form-group">
                <label for="nama">Nama *</label>
                <input type="text" id="nama" required placeholder="Masukkan Nama">
            </div>

            <div class="form-group">
                <label for="harga">Harga *</label>
                <input type="text" id="harga" required placeholder="Masukkan Harga">
            </div>

            <div class="btn-action-container">
                <button type="button" class="btn btn-secondary" id="resetButton" onclick="resetForm()" style="display: none;">↺ Reset</button>
                <button type="submit" class="btn btn-primary" id="submitButton">💾 Simpan Layanan</button>
            </div>
        </form>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody id="layananTable">
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

            async getLayananList() {
                return this.request("/layanan");
            }

            async getLayananById(id) {
                return this.request(`/layanan/${id}`);
            }

            async createLayanan(data) {
                return this.request("/layanan", {
                    method: "POST",
                    body: JSON.stringify(data),
                });
            }

            async updateLayanan(id, data) {
                return this.request(`/layanan/${id}`, {
                    method: "PUT",
                    body: JSON.stringify(data),
                });
            }

            async deleteLayanan(id) {
                return this.request(`/layanan/${id}`, {
                    method: "DELETE",
                });
            }
        }

        const apiClient = new ApiClient();
    </script>

    <script>
        let layananData = [];
        let filteredData = [];
        let isEditing = false;

        document.addEventListener('DOMContentLoaded', async () => {
            await loadLayananData();
        });

        async function loadLayananData() {
            try {
                showLoading();
                console.log("[v0] Loading layanan data...");
                const response = await apiClient.getLayananList();
                console.log("[v0] Response received:", response);
                layananData = response.data || response;
                filteredData = layananData;
                renderTable();
                hideMessage();
            } catch (error) {
                showError('Gagal memuat data layanan: ' + error.message);
                console.error("[v0] Error loading data:", error);
            }
        }

        async function handleSubmit(event) {
            event.preventDefault();

            const layananId = document.getElementById('layananId').value;
            const nama = document.getElementById('nama').value.trim();
            const harga = document.getElementById('harga').value.trim();

            if (!nama || !harga) {
                showError('Semua field wajib diisi!');
                return;
            }

            const layananDataPayload = {
                nama,
                harga,
            };

            try {
                if (layananId) {
                    await apiClient.updateLayanan(layananId, layananDataPayload);
                    showSuccess('Data layanan berhasil diperbarui!');
                } else {
                    await apiClient.createLayanan(layananDataPayload);
                    showSuccess('Data layanan berhasil ditambahkan!');
                }
                resetForm();
                await loadLayananData();
            } catch (error) {
                showError('Gagal menyimpan data: ' + error.message);
                console.error("[v0] Error saving data:", error);
            }
        }

        function renderTable() {
            const tbody = document.getElementById('layananTable');
            tbody.innerHTML = '';

            if (filteredData.length === 0) {
                tbody.innerHTML = '<tr><td colspan="8" style="text-align: center; padding: 20px; color: #6b7280;">Belum ada data layanan</td></tr>';
                return;
            }

            filteredData.forEach((item, index) => {
                const statusClass = item.status === 'Aktif' ? 'badge-aktif' : 'badge-tidak-aktif';
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.id_layanan}</td>
                    <td>${item.nama}</td>
                    <td>${item.harga}</td>
                    <td class="action-cell">
                        <button class="btn btn-edit" onclick="editData(${item.id_layanan})">✏ Edit</button>
                        <button class="btn btn-delete" onclick="deleteData(${item.id_layanan})">🗑 Hapus</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        async function editData(id) {
            try {
                const layanan = layananData.find(p => p.id_layanan === id);
                if (!layanan) {
                    showError('Data layanan tidak ditemukan');
                    return;
                }

                document.getElementById('layananId').value = layanan.id_layanan;
                document.getElementById('nama').value = layanan.nama;
                document.getElementById('harga').value = layanan.harga;

                document.getElementById('submitButton').textContent = '✅ Simpan Perubahan';
                document.getElementById('resetButton').style.display = 'inline-flex';
                isEditing = true;

                document.getElementById('layananForm').scrollIntoView({ behavior: 'smooth' });
            } catch (error) {
                showError('Gagal memuat data: ' + error.message);
            }
        }

        async function deleteData(id) {
            if (confirm('Yakin ingin menghapus data layanan ini?')) {
                try {
                    await apiClient.deleteLayanan(id);
                    showSuccess('Data layanan berhasil dihapus!');
                    await loadLayananData();
                } catch (error) {
                    showError('Gagal menghapus data: ' + error.message);
                    console.error("[v0] Error deleting data:", error);
                }
            }
        }

        function resetForm() {
            document.getElementById('layananForm').reset();
            document.getElementById('layananId').value = '';
            document.getElementById('submitButton').textContent = '💾 Simpan Layanan';
            document.getElementById('resetButton').style.display = 'none';
            isEditing = false;
        }

        function searchLayanan() {
            const keyword = document.getElementById('searchInput').value.toLowerCase();
            filteredData = layananData.filter(item =>
                item.nama.toLowerCase().includes(keyword)
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
            const tbody = document.getElementById('layananTable');
            tbody.innerHTML = '<tr><td colspan="8" class="loading">Memuat data...</td></tr>';
        }
    </script>
</body>

</html>