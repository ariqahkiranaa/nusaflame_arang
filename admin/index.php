<?php
require_once "../includes/auth.php";
require_once "../config/database.php";
require_once "../includes/flash.php";

$totalProduk = (int)$pdo->query("SELECT COUNT(*) FROM produk")->fetchColumn();
$totalKategori = (int)$pdo->query("SELECT COUNT(DISTINCT kategori) FROM produk")->fetchColumn();

$page_title = "Dashboard Admin";
$base = "../";
require_once "../includes/header.php";
show_flash();
?>
<section class="page-header">
    <div class="container">
        <h1>Dashboard Admin</h1>
        <p>Kelola katalog NUSAF LAME_ARANG.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="admin-grid">
            <div class="stat">
                <small>Total Produk</small>
                <strong><?= $totalProduk ?></strong>
            </div>
            <div class="stat">
                <small>Total Kategori</small>
                <strong><?= $totalKategori ?></strong>
            </div>
            <div class="stat">
                <small>Admin Login</small>
                <strong><?= htmlspecialchars($_SESSION["admin_username"] ?? "-") ?></strong>
            </div>
        </div>

        <div class="about-box">
            <h2>Manajemen Produk</h2>
            <p class="muted" style="margin:8px 0 20px;">
                Tambahkan, ubah, atau hapus produk NUSAF LAME_ARANG.
            </p>
            <a href="produk.php" class="btn">Kelola Produk</a>
            <a href="tambah.php" class="btn btn-success">+ Tambah Produk</a>
        </div>
    </div>
</section>
<?php require_once "../includes/footer.php"; ?>
