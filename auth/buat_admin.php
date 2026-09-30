<?php
session_start();
require_once "../config/database.php";

$message = "";
$type = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || strlen($password) < 6) {
        $message = "Username wajib diisi dan password minimal 6 karakter.";
        $type = "danger";
    } else {
        $check = $pdo->prepare("SELECT id FROM admin WHERE username = ?");
        $check->execute([$username]);

        if ($check->fetch()) {
            $message = "Username sudah digunakan.";
            $type = "danger";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hash]);
            $message = "Admin berhasil dibuat. Silakan login.";
            $type = "success";
        }
    }
}

$page_title = "Buat Admin";
$base = "../";
require_once "../includes/header.php";
?>
<section class="login-page">
    <div class="login-box">
        <p class="kicker" style="color:#666;">SETUP</p>
        <h1>Buat Admin</h1>
        <p class="muted">Gunakan halaman ini saat instalasi pertama.</p>

        <?php if ($message): ?>
            <div class="alert alert-<?= htmlspecialchars($type) ?>" style="width:100%;margin:20px 0;">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" style="margin-top:25px;">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" minlength="6" required>
            </div>

            <button class="btn" type="submit">Buat Admin</button>
            <a class="btn" href="login.php">Ke Login</a>
        </form>
    </div>
</section>
<?php require_once "../includes/footer.php"; ?>
