<?php
session_start();

if (!isset($_SESSION['is_login'])) {
    header("Location: index.php?page=login");
    exit;
}
?>

<h2>Profil User</h2>
<p>Nama: <?= $_SESSION['user']['nama']; ?></p>
<p>Email: <?= $_SESSION['user']['email']; ?></p>
