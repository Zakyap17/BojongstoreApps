# 🔧 Database Connection Error - SOLUTION GUIDE

## ❌ Error Message
```
❌ Koneksi Database Gagal
could not find driver

Pastikan XAMPP MySQL sudah berjalan dan database bojongstore sudah dibuat.
```

## ✅ Solutions (Try in Order)

### Solution 1: Start MySQL in XAMPP (MOST COMMON)

**Step 1**: Open XAMPP Control Panel
- Location: `C:\xampp\xampp-control.exe`

**Step 2**: Find MySQL service
- Look for "MySQL" in the list
- Check the status (should show "Running" in green)

**Step 3**: If MySQL is NOT running:
- Click the "Start" button next to MySQL
- Wait for it to turn green and show "Running"

**Step 4**: Refresh your website
- Go back to browser
- Press F5 to refresh
- Try login again

---

### Solution 2: Check if MySQL Service Exists

If you don't see MySQL in XAMPP Control Panel:

**Option A**: Start MySQL from Command Line
```bash
# Run as Administrator
cd C:\xampp\mysql\bin
mysqld --console
```

**Option B**: Use MySQL Service
```bash
# Check if service exists
sc query MySQL80

# Start the service
net start MySQL80
```

---

### Solution 3: Reset Database & Reinstall

If MySQL is running but database still won't connect:

**Step 1**: Open Command Prompt as Administrator

**Step 2**: Run setup script
```bash
cd C:\xampp\htdocs\BojongStore
php setup_database.php
```

**Step 3**: Check output
```
✅ Connected to MySQL server
✅ Database 'bojongstore' created/verified
✅ Table 'users' created/verified
✅ Database setup completed successfully!
```

**Step 4**: Refresh your website

---

### Solution 4: Verify Connection with Diagnostic

**Step 1**: Run diagnostic script
```bash
cd C:\xampp\htdocs\BojongStore
php diagnostic.php
```

**Step 2**: Check output for:
```
✅ PDO Extension: Loaded
✅ PDO MySQL: Available
✅ Connected to MySQL
✅ Connected to bojongstore database
```

If any shows ❌, see the solutions below.

---

## 🔍 Detailed Troubleshooting

### Issue: "could not find driver"

**Cause**: PDO MySQL driver not loaded

**Fix**:
1. Edit `C:\xampp\php\php.ini`
2. Find line: `;extension=pdo_mysql`
3. Remove semicolon: `extension=pdo_mysql`
4. Save and restart Apache

### Issue: MySQL Port 3306 Already in Use

**Cause**: Another application using port 3306

**Fix**:
1. Change port in XAMPP (MySQL port config)
2. Or stop the other application
3. Or use: `netstat -ano | findstr :3306`

### Issue: MySQL Crashed or Won't Start

**Cause**: MySQL data corrupted

**Fix**:
1. Stop all XAMPP services
2. Delete: `C:\xampp\mysql\data\bojongstore` (optional)
3. Restart XAMPP
4. Run: `php setup_database.php`

### Issue: Access Denied (root user)

**Cause**: Password required but not set

**Fix**:
1. Edit `includes/db.php`
2. Change: `$pass = '';` to your MySQL password
3. Or set MySQL password to empty in XAMPP

---

## 🚀 Quick Checklist

Before accessing the website:

- [ ] XAMPP is installed
- [ ] XAMPP is running (double-click xampp-control.exe)
- [ ] Apache is "Running" (green)
- [ ] MySQL is "Running" (green)
- [ ] Database created (run setup_database.php)
- [ ] Browser URL is correct: http://localhost/BojongStore/

---

## 📝 Step-by-Step Setup (Fresh Start)

### 1. Start XAMPP
```
1. Open: C:\xampp\xampp-control.exe
2. Click "Start" for Apache
3. Click "Start" for MySQL
4. Wait for both to turn green
```

### 2. Create Database
```bash
# Open Command Prompt
cd C:\xampp\htdocs\BojongStore
php setup_database.php
```

Expected output:
```
✅ Connected to MySQL server
✅ Database 'bojongstore' created/verified
✅ Table 'users' created/verified
✅ Added test user: admin@bojongstore.test
✅ Database setup completed successfully!
```

### 3. Test Connection
```bash
php diagnostic.php
```

Expected output:
```
✅ PDO Extension: Loaded
✅ PDO MySQL: Available
✅ Connected to MySQL at localhost:3306
✅ Connected to bojongstore database
✅ Users table exists with 3 records
```

### 4. Access Website
```
Open browser: http://localhost/BojongStore/
Login with:
  Email: admin@bojongstore.test
  Password: admin123
```

---

## 📞 Support Scripts Available

| Script | Purpose |
|--------|---------|
| `setup_database.php` | Create database and users |
| `diagnostic.php` | Check connection and diagnose issues |
| `verify_users.php` | Verify users and passwords |
| `test_db.php` | Quick database test |
| `phpinfo_check.php` | Check PHP configuration |

---

## ✅ When It's Working

You should see:
- ✅ Homepage loads
- ✅ Login page accessible
- ✅ Register page accessible
- ✅ Can login with admin@bojongstore.test / admin123
- ✅ Profile page shows user info

---

## 🆘 Still Having Issues?

1. **Run diagnostic**: `php diagnostic.php`
2. **Check XAMPP Control Panel**: Is MySQL running?
3. **Run setup again**: `php setup_database.php`
4. **Clear browser cache**: Ctrl+Shift+Delete
5. **Restart computer**: Sometimes helps
6. **Restart XAMPP**: Stop all, then start again

---

## 📋 Database Connection Info

```
Host:     localhost (or 127.0.0.1)
Port:     3306
Database: bojongstore
User:     root
Password: (empty)
Charset:  utf8mb4
```

**File**: `C:\xampp\htdocs\BojongStore\includes\db.php`

If you need to change these values, edit the file above.

---

## ✨ Test Accounts

After setup, use these to login:

```
Account 1 (Admin):
Email: admin@bojongstore.test
Password: admin123

Account 2 (User):
Email: user@bojongstore.test
Password: user123

Account 3 (Seller):
Email: seller@bojongstore.test
Password: seller123
```

---

**Last Updated**: May 1, 2026
**Status**: Quick Reference Guide
