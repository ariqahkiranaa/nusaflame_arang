<?php
require_once "../includes/auth.php";
require_once "../config/database.php";
require_once "../includes/flash.php";

$id = (int)($_GET["id"] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->execute([$id]);
$produk = $stmt->fetch();

if (!$produk) {
    set_flash("danger", "Produk tidak ditemukan.");
    header("Location: produk.php");
    exit;
}

$page_title = "Edit Produk";
$base = "../";
require_once "../includes/header.php";
show_flash();
?>
<section class="page-header">
    <div class="container">
        <h1>Edit Produk</h1>
        <p>Perbarui informasi produk.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <form class="form-box" action="proses_produk.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="aksi" value="edit">
            <input type="hidden" name="id" value="<?= $produk["id"] ?>">
            <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($produk["gambar"]) ?>">

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama" value="<?= htmlspecialchars($produk["nama"]) ?>" required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" required>
                    <?php
                    $kategori = ["Arang Ekspor", "Arang Lokal", "Arang Industri", "Kayu Bakar"];
                    foreach ($kategori as $kat):
                    ?>
                        <option value="<?= $kat ?>" <?= $produk["kategori"] === $kat ? "selected" : "" ?>>
                            <?= $kat ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" min="0" value="<?= $produk["harga"] ?>" required>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" required><?= htmlspecialchars($produk["deskripsi"]) ?></textarea>
            </div>

            <div class="form-group">
                <label>Gambar Sekarang</label><br>
                <img class="table-image" src="../uploads/produk/<?= htmlspecialchars($produk["gambar"]) ?>" alt="">
            </div>

            <div class="form-group">
                <label>Ganti Gambar (opsional)</label>
                <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp">
            </div>

            <button class="btn btn-success" type="submit">Simpan Perubahan</button>
            <a class="btn" href="produk.php">Batal</a>
        </form>
    </div>
</section>
<?php require_once "../includes/footer.php"; ?>
