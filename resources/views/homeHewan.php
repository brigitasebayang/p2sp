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
      --bg-light: #ecfdf5;
      --bg-dark: #ffffff;
      --border-color: #e5e7eb;
      --danger-color: #ef4444;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg-light);
      color: #1f2937;
      line-height: 1.6;
      min-height: 100vh;
    }

    .container { max-width: 900px; margin: 40px auto; padding: 0 20px; }

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

    input[type="text"], input[type="date"] {
      width: 100%;
      padding: 12px;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      font-size: 1rem;
    }

    input:focus {
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
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Kelola Hewan</h1>
    </div>

    <div class="search-container">
      <input type="text" id="searchInput" placeholder="Cari nama hewan..." onkeyup="filterAnimals()">
    </div>

    <!-- FORM -->
    <form id="animalForm" novalidate>
      <h2>Form Data Hewan</h2>
      <input type="hidden" id="animalId">

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
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
      </div>
    </form>

    <!-- TABLE -->
    <table id="animalTable">
      <thead>
        <tr>
          <th>ID</th><th>Nama Hewan</th><th>Tanggal Lahir</th><th>Jenis Hewan</th><th>Aksi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <script>
    let animals = [];
    let nextId = 1;
    let filtered = [];

    const tbody = document.querySelector("#animalTable tbody");

    function renderAnimals() {
      tbody.innerHTML = "";
      if (filtered.length === 0) {
  tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;">Tidak ada produk ditemukan.</td></tr>`;
  return;
}
      filtered.forEach(a => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${a.id}</td>
          <td>${a.name}</td>
          <td>${a.birth}</td>
          <td>${a.type}</td>
          <td>
            <div class="actions">
              <button class="btn btn-edit" onclick="editAnimal(${a.id})">✏</button>
              <button class="btn btn-delete" onclick="deleteAnimal(${a.id})">🗑</button>
            </div>
          </td>`;
        tbody.appendChild(row);
      });
    }

    function filterAnimals() {
      const keyword = document.getElementById("searchInput").value.toLowerCase();
      filtered = animals.filter(a => a.name.toLowerCase().includes(keyword));
      renderAnimals();
    }

    document.getElementById("animalForm").addEventListener("submit", (e) => {
      e.preventDefault();
      clearErrors();

      const name = document.getElementById("animalName").value.trim();
      const birth = document.getElementById("birthDate").value;
      const type = document.getElementById("animalType").value.trim();
      const id = document.getElementById("animalId").value;

      let valid = true;

      if (name === "") { showError("errorName", "Nama hewan wajib diisi!"); valid = false; }
      if (birth === "") { showError("errorDate", "Tanggal lahir wajib diisi!"); valid = false; }
      if (type === "") { showError("errorType", "Jenis hewan wajib diisi!"); valid = false; }

      if (!valid) {
        alert("⚠ Mohon lengkapi semua data dengan benar!");
        return;
      }

      const animal = {
        id: id ? parseInt(id) : nextId++,
        name, birth, type
      };

      if (id) {
        const idx = animals.findIndex(a => a.id == id);
        animals[idx] = animal;
        alert("✅ Data hewan berhasil diperbarui!");
      } else {
        animals.push(animal);
        alert("✅ Hewan baru berhasil ditambahkan!");
      }

      filtered = [...animals];
      renderAnimals();
      e.target.reset();
      document.getElementById("animalId").value = "";
    });

    function showError(id, msg) {
      document.getElementById(id).textContent = msg;
    }

    function clearErrors() {
      document.querySelectorAll(".error-msg").forEach(el => el.textContent = "");
    }

    function editAnimal(id) {
      const a = animals.find(animal => animal.id === id);
      if (!a) return;
      document.getElementById("animalId").value = a.id;
      document.getElementById("animalName").value = a.name;
      document.getElementById("birthDate").value = a.birth;
      document.getElementById("animalType").value = a.type;
      window.scrollTo({ top: 0, behavior: "smooth" });
    }

     function deleteAnimal(id) {
      const a = animals.find(animal => animal.id === id);
      if (confirm(`Yakin ingin menghapus data hewan "${a.name}"?`)) {
        animals = animals.filter(animal => animal.id !== id);
        filtered = [...animals];
        renderAnimals();
      }
    }

    renderAnimals();
  </script>
</body>
</html>