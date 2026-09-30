<?php
require_once '../config/database.php';
require_once '../includes/flash.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Ambil data user dari tabel users
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verifikasi: cocokkan dengan password_verify ATAU teks biasa
    if ($user && (password_verify($password, $user['password']) || $password === $user['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id']        = $user['id'];
        $_SESSION['admin_nama']      = $user['nama_lengkap'] ?? $user['username'];

        set_flash('success', 'Selamat datang, ' . htmlspecialchars($_SESSION['admin_nama']));
        header("Location: ../admin/index.php");
        exit;
    } else {
        set_flash('danger', 'Username atau password salah.');
        header("Location: login.php");
        exit;
    }
}

header("Location: login.php");
exit;
