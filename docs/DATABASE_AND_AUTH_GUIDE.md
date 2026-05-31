# 🚀 BojongStore - Database & Authentication Setup Guide

## ✅ Status: Database Created & Ready!

Database `bojongstore` has been successfully created with all necessary tables and sample users for testing.

---

## 📊 Database Setup Summary

### Database Information
- **Database Name**: `bojongstore`
- **Character Set**: UTF8MB4 (supports all Unicode characters)
- **Status**: ✅ Created and ready to use

### Table: users
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telepon VARCHAR(20),
    negara VARCHAR(100) DEFAULT 'Indonesia',
    password VARCHAR(255) NOT NULL,
    foto VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
```

---

## 🔐 Test Credentials

Three sample users have been pre-created for testing:

| No | Email | Password | Nama |
|----|-------|----------|------|
| 1 | `admin@bojongstore.test` | `admin123` | Admin Test |
| 2 | `user@bojongstore.test` | `user123` | User Test |
| 3 | `seller@bojongstore.test` | `seller123` | Seller Test |

---

## 🧪 How to Test

### Test 1: Login with Existing User
1. Go to: `http://localhost/BojongStore/login.php`
2. Enter email: `admin@bojongstore.test`
3. Enter password: `admin123`
4. Click "Masuk"
5. ✅ Should redirect to profile page showing user info

### Test 2: Register New User
1. Go to: `http://localhost/BojongStore/register.php`
2. Fill in form:
   - **Nama**: Your Name
   - **Email**: your.email@example.com
   - **No. Telepon**: 08123456789
   - **Password**: yourpassword123
   - **Konfirmasi Password**: yourpassword123
3. Click "Buat Akun"
4. ✅ Should redirect to profile page

### Test 3: Edit Profile
1. Login (use credentials above)
2. You'll be on profile page
3. Edit any field (nama, email, telepon, negara)
4. Optionally change password
5. Click "Edit Profile"
6. ✅ Should show success message and update displayed info

### Test 4: Logout
1. Click logout button (red exit icon in navbar)
2. ✅ Should redirect to homepage

### Test 5: Session Protection
1. Without logging in, try to access: `http://localhost/BojongStore/profile.php`
2. ✅ Should redirect to login page

---

## 🔧 Technical Improvements Made

### ✅ Enhanced Register Validation
- ✓ Validate all fields are filled
- ✓ Email format validation
- ✓ Password minimum 6 characters
- ✓ Password confirmation matching
- ✓ Phone number minimum 10 characters
- ✓ Duplicate email check

### ✅ Enhanced Login Validation
- ✓ Validate all fields are filled
- ✓ Email format validation
- ✓ Try-catch error handling
- ✓ Security: Check email existence before password verify

### ✅ Enhanced Profile Update
- ✓ Field validation
- ✓ Email duplicate check (excluding self)
- ✓ Password change optional and validated
- ✓ Session update when name changes
- ✓ Error handling with user feedback

### ✅ Database Improvements
- ✓ Updated timestamp on record update
- ✓ Proper collation for Indonesian characters
- ✓ Password stored as hashed (PASSWORD_DEFAULT)

---

## 📁 Files Modified/Created

| File | Status | Changes |
|------|--------|---------|
| `setup_database.php` | ✅ NEW | Database setup script with sample users |
| `login.php` | ✅ IMPROVED | Better validation and error handling |
| `register.php` | ✅ IMPROVED | Added password confirmation field + validation |
| `profile.php` | ✅ IMPROVED | Better profile update validation |
| `logout.php` | ✅ FIXED | Redirects to index.php (not login.php) |
| `includes/db.php` | ✅ OK | PDO connection working |

---

## 🛠️ Setup Files

### Option 1: Run Setup Script (Recommended)
```bash
php setup_database.php
```
This will:
1. Create database `bojongstore`
2. Create `users` table
3. Add 3 sample users for testing
4. Display confirmation message

### Option 2: Manual MySQL Import
```bash
mysql -u root < setup_db.sql
```

---

## 📝 Password Security

- ✅ Passwords hashed with `PASSWORD_DEFAULT` (bcrypt)
- ✅ Never stored in plaintext
- ✅ Verified with `password_verify()` function
- ✅ Minimum 6 characters enforced
- ✅ Password confirmation on register

---

## ⚠️ Important Notes

### For Development/Testing Only
The test credentials and sample users are for testing purposes:
- Change passwords in production
- Don't use test emails in production
- Update database credentials (currently root with no password)

### Security Recommendations for Production
1. **Change Database Password**:
   ```php
   // In includes/db.php
   $user = 'bojongstore_user';  // Don't use 'root'
   $pass = 'strong_password_here';
   ```

2. **Enable CSRF Protection**:
   Add CSRF tokens to forms

3. **Rate Limiting**:
   Limit login attempts to prevent brute force

4. **SSL/HTTPS**:
   Use HTTPS in production

5. **Input Sanitization**:
   Already using `trim()` and prepared statements

6. **Update Session Timeout**:
   ```php
   ini_set('session.gc_maxlifetime', 1800); // 30 minutes
   ```

---

## 🔍 Troubleshooting

### "Database Connection Failed"
- **Check**: Is MySQL running? (start XAMPP MySQL service)
- **Check**: Database exists? Run `setup_database.php`
- **Check**: Credentials correct in `includes/db.php`

### "Email already registered"
- **Solution**: Use different email or login with existing user

### "Password does not match"
- **Check**: Ensure password and confirmation match exactly
- **Check**: Password is minimum 6 characters

### "Cannot access profile without login"
- **Solution**: Login first or register a new account

---

## 📞 Files Available for Testing

1. **setup_database.php** - Run once to setup everything
2. **test_db.php** - Quick connection test
3. **phpinfo_check.php** - Check PHP configuration

---

## ✨ Next Features You Can Add

1. **Email Verification**: Send confirmation email on register
2. **Password Reset**: "Forgot Password" functionality
3. **Profile Picture Upload**: Image upload and storage
4. **Two-Factor Authentication**: Additional security layer
5. **Social Login**: Google, Facebook login integration
6. **Role-Based Access**: Admin, seller, buyer roles

---

## 📞 Support

For issues or questions about the setup:
1. Check the error message displayed
2. Review the Troubleshooting section
3. Check browser console for JavaScript errors
4. Review server logs for PHP errors

---

**Setup Date**: May 1, 2026
**Status**: ✅ Ready for Testing
**Database**: bojongstore (3 test users ready)
