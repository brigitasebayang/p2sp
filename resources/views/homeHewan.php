<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Hewan - Kouvee Pet Shop</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #10b981;
      --primary-hover: #059669;
      --secondary-color: #1f2937;
      --bg-light: #ecfdf5;
      --bg-dark: #ffffff;
      --border-color: #e5e7eb;
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

    .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }

    .header {
      display: flex; justify-content: space-between; align-items: center;
      margin-bottom: 30px; padding-bottom: 10px; border-bottom: 2px solid var(--primary-color);
    }

    .header h1 { font-size: 2rem; font-weight: 700; color: var(--primary-color); }

    .search-container { margin-bottom: 25px; display: flex; justify-content: flex-end; }

    #searchInput {
      width: 300px; padding: 10px 15px; border: 1px solid var(--border-color);
      border-radius: 8px; font-size: 1rem;
    }

    #animalForm {
      background: var(--bg-dark);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      margin-bottom: 40px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    #animalForm h2 {
      grid-column: 1 / -1;
      margin-bottom: 10px;
      color: var(--primary-color);
    }

    label { display: block; margin-bottom: 5px; font-weight: 600; }

    input[type="text"], input[type="date"], select {
      width: 100%;
      padding: 12px;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      font-size: 1rem;
    }

    input:focus, select:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(16,185,129,0.2);
    }

    .error-msg {
      color: var(--danger-color);
      font-size: 0.85rem;
      margin-top: 4px;
    }

    .full-width { grid-column: 1 / -1; }

    .btn {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      font-size: 1rem;
    }

    .btn-primary { background: var(--primary-color); color: white; }
    .btn-primary:hover { background: var(--primary-hover); }
    .btn-primary:disabled { background: #ccc; cursor: not-allowed; }
    .btn-edit { background: #3b82f6; color: white; }
    .btn-delete { background: var(--danger-color); color: white; }

    table {
      width: 100%;
      border-collapse: collapse;
      background: var(--bg-dark);
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    th, td { text-align: left; padding: 12px 16px; }
    th { background: var(--primary-color); color: white; font-weight: 600; }
    tr:nth-child(even) { background: #f9fafb; }
    tr:hover { background: #d1fae5; }

    .actions { display: flex; gap: 10px; }

    .alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      display: none;
    }

    .alert.show { display: block; }
    .alert.success { background: #d1fae5; color: #065f46; border: 1px solid var(--primary-color); }
    .alert.error { background: #fee2e2; color: #991b1b; border: 1px solid var(--danger-color); }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Kelola Hewan Kouvee Pet Shop</h1>
    </div>

    <div id="alertBox" class="alert"></div>

    <div class="search-container">
      <input type="text" id="searchInput" placeholder="Cari nama hewan..." onkeyup="filterAnimals()">
    </div>

    <!-- FORM -->
    <form id="animalForm" novalidate>
      <h2>Form Hewan</h2>
      <input type="hidden" id="animalId">

      <div>
        <label for="customerId">ID Customer</label>
        <input type="text" id="customerId" required placeholder="Contoh: 1">
        <div class="error-msg" id="errorCustomer"></div>
      </div>

      <div>
        <label for="animalName">Nama Hewan</label>
        <input type="text" id="animalName" required placeholder="Contoh: Luna">
        <div class="error-msg" id="errorName"></div>
      </div>

      <div>
        <label for="birthDate">Tanggal Lahir</label>
        <input type="date" id="birthDate" required>
        <div class="error-msg" id="errorDate"></div>
      </div>

      <div class="full-width">
        <label for="animalType">Jenis Hewan</label>
        <input type="text" id="animalType" required placeholder="Contoh: Kucing Persia / Anjing Golden">
        <div class="error-msg" id="errorType"></div>
      </div>

      <div class="full-width" style="text-align:right;">
        <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
      </div>
    </form>

    <!-- TABLE -->
    <table id="animalTable">
      <thead>
        <tr>
          <th>ID</th><th>ID Customer</th><th>Nama Hewan</th><th>Tanggal Lahir</th><th>Jenis Hewan</th><th>Aksi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <script>
    const API_BASE_URL = 'http://127.0.0.1:8000/api';
    let animals = [];
    let filtered = [];
    let isEditing = false;

    const tbody = document.querySelector("#animalTable tbody");
    const alertBox = document.getElementById("alertBox");

    async function loadAnimals() {
      try {
        const response = await fetch(`${API_BASE_URL}/hewans`);
        if (!response.ok) throw new Error('Failed to load animals');
        animals = await response.json();
        filtered = [...animals];
        renderAnimals();
      } catch (error) {
        showAlert('Error loading animals: ' + error.message, 'error');
      }
    }

    function renderAnimals() {
      tbody.innerHTML = "";
      if (filtered.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;">Tidak ada hewan ditemukan.</td></tr>`;
        return;
      }
      filtered.forEach(a => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${a.id_hewan}</td>
          <td>${a.id_customer}</td>
          <td>${a.nama}</td>
          <td>${a.tanggal_lahir}</td>
          <td>${a.jenis_hewan}</td>
          <td>
            <div class="actions">
              <button class="btn btn-edit" onclick="editAnimal(${a.id_hewan})">Edit</button>
              <button class="btn btn-delete" onclick="deleteAnimal(${a.id_hewan})">Hapus</button>
            </div>
          </td>`;
        tbody.appendChild(row);
      });
    }

    function filterAnimals() {
      const keyword = document.getElementById("searchInput").value.toLowerCase();
      filtered = animals.filter(a => a.nama.toLowerCase().includes(keyword));
      renderAnimals();
    }

    document.getElementById("animalForm").addEventListener("submit", async (e) => {
      e.preventDefault();

      const customerId = document.getElementById("customerId").value.trim();
      const name = document.getElementById("animalName").value.trim();
      const birth = document.getElementById("birthDate").value;
      const type = document.getElementById("animalType").value.trim();
      const id = document.getElementById("animalId").value;

      clearErrors();
      let valid = true;

      if (!customerId) { showError("errorCustomer", "ID Customer wajib diisi!"); valid = false; }
      if (!name) { showError("errorName", "Nama hewan wajib diisi!"); valid = false; }
      if (!birth) { showError("errorDate", "Tanggal lahir wajib diisi!"); valid = false; }
      if (!type) { showError("errorType", "Jenis hewan wajib diisi!"); valid = false; }

      if (!valid) return;

      const submitBtn = document.getElementById("submitBtn");
      submitBtn.disabled = true;
      submitBtn.textContent = "Menyimpan...";

      const payload = {
        id_customer: customerId,
        nama: name,
        tanggal_lahir: birth,
        jenis_hewan: type
      };

      try {
        let response;

        if (id) {
          response = await fetch(`${API_BASE_URL}/hewans/${id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json'},
            body: JSON.stringify(payload)
          });
        } else {
          response = await fetch(`${API_BASE_URL}/hewans`, {
            method: 'POST',
            headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
          });
        }

        if (!response.ok) throw new Error('Gagal menyimpan data hewan');

        showAlert(id ? 'Hewan berhasil diperbarui!' : 'Hewan baru berhasil ditambahkan!', 'success');
        await loadAnimals();
        e.target.reset();
        document.getElementById("animalId").value = "";
        isEditing = false;
      } catch (error) {
        showAlert('Error: ' + error.message, 'error');
      } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = "Simpan";
      }
    });

    function showError(id, message) { document.getElementById(id).textContent = message; }
    function clearErrors() { document.querySelectorAll(".error-msg").forEach(el => el.textContent = ""); }

    function showAlert(message, type) {
      alertBox.textContent = message;
      alertBox.className = `alert show ${type}`;
      setTimeout(() => alertBox.classList.remove('show'), 3000);
    }

    function editAnimal(id) {
      const a = animals.find(animal => animal.id_hewan === id);
      if (!a) return;
      document.getElementById("animalId").value = a.id_hewan;
      document.getElementById("customerId").value = a.id_customer;
      document.getElementById("animalName").value = a.nama;
      document.getElementById("birthDate").value = a.tanggal_lahir;
      document.getElementById("animalType").value = a.jenis_hewan;
      isEditing = true;
      window.scrollTo({ top: 0, behavior: "smooth" });
    }

    async function deleteAnimal(id) {
      const a = animals.find(animal => animal.id_hewan === id);
      if (!a || !confirm(`Yakin ingin menghapus data hewan "${a.nama}"?`)) return;

      try {
        const response = await fetch(`${API_BASE_URL}/hewans/${id}`, { method: 'DELETE' });
        if (!response.ok) throw new Error('Gagal menghapus data hewan');
        showAlert('Hewan berhasil dihapus!', 'success');
        await loadAnimals();
      } catch (error) {
        showAlert('Error: ' + error.message, 'error');
      }
    }

    loadAnimals();
  </script>
</body>
</html>
