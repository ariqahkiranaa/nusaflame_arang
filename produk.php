<?php
require_once "config/database.php";

$keyword = trim($_GET["keyword"] ?? "");
$kategori = trim($_GET["kategori"] ?? "");

$sql = "SELECT * FROM produk WHERE 1=1";
$params = [];

if ($keyword !== "") {
    $sql .= " AND (nama LIKE ? OR deskripsi LIKE ?)";
    $params[] = "%$keyword%";
    $params[] = "%$keyword%";
}

if ($kategori !== "") {
    $sql .= " AND kategori = ?";
    $params[] = $kategori;
}

$sql .= " ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$produk = $stmt->fetchAll();

$kategoriList = $pdo->query("SELECT DISTINCT kategori FROM produk ORDER BY kategori")->fetchAll();

$page_title = "Produk";
$base = "";
require_once "includes/header.php";
?>
<section class="page-header">
    <div class="container">
        <h1>Produk</h1>
        <p>Temukan koleksi NUSAF LAME_ARANG.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="toolbar">
            <form class="search-form" method="GET">
                <input type="text" name="keyword" placeholder="Cari produk..." value="<?= htmlspecialchars($keyword) ?>">
                <select name="kategori">
                    <option value="">Semua kategori</option>
                    <?php foreach ($kategoriList as $kat): ?>
                        <option value="<?= htmlspecialchars($kat["kategori"]) ?>" <?= $kategori === $kat["kategori"] ? "selected" : "" ?>>
                            <?= htmlspecialchars($kat["kategori"]) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button class="btn" type="submit">Cari</button>
            </form>
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
                            <a class="btn" href="detail.php?id=<?= $item["id"] ?>">Detail</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty">Produk tidak ditemukan.</div>
        <?php endif; ?>
    </div>
</section>
<?php require_once "includes/footer.php"; ?>
