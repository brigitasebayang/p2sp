<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kouvee Pet Shop - Home</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: #1f2937;
            background: #ffffff;
        }

        /* Navigation */
        .navbar {
            background: #ffffff;
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
            color: #1f2937;
            text-decoration: none;
        }

        .nav-brand svg {
            width: 32px;
            height: 32px;
            color: #d97706;
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
            color: #d97706;
        }

        .nav-icons {
            display: flex;
            gap: 1rem;
        }

        .nav-icons button {
            background: none;
            border: none;
            color: #4b5563;
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.3s;
        }

        .nav-icons button:hover {
            color: #d97706;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(to bottom, #fef3c7, #ffffff);
            padding: 5rem 1rem;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.25rem;
            color: #4b5563;
            margin-bottom: 2rem;
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
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
            background: #d97706;
            color: white;
        }

        .btn-primary:hover {
            background: #b45309;
        }

        .btn-secondary {
            background: #1f2937;
            color: white;
        }

        .btn-secondary:hover {
            background: #111827;
        }

        /* Features Section */
        .features {
            max-width: 1280px;
            margin: 0 auto;
            padding: 4rem 1rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #1f2937;
        }

        .feature-card p {
            color: #4b5563;
        }

        /* Stats Section */
        .stats {
            background: #1f2937;
            color: white;
            padding: 4rem 1rem;
        }

        .stats-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #fbbf24;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #d1d5db;
        }

        /* Products Section */
        .products-section {
            background: #fef3c7;
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
            color: #1f2937;
            margin-bottom: 2rem;
        }

        /* Search and Sort */
        .search-bar {
            background: white;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .search-input-wrapper {
            flex: 1;
            position: relative;
            min-width: 250px;
        }

        .search-input-wrapper input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
        }

        .search-input-wrapper input:focus {
            outline: none;
            border-color: #d97706;
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
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
        }

        .sort-wrapper select:focus {
            outline: none;
            border-color: #d97706;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .product-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        .product-image {
            height: 200px;
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }

        .product-info {
            padding: 1.5rem;
        }

        .product-category {
            font-size: 0.875rem;
            color: #d97706;
            margin-bottom: 0.25rem;
        }

        .product-name {
            font-size: 1.25rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .product-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
        }

        .product-stock {
            font-size: 0.875rem;
            color: #4b5563;
        }

        .add-to-cart {
            width: 100%;
            padding: 0.75rem;
            background: #d97706;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }

        .add-to-cart:hover {
            background: #b45309;
        }

        /* Footer */
        .footer {
            background: #1f2937;
            color: white;
            padding: 2rem 1rem;
        }

        .footer-container {
            max-width: 1280px;
            margin: 0 auto;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer h4 {
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .footer p {
            color: #9ca3af;
            margin-bottom: 0.5rem;
        }

        .footer-bottom {
            border-top: 1px solid #374151;
            padding-top: 2rem;
            text-align: center;
            color: #9ca3af;
        }

        .hidden {
            display: none;
        }

        /* SVG Icons */
        svg {
            width: 20px;
            height: 20px;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .nav-links {
                display: none;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
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
    <li><a href="#" class="active" onclick="showPage('home')">🏠 Home</a></li>
    <li><a href="#" onclick="showPage('products')">📦 Produk</a></li>
    <li><a href="#" onclick="showPage('services')">💼 layanan</a></li>
    <li><a href="#" onclick="showPage('dashboard')">📊 Dashboard</a></li>
    
</ul>


            <div class="nav-icons">
                <button>🛒</button>
                <button>👤</button>
            </div>
        </div>
    </nav>

    <!-- Home Page -->
    <div id="home-page">
        <!-- Hero Section -->
        <section class="hero">
            <h1>Selamat Datang di Kouvee Pet Shop</h1>
            <p>Toko hewan terpercaya sejak 2023 di Yogyakarta</p>
            <div class="hero-buttons">
                <button class="btn btn-primary" onclick="showPage('products')">Lihat Produk</button>
                <button class="btn btn-secondary" onclick="showPage('services')">Lihat Layanan</button>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🐕</div>
                    <h3>Produk Berkualitas</h3>
                    <p>Berbagai produk makanan, aksesoris, dan perlengkapan hewan kesayangan</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">✂️</div>
                    <h3>Layanan Grooming</h3>
                    <p>Perawatan profesional untuk hewan kesayangan Anda</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🏠</div>
                    <h3>Penitipan Hewan</h3>
                    <p>Tempat aman dan nyaman untuk hewan peliharaan Anda</p>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats">
            <div class="stats-container">
                <div class="stats-grid">
                    <div>
                        <div class="stat-number">2+</div>
                        <div class="stat-label">Tahun Berpengalaman</div>
                    </div>
                    <div>
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Konsumen Tetap</div>
                    </div>
                    <div>
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Tim Profesional</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Products Page -->
    <div id="products-page" class="products-section hidden">
        <div class="container">
            <h1 class="section-title">Katalog Produk</h1>
            
            <!-- Search and Sort -->
            <div class="search-bar">
                <div class="search-input-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="searchInput" placeholder="Cari produk..." onkeyup="filterProducts()">
                </div>
                <div class="sort-wrapper">
                    <span>↕️</span>
                    <select id="sortSelect" onchange="sortProducts()">
                        <option value="name">Nama A-Z</option>
                        <option value="price-asc">Harga Terendah</option>
                        <option value="price-desc">Harga Tertinggi</option>
                        <option value="stock-asc">Stok Terendah</option>
                        <option value="stock-desc">Stok Tertinggi</option>
                    </select>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="products-grid" id="productsGrid">
                <!-- Products will be rendered here by JavaScript -->
            </div>
        </div>
    </div>

   <!-- Services Page -->
<div id="services-page" class="services-section hidden">
    <div class="container">
        <h1 class="section-title">Daftar Layanan</h1>

        <!-- Search and Sort -->
        <div class="search-bar">
            <div class="search-input-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" id="searchServiceInput" placeholder="Cari layanan..." onkeyup="filterServices()">
            </div>
            <div class="sort-wrapper">
                <span>↕️</span>
                <select id="sortServiceSelect" onchange="sortServices()">
                    <option value="name">Nama A-Z</option>
                    <option value="price-asc">Harga Terendah</option>
                    <option value="price-desc">Harga Tertinggi</option>
                    <option value="duration-asc">Durasi Terpendek</option>
                    <option value="duration-desc">Durasi Terlama</option>
                </select>
            </div>
        </div>

        <!-- Services Grid -->
        <div class="services-grid" id="servicesGrid">
            <!-- Layanan akan dimunculkan oleh JavaScript -->
        </div>
    </div>
</div>


    <!-- Dashboard Page -->
    <div id="dashboard-page" class="products-section hidden" style="background: #f9fafb;">
        <div class="container">
            <h1 class="section-title">Dashboard Owner</h1>
            
            <!-- Stats Cards -->
            <div class="features-grid" style="margin-bottom: 2rem;">
                <div class="feature-card" style="text-align: left;">
                    <p style="color: #4b5563; margin-bottom: 0.5rem;">Pendapatan Hari Ini</p>
                    <div style="font-size: 2rem; font-weight: bold; color: #1f2937;">Rp 2.5jt</div>
                    <p style="color: #10b981; margin-top: 0.5rem;">↑ 12% dari kemarin</p>
                </div>
                <div class="feature-card" style="text-align: left;">
                    <p style="color: #4b5563; margin-bottom: 0.5rem;">Pendapatan Bulan Ini</p>
                    <div style="font-size: 2rem; font-weight: bold; color: #1f2937;">Rp 45jt</div>
                    <p style="color: #10b981; margin-top: 0.5rem;">↑ 8% dari bulan lalu</p>
                </div>
                <div class="feature-card" style="text-align: left;">
                    <p style="color: #4b5563; margin-bottom: 0.5rem;">Total Transaksi</p>
                    <div style="font-size: 2rem; font-weight: bold; color: #1f2937;">156</div>
                    <p style="color: #3b82f6; margin-top: 0.5rem;">Bulan ini</p>
                </div>
            </div>

            <!-- Popular Items -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                <div class="feature-card" style="text-align: left;">
                    <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">Produk Terpopuler</h3>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                        <span>Royal Canin Dog Food</span>
                        <span style="color: #d97706; font-weight: bold;">45 terjual</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                        <span>Cat Litter Premium</span>
                        <span style="color: #d97706; font-weight: bold;">38 terjual</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Vitamin Kucing</span>
                        <span style="color: #d97706; font-weight: bold;">32 terjual</span>
                    </div>
                </div>
                <div class="feature-card" style="text-align: left;">
                    <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">Layanan Terpopuler</h3>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                        <span>Grooming Basic</span>
                        <span style="color: #d97706; font-weight: bold;">28 booking</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                        <span>Grooming Premium</span>
                        <span style="color: #d97706; font-weight: bold;">22 booking</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>Penitipan Harian</span>
                        <span style="color: #d97706; font-weight: bold;">18 booking</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="features-grid">
                <div class="feature-card" style="text-align: left; cursor: pointer;" onclick="window.location.href='/homeProduk'">
                    <div style="font-size: 2rem; color: #d97706; margin-bottom: 0.5rem;">📦</div>
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Kelola Produk</h3>
                    <p style="color: #4b5563; font-size: 0.875rem;">Tambah, edit, atau hapus produk</p>
                </div>
                <div class="feature-card" style="text-align: left; cursor: pointer;" onclick="window.location.href='/homeCustomer'">
                    <div style="font-size: 2rem; color: #d97706; margin-bottom: 0.5rem;">👥</div>
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Kelola Customer</h3>
                    <p style="color: #4b5563; font-size: 0.875rem;">Tambah, edit, atau hapus Customer</p>
                </div>
                <div class="feature-card" style="text-align: left; cursor: pointer;" onclick="window.location.href='/homePegawai'">
                    <div style="font-size: 2rem; color: #d97706; margin-bottom: 0.5rem;">👥</div>
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Kelola Pegawai</h3>
                    <p style="color: #4b5563; font-size: 0.875rem;">Manajemen data pegawai</p>
                </div>
                <div class="feature-card" style="text-align: left; cursor: pointer;">
                    <div style="font-size: 2rem; color: #d97706; margin-bottom: 0.5rem;">📊</div>
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Laporan Lengkap</h3>
                    <p style="color: #4b5563; font-size: 0.875rem;">Lihat & cetak laporan detail</p>
                </div>
                <div class="feature-card" style="text-align: left; cursor: pointer;" onclick="window.location.href='/homeLayanan'">
                    <div style="font-size: 2rem; color: #d97706; margin-bottom: 0.5rem;">!</div>
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Kelola layanan</h3>
                    <p style="color: #4b5563; font-size: 0.875rem;">ubah detail layanan disini </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
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
        
        const products = [
            { id: 1, name: 'Royal Canin Dog Food', category: 'Makanan', price: 250000, stock: 25, image: '🐕' },
            { id: 2, name: 'Cat Litter Premium', category: 'Perlengkapan', price: 85000, stock: 40, image: '🐱' },
            { id: 3, name: 'Pet Carrier Large', category: 'Aksesoris', price: 350000, stock: 15, image: '🎒' },
            { id: 4, name: 'Vitamin Kucing', category: 'Kesehatan', price: 125000, stock: 30, image: '💊' },
            { id: 5, name: 'Mainan Anjing', category: 'Aksesoris', price: 75000, stock: 50, image: '🎾' },
            { id: 6, name: 'Shampoo Anti Kutu', category: 'Perawatan', price: 95000, stock: 35, image: '🧴' },
        ];

        let filteredProducts = [...products];

        // Page Navigation
        function showPage(page) {
            document.getElementById('home-page').classList.add('hidden');
            document.getElementById('products-page').classList.add('hidden');
            document.getElementById('services-page').classList.add('hidden');
            document.getElementById('dashboard-page').classList.add('hidden');
            
            document.getElementById(page + '-page').classList.remove('hidden');
            
            // Update active nav link
            document.querySelectorAll('.nav-links a').forEach(link => {
                link.classList.remove('active');
            });
            
            if (page === 'products') {
                renderProducts();
            }
        }

        // Render Products
        function renderProducts() {
            const grid = document.getElementById('productsGrid');
            grid.innerHTML = '';
            
            filteredProducts.forEach(product => {
                const card = `
                    <div class="product-card">
                        <div class="product-image">${product.image}</div>
                        <div class="product-info">
                            <div class="product-category">${product.category}</div>
                            <h3 class="product-name">${product.name}</h3>
                            <div class="product-details">
                                <span class="product-price">Rp ${product.price.toLocaleString('id-ID')}</span>
                                <span class="product-stock">Stok: ${product.stock}</span>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(${product.id})">Tambah ke Keranjang</button>
                        </div>
                    </div>
                `;
                grid.innerHTML += card;
            });
        }

        // Filter Products
        function filterProducts() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            filteredProducts = products.filter(product => 
                product.name.toLowerCase().includes(searchValue)
            );
            sortProducts();
        }

        // Sort Products
        function sortProducts() {
            const sortValue = document.getElementById('sortSelect').value;
            
            filteredProducts.sort((a, b) => {
                switch(sortValue) {
                    case 'price-asc':
                        return a.price - b.price;
                    case 'price-desc':
                        return b.price - a.price;
                    case 'stock-asc':
                        return a.stock - b.stock;
                    case 'stock-desc':
                        return b.stock - a.stock;
                    default:
                        return a.name.localeCompare(b.name);
                }
            });
            
            renderProducts();
        }

        // Add to Cart
        function addToCart(productId) {
            const product = products.find(p => p.id === productId);
            alert(`${product.name} ditambahkan ke keranjang!`);
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderProducts();
        });
    </script>