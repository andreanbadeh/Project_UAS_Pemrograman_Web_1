<?php
if (!isset($_SESSION)) session_start();
if ($_SESSION['role'] != "admin") {
    header("Location: index.php?page=user/list");
    exit;
}

include "class/Database.php";
$db = new Database();

if (isset($_POST['submit'])) {
    
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    if ($gambar != "") {
        move_uploaded_file($tmp, "gambar/$gambar");
    }

    $data = [
        "nama" => $_POST['nama'],
        "kategori" => $_POST['kategori'],
        "harga_beli" => $_POST['harga_beli'],
        "harga_jual" => $_POST['harga_jual'],
        "stok" => $_POST['stok'],
        "gambar" => $gambar
    ];

    $db->insert("data_barang", $data);
    header("Location: index.php?page=user/list");
}
?>

<h2 class="title">Tambah Barang</h2>

<form class="form" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" required>
    </div>

    <div class="form-group">
        <label>Kategori</label>
        <select name="kategori">
            <option>Elektronik</option>
            <option>Komputer</option>
            <option>Hand Phone</option>
        </select>
    </div>

    <div class="form-group">
        <label>Harga Beli</label>
        <input type="number" name="harga_beli">
    </div>

    <div class="form-group">
        <label>Harga Jual</label>
        <input type="number" name="harga_jual">
    </div>

    <div class="form-group">
        <label>Stok</label>
        <input type="number" name="stok">
    </div>

    <div class="form-group">
        <label>Gambar</label>
        <input type="file" name="gambar">
    </div>

    <button class="btn-submit" name="submit">Simpan</button>

</form>
