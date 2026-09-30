<?php
require_once "../includes/auth.php";
require_once "../config/database.php";
require_once "../includes/flash.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: produk.php");
    exit;
}

$aksi = $_POST["aksi"] ?? "";
$nama = trim($_POST["nama"] ?? "");
$kategori = trim($_POST["kategori"] ?? "");
$harga = (int)($_POST["harga"] ?? 0);
$deskripsi = trim($_POST["deskripsi"] ?? "");

if ($nama === "" || $kategori === "" || $harga < 0 || $deskripsi === "") {
    set_flash("danger", "Data produk belum lengkap.");
    header("Location: " . ($aksi === "edit" ? "edit.php?id=" . (int)($_POST["id"] ?? 0) : "tambah.php"));
    exit;
}

$uploadDir = __DIR__ . "/../uploads/produk/";
$allowed = ["jpg", "jpeg", "png", "webp"];

function upload_gambar($file, $uploadDir, $allowed) {
    if (!isset($file) || $file["error"] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if ($file["error"] !== UPLOAD_ERR_OK) {
        return false;
    }

    $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed, true)) {
        return false;
    }

    if ($file["size"] > 3 * 1024 * 1024) {
        return false;
    }

    $namaFile = uniqid("produk_", true) . "." . $ext;

    if (!move_uploaded_file($file["tmp_name"], $uploadDir . $namaFile)) {
        return false;
    }

    return $namaFile;
}

if ($aksi === "tambah") {
    $gambar = upload_gambar($_FILES["gambar"] ?? null, $uploadDir, $allowed);

    if (!$gambar) {
        set_flash("danger", "Gambar wajib diunggah dan harus JPG, JPEG, PNG, atau WEBP maksimal 3 MB.");
        header("Location: tambah.php");
        exit;
    }

    $stmt = $pdo->prepare(
        "INSERT INTO produk (nama, kategori, harga, deskripsi, gambar)
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->execute([$nama, $kategori, $harga, $deskripsi, $gambar]);

    set_flash("success", "Produk berhasil ditambahkan.");
    header("Location: produk.php");
    exit;
}

if ($aksi === "edit") {
    $id = (int)($_POST["id"] ?? 0);
    $gambarLama = basename($_POST["gambar_lama"] ?? "");

    $gambarBaru = upload_gambar($_FILES["gambar"] ?? null, $uploadDir, $allowed);

    if ($gambarBaru === false) {
        set_flash("danger", "Gambar baru tidak valid.");
        header("Location: edit.php?id=" . $id);
        exit;
    }

    $gambar = $gambarBaru ?: $gambarLama;

    $stmt = $pdo->prepare(
        "UPDATE produk
         SET nama = ?, kategori = ?, harga = ?, deskripsi = ?, gambar = ?
         WHERE id = ?"
    );
    $stmt->execute([$nama, $kategori, $harga, $deskripsi, $gambar, $id]);

    if ($gambarBaru && $gambarLama && $gambarBaru !== $gambarLama) {
        $oldFile = $uploadDir . $gambarLama;
        if (is_file($oldFile)) {
            @unlink($oldFile);
        }
    }

    set_flash("success", "Produk berhasil diperbarui.");
    header("Location: produk.php");
    exit;
}

set_flash("danger", "Aksi tidak dikenali.");
header("Location: produk.php");
exit;
?>
