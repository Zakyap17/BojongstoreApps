# 🎯 BojongStore - Quick Start Guide

## ⚡ Get Started in 3 Steps

### Step 1️⃣: Verify Database is Created
```bash
php setup_database.php
```
Expected output: "✅ Database setup completed successfully!"

### Step 2️⃣: Test Login
- URL: `http://localhost/BojongStore/login.php`
- Email: `admin@bojongstore.test`
- Password: `admin123`

### Step 3️⃣: Or Register New Account
- URL: `http://localhost/BojongStore/register.php`
- Fill form and submit
- Will be logged in automatically

---

## 🔑 Test Accounts Ready to Use

```
┌────────────────────────────────────────────┐
│ 1. Admin Account                           │
├────────────────────────────────────────────┤
│ Email: admin@bojongstore.test              │
│ Password: admin123                         │
└────────────────────────────────────────────┘

┌────────────────────────────────────────────┐
│ 2. Regular User                            │
├────────────────────────────────────────────┤
│ Email: user@bojongstore.test               │
│ Password: user123                          │
└────────────────────────────────────────────┘

┌────────────────────────────────────────────┐
│ 3. Seller Account                          │
├────────────────────────────────────────────┤
│ Email: seller@bojongstore.test             │
│ Password: seller123                        │
└────────────────────────────────────────────┘
```

---

## 🌐 Access Your Website

| Page | URL | Status |
|------|-----|--------|
| Homepage | http://localhost/BojongStore/ | ✅ Working |
| Products | http://localhost/BojongStore/produk.php | ✅ Working |
| Contact | http://localhost/BojongStore/kontak.php | ✅ Working |
| Login | http://localhost/BojongStore/login.php | ✅ Working |
| Register | http://localhost/BojongStore/register.php | ✅ Working |
| Profile | http://localhost/BojongStore/profile.php | ✅ Working (login required) |

---

## ✨ What's Working

### ✅ Authentication
- Login with email & password
- Register new account with validation
- Profile view and edit
- Password change
- Session management
- Logout

### ✅ Database
- User table with proper schema
- Password hashing (bcrypt)
- Auto timestamps
- Email uniqueness check

### ✅ Frontend
- Responsive design
- Form validation
- Error messages
- Success messages
- Protected pages

---

## 🔐 Features You Can Test

### 1. Login Flow
```
Visit Login Page 
  → Enter credentials 
    → Click "Masuk" 
      → Redirected to Profile
```

### 2. Register Flow
```
Visit Register Page 
  → Fill form 
    → Click "Buat Akun" 
      → Auto-login & redirect to Profile
```

### 3. Profile Edit
```
Login 
  → Click "Edit Profile" 
    → Change name/email/phone/country 
      → See success message
```

### 4. Password Change
```
Login 
  → In Profile page 
    → Enter new password 
      → Click Submit 
        → Password updated
```

### 5. Session Protection
```
Open new tab 
  → Visit /profile.php (without login) 
    → Redirected to Login
```

---

## 📝 Database Info

- **Database**: bojongstore
- **Table**: users
- **Charset**: UTF8MB4 (supports all languages)
- **Users**: 3 sample accounts
- **Password**: Stored hashed with bcrypt
- **Status**: ✅ Ready to use

---

## 🛠️ If You Need to Reset

To reset database and recreate from scratch:

```bash
# Option 1: Delete and recreate
php setup_database.php

# Option 2: Manual reset
# 1. Delete database via phpMyAdmin
# 2. Run setup_database.php
```

---

## 🚀 Next Steps

1. **Test all pages** - Click around, try register/login
2. **Test search** - Search for products in search bar
3. **Edit profile** - Change your user info
4. **Logout and login** - Verify session works
5. **Try invalid inputs** - See validation messages

---

## ❓ Common Issues & Fixes

| Issue | Solution |
|-------|----------|
| Database not found | Run `php setup_database.php` |
| Login fails | Check email/password are correct |
| Email already exists | Use different email or login |
| Password won't change | Minimum 6 characters required |
| Can't access profile | You must login first |
| MySQL not running | Start XAMPP MySQL service |

---

## 📞 Support Files

- `setup_database.php` - Database setup
- `test_db.php` - Test connection
- `phpinfo_check.php` - PHP info
- `DATABASE_AND_AUTH_GUIDE.md` - Full documentation
- `PERBAIKAN_DAN_ERROR_REPORT.md` - Fixes summary

---

**Everything is ready! Start testing now! 🎉**

Visit: `http://localhost/BojongStore/login.php`
