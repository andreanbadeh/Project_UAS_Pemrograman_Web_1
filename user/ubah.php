<?php
include "class/Database.php";
$db = new Database();

$id = $_GET['id'];
$data = $db->getById("data_barang", "id_barang", $id);

if (isset($_POST['submit'])) {

    $gambar_baru = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if ($gambar_baru != "") {
        move_uploaded_file($tmp, "gambar/$gambar_baru");
        $g = $gambar_baru;
    } else {
        $g = $data['gambar'];
    }

    $update = [
        "nama" => $_POST['nama'],
        "kategori" => $_POST['kategori'],
        "harga_beli" => $_POST['harga_beli'],
        "harga_jual" => $_POST['harga_jual'],
        "stok" => $_POST['stok'],
        "gambar" => $g
    ];

    $db->update("data_barang", $update, "id_barang='$id'");

    header("Location: index.php?page=user/list");
}
?>

<h2 class="title">Ubah Barang</h2>

<form class="form" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= $data['nama'] ?>">
    </div>

    <div class="form-group">
        <label>Kategori</label>
        <select name="kategori">
            <option <?= ($data['kategori']=="Elektronik")?"selected":"" ?>>Elektronik</option>
            <option <?= ($data['kategori']=="Komputer")?"selected":"" ?>>Komputer</option>
            <option <?= ($data['kategori']=="Hand Phone")?"selected":"" ?>>Hand Phone</option>
        </select>
    </div>

    <div class="form-group">
        <label>Harga Beli</label>
        <input type="number" name="harga_beli" value="<?= $data['harga_beli'] ?>">
    </div>

    <div class="form-group">
        <label>Harga Jual</label>
        <input type="number" name="harga_jual" value="<?= $data['harga_jual'] ?>">
    </div>

    <div class="form-group">
        <label>Stok</label>
        <input type="number" name="stok" value="<?= $data['stok'] ?>">
    </div>

    <div class="form-group">
        <label>Gambar</label>
        <input type="file" name="gambar">
    </div>

    <button class="btn-submit" name="submit">Simpan</button>

</form>
