<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function set_flash($type, $message) {
    $_SESSION["flash"] = [
        "type" => $type,
        "message" => $message
    ];
}

function show_flash() {
    if (!empty($_SESSION["flash"])) {
        $flash = $_SESSION["flash"];
        unset($_SESSION["flash"]);
        echo '<div class="alert alert-' . htmlspecialchars($flash["type"]) . '">'
            . htmlspecialchars($flash["message"]) . '</div>';
    }
}
?>
