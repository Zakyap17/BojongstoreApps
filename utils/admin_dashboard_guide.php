<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BojongStore</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .container {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #667eea;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        h2 {
            color: #667eea;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        .section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }
        .step {
            margin: 15px 0;
            padding-left: 30px;
            position: relative;
        }
        .step::before {
            content: "▶";
            position: absolute;
            left: 0;
            color: #667eea;
            font-weight: bold;
        }
        .button-link {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin: 10px 5px 10px 0;
            transition: all 0.3s;
        }
        .button-link:hover {
            background: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .credentials {
            background: #e8f5e9;
            border: 2px solid #4caf50;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            font-family: 'Courier New', monospace;
        }
        .credentials strong {
            color: #2e7d32;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        .feature-card {
            background: #f0f4ff;
            border: 2px solid #667eea;
            padding: 20px;
            border-radius: 8px;
        }
        .feature-card h3 {
            color: #667eea;
            margin-top: 0;
        }
        .status {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            margin: 5px 0;
        }
        .status.success {
            background: #c8e6c9;
            color: #2e7d32;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #667eea;
            color: white;
        }
        code {
            background: #f5f5f5;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎋 Admin Dashboard - BojongStore</h1>
        
        <div class="section">
            <h2>✅ Status Admin Dashboard</h2>
            <p>
                <span class="status success">✓ Dashboard Created</span>
                <span class="status success">✓ Navbar Implemented</span>
                <span class="status success">✓ Admin Redirect Active</span>
                <span class="status success">✓ Sidebar Navigation</span>
                <span class="status success">✓ Database Tables Ready</span>
            </p>
        </div>

        <div class="section">
            <h2>🔐 Admin Login Credentials</h2>
            <div class="credentials">
                <strong>Email:</strong> admin@bojongstore.local<br>
                <strong>Password:</strong> Admin123!
            </div>
        </div>

        <div class="section">
            <h2>🚀 Cara Akses Admin Dashboard</h2>
            
            <div class="step">
                <strong>Step 1: Buka halaman login</strong><br>
                <a href="/login.php" class="button-link">🔐 Buka Login</a>
            </div>
            
            <div class="step">
                <strong>Step 2: Masukkan kredensial admin</strong>
                <ul>
                    <li>Email: <code>admin@bojongstore.local</code></li>
                    <li>Password: <code>Admin123!</code></li>
                </ul>
            </div>
            
            <div class="step">
                <strong>Step 3: Klik "Masuk"</strong>
            </div>
            
            <div class="step">
                <strong>Step 4: Anda akan otomatis dialihkan ke Admin Dashboard</strong><br>
                URL: <code>/admin/dashboard.php</code>
            </div>
        </div>

        <div class="section">
            <h2>📊 Dashboard Features</h2>
            
            <div class="feature-grid">
                <div class="feature-card">
                    <h3>📌 Sidebar Navigation</h3>
                    <ul>
                        <li>Dashboard</li>
                        <li>Produk</li>
                        <li>UMKM</li>
                        <li>Review</li>
                        <li>Konten</li>
                        <li>Bantuan Support</li>
                        <li>Keluar</li>
                    </ul>
                </div>

                <div class="feature-card">
                    <h3>🔍 Top Navbar</h3>
                    <ul>
                        <li>Search Bar</li>
                        <li>Notifications (🔔)</li>
                        <li>Settings (⚙️)</li>
                        <li>User Profile Menu</li>
                    </ul>
                </div>

                <div class="feature-card">
                    <h3>📈 Statistics Cards</h3>
                    <ul>
                        <li>Total Produk</li>
                        <li>UMKM BojongStore</li>
                        <li>Total Review</li>
                    </ul>
                </div>

                <div class="feature-card">
                    <h3>📝 Activity Section</h3>
                    <ul>
                        <li>Recent Activities</li>
                        <li>Timeline View</li>
                        <li>Action Items</li>
                        <li>Featured Content</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="section">
            <h2>🎨 Dashboard Design</h2>
            <table>
                <thead>
                    <tr>
                        <th>Element</th>
                        <th>Description</th>
                        <th>Style</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Sidebar</strong></td>
                        <td>Left navigation menu</td>
                        <td>White background, 260px width</td>
                    </tr>
                    <tr>
                        <td><strong>Navbar</strong></td>
                        <td>Top header bar</td>
                        <td>White, sticky, search + icons</td>
                    </tr>
                    <tr>
                        <td><strong>Stat Cards</strong></td>
                        <td>Dashboard metrics</td>
                        <td>White cards with colored icons</td>
                    </tr>
                    <tr>
                        <td><strong>Activity List</strong></td>
                        <td>Recent actions</td>
                        <td>List with icons and timestamps</td>
                    </tr>
                    <tr>
                        <td><strong>Featured Section</strong></td>
                        <td>Promotional area</td>
                        <td>Image with overlay text</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>🔑 Navigation Consistency</h2>
            <p>Navbar dan sidebar yang konsisten di setiap halaman admin:</p>
            <ul>
                <li>✓ Same navbar di semua admin pages</li>
                <li>✓ Same sidebar dengan menu items</li>
                <li>✓ Consistent styling dan colors</li>
                <li>✓ Hover effects dan active states</li>
                <li>✓ Search functionality tersedia</li>
                <li>✓ User profile dropdown menu</li>
                <li>✓ Logout button accessible</li>
            </ul>
        </div>

        <div class="section">
            <h2>📱 Responsive Design</h2>
            <ul>
                <li>✓ Desktop (1200px+): Full sidebar + content</li>
                <li>✓ Tablet (768px - 1200px): Adjusted grid</li>
                <li>✓ Mobile (< 768px): Hidden sidebar, full-width content</li>
                <li>✓ Search bar adapts to screen size</li>
                <li>✓ User menu collapsible on mobile</li>
            </ul>
        </div>

        <div class="section">
            <h2>🔄 Login Redirect Logic</h2>
            <p>Sistem otomatis menentukan halaman berdasarkan user role:</p>
            <table>
                <thead>
                    <tr>
                        <th>User Role</th>
                        <th>Redirect To</th>
                        <th>Page</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>admin</strong></td>
                        <td>Admin Dashboard</td>
                        <td><code>/admin/dashboard.php</code></td>
                    </tr>
                    <tr>
                        <td><strong>seller</strong></td>
                        <td>Home Page</td>
                        <td><code>/index.php</code></td>
                    </tr>
                    <tr>
                        <td><strong>user</strong></td>
                        <td>Home Page</td>
                        <td><code>/index.php</code></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>📂 File Structure</h2>
            <code style="display: block; padding: 15px; background: #f5f5f5; border-radius: 6px;">
BojongStore/<br>
├── login.php (dimodifikasi - redirect logic)<br>
├── admin/<br>
│   ├── dashboard.php (NEW - Admin dashboard)<br>
│   ├── navbar.php (NEW - Shared navbar)<br>
│   ├── produk.php (akan dibuat)<br>
│   ├── umkm.php (akan dibuat)<br>
│   ├── review.php (akan dibuat)<br>
│   ├── konten.php (akan dibuat)<br>
│   └── support.php (akan dibuat)<br>
└── includes/<br>
    ├── db.php (koneksi database)<br>
    ├── security.php (security functions)<br>
    └── header.php (header template)
            </code>
        </div>

        <div class="section">
            <h2>✨ Next Steps</h2>
            <ul>
                <li>☐ Create admin/produk.php - Manage products</li>
                <li>☐ Create admin/umkm.php - Manage UMKM</li>
                <li>☐ Create admin/review.php - Manage reviews</li>
                <li>☐ Create admin/konten.php - Manage content</li>
                <li>☐ Create admin/support.php - Support management</li>
                <li>☐ Add sample data to dashboard</li>
                <li>☐ Test all navigation links</li>
                <li>☐ Implement activity tracking</li>
            </ul>
        </div>

        <div class="section">
            <h2>🎯 Quick Links</h2>
            <div style="text-align: center; margin: 20px 0;">
                <a href="/login.php" class="button-link">🔐 Admin Login</a>
                <a href="/" class="button-link">🏠 Home</a>
                <a href="/sign_up_guide.php" class="button-link">📘 Sign Up Guide</a>
            </div>
        </div>

        <div style="text-align: center; margin-top: 40px; color: #666; font-size: 14px;">
            <p>✅ Admin Dashboard Ready to Use!</p>
            <p>© 2026 BojongStore - All Rights Reserved</p>
        </div>
    </div>
</body>
</html>
