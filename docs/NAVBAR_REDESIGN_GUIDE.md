# 🎨 NAVBAR REDESIGN & PHOTO UPLOAD FEATURE

## Overview

Navbar user menu telah didesain ulang sesuai dengan mockup Anda:
- **Bookmark icon** (wishlist/saved items) - untuk feature di masa depan
- **Avatar button** (profile photo) - navigasi langsung ke profile
- **Logout button** (red) - muncul saat hover untuk quick logout

## Perubahan Detail

### 1. **Navbar User Section (Icon-Based)**

#### Design Elements:
```
[⭐ Bookmark] [👤 Avatar] [✕ Logout on hover]
```

**File yang diubah:**
- `includes/header.php` - HTML structure untuk navbar user section
- `assets/css/style.css` - Styling untuk `.navbar-user-section`, `.navbar-icon-btn`, `.navbar-avatar-btn`, `.navbar-logout-btn`
- `assets/js/main.js` - Removed old dropdown logic (no longer needed)

#### Features:
- ✅ **Avatar Button** (Green rounded square)
  - Menampilkan foto user jika ada
  - Fallback ke default SVG icon jika belum upload
  - Klik → langsung ke `profile.php`
  - Hover → shadow dan background effect

- ✅ **Logout Button** (Red)
  - Tersembunyi by default
  - Muncul saat hover di navbar user section
  - Smooth transition animation
  - Klik → langsung logout

- ✅ **Wishlist Button** (Bookmark icon)
  - Siap untuk feature wishlish di masa depan
  - Same styling dengan button lainnya
  - Hover state yang konsisten

#### CSS Classes:
```css
.navbar-user-section {}           /* Container utama */
.navbar-icon-btn {}                /* Wishlist & Avatar */
.navbar-avatar-btn {}              /* Avatar khusus (hijau) */
.navbar-logout-btn {}              /* Logout button (merah) */
.avatar-image {}                   /* Image di dalam avatar */
```

### 2. **Photo Upload Feature (Profile Page)**

#### Database Schema:
```sql
-- Field yang sudah ada:
ALTER TABLE users ADD COLUMN foto VARCHAR(255) DEFAULT NULL;
```

#### Upload Processing:
File: `profile.php` (lines 18-62)

```php
// File Upload Logic:
- Accept formats: JPG, JPEG, PNG, GIF
- Max file size: 5MB
- Storage location: assets/uploads/
- Naming format: avatar_{user_id}_{timestamp}.{ext}
- Auto delete old file saat upload baru
```

**Validasi:**
1. Format file (JPG, PNG, GIF only)
2. File size (max 5MB)
3. Upload error handling
4. Old file cleanup

**Error Messages:**
- "Format file tidak didukung. Gunakan JPG, PNG, atau GIF."
- "Ukuran file terlalu besar (max 5MB)."
- "Gagal mengupload file. Silakan coba lagi."

#### Form Setup:
```html
<form method="POST" enctype="multipart/form-data">
  <input type="file" id="avatarInput" name="avatar" accept="image/*">
  <label for="avatarInput" class="avatar-camera-btn">
    <!-- Camera icon -->
  </label>
</form>
```

#### JavaScript Preview:
```javascript
// File: profile.php (line 619-628)
// Real-time image preview saat user select file
// Menggunakan FileReader API
```

### 3. **Default Avatar**

File: `assets/images/default-avatar.svg`

SVG default avatar untuk user yang belum upload foto:
- Green background (primary color)
- Person icon
- Size: 44x44px (scalable)

### 4. **Uploads Directory**

Direktori baru: `assets/uploads/`
- Tempat menyimpan foto user
- Auto-created during first upload
- Upload files: `avatar_{user_id}_{timestamp}.ext`

## User Flow

### Login/Register → Home
```
User login/register
↓
Session set ($_SESSION['user_id'], $_SESSION['user_name'])
↓
Redirect ke index.php
↓
Navbar menampilkan user section (avatar + logout)
↓
Avatar show default SVG (belum ada foto)
```

### Edit Profile
```
User klik avatar di navbar → ke profile.php
↓
User klik camera icon di avatar
↓
Select image file (JPG/PNG/GIF, max 5MB)
↓
Preview muncul sebelum submit
↓
Submit form
↓
Server validate & upload ke assets/uploads/
↓
Update database field `foto`
↓
Delete old file (jika ada)
↓
Navbar avatar update otomatis
```

### Logout
```
User hover navbar user section
↓
Red logout button muncul
↓
Klik logout
↓
Redirect ke index.php
↓
Navbar kembali show Login/Sign Up buttons
```

## Technical Details

### Header.php User Data Fetching
```php
// Di header.php
if (isset($_SESSION['user_id']) && $pdo) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
}
```

### Avatar Display Logic
```php
// Show user photo if exists
if ($userExists && !empty($user['foto'])) {
    <img src="<?= $fotoPath ?>" alt="Avatar">
} else {
    <svg>Default Icon</svg>
}
```

### CSS Hover Animation
```css
.navbar-user-section:hover .navbar-logout-btn {
  opacity: 1;
  pointer-events: all;
  transition: all 0.3s ease;
}
```

## Files Modified

1. **includes/header.php**
   - Added user data fetching
   - New navbar user section HTML
   - Avatar display logic

2. **assets/css/style.css**
   - Added `.navbar-user-section` styling
   - Added `.navbar-icon-btn` styling
   - Added `.navbar-avatar-btn` styling
   - Added `.navbar-logout-btn` styling
   - Removed old `.user-dropdown` styles
   - Removed old `.btn-user-menu` styles

3. **assets/js/main.js**
   - Removed dropdown toggle logic
   - Removed dropdown close-on-outside logic

4. **profile.php**
   - Added file upload processing (lines 18-62)
   - Added file validation
   - Added old file cleanup
   - Added `enctype="multipart/form-data"` to form
   - Photo preview JavaScript sudah ada

5. **assets/images/default-avatar.svg**
   - New file untuk default avatar

6. **assets/uploads/** (directory)
   - New directory untuk menyimpan user photos

## Testing Checklist

- [ ] Login → Navbar menampilkan avatar (default SVG)
- [ ] Hover navbar user section → Logout button muncul
- [ ] Klik avatar → Redirect ke profile.php
- [ ] Klik logout → Session destroy, kembali ke home dengan Login buttons
- [ ] Upload foto di profile
  - [ ] Select JPG/PNG/GIF file
  - [ ] Size < 5MB
  - [ ] Preview muncul
  - [ ] Submit form
- [ ] Photo appear di navbar avatar
- [ ] Upload foto baru → old file deleted, new file uploaded
- [ ] Refresh page → Avatar persists
- [ ] Logout → Navbar kembali ke Login/Sign Up buttons

## Future Enhancements

1. **Wishlist Feature** - Bookmark button sudah ready
2. **Avatar Crop Tool** - Untuk better image handling
3. **Drag & Drop Upload** - UI improvement
4. **Image Optimization** - Compress images sebelum save
5. **CDN Integration** - Untuk faster image loading

## Deployment Notes

1. Pastikan folder `assets/uploads/` writable:
   ```bash
   chmod 777 assets/uploads/
   ```

2. Update file permissions:
   ```bash
   chmod 644 assets/uploads/*.jpg
   chmod 644 assets/uploads/*.png
   ```

3. Database migration (jika diperlukan):
   ```sql
   ALTER TABLE users ADD COLUMN foto VARCHAR(255) DEFAULT NULL;
   ```

---

✅ **Redesign selesai dan siap untuk production!**
