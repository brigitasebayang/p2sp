<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Produk - Kouvee Pet Shop</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #d97706;
      --primary-hover: #b45309;
      --secondary-color: #1f2937;
      --bg-light: #fef3c7;
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

    #productForm {
      background: var(--bg-dark);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      margin-bottom: 40px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    #productForm h2 {
      grid-column: 1 / -1;
      margin-bottom: 10px;
      color: var(--primary-color);
    }

    label { display: block; margin-bottom: 5px; font-weight: 600; }

    input[type="text"], input[type="number"], input[type="file"] {
      width: 100%;
      padding: 12px;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      font-size: 1rem;
    }

    input:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(217,119,6,0.2);
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
    tr:hover { background: #fef3c7; }

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
      <h1>Kelola Produk Kouvee Pet Shop</h1>
    </div>

    <div id="alertBox" class="alert"></div>

    <div class="search-container">
      <input type="text" id="searchInput" placeholder="Cari nama produk..." onkeyup="filterProducts()">
    </div>

    <!-- FORM -->
    <form id="productForm" novalidate>
      <h2>Form Produk</h2>
      <input type="hidden" id="productId">

      <div>
        <label for="productName">Nama Produk</label>
        <input type="text" id="productName" required placeholder="Contoh: Royal Canin Kitten 2Kg">
        <div class="error-msg" id="errorName"></div>
      </div>

      <div>
        <label for="productPrice">Harga (Rp)</label>
        <input type="number" id="productPrice" required min="1000" placeholder="Contoh: 185000">
        <div class="error-msg" id="errorPrice"></div>
      </div>

      <div>
        <label for="productStock">Stok</label>
        <input type="number" id="productStock" required min="1" placeholder="Contoh: 10">
        <div class="error-msg" id="errorStock"></div>
      </div>

      <div class="full-width">
        <label for="productImage">Upload Gambar</label>
        <input type="file" id="productImage" accept="image/*">
        <div class="error-msg" id="errorImage"></div>
      </div>

      <div class="full-width" style="text-align:right;">
        <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
      </div>
    </form>

    <!-- TABLE -->
    <table id="productTable">
      <thead>
        <tr>
          <th>ID</th><th>Nama Produk</th><th>Harga</th><th>Stok</th><th>Gambar</th><th>Aksi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <script>
    const API_BASE_URL = 'http://localhost:8000/api';
    let products = [];
    let filtered = [];
    let isEditing = false;
    let currentImageBase64 = "";

    const tbody = document.querySelector("#productTable tbody");
    const alertBox = document.getElementById("alertBox");

    async function loadProducts() {
      try {
        const response = await fetch(`${API_BASE_URL}/products`);
        if (!response.ok) throw new Error('Failed to load products');
        products = await response.json();
        filtered = [...products];
        renderProducts();
      } catch (error) {
        showAlert('Error loading products: ' + error.message, 'error');
        console.error('Error:', error);
      }
    }

    function renderProducts() {
      tbody.innerHTML = "";
      if (filtered.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;">Tidak ada produk ditemukan.</td></tr>`;
        return;
      }
      filtered.forEach(prod => {
        const row = document.createElement("tr");
        const imageHtml = prod.gambar ? `<img src="${prod.gambar}" width="60" height="60" style="object-fit:cover;border-radius:6px;">` : 'No Image';
        row.innerHTML = `
          <td>${prod.id_produk}</td>
          <td>${prod.nama}</td>
          <td>Rp ${parseInt(prod.harga).toLocaleString("id-ID")}</td>
          <td>${prod.stok}</td>
          <td>${imageHtml}</td>
          <td>
            <div class="actions">
              <button class="btn btn-edit" onclick="editProduct(${prod.id_produk})">Edit</button>
              <button class="btn btn-delete" onclick="deleteProduct(${prod.id_produk})">Hapus</button>
            </div>
          </td>`;
        tbody.appendChild(row);
      });
    }

    function filterProducts() {
      const keyword = document.getElementById("searchInput").value.toLowerCase();
      filtered = products.filter(p => p.nama.toLowerCase().includes(keyword));
      renderProducts();
    }

    document.getElementById("productForm").addEventListener("submit", async (e) => {
      e.preventDefault();

      const nameInput = document.getElementById("productName");
      const priceInput = document.getElementById("productPrice");
      const stockInput = document.getElementById("productStock");
      const imageInput = document.getElementById("productImage");

      let valid = true;
      clearErrors();

      if (nameInput.value.trim() === "") {
        showError("errorName", "Nama produk wajib diisi!");
        valid = false;
      }
      if (priceInput.value.trim() === "" || priceInput.value <= 0) {
        showError("errorPrice", "Harga harus diisi dan lebih dari 0!");
        valid = false;
      }
      if (stockInput.value.trim() === "" || stockInput.value <= 0) {
        showError("errorStock", "Stok harus diisi dan minimal 1!");
        valid = false;
      }

      const id = document.getElementById("productId").value;
      if (imageInput.files.length === 0 && !id) {
        showError("errorImage", "Silakan unggah gambar produk!");
        valid = false;
      }

      if (!valid) return;

      const submitBtn = document.getElementById("submitBtn");
      submitBtn.disabled = true;
      submitBtn.textContent = "Menyimpan...";

      try {
        let imageBase64 = currentImageBase64;
        if (imageInput.files.length > 0) {
          imageBase64 = await toBase64(imageInput.files[0]);
        }

        const payload = {
          nama: nameInput.value.trim(),
          harga: parseInt(priceInput.value),
          stok: parseInt(stockInput.value),
    
        };

        let response;
        if (id) {
          response = await fetch(`${API_BASE_URL}/products/${id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
          });
        } else {
          response = await fetch(`http://127.0.0.1:8000/api/products`, {
            method: 'POST',
            headers: { 'Accept': 'application/json',
              'Content-Type': 'application/json'
             },
            body: JSON.stringify(payload)
          });
        }

        if (!response.ok) throw new Error('Failed to save product');
        
        const result = await response.json();
        showAlert(id ? 'Produk berhasil diperbarui!' : 'Produk baru berhasil ditambahkan!', 'success');
        
        await loadProducts();
        e.target.reset();
        document.getElementById("productId").value = "";
        currentImageBase64 = "";
        isEditing = false;
      } catch (error) {
        showAlert('Error: ' + error.message, 'error');
      } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = "Simpan";
      }
    });

    function showError(id, message) {
      document.getElementById(id).textContent = message;
    }

    function clearErrors() {
      document.querySelectorAll(".error-msg").forEach(el => el.textContent = "");
    }

    function showAlert(message, type) {
      alertBox.textContent = message;
      alertBox.className = `alert show ${type}`;
      setTimeout(() => alertBox.classList.remove('show'), 3000);
    }

    function toBase64(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
      });
    }

    function editProduct(id) {
      const p = products.find(prod => prod.id_produk === id);
      if (!p) return;
      document.getElementById("productId").value = p.id_produk;
      document.getElementById("productName").value = p.nama;
      document.getElementById("productPrice").value = p.harga;
      document.getElementById("productStock").value = p.stok;
      currentImageBase64 = p.gambar || "";
      isEditing = true;
      window.scrollTo({ top: 0, behavior: "smooth" });
    }

    async function deleteProduct(id) {
      const p = products.find(prod => prod.id_produk === id);
      if (!p || !confirm(`Yakin ingin menghapus data produk "${p.nama}"?`)) return;

      try {
        const response = await fetch(`${API_BASE_URL}/products/${id}`, {
          method: 'DELETE'
        });
        if (!response.ok) throw new Error('Failed to delete product');
        
        showAlert('Produk berhasil dihapus!', 'success');
        await loadProducts();
      } catch (error) {
        showAlert('Error: ' + error.message, 'error');
      }
    }

    // Load products when page loads
    loadProducts();
  </script>
</body>
</html>
