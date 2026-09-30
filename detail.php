<?php
require_once "config/database.php";

$id = (int)($_GET["id"] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->execute([$id]);
$produk = $stmt->fetch();

if (!$produk) {
    http_response_code(404);
    $page_title = "Produk Tidak Ditemukan";
    $base = "";
    require_once "includes/header.php";
    ?>
    <section class="section">
        <div class="container">
            <div class="empty">
                <h2>Produk tidak ditemukan</h2>
                <p class="muted" style="margin:10px 0 20px;">Produk yang kamu cari tidak tersedia.</p>
                <a class="btn" href="produk.php">Kembali ke Produk</a>
            </div>
        </div>
    </section>
    <?php
    require_once "includes/footer.php";
    exit;
}

$page_title = $produk["nama"];
$base = "";
require_once "includes/header.php";
?>
<section class="detail">
    <div class="container detail-grid">
        <div>
            <img class="detail-image"
                 src="uploads/produk/<?= htmlspecialchars($produk["gambar"]) ?>"
                 alt="<?= htmlspecialchars($produk["nama"]) ?>">
        </div>

        <div class="detail-info">
            <span class="category"><?= htmlspecialchars($produk["kategori"]) ?></span>
            <h1><?= htmlspecialchars($produk["nama"]) ?></h1>
            <p class="price">Rp <?= number_format($produk["harga"], 0, ",", ".") ?></p>
            <p style="color:#555; margin-bottom:25px;">
                <?= nl2br(htmlspecialchars($produk["deskripsi"])) ?>
            </p>
            <a class="btn" href="produk.php">← Kembali ke Produk</a>
        </div>
    </div>
</section>
<?php require_once "includes/footer.php"; ?>
