<?php
require_once "config/database.php";

$stmt = $pdo->query("SELECT * FROM produk ORDER BY id DESC LIMIT 6");
$produk = $stmt->fetchAll();

$page_title = "Home";
$base = "";
require_once "includes/header.php";
?>
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <p class="kicker">NUSAF LAME_ARANG</p>
            <h1>Dark <span> Soul Built to.</span><br>Burn.</h1>
            <p>
                Natural Energy, Global Quality
            </p>
            <a href="produk.php" class="btn btn-light">Lihat Produk</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Latest Collection</h2>
            <p>Produk pilihan dari NUSAF LAME_ARANG.</p>
        </div>

        <?php if ($produk): ?>
            <div class="products-grid">
                <?php foreach ($produk as $item): ?>
                    <article class="card">
                        <img class="product-image"
                             src="uploads/produk/<?= htmlspecialchars($item["gambar"]) ?>"
                             alt="<?= htmlspecialchars($item["nama"]) ?>">
                        <div class="card-body">
                            <span class="category"><?= htmlspecialchars($item["kategori"]) ?></span>
                            <h3><?= htmlspecialchars($item["nama"]) ?></h3>
                            <p class="price">Rp <?= number_format($item["harga"], 0, ",", ".") ?></p>
                            <a class="btn" href="detail.php?id=<?= $item["id"] ?>">Lihat Detail</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty">
                Belum ada produk. Silakan tambahkan produk melalui halaman admin.
            </div>
        <?php endif; ?>
    </div>
</section>
<?php require_once "includes/footer.php"; ?>
