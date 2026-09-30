<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page_title = $page_title ?? "NUSAF LAME_ARANG";
$base = $base ?? "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?> | NUSAF LAME_ARANG</title>
    <link rel="stylesheet" href="<?= $base ?>assets/style.css">
</head>
<body>
<header class="navbar">
    <div class="container nav-inner">
        <a class="brand" href="<?= $base ?>index.php">
            <span>NUSAF</span> LAME_ARANG
        </a>
        <nav>
            <a href="<?= $base ?>index.php">Home</a>
            <a href="<?= $base ?>produk.php">Produk</a>
            <a href="<?= $base ?>tentang.php">Tentang</a>
            <?php if (isset($_SESSION["admin_id"])): ?>
                <a href="<?= $base ?>admin/index.php">Admin</a>
                <a href="<?= $base ?>admin/logout.php" class="nav-button">Logout</a>
            <?php else: ?>
                <a href="<?= $base ?>auth/login.php" class="nav-button">Login</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main>
