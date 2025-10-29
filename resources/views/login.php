    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Kouvee Pet Shop</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
                background: #fef3c7; /* soft yellow */
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .login-container {
                background: white;
                padding: 3rem 2rem;
                border-radius: 1rem;
                box-shadow: 0 4px 15px rgba(0,0,0,0.15);
                width: 100%;
                max-width: 400px;
            }

            .login-container h1 {
                text-align: center;
                color: #1f2937; /* dark gray */
                margin-bottom: 2rem;
                font-size: 1.75rem;
            }

            .input-group {
                margin-bottom: 1.5rem;
            }

            .input-group label {
                display: block;
                margin-bottom: 0.5rem;
                color: #4b5563; /* gray */
                font-weight: 500;
            }

            .input-group input {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 1px solid #d1d5db;
                border-radius: 0.5rem;
                font-size: 1rem;
            }

            .input-group input:focus {
                outline: none;
                border-color: #d97706;
                box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.2);
            }

            .btn-login {
                width: 100%;
                padding: 0.75rem;
                background: #d97706;
                color: white;
                font-weight: 600;
                font-size: 1rem;
                border: none;
                border-radius: 0.5rem;
                cursor: pointer;
                transition: background 0.3s;
            }

            .btn-login:hover {
                background: #b45309;
            }

            .login-footer {
                text-align: center;
                margin-top: 1rem;
                color: #4b5563;
                font-size: 0.875rem;
            }

            .login-footer a {
                color: #d97706;
                text-decoration: none;
            }

            .login-footer a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>

        <div class="login-container">
            <h1>Login Kouvee Pet Shop</h1>
            <form id="loginForm">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
            
        </div>

        <script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault(); // mencegah form reload halaman

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    try {
        const response = await fetch('http://localhost:8000/api/auth/login', { // sesuaikan URL API
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ username, password })
        });

        const data = await response.json();

        if (response.ok) {
        alert('Login berhasil! Token: ' + data.token);
        // Simpan token ke localStorage supaya bisa dipakai untuk request selanjutnya
        localStorage.setItem('token', data.token);
        window.location.href = '/owner'; // redirect ke dashboard
    } else {
        alert('Login gagal: ' + (data.message || 'Username atau password salah'));
    }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat login. Silakan coba lagi.');
    }
});
</script>

    
    </body>
    </html>
