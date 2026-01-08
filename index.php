<?php
session_start();

include "template/header.php";

// Default page
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$path = explode('/', $page);

// Halaman yang butuh login
$need_login = ['home', 'about', 'kontak', 'profil', 'user', 'list', 'tambah', 'ubah', 'hapus'];

// Jika belum login dan mengakses page private
if (!isset($_SESSION['is_login']) && in_array($path[0], $need_login)) {
    header("Location: index.php?page=login");
    exit;
}

// Routing folder user
if ($path[0] == "user") {
    $file = "user/" . ($path[1] ?? 'list') . ".php";

    if (file_exists($file)) {
        include $file;
    } else {
        echo "<h3>Halaman tidak ditemukan</h3>";
    }

} else {
    // Routing folder pages
    $file = "pages/" . $path[0] . ".php";
    if (file_exists($file)) {
        include $file;
    } else {
        echo "<h3>Halaman tidak ditemukan</h3>";
    }
}

// Footer hanya tampil kalau bukan login
if ($path[0] != 'login') {
    include "template/footer.php";
}
?>
