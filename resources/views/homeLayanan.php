<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Layanan - Kouvee Pet Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #d97706;
            --primary-hover: #b45309;
            --secondary-color: #1f2937;
            --bg-light: #fef3c7;
            --bg-dark: #ffffff;
            --border-color: #e5e7eb;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-light);
            color: var(--secondary-color);
            line-height: 1.6;
            min-height: 100vh;
        }

        .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-color);
        }

        .header h1 { font-size: 2rem; font-weight: 700; color: var(--primary-color); }

        #layananForm {
            background: var(--bg-dark);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 40px;
        }

        .form-group { margin-bottom: 15px; }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s;
            font-size: 1rem;
        }

        input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.2); }

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

        .btn-primary { background: var(--primary-color); color: white; margin-top: 15px; }
        .btn-primary:hover { background: var(--primary-hover); box-shadow: 0 4px 10px rgba(217,119,6,0.3); }
        .btn-edit { background: #3b82f6; color: white; }
        .btn-edit:hover { background: #2563eb; }
        .btn-delete { background: #ef4444; color: white; }
        .btn-delete:hover { background: #dc2626; }

        .table-wrapper {
            background: var(--bg-dark);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        table { width: 100%; border-collapse: separate; border-spacing: 0; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid var(--border-color); }
        th { background: #f3f4f6; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; color: #6b7280; }

        tbody tr:nth-child(even) { background-color: #f9fafb; }
        tbody tr:hover { background-color: #fefcf3; }

        .action-cell { white-space: nowrap; }
        .action-cell .btn { padding: 8px 12px; font-size: 0.85rem; margin-right: 5px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>🐾 Kelola Layanan Kouvee Pet Shop</h1>
    </div>

    <form id="layananForm" onsubmit="handleSubmit(event)">
        <h2>Tambah/Edit Layanan</h2>
        <input type="hidden" id="layananId" value="">
        
        <div class="form-group">
            <label for="nama">Nama Layanan *</label>
            <input type="text" id="nama" required placeholder="Contoh: Pet Grooming Premium">
        </div>

        <div class="form-group">
            <label for="harga">Harga (Rp) *</label>
            <input type="number" id="harga" required min="1000" placeholder="Contoh: 85000">
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="layananTable"></tbody>
        </table>
    </div>
</div>

<script>
const API_URL = 'http://127.0.0.1:8000/api/layanan';

async function fetchLayanan() {
    const tbody = document.getElementById('layananTable');
    tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;padding:20px;">Memuat data...</td></tr>';
    try {
        const res = await fetch(API_URL);
        if (!res.ok) throw new Error('HTTP error: ' + res.status);
        const data = await res.json();
        renderTable(data);
    } catch (e) {
        console.error(e);
        tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;padding:20px;color:#ef4444;">❌ Gagal memuat data.</td></tr>';
    }
}

function renderTable(data) {
    const tbody = document.getElementById('layananTable');
    tbody.innerHTML = '';
    if (data.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;padding:20px;color:#6b7280;">Belum ada data layanan. Tambahkan yang baru!</td></tr>';
        return;
    }
    data.forEach((item, i) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${i+1}</td>
            <td>${item.nama}</td>
            <td>Rp ${Number(item.harga).toLocaleString('id-ID')}</td>
            <td class="action-cell">
                <button class="btn btn-edit" onclick="editData(${item.id})">✏ Edit</button>
                <button class="btn btn-delete" onclick="deleteData(${item.id}, '${item.nama}')">🗑 Hapus</button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

async function handleSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('layananId').value;
    const nama = document.getElementById('nama').value.trim();
    const harga = document.getElementById('harga').value.trim();
    if (!nama || !harga) { alert('Nama dan Harga wajib diisi!'); return; }

    const payload = { nama, harga: parseInt(harga) };
    const url = id ? `${API_URL}/${id}` : API_URL;
    const method = id ? 'PUT' : 'POST';

    try {
        const res = await fetch(url, {
            method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        if (!res.ok) throw new Error('Gagal menyimpan layanan.');
        document.getElementById('layananForm').reset();
        resetFormState();
        await fetchLayanan();
        alert(id ? '✅ Layanan berhasil diperbarui!' : '✅ Layanan baru berhasil ditambahkan!');
    } catch (e) { console.error(e); alert('Terjadi kesalahan.'); }
}

async function editData(id) {
    try {
        const res = await fetch(`${API_URL}/${id}`);
        const item = await res.json();
        document.getElementById('layananId').value = item.id;
        document.getElementById('nama').value = item.nama;
        document.getElementById('harga').value = item.harga;
        document.getElementById('submitButton').textContent = '✅ Simpan Perubahan';
        document.getElementById('layananForm').scrollIntoView({behavior:'smooth'});
    } catch(e){console.error(e); alert('Gagal memuat data.');}
}

async function deleteData(id,nama){
    if(!confirm(`Yakin ingin menghapus layanan "${nama}"? Tindakan ini tidak dapat dibatalkan.`)) return;
    try{
        const res = await fetch(`${API_URL}/${id}`,{method:'DELETE'});
        if(!res.ok) throw new Error('Gagal menghapus layanan.');
        await fetchLayanan();
        alert(`🗑 Layanan "${nama}" berhasil dihapus.`);
    }catch(e){console.error(e); alert('Gagal menghapus layanan.');}
}

function resetFormState(){
    document.getElementById('layananId').value = '';
    document.getElementById('submitButton').textContent = '💾 Simpan Layanan';
}

document.addEventListener('DOMContentLoaded', fetchLayanan);
</script>
</body>
</html>
