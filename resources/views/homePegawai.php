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
            --primary-color: #d97706; /* Emas/Jingga */
            --primary-hover: #b45309;
            --secondary-color: #1f2937; /* Biru Gelap/Hitam */
            --bg-light: #fef3c7; /* Latar Belakang sangat terang */
            --bg-dark: #ffffff;
            --border-color: #e5e7eb;
            --success-color: #10b981; /* Hijau untuk Aktif */
            --danger-color: #ef4444; /* Merah untuk Tidak Aktif */
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

        /* FORM STYLING */
        #pegawaiForm {
            background: var(--bg-dark);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 40px;
            /* Layout Form 2 kolom */
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        #pegawaiForm h2 {
            grid-column: 1 / -1; /* Judul membentang di semua kolom */
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 0; /* Jarak sudah diatur oleh gap grid */
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
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s;
            font-size: 1rem;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.2);
        }

        /* BUTTON STYLING */
        .btn-action-container {
            grid-column: 1 / -1;
            text-align: right;
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
            /* margin-top: 15px; */
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            box-shadow: 0 4px 10px rgba(217, 119, 6, 0.3);
        }

        .btn-edit {
            background: #3b82f6; /* Biru */
            color: white;
        }
        .btn-edit:hover {
            background: #2563eb;
        }
        .btn-delete {
            background: var(--danger-color); /* Merah */
            color: white;
        }
        .btn-delete:hover {
            background: #dc2626;
        }

        /* TABLE STYLING */
        .table-wrapper {
            background: var(--bg-dark);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow-x: auto; 
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        th, td {
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

    <form id="pegawaiForm" onsubmit="handleSubmit(event)">
        <h2>Tambah/Edit Data Pegawai</h2>
        <input type="hidden" id="index" value="">
        
        <div class="form-group">
            <label for="nama">Nama Pegawai *</label>
            <input type="text" id="nama" required placeholder="Contoh: Budi Santoso">
        </div>

        <div class="form-group">
            <label for="jabatan">Jabatan *</label>
            <input type="text" id="jabatan" required placeholder="Contoh: Pet Groomer Senior">
        </div>

        <div class="form-group">
            <label for="gaji">Gaji (Rp) *</label>
            <input type="number" id="gaji" required min="1000000" placeholder="Contoh: 3500000">
        </div>

        <div class="form-group">
            <label for="status">Status Kerja *</label>
            <select id="status" required>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
        </div>

        <div class="btn-action-container">
            <button type="submit" class="btn btn-primary" id="submitButton">💾 Simpan Pegawai</button>
        </div>
    </form>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    <th>Jabatan</th>
                    <th>Gaji</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="pegawaiTable">
                </tbody>
        </table>
    </div>
</div>

<script>
    // Data awal untuk demonstrasi (Model Pegawai)
    let pegawaiData = [
        { nama: 'Dini Fitriana', jabatan: 'Manajer Toko', gaji: 5000000, status: 'Aktif' },
        { nama: 'Rizki Adi', jabatan: 'Kasir', gaji: 2800000, status: 'Aktif' },
        { nama: 'Siska Dewi', jabatan: 'Pet Groomer', gaji: 3200000, status: 'Tidak Aktif' }
    ];

    function handleSubmit(event) {
        event.preventDefault();
        
        const index = document.getElementById('index').value;
        const nama = document.getElementById('nama').value.trim();
        const jabatan = document.getElementById('jabatan').value.trim();
        const gaji = document.getElementById('gaji').value.trim();
        const status = document.getElementById('status').value;

        if(nama === '' || jabatan === '' || gaji === '') {
            alert('Semua field wajib diisi!');
            return;
        }

        const pegawai = { nama, jabatan, gaji: parseInt(gaji), status };

        if(index === '') {
            // Tambah baru
            pegawaiData.push(pegawai);
        } else {
            // Edit
            pegawaiData[index] = pegawai;
        }

        document.getElementById('pegawaiForm').reset();
        document.getElementById('index').value = '';
        document.getElementById('submitButton').textContent = '💾 Simpan Pegawai';
        renderTable();
    }

    function renderTable() {
        const tbody = document.getElementById('pegawaiTable');
        tbody.innerHTML = '';
        if (pegawaiData.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 20px; color: #6b7280;">Belum ada data pegawai. Tambahkan yang baru!</td></tr>';
            return;
        }
        
        pegawaiData.forEach((item, i) => {
            const statusClass = item.status === 'Aktif' ? 'badge-aktif' : 'badge-tidak-aktif';
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${i+1}</td>
                <td>${item.nama}</td>
                <td>${item.jabatan}</td>
                <td>Rp ${Number(item.gaji).toLocaleString('id-ID')}</td>
                <td><span class="badge ${statusClass}">${item.status}</span></td>
                <td class="action-cell">
                    <button class="btn btn-edit" onclick="editData(${i})">✏️ Edit</button>
                    <button class="btn btn-delete" onclick="deleteData(${i})">🗑️ Hapus</button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    function editData(i) {
        document.getElementById('index').value = i;
        document.getElementById('nama').value = pegawaiData[i].nama;
        document.getElementById('jabatan').value = pegawaiData[i].jabatan;
        document.getElementById('gaji').value = pegawaiData[i].gaji;
        document.getElementById('status').value = pegawaiData[i].status;
        
        // Ubah teks tombol menjadi "Simpan Perubahan"
        document.getElementById('submitButton').textContent = '✅ Simpan Perubahan';

        // Scroll ke atas agar form terlihat
        document.getElementById('pegawaiForm').scrollIntoView({ behavior: 'smooth' });
    }

    function deleteData(i) {
        if(confirm(`Yakin ingin menghapus data pegawai "${pegawaiData[i].nama}"?`)) {
            pegawaiData.splice(i, 1);
            renderTable();
        }
    }

    // Render awal saat halaman dimuat
    document.addEventListener('DOMContentLoaded', renderTable);
</script>

</body>
</html>