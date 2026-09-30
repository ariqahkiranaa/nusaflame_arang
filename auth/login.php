<?php
session_start();

if (isset($_SESSION["admin_id"])) {
    header("Location: ../admin/index.php");
    exit;
}

$page_title = "Login Admin";
$base = "../";
require_once "../includes/header.php";
require_once "../includes/flash.php";
show_flash();
?>
<section class="login-page">
    <div class="login-box">
        <p class="kicker" style="color:#666;">NUSAF LAME_ARANG</p>
        <h1>Login Admin</h1>
        <p class="muted">Masuk untuk mengelola katalog produk.</p>

        <form action="proses_login.php" method="POST" style="margin-top:25px;">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button class="btn" type="submit">Login</button>
        </form>
    </div>
</section>
<?php require_once "../includes/footer.php"; ?>
