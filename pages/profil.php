<?php
session_start();

if (!isset($_SESSION['is_login'])) {
    header("Location: index.php?page=login");
    exit;
}

$user = $_SESSION['user'];
?>

<h2>Profil <?= ucfirst($user['role']); ?></h2>

<p>Nama: <?= $user['nama']; ?></p>
<p>Email: <?= $user['email']; ?></p>
<p>No Telepon: <?= $user['no_telepon'] ?? '-'; ?></p>
<p>NIM: <?= $user['nim'] ?? '-'; ?></p>
<p>Prodi: <?= $user['prodi'] ?? '-'; ?></p>
<p>Alamat: <?= $user['alamat'] ?? '-'; ?></p>
