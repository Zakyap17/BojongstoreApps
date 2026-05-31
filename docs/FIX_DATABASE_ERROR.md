# 🆘 DATABASE CONNECTION ERROR - COMPLETE SOLUTION

## Problem You're Seeing:
```
❌ Koneksi Database Gagal
could not find driver

Pastikan XAMPP MySQL sudah berjalan dan database bojongstore sudah dibuat.
```

---

## ✅ FIX IN 3 STEPS

### Step 1️⃣: Start MySQL in XAMPP

**Windows:**
1. Open: `C:\xampp\xampp-control.exe`
2. Click **"Start"** button next to **"MySQL"**
3. Wait for it to turn **GREEN** (shows "Running")
4. Also make sure **Apache** is running (green)

**Screenshot:**
```
XAMPP Control Panel
├─ Apache    [Start] (should be GREEN)
├─ MySQL     [Start] (should be GREEN) ← CLICK THIS
└─ Other services...
```

---

### Step 2️⃣: Create the Database

1. Open **Command Prompt** (or PowerShell)
2. Type these commands:

```bash
cd C:\xampp\htdocs\BojongStore
php setup_database.php
```

3. You should see:
```
✅ Connected to MySQL server
✅ Database 'bojongstore' created/verified
✅ Table 'users' created/verified
✅ Added test user: admin@bojongstore.test
✅ Database setup completed successfully!
```

If you see errors, go back to Step 1 and make sure MySQL is running.

---

### Step 3️⃣: Test the Website

1. Open your browser
2. Visit: **http://localhost/BojongStore/login.php**
3. Use these credentials:
   - Email: `admin@bojongstore.test`
   - Password: `admin123`
4. Click **"Masuk"**
5. ✅ You should see your profile page!

---

## 🆘 Still Seeing the Error?

### Check 1: Is MySQL Really Running?

**Windows Command Prompt:**
```bash
php diagnostic.php
```

If it shows:
```
✅ Connected to MySQL at localhost:3306
✅ Connected to bojongstore database
```
Then MySQL is working.

If it shows:
```
❌ Failed: Connection refused
```
Then **MySQL is NOT running**. Go back to Step 1.

---

### Check 2: Is the Database Created?

Run this in Command Prompt:
```bash
php verify_users.php
```

If it shows:
```
✅ Users in database:
   ID 1 | Name: Admin Test | Email: admin@bojongstore.test
   ID 2 | Name: User Test | Email: user@bojongstore.test
   ID 3 | Name: Seller Test | Email: seller@bojongstore.test
```

Then the database exists and is working.

---

### Check 3: Clear Browser Cache

Sometimes the browser caches the error page.

**Windows (Chrome/Firefox/Edge):**
1. Press: **Ctrl + Shift + Delete**
2. Select all time
3. Check "Cached images and files"
4. Click **"Clear data"**
5. Refresh page: **F5**

---

## 📋 Checklist Before Testing

Before you try to login, verify ALL of these:

- [ ] XAMPP is running (Control Panel open)
- [ ] Apache shows "Running" in GREEN
- [ ] MySQL shows "Running" in GREEN
- [ ] Ran `php setup_database.php` successfully
- [ ] Ran `php diagnostic.php` and it shows ✅
- [ ] Cleared browser cache (Ctrl+Shift+Delete)
- [ ] Refreshing page in browser (F5)

---

## 🎯 Quick Reference

### Command to Run Setup
```bash
cd C:\xampp\htdocs\BojongStore
php setup_database.php
```

### Command to Check Connection
```bash
php diagnostic.php
```

### URL to Access Website
```
http://localhost/BojongStore/
```

### Login Credentials
```
Email: admin@bojongstore.test
Password: admin123
```

---

## 🔍 Why This Happens

The error "could not find driver" means:
1. **MySQL is not running** (most common)
2. PHP can't reach the database server
3. Database not created yet

**Solution**: Always do this order:
1. Start XAMPP MySQL
2. Run setup_database.php
3. Access website

---

## 📁 Important Files

- `includes/db.php` - Database connection (✅ UPDATED with better error handling)
- `setup_database.php` - Create database
- `diagnostic.php` - Check connection
- `DATABASE_CONNECTION_TROUBLESHOOTING.md` - Detailed guide

---

## ✅ Expected Results After Fix

### After Starting MySQL + Running Setup:

```
✅ Website loads
✅ Login page accessible
✅ Can login with admin@bojongstore.test / admin123
✅ Profile page shows user information
✅ Can edit profile
✅ Can change password
✅ Can logout
```

---

## 🚀 FULL STEP-BY-STEP PROCESS

### 1. Open XAMPP Control Panel
```
C:\xampp\xampp-control.exe
```

### 2. Start Services
```
Click "Start" button for Apache → Wait for GREEN
Click "Start" button for MySQL → Wait for GREEN
```

### 3. Open Command Prompt
```
Windows Key + R
Type: cmd
Press Enter
```

### 4. Navigate to Project
```
cd C:\xampp\htdocs\BojongStore
```

### 5. Run Setup
```
php setup_database.php
```

### 6. Run Diagnostic (optional but recommended)
```
php diagnostic.php
```

### 7. Open Browser
```
http://localhost/BojongStore/
```

### 8. Login
```
Email: admin@bojongstore.test
Password: admin123
```

### 9. Enjoy!
```
✅ You should now see your profile page!
```

---

## 💡 Common Mistakes

❌ **MISTAKE**: Trying to access website before starting MySQL
✅ **FIX**: Always start MySQL first in XAMPP Control Panel

❌ **MISTAKE**: Not running setup_database.php
✅ **FIX**: Run `php setup_database.php` after starting MySQL

❌ **MISTAKE**: Browser showing cached error
✅ **FIX**: Clear cache (Ctrl+Shift+Delete) and refresh (F5)

❌ **MISTAKE**: Only starting Apache, not MySQL
✅ **FIX**: Start BOTH Apache and MySQL in XAMPP

---

## 📞 Quick Support

| Issue | Solution |
|-------|----------|
| MySQL not starting | Check if another app uses port 3306 |
| Setup.php fails | Make sure MySQL is running (step 1) |
| Still see error after setup | Clear cache and refresh browser |
| Can't access XAMPP Control Panel | Run as Administrator |
| Lost XAMPP window | Open C:\xampp\xampp-control.exe again |

---

## ✨ Success Indicators

You'll know it's working when:

1. ✅ Browser shows BojongStore homepage (no red error box)
2. ✅ Login page loads without error
3. ✅ Can enter email and password
4. ✅ Click "Masuk" redirects to profile page
5. ✅ Profile shows your user information
6. ✅ Can edit profile and see success message

---

## 🎉 Once It's Working

Now you can:
- ✅ Login and logout
- ✅ Register new accounts
- ✅ Edit your profile
- ✅ Change your password
- ✅ Browse products
- ✅ Search and filter
- ✅ Send contact form
- ✅ Use all features!

---

**Try these steps now!** If you still have issues after doing all of this, let me know what error you see and I'll help further.

Good luck! 🚀
