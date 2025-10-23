<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Kouvee Pet Shop</title>
    <style>
        /* Variabel CSS (Menggunakan variabel dari file sebelumnya) */
        :root {
            --primary-color: #d97706; /* Emas/Jingga */
            --primary-hover: #b45309;
            --secondary-color: #1f2937; /* Biru Gelap/Hitam */
            --bg-light: #fef3c7; /* Latar Belakang sangat terang */
            --bg-dark: #ffffff;
            --border-color: #e5e7eb;
        }

        /* CSS yang sudah ada (disingkat) */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: var(--secondary-color);
            background: var(--bg-dark);
        }

        /* Navigation */
        .navbar {
            background: var(--bg-dark);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 64px;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--secondary-color);
            text-decoration: none;
        }

        .nav-brand svg {
            width: 32px;
            height: 32px;
            color: var(--primary-color);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: #4b5563;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            transition: color 0.3s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--primary-color);
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-secondary {
            background: var(--secondary-color);
            color: white;
        }

        .btn-secondary:hover {
            background: #111827;
        }

        .products-section {
            background: var(--bg-light); /* Latar belakang cerah */
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 2rem;
        }

        .search-bar {
            background: white;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        .search-input-wrapper {
            flex: 1;
            position: relative;
            min-width: 200px;
        }

        .search-input-wrapper input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
        }

        .search-input-wrapper input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        .sort-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sort-wrapper select {
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
        }

        .sort-wrapper select:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        /* Products Grid Styling (Menggunakan nama class layanan yang sudah ada) */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Sedikit lebih kecil untuk produk */
            gap: 1.5rem;
        }

        .service-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .service-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }

        .product-image-container {
            height: 200px;
            overflow: hidden;
            position: relative;
            background: #f7f7f7;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .service-info {
            padding: 1.5rem;
        }

        .service-name {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .service-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .product-stock {
            font-size: 0.9rem;
            color: #4b5563;
            margin-bottom: 1rem;
            font-weight: 500;
        }
        
        .stock-available {
            color: var(--success-color, #10b981);
        }

        .stock-low {
            color: var(--danger-color, #ef4444);
        }

        .card-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .btn-edit, .btn-delete {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: background 0.3s;
        }

        .btn-edit {
            background: #3b82f6; 
            color: white;
        }

        .btn-edit:hover {
            background: #2563eb;
        }

        .btn-delete {
            background: #ef4444; 
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        .hidden {
            display: none;
        }

        /* Modal Styling */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .modal-content h2 {
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            text-align: center;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: var(--secondary-color);
        }

        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }

        /* Footer styling kept the same */
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-brand">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="4" r="2"/>
                    <circle cx="18" cy="8" r="2"/>
                    <path d="M21 16v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/>
                    <path d="M11 6v10"/>
                    <path d="M8 12h6"/>
                </svg>
                Kouvee Pet Shop
            </a>
            
            <ul class="nav-links">
                <li><a href="#" onclick="showPage('home')">🏠 Home</a></li>
                <li><a href="#" class="active" onclick="showPage('products')">📦 Produk</a></li>
                <li><a href="#" onclick="showPage('services')">💼 Layanan</a></li>
                <li><a href="#" onclick="showPage('dashboard')">📊 Dashboard</a></li>
            </ul>

            <div class="nav-icons">
                <button>🛒</button>
                <button>👤</button>
            </div>
        </div>
    </nav>

    <div id="home-page" class="hidden"></div>
    <div id="services-page" class="hidden"></div>
    <div id="dashboard-page" class="hidden"></div>

    <div id="products-page" class="products-section">
        <div class="container">
            <h1 class="section-title">Kelola Produk Kouvee Pet Shop</h1>

            <div class="search-bar">
                <div class="search-input-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="searchProductInput" placeholder="Cari nama produk..." onkeyup="filterProducts()">
                </div>
                <div class="sort-wrapper">
                    <button class="btn btn-primary" onclick="openProductModal()">➕ Tambah Produk Baru</button>
                </div>
                <div class="sort-wrapper">
                    <span>↕️ Sortir: </span>
                    <select id="sortProductSelect" onchange="sortProducts()">
                        <option value="name-asc">Nama A-Z</option>
                        <option value="name-desc">Nama Z-A</option>
                        <option value="price-asc">Harga Termurah</option>
                        <option value="price-desc">Harga Termahal</option>
                        <option value="stock-asc">Stok Tersedikit</option>
                        <option value="stock-desc">Stok Terbanyak</option>
                    </select>
                </div>
            </div>

            <div class="services-grid" id="productsGrid">
                </div>
        </div>
    </div>
    
    <div id="productModal" class="modal hidden">
        <div class="modal-content">
            <h2 id="modalTitle">Tambah Produk Baru</h2>
            <form id="productForm">
                <input type="hidden" id="productId" value="">

                <div class="form-group">
                    <label for="productName">Nama Produk *</label>
                    <input type="text" id="productName" required placeholder="Contoh: Royal Canin Kitten 2Kg">
                </div>

                <div class="form-group">
                    <label for="productPrice">Harga (Rp) *</label>
                    <input type="number" id="productPrice" required min="1000" placeholder="Contoh: 185000">
                </div>
                
                <div class="form-group">
                    <label for="productStock">Stok *</label>
                    <input type="number" id="productStock" required min="0" placeholder="Contoh: 15">
                </div>

                <div class="form-group">
                    <label for="productImage">URL Gambar (Opsional)</label>
                    <input type="text" id="productImage" placeholder="Contoh: https://linkgambar.com/makanan.jpg">
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeProductModal()">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitButton">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>


    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                        <span style="font-size: 1.5rem;">🐾</span>
                        <h4>Kouvee Pet Shop</h4>
                    </div>
                    <p>Toko hewan terpercaya sejak 2023 di Yogyakarta</p>
                </div>
                <div>
                    <h4>Kontak</h4>
                    <p>📍 Yogyakarta, Indonesia</p>
                    <p>📞 (+62) 123-456</p>
                    <p>✉️ info@kouveepetshop.com</p>
                </div>
                <div>
                    <h4>Jam Operasional</h4>
                    <p>Senin - Sabtu: 09.00 - 20.00</p>
                    <p>Minggu: 10.00 - 18.00</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Kouvee Pet Shop. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Data Produk (Model)
        let products = [
            { id: 101, name: 'Royal Canin Kitten 2Kg', price: 185000, stock: 15, image_url: 'https://images.unsplash.com/photo-1628185852504-2b7e5e1e35d2?q=80&w=600&h=400&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
            { id: 102, name: 'Mainan Tikus Berbulu', price: 15000, stock: 4, image_url: 'https://images.unsplash.com/photo-1549410118-2495b6c936cc?q=80&w=600&h=400&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
            { id: 103, name: 'Sampo Anjing Anti Kutu 500ml', price: 55000, stock: 28, image_url: 'https://images.unsplash.com/photo-1627916692795-3507d9b9a4c5?q=80&w=600&h=400&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
            { id: 104, name: 'Tempat Minum Otomatis', price: 120000, stock: 0, image_url: 'https://images.unsplash.com/photo-1616782298288-51f618a80479?q=80&w=600&h=400&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' },
        ];

        let nextProductId = products.length > 0 ? Math.max(...products.map(s => s.id)) + 1 : 101;
        let filteredProducts = [...products];
        const defaultImageUrl = 'https://images.unsplash.com/photo-1583594916819-74d6f8303d32?q=80&w=600&h=400&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'; // Gambar placeholder

        // --- Navigasi Halaman (untuk simulasi) ---
        function showPage(pageId) {
            document.querySelectorAll('div[id$="-page"]').forEach(page => {
                page.classList.add('hidden');
            });
            document.getElementById(pageId + '-page').classList.remove('hidden');

            // Update active nav link
            document.querySelectorAll('.nav-links a').forEach(link => {
                link.classList.remove('active');
            });
            document.querySelector(`.nav-links a[onclick*="'${pageId}'"]`).classList.add('active');

            if (pageId === 'products') {
                renderProducts(); // Pastikan data produk di-refresh
            }
        }
        
        // --- READ: Render Products ---
        function renderProducts() {
            const grid = document.getElementById('productsGrid');
            grid.innerHTML = '';

            if (filteredProducts.length === 0) {
                grid.innerHTML = '<p style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: #4b5563;">Tidak ada produk yang ditemukan.</p>';
                return;
            }
            
            filteredProducts.forEach(product => {
                const stockClass = product.stock <= 5 && product.stock > 0 ? 'stock-low' : (product.stock > 5 ? 'stock-available' : 'stock-low');
                const stockText = product.stock > 0 ? `Stok: ${product.stock} unit` : '🚫 Stok Habis';
                const imageUrl = product.image_url && product.image_url.trim() !== '' ? product.image_url : defaultImageUrl;

                const card = `
                    <div class="service-card">
                        <div class="product-image-container">
                            <img src="${imageUrl}" alt="Gambar Produk ${product.name}" class="product-image" onerror="this.onerror=null; this.src='${defaultImageUrl}'">
                        </div>
                        <div class="service-info">
                            <h3 class="service-name" title="${product.name}">${product.name}</h3>
                            <p class="service-price">Rp ${product.price.toLocaleString('id-ID')}</p>
                            <p class="product-stock ${stockClass}">
                                ${stockText}
                            </p>
                            <div class="card-actions">
                                <button class="btn-edit" onclick="editProduct(${product.id})">✏️ Edit</button>
                                <button class="btn-delete" onclick="deleteProduct(${product.id})">🗑️ Hapus</button>
                            </div>
                        </div>
                    </div>
                `;
                grid.innerHTML += card;
            });
        }

        // --- CRUD Functionality ---

        // Open Modal (for Create or Update)
        function openProductModal(product = null) {
            const modal = document.getElementById('productModal');
            const form = document.getElementById('productForm');
            const modalTitle = document.getElementById('modalTitle');
            const submitButton = document.getElementById('submitButton');
            
            form.reset();
            document.getElementById('productId').value = '';

            if (product) {
                // UPDATE mode
                modalTitle.textContent = 'Edit Produk: ' + product.name;
                submitButton.textContent = 'Simpan Perubahan';
                document.getElementById('productId').value = product.id;
                document.getElementById('productName').value = product.name;
                document.getElementById('productPrice').value = product.price;
                document.getElementById('productStock').value = product.stock;
                document.getElementById('productImage').value = product.image_url;
            } else {
                // CREATE mode
                modalTitle.textContent = 'Tambah Produk Baru';
                submitButton.textContent = 'Tambah Produk';
            }
            
            modal.classList.remove('hidden');
        }

        // Close Modal
        function closeProductModal() {
            document.getElementById('productModal').classList.add('hidden');
        }

        // Handle Form Submission (Create or Update)
        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = document.getElementById('productId').value;
            const name = document.getElementById('productName').value.trim();
            const price = parseInt(document.getElementById('productPrice').value);
            const stock = parseInt(document.getElementById('productStock').value);
            const image_url = document.getElementById('productImage').value.trim();

            if (name === '' || isNaN(price) || isNaN(stock)) {
                alert('Nama, Harga, dan Stok wajib diisi dengan nilai yang benar!');
                return;
            }

            const newProductData = { name, price, stock, image_url };

            if (id) {
                // UPDATE (Edit)
                const index = products.findIndex(p => p.id == id);
                if (index !== -1) {
                    products[index] = { id: parseInt(id), ...newProductData };
                    alert(`Produk "${name}" berhasil diubah!`);
                }
            } else {
                // CREATE (Tambah)
                const newProduct = {
                    id: nextProductId++,
                    ...newProductData
                };
                products.push(newProduct);
                alert(`Produk "${name}" berhasil ditambahkan!`);
            }

            closeProductModal();
            // Re-render, filter, and sort the list
            filterProducts();
        });

        // EDIT (Bagian 1: Buka Modal)
        function editProduct(id) {
            const productToEdit = products.find(p => p.id === id);
            if (productToEdit) {
                openProductModal(productToEdit);
            }
        }

        // DELETE
        function deleteProduct(id) {
            const productToDelete = products.find(p => p.id === id);
            if (confirm(`Yakin ingin menghapus produk: "${productToDelete.name}"?`)) {
                products = products.filter(p => p.id !== id);
                alert(`Produk "${productToDelete.name}" berhasil dihapus.`);
                // Re-render, filter, and sort the list
                filterProducts();
            }
        }

        // Filter Products
        function filterProducts() {
            const searchValue = document.getElementById('searchProductInput').value.toLowerCase();
            filteredProducts = products.filter(product => 
                product.name.toLowerCase().includes(searchValue)
            );
            sortProducts(); // Panggil fungsi sort setelah filter
        }

        // Sort Products
        function sortProducts() {
            const sortValue = document.getElementById('sortProductSelect').value;
            
            filteredProducts.sort((a, b) => {
                switch(sortValue) {
                    case 'name-asc':
                        return a.name.localeCompare(b.name);
                    case 'name-desc':
                        return b.name.localeCompare(a.name);
                    case 'price-asc':
                        return a.price - b.price;
                    case 'price-desc':
                        return b.price - a.price;
                    case 'stock-asc':
                        return a.stock - b.stock;
                    case 'stock-desc':
                        return b.stock - a.stock;
                    default:
                        return 0;
                }
            });
            
            renderProducts();
        }


        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Tampilkan halaman produk secara default
            document.getElementById('products-page').classList.remove('hidden');
            filterProducts(); // Render awal dengan sort default
        });
    </script>
</body>
</html>