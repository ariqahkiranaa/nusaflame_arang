<?php
require_once "../includes/auth.php";
require_once "../includes/flash.php";

$page_title = "Tambah Produk";
$base = "../";
require_once "../includes/header.php";
show_flash();
?>
<section class="page-header">
    <div class="container">
        <h1>Tambah Produk</h1>
        <p>Tambahkan produk baru ke katalog.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <form class="form-box" action="proses_produk.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="tambah">

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama" required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" required>
                    <option value="">Pilih kategori</option>
                    <option>Arang Ekspor</option>
                    <option>Arang Industri</option>
                    <option>Arang Lokal</option>
                    <option>Kayu Bakar</option>
                </select>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" min="0" required>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" required></textarea>
            </div>

            <div class="form-group">
                <label>Gambar Produk</label>
                <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp" required>
            </div>

            <button class="btn btn-success" type="submit">Simpan Produk</button>
            <a class="btn" href="produk.php">Batal</a>
        </form>
    </div>
</section>
<?php require_once "../includes/footer.php"; ?>
