<?php
require_once "../includes/auth.php";
require_once "../config/database.php";
require_once "../includes/flash.php";

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

$page_title = "Kelola Produk";
$base = "../";
require_once "../includes/header.php";
show_flash();
?>
<section class="page-header">
    <div class="container">
        <h1>Kelola Produk</h1>
        <p>Manajemen katalog NUSAF LAME_ARANG.</p>
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
            <a href="tambah.php" class="btn btn-success">+ Tambah Produk</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!$produk): ?>
                    <tr>
                        <td colspan="5">Belum ada produk.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($produk as $item): ?>
                        <tr>
                            <td>
                                <img class="table-image"
                                     src="../uploads/produk/<?= htmlspecialchars($item["gambar"]) ?>"
                                     alt="<?= htmlspecialchars($item["nama"]) ?>">
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($item["nama"]) ?></strong><br>
                                <small class="muted"><?= htmlspecialchars($item["deskripsi"]) ?></small>
                            </td>
                            <td><?= htmlspecialchars($item["kategori"]) ?></td>
                            <td>Rp <?= number_format($item["harga"], 0, ",", ".") ?></td>
                            <td>
                                <div class="actions">
                                    <a class="btn" href="edit.php?id=<?= $item["id"] ?>">Edit</a>
                                    <a class="btn btn-danger"
                                       href="hapus.php?id=<?= $item["id"] ?>"
                                       onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php require_once "../includes/footer.php"; ?>
