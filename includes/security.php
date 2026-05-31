<?php
/**
 * BojongStore - Security Helper Functions
 * Provides CSRF protection, input validation, and security utilities
 */

if (!defined('BOJONG_SECURITY_LOADED')) {
    define('BOJONG_SECURITY_LOADED', true);
    
    /**
     * Generate and store CSRF token
     */
    function generateCSRFToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    /**
     * Verify CSRF token from form submission
     */
    function verifyCSRFToken($token) {
        if (empty($_SESSION['csrf_token'])) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token ?? '');
    }
    
    /**
     * Sanitize input with proper escaping
     */
    function sanitizeInput($input, $type = 'text') {
        $input = is_array($input) ? array_map('sanitizeInput', $input) : trim($input);
        
        switch ($type) {
            case 'email':
                return filter_var($input, FILTER_SANITIZE_EMAIL);
            case 'url':
                return filter_var($input, FILTER_SANITIZE_URL);
            case 'number':
                return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
            case 'html':
                return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
            default:
                return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        }
    }
    
    /**
     * Validate email format
     */
    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    /**
     * Validate password strength
     */
    function validatePassword($password) {
        if (strlen($password) < 6) {
            return 'Password minimal 6 karakter.';
        }
        return null;
    }
    
    /**
     * Validate phone number (Indonesia format)
     */
    function validatePhoneNumber($phone) {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($phone) < 10 || strlen($phone) > 15) {
            return 'Nomor telepon tidak valid.';
        }
        return null;
    }
    
    /**
     * Rate limiting - prevent brute force attacks
     */
    function checkRateLimit($key, $maxAttempts = 5, $windowSeconds = 300) {
        $sessionKey = 'rate_limit_' . $key;
        $now = time();
        
        if (!isset($_SESSION[$sessionKey])) {
            $_SESSION[$sessionKey] = [];
        }
        
        // Remove old attempts outside window
        $_SESSION[$sessionKey] = array_filter(
            $_SESSION[$sessionKey],
            function($timestamp) use ($now, $windowSeconds) {
                return $timestamp > ($now - $windowSeconds);
            }
        );
        
        if (count($_SESSION[$sessionKey]) >= $maxAttempts) {
            return false;
        }
        
        $_SESSION[$sessionKey][] = $now;
        return true;
    }
    
    /**
     * Regenerate session ID for security
     */
    function regenerateSessionID() {
        if (function_exists('session_regenerate_id')) {
            session_regenerate_id(true);
        }
    }
    
    /**
     * Safe file upload handler
     */
    function handleFileUpload($fileInput, $userId, $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'], $maxSize = 5242880) {
        if (!isset($_FILES[$fileInput]) || $_FILES[$fileInput]['error'] === UPLOAD_ERR_NO_FILE) {
            return ['success' => false, 'error' => 'Tidak ada file yang dipilih'];
        }
        
        $file = $_FILES[$fileInput];
        
        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'Error saat upload file'];
        }
        
        // Validate file size
        if ($file['size'] > $maxSize) {
            return ['success' => false, 'error' => 'Ukuran file terlalu besar (max 5MB)'];
        }
        
        // Validate extension
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExtensions)) {
            return ['success' => false, 'error' => 'Format file tidak didukung'];
        }
        
        // Validate MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        $allowedMimes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif'
        ];
        
        if ($mimeType !== $allowedMimes[$ext]) {
            return ['success' => false, 'error' => 'File MIME type tidak valid'];
        }
        
        // Create upload directory if doesn't exist
        if (!is_dir('assets/uploads')) {
            mkdir('assets/uploads', 0755, true);
        }
        
        // Generate unique filename
        $newFilename = 'avatar_' . $userId . '_' . time() . '.' . $ext;
        $uploadPath = 'assets/uploads/' . $newFilename;
        
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return ['success' => true, 'path' => $uploadPath];
        }
        
        return ['success' => false, 'error' => 'Gagal menyimpan file'];
    }
    
    /**
     * Get error message with HTML escaping
     */
    function getErrorHTML($message) {
        return '<div style="background:#fdecea;color:#c0392b;border:1px solid #f5c6cb;border-radius:8px;padding:10px 14px;font-size:13px;margin-bottom:16px;">'
            . htmlspecialchars($message)
            . '</div>';
    }
    
    /**
     * Get success message with HTML escaping
     */
    function getSuccessHTML($message) {
        return '<div style="background:#d4edda;color:#155724;border:1px solid #c3e6cb;border-radius:8px;padding:10px 14px;font-size:13px;margin-bottom:16px;">'
            . htmlspecialchars($message)
            . '</div>';
    }
}
?>
