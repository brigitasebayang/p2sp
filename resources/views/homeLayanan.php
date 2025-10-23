<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Layanan - Kouvee Pet Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Variabel CSS */
        :root {
            --primary-color: #d97706; /* Emas/Jingga */
            --primary-hover: #b45309;
            --secondary-color: #1f2937; /* Biru Gelap/Hitam */
            --bg-light: #fef3c7; /* Latar Belakang sangat terang */
            --bg-dark: #ffffff;
            --border-color: #e5e7eb;
        }

        /* RESET & Dasar */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-light); /* Latar belakang cerah */
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
        #layananForm {
            background: var(--bg-dark);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 40px;
        }

        .form-group {
            margin-bottom: 15px;
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
            margin-top: 15px;
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
            background: #ef4444; /* Merah */
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
            overflow-x: auto; /* Membuat tabel responsif */
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

        /* Efek garis selang-seling (striped) */
        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }
        
        tbody tr:hover {
            background-color: #fefcf3; /* Efek hover halus */
        }
        
        /* Kolom aksi */
        .action-cell {
            white-space: nowrap;
        }

        .action-cell .btn {
            padding: 8px 12px;
            font-size: 0.85rem;
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>🐾 Kelola Layanan Kouvee Pet Shop</h1>
    </div>

    <form id="layananForm" onsubmit="handleSubmit(event)">
        <h2>Tambah/Edit Layanan</h2>
        <input type="hidden" id="index" value="">
        
        <div class="form-group">
            <label for="nama">Nama Layanan *</label>
            <input type="text" id="nama" required placeholder="Contoh: Pet Grooming Premium">
        </div>

        <div class="form-group">
            <label for="harga">Harga (Rp) *</label>
            <input type="number" id="harga" required min="1000" placeholder="Contoh: 85000">
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" id="deskripsi" placeholder="Durasi, detail, atau catatan layanan">
        </div>

        <button type="submit" class="btn btn-primary" id="submitButton">💾 Simpan Layanan</button>
    </form>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Layanan</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="layananTable">
                </tbody>
        </table>
    </div>
</div>

<script>
    // Data awal untuk demonstrasi
    let layananData = [
        { nama: 'Mandi Kering (Dry Bath)', harga: 30000, deskripsi: 'Untuk anjing/kucing bulu pendek.' },
        { nama: 'Grooming Lengkap', harga: 85000, deskripsi: 'Mandi, potong kuku, bersih telinga.' },
        { nama: 'Konsultasi Dokter Hewan', harga: 50000, deskripsi: 'Pemeriksaan dasar 15 menit.' }
    ];

    function handleSubmit(event) {
        event.preventDefault();
        
        const index = document.getElementById('index').value;
        const nama = document.getElementById('nama').value.trim();
        const harga = document.getElementById('harga').value.trim();
        const deskripsi = document.getElementById('deskripsi').value.trim();

        if(nama === '' || harga === '') {
            alert('Nama dan Harga wajib diisi!');
            return;
        }

        const layanan = { nama, harga, deskripsi };

        if(index === '') {
            // Tambah baru
            layananData.push(layanan);
        } else {
            // Edit
            layananData[index] = layanan;
        }

        document.getElementById('layananForm').reset();
        document.getElementById('index').value = '';
        document.getElementById('submitButton').textContent = '💾 Simpan Layanan';
        renderTable();
    }

    function renderTable() {
        const tbody = document.getElementById('layananTable');
        tbody.innerHTML = '';
        if (layananData.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" style="text-align: center; padding: 20px; color: #6b7280;">Belum ada data layanan. Tambahkan yang baru!</td></tr>';
            return;
        }
        
        layananData.forEach((item, i) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${i+1}</td>
                <td>${item.nama}</td>
                <td>Rp ${Number(item.harga).toLocaleString('id-ID')}</td>
                <td>${item.deskripsi || '-'}</td>
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
        document.getElementById('nama').value = layananData[i].nama;
        document.getElementById('harga').value = layananData[i].harga;
        document.getElementById('deskripsi').value = layananData[i].deskripsi;
        
        // Ubah teks tombol menjadi "Simpan Perubahan"
        document.getElementById('submitButton').textContent = '✅ Simpan Perubahan';

        // Scroll ke atas agar form terlihat
        document.getElementById('layananForm').scrollIntoView({ behavior: 'smooth' });
    }

    function deleteData(i) {
        if(confirm(`Yakin ingin menghapus layanan "${layananData[i].nama}"?`)) {
            layananData.splice(i, 1);
            renderTable();
        }
    }

    // Render awal saat halaman dimuat
    document.addEventListener('DOMContentLoaded', renderTable);
</script>

</body>
</html>