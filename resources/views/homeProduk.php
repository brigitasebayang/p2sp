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
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Kelola Produk Kouvee Pet Shop</h1>
    </div>

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
        <input type="file" id="productImage" accept="image/*" required>
        <div class="error-msg" id="errorImage"></div>
      </div>

      <div class="full-width" style="text-align:right;">
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
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
    let products = [];
    let nextId = 1;
    let filtered = [];

    const tbody = document.querySelector("#productTable tbody");

    function renderProducts() {
      tbody.innerHTML = "";
      if (filtered.length === 0) {
  tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;">Tidak ada produk ditemukan.</td></tr>`;
  return;
}
      filtered.forEach(prod => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${prod.id}</td>
          <td>${prod.name}</td>
          <td>Rp ${prod.price.toLocaleString("id-ID")}</td>
          <td>${prod.stock}</td>
          <td><img src="${prod.image}" width="60" height="60" style="object-fit:cover;border-radius:6px;"></td>
          <td>
            <div class="actions">
              <button class="btn btn-edit" onclick="editProduct(${prod.id})">✏</button>
              <button class="btn btn-delete" onclick="deleteProduct(${prod.id})">🗑</button>
            </div>
          </td>`;
        tbody.appendChild(row);
      });
    }

    function filterProducts() {
      const keyword = document.getElementById("searchInput").value.toLowerCase();
      filtered = products.filter(p => p.name.toLowerCase().includes(keyword));
      renderProducts();
    }

    document.getElementById("productForm").addEventListener("submit", async (e) => {
      e.preventDefault();

      // ambil elemen input
      const nameInput = document.getElementById("productName");
      const priceInput = document.getElementById("productPrice");
      const stockInput = document.getElementById("productStock");
      const imageInput = document.getElementById("productImage");

      // validasi manual
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
      let imageBase64 = "";
      if (imageInput.files.length === 0 && !id) {
        showError("errorImage", "Silakan unggah gambar produk!");
        valid = false;
      }

      if (!valid) {
        alert("⚠ Mohon lengkapi semua data dengan benar sebelum menyimpan!");
        return;
      }

      // convert gambar ke base64
      if (imageInput.files.length > 0) {
        imageBase64 = await toBase64(imageInput.files[0]);
      } else if (id) {
        imageBase64 = products.find(p => p.id == id).image;
      }

      const product = {
        id: id ? parseInt(id) : nextId++,
        name: nameInput.value.trim(),
        price: parseInt(priceInput.value),
        stock: parseInt(stockInput.value),
        image: imageBase64
      };

      if (id) {
        const idx = products.findIndex(p => p.id == id);
        products[idx] = product;
        alert("✅ Produk berhasil diperbarui!");
      } else {
        products.push(product);
        alert("✅ Produk baru berhasil ditambahkan!");
      }

      filtered = [...products];
      renderProducts();
      e.target.reset();
      document.getElementById("productId").value = "";
      clearErrors();
    });

    function showError(id, message) {
      document.getElementById(id).textContent = message;
    }

    function clearErrors() {
      document.querySelectorAll(".error-msg").forEach(el => el.textContent = "");
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
      const p = products.find(prod => prod.id === id);
      if (!p) return;
      document.getElementById("productId").value = p.id;
      document.getElementById("productName").value = p.name;
      document.getElementById("productPrice").value = p.price;
      document.getElementById("productStock").value = p.stock;
      window.scrollTo({ top: 0, behavior: "smooth" });
    }

    function deleteProduct(id) {
      const p = products.find(prod => prod.id === id);
      if (confirm(`Yakin ingin menghapus data produk "${p.name}"?`)) {
        products = products.filter(prod => prod.id !== id);
        filtered = [...products];
        renderProducts();
      }
    }

    renderProducts();
  </script>
</body>
</html>