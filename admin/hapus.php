<?php
require_once "../includes/auth.php";
require_once "../config/database.php";
require_once "../includes/flash.php";

$id = (int)($_GET["id"] ?? 0);

$stmt = $pdo->prepare("SELECT gambar FROM produk WHERE id = ?");
$stmt->execute([$id]);
$produk = $stmt->fetch();

if (!$produk) {
    set_flash("danger", "Produk tidak ditemukan.");
    header("Location: produk.php");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM produk WHERE id = ?");
$stmt->execute([$id]);

$gambar = basename($produk["gambar"]);
$file = __DIR__ . "/../uploads/produk/" . $gambar;

if (is_file($file)) {
    @unlink($file);
}

set_flash("success", "Produk berhasil dihapus.");
header("Location: produk.php");
exit;
?>
