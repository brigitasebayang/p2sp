<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kouvee Pet Shop - Hewan</title>
    <style>
        /* CSS yang sudah ada (disingkat) */
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

        .search-bar {
            background: white;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: space-between; /* Agar elemen di dalamnya merata */
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

        /* Services Grid Styling */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
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
        
        .service-info {
            padding: 1.5rem;
        }

        .service-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .service-price {
            font-size: 1.25rem;
            font-weight: bold;
            color: #d97706;
            margin-bottom: 0.5rem;
        }
        
        .service-details {
            font-size: 0.9rem;
            color: #4b5563;
            margin-bottom: 1rem;
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
            background: #3b82f6; /* Biru untuk edit */
            color: white;
        }

        .btn-edit:hover {
            background: #2563eb;
        }

        .btn-delete {
            background: #ef4444; /* Merah untuk delete */
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        .hidden {
            display: none;
        }

        /* Modal Styling (for Add/Edit Form) */
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
            color: #d97706;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #1f2937;
        }

        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
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

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            .services-grid {
                grid-template-columns: 1fr;
            }
        }
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
                <li><a href="#" onclick="showPage('products')">📦 Produk</a></li>
                <li><a href="#" class="active" onclick="showPage('services')">💼 Layanan</a></li>
                <li><a href="#" onclick="showPage('dashboard')">📊 Dashboard</a></li>
            </ul>

            <div class="nav-icons">
                <button>🛒</button>
                <button>👤</button>
            </div>
        </div>
    </nav>

    <div id="home-page" class="hidden"></div>
    <div id="products-page" class="hidden"></div>
    <div id="dashboard-page" class="hidden"></div>

    <div id="services-page" class="products-section">
        <div class="container">
            <h1 class="section-title">Kelola Hewan Kouvee Pet Shop</h1>

            <div class="search-bar">
                <div class="search-input-wrapper">
                    <span class="search-icon">🔍</span>
                    <input type="text" id="searchServiceInput" placeholder="Cari nama layanan..." onkeyup="filterServices()">
                </div>
                <div class="sort-wrapper">
                    <button class="btn btn-primary" onclick="openServiceModal()">➕ Tambah Produk Baru</button>
                </div>
                <div class="sort-wrapper">
                    <span>↕️ Sortir: </span>
                    <select id="sortServiceSelect" onchange="sortServices()">
                        <option value="name-asc">Nama A-Z</option>
                        <option value="name-desc">Nama Z-A</option>
                        <option value="price-asc">Harga Termurah</option>
                        <option value="price-desc">Harga Termahal</option>
                    </select>
                </div>
            </div>

            <div class="services-grid" id="servicesGrid">
                </div>
        </div>
    </div>
    
    <div id="serviceModal" class="modal hidden">
        <div class="modal-content">
            <h2 id="modalTitle">Tambah ustomer Baru</h2>
            <form id="serviceForm">
                <input type="hidden" id="serviceId" value="">

                <div class="form-group">
                    <label for="serviceName">Nama Hewan</label>
                    <input type="text" id="serviceName" required>
                </div>

                <div class="form-group">
                    <label for="servicePrice">Tanggal Lahir</label>
                    <input type="number" id="servicePrice" required min="1000">
                </div>
                
                <div class="form-group">
                    <label for="serviceDuration">Jenis Hewan</label>
                    <input type="number" id="serviceDuration" required min="5">
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeServiceModal()">Batal</button>
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
        // Data Layanan (Model)
        let services = [
            { id: 1, name: 'Grooming Basic Kucing', price: 60000, duration: 45, description: 'Mandi, pengeringan, potong kuku, dan bersih telinga.' },
            { id: 2, name: 'Grooming Premium Anjing', price: 150000, duration: 90, description: 'Grooming lengkap + treatment anti kutu/jamur, parfume eksklusif.' },
            { id: 3, name: 'Penitipan Harian', price: 50000, duration: 1440, description: 'Perawatan dan pengawasan harian di lingkungan yang aman.' },
            { id: 4, name: 'Cukur Rambut (Non-Grooming)', price: 40000, duration: 30, description: 'Layanan cukur cepat tanpa proses mandi.' },
        ];

        let nextServiceId = services.length > 0 ? Math.max(...services.map(s => s.id)) + 1 : 1;
        let filteredServices = [...services];

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

            if (pageId === 'services') {
                renderServices(); // Pastikan data layanan di-refresh
            }
        }
        
        // --- READ: Render Services ---
        function renderServices() {
            const grid = document.getElementById('servicesGrid');
            grid.innerHTML = '';

            if (filteredServices.length === 0) {
                grid.innerHTML = '<p style="grid-column: 1 / -1; text-align: center; padding: 2rem; color: #4b5563;">Tidak ada layanan yang ditemukan.</p>';
                return;
            }
            
            filteredServices.forEach(service => {
                const card = `
                    <div class="service-card">
                        <div class="service-info">
                            <h3 class="service-name">${service.name}</h3>
                            <p class="service-price">Rp ${service.price.toLocaleString('id-ID')}</p>
                            <p class="service-details">Durasi: ${service.duration} Menit</p>
                            <p class="service-details">${service.description}</p>
                            <div class="card-actions">
                                <button class="btn-edit" onclick="editService(${service.id})">✏️ Edit</button>
                                <button class="btn-delete" onclick="deleteService(${service.id})">🗑️ Hapus</button>
                            </div>
                        </div>
                    </div>
                `;
                grid.innerHTML += card;
            });
        }

        // --- CRUD Functionality ---

        // Open Modal (for Create or Update)
        function openServiceModal(service = null) {
            const modal = document.getElementById('serviceModal');
            const form = document.getElementById('serviceForm');
            const modalTitle = document.getElementById('modalTitle');
            const submitButton = document.getElementById('submitButton');
            
            form.reset();
            document.getElementById('serviceId').value = '';

            if (service) {
                // UPDATE mode
                modalTitle.textContent = 'Edit Layanan: ' + service.name;
                submitButton.textContent = 'Simpan Perubahan';
                document.getElementById('serviceId').value = service.id;
                document.getElementById('serviceName').value = service.name;
                document.getElementById('servicePrice').value = service.price;
                document.getElementById('serviceDuration').value = service.duration;
                document.getElementById('serviceDescription').value = service.description;
            } else {
                // CREATE mode
                modalTitle.textContent = 'Tambah Layanan Baru';
                submitButton.textContent = 'Tambah Layanan';
            }
            
            modal.classList.remove('hidden');
        }

        // Close Modal
        function closeServiceModal() {
            document.getElementById('serviceModal').classList.add('hidden');
        }

        // Handle Form Submission (Create or Update)
        document.getElementById('serviceForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = document.getElementById('serviceId').value;
            const name = document.getElementById('serviceName').value;
            const price = parseInt(document.getElementById('servicePrice').value);
            const duration = parseInt(document.getElementById('serviceDuration').value);
            const description = document.getElementById('serviceDescription').value;

            if (id) {
                // UPDATE (Edit)
                const index = services.findIndex(s => s.id == id);
                if (index !== -1) {
                    services[index] = { id: parseInt(id), name, price, duration, description };
                    alert(`Layanan "${name}" berhasil diubah!`);
                }
            } else {
                // CREATE (Tambah)
                const newService = {
                    id: nextServiceId++,
                    name,
                    price,
                    duration,
                    description
                };
                services.push(newService);
                alert(`Layanan "${name}" berhasil ditambahkan!`);
            }

            closeServiceModal();
            // Re-render, filter, and sort the list
            filterServices();
        });

        // EDIT (Bagian 1: Buka Modal)
        function editService(id) {
            const serviceToEdit = services.find(s => s.id === id);
            if (serviceToEdit) {
                openServiceModal(serviceToEdit);
            }
        }

        // DELETE
        function deleteService(id) {
            const serviceToDelete = services.find(s => s.id === id);
            if (confirm(`Yakin ingin menghapus layanan: "${serviceToDelete.name}"?`)) {
                services = services.filter(s => s.id !== id);
                alert(`Layanan "${serviceToDelete.name}" berhasil dihapus.`);
                // Re-render, filter, and sort the list
                filterServices();
            }
        }

        // Filter Services
        function filterServices() {
            const searchValue = document.getElementById('searchServiceInput').value.toLowerCase();
            filteredServices = services.filter(service => 
                service.name.toLowerCase().includes(searchValue) ||
                service.description.toLowerCase().includes(searchValue)
            );
            sortServices(); // Panggil fungsi sort setelah filter
        }

        // Sort Services
        function sortServices() {
            const sortValue = document.getElementById('sortServiceSelect').value;
            
            filteredServices.sort((a, b) => {
                switch(sortValue) {
                    case 'name-asc':
                        return a.name.localeCompare(b.name);
                    case 'name-desc':
                        return b.name.localeCompare(a.name);
                    case 'price-asc':
                        return a.price - b.price;
                    case 'price-desc':
                        return b.price - a.price;
                    default:
                        return 0;
                }
            });
            
            renderServices();
        }


        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Tampilkan halaman layanan secara default
            showPage('services'); 
            filterServices(); // Render awal dengan sort default
        });
    </script>
</body>
</html>