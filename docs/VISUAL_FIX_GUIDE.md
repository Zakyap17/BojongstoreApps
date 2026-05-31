# 🎯 VISUAL GUIDE - How to Fix Database Connection Error

## The Error You See:
```
❌ Koneksi Database Gagal
could not find driver
```

---

## ✅ SOLUTION IN IMAGES & STEPS

### STEP 1: Open XAMPP Control Panel

```
Find this file:
  C:\xampp\xampp-control.exe

Double-click to open it
```

Expected window:
```
╔═══════════════════════════════════════════════╗
║        XAMPP Control Panel                    ║
╠═══════════════════════════════════════════════╣
║  Module     PID     Status      Action        ║
╟───────────────────────────────────────────────╢
║  Apache     ----    [red]       [Start]       ║
║  MySQL      ----    [red]       [Start]       ║
║  FTP        ----    [red]       [Start]       ║
╚═══════════════════════════════════════════════╝
```

---

### STEP 2: Start Apache & MySQL

```
1. Find "Apache" row
   └─ Click blue [Start] button
   └─ Wait 2-3 seconds
   └─ It should turn GREEN showing "Running"

2. Find "MySQL" row
   └─ Click blue [Start] button
   └─ Wait 2-3 seconds
   └─ It should turn GREEN showing "Running"

Result should look like:
╔═══════════════════════════════════════════════╗
║  Module     PID     Status      Action        ║
╟───────────────────────────────────────────────╢
║  Apache     1234    [GREEN]     [Stop]        ║
║  MySQL      5678    [GREEN]     [Stop]        ║
║  FTP        ----    [RED]       [Start]       ║
╚═══════════════════════════════════════════════╝

✅ Both should show GREEN and "Running"
```

---

### STEP 3: Open Command Prompt

```
Windows Key + R

Type:  cmd

Press: Enter
```

---

### STEP 4: Navigate to Project Folder

```
Type these commands:

cd C:\xampp\htdocs\BojongStore

Press: Enter
```

---

### STEP 5: Run Database Setup

```
Type:  php setup_database.php

Press: Enter

You should see:

✅ Connected to MySQL server
✅ Database 'bojongstore' created/verified
✅ Table 'users' created/verified
✅ Added test user: admin@bojongstore.test
✅ Database setup completed successfully!

🔐 Test Credentials:
   Email: admin@bojongstore.test
   Password: admin123
```

---

### STEP 6: Open Website in Browser

```
URL:  http://localhost/BojongStore/

Or:   http://localhost/BojongStore/login.php

Press: Enter
```

Expected:
```
✅ Website loads WITHOUT red error box
✅ See login page with form
✅ Form asks for: Email and Password
```

---

### STEP 7: Login

```
Fill the form:
  Email:    admin@bojongstore.test
  Password: admin123

Click: "Masuk" button

Expected:
✅ Redirects to profile page
✅ Shows your name: "Admin Test"
✅ Shows your email: "admin@bojongstore.test"
✅ Can edit profile
```

---

## 🆘 If It Still Doesn't Work

### Run Diagnostic Test

```
In Command Prompt, type:
  php diagnostic.php

Press: Enter

Look for:
  ✅ PDO Extension: Loaded
  ✅ PDO MySQL: Available
  ✅ Connected to MySQL at localhost:3306
  ✅ Connected to bojongstore database

If any show ❌, MySQL might not be running
(Go back to STEP 2)
```

---

## 📝 TROUBLESHOOTING FLOWCHART

```
                    ┌──────────────────────┐
                    │  Access BojongStore  │
                    └──────────┬───────────┘
                               │
                    ┌──────────▼───────────┐
                    │  See error message?  │
                    └──────────┬───────────┘
                           YES │
        ┌──────────────────────┘
        │
        ▼
   ┌────────────────────────┐
   │ MySQL running in XAMPP? │
   └────┬──────────────┬─────┘
        │ NO           │ YES
        │              │
        ▼              ▼
   ┌────────────┐  ┌────────────────────┐
   │ Start MySQL│  │ Run setup_database │
   │ (Step 2)   │  │ .php (Step 5)      │
   └────┬───────┘  └────────┬───────────┘
        │                   │
        └───────┬───────────┘
                ▼
        ┌────────────────────────┐
        │ Refresh page (F5)       │
        │ or visit again          │
        └────┬──────────────┬─────┘
             │ ERROR GONE   │ ERROR PERSISTS
             │              │
             ▼              ▼
        ┌────────┐     ┌──────────────────┐
        │ SUCCESS│     │ Clear browser    │
        │ ✅     │     │ cache (Ctrl+Sh.. │
        └────────┘     │ +Del) and retry  │
                       └──────┬───────────┘
                              ▼
                        ┌────────────┐
                        │ Try again   │
                        └────────────┘
```

---

## ✅ SUCCESS CHECKLIST

After following all steps, check:

```
1. [ ] XAMPP Control Panel shows Apache: GREEN
2. [ ] XAMPP Control Panel shows MySQL: GREEN
3. [ ] Ran: php setup_database.php (no errors)
4. [ ] Website URL: http://localhost/BojongStore/
5. [ ] No red error box showing
6. [ ] Login page visible
7. [ ] Can enter email and password
8. [ ] Can click "Masuk" button
9. [ ] Redirected to profile page
10. [ ] See user information displayed
```

If all checked ✅, then your database connection is working!

---

## 🎯 QUICK COMMAND REFERENCE

```bash
# Check PHP syntax
php -l includes/db.php

# Create database
php setup_database.php

# Test connection
php diagnostic.php

# Verify users
php verify_users.php

# Quick DB test
php test_db.php
```

---

## 💡 REMEMBER

```
ALWAYS DO THIS ORDER:

1️⃣  Start XAMPP MySQL
     └─ XAMPP Control Panel → Click Start (MySQL)

2️⃣  Run setup script
     └─ cmd → cd BojongStore → php setup_database.php

3️⃣  Access website
     └─ Browser → http://localhost/BojongStore/

4️⃣  Login
     └─ Use: admin@bojongstore.test / admin123
```

---

## 🚀 Expected Final Result

```
Homepage loads ✅
  ↓
Click "Log In" ✅
  ↓
See login form ✅
  ↓
Enter credentials ✅
  ↓
Click "Masuk" ✅
  ↓
Redirected to profile ✅
  ↓
See profile page ✅
  ↓
Can edit info ✅
  ↓
🎉 SUCCESS!
```

---

**This should fix your database connection error!**

If you follow all these steps and still have issues, let me know!
