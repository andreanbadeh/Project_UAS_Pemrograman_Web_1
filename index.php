<?php
session_start();

include "template/header.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$path = explode('/', $page);

$need_login = ['home', 'about', 'kontak', 'profil', 'user', 'list', 'tambah', 'ubah', 'hapus'];

if (!isset($_SESSION['is_login']) && in_array($path[0], $need_login)) {
    header("Location: index.php?page=login");
    exit;
}

if ($path[0] == "user") {
    $file = "user/" . ($path[1] ?? 'list') . ".php";

    if (file_exists($file)) {
        include $file;
    } else {
        echo "<h3>Halaman tidak ditemukan</h3>";
    }

} else {
    $file = "pages/" . $path[0] . ".php";
    if (file_exists($file)) {
        include $file;
    } else {
        echo "<h3>Halaman tidak ditemukan</h3>";
    }
}

if ($path[0] != 'login') {
    include "template/footer.php";
}
?>
