<?php
include "class/Database.php";
$db = new Database();

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

$where = '';
if ($keyword != '') {
    $where = "WHERE nama LIKE '%$keyword%' 
              OR kategori LIKE '%$keyword%'";
}

$limit = 5;
$hal   = isset($_GET['hal']) ? (int)$_GET['hal'] : 1;
$start = ($hal - 1) * $limit;

$sql = "SELECT * FROM data_barang $where LIMIT $start, $limit";
$result = $db->query($sql);

$totalData = mysqli_num_rows(
    $db->query("SELECT * FROM data_barang $where")
);
$totalHalaman = ceil($totalData / $limit);
?>

<h2>Data Barang</h2>

<a href="index.php?page=user/tambah" class="btn">+ Tambah</a>

<form method="get" style="margin:15px 0;">
    <input type="hidden" name="page" value="user/list">
    <input type="text" name="keyword" placeholder="Cari nama / kategori..."
           value="<?= htmlspecialchars($keyword); ?>"
           style="width:250px; padding:8px;">
    <button type="submit" class="btn">Cari</button>
</form>

<table>
    <tr>
        <th>No</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

<?php $no = $start + 1; ?>
<?php while ($row = mysqli_fetch_assoc($result)) : ?>
<tr>
    <td><?= $no++; ?></td>
    <td><img src="gambar/<?= $row['gambar']; ?>" width="70"></td>
    <td><?= $row['nama']; ?></td>
    <td><?= $row['kategori']; ?></td>
    <td><?= number_format($row['harga_beli']); ?></td>
    <td><?= number_format($row['harga_jual']); ?></td>
    <td><?= $row['stok']; ?></td>
    <td>
        <a class="link" href="index.php?page=user/ubah&id=<?= $row['id_barang']; ?>">Ubah</a> |
        <a class="link" href="index.php?page=user/hapus&id=<?= $row['id_barang']; ?>"
           onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<div style="margin-top:20px; text-align:center;">

<?php if ($hal > 1): ?>
    <a class="btn"
       href="index.php?page=user/list&hal=<?= $hal - 1 ?>&keyword=<?= $keyword ?>">
       Prev
    </a>
<?php endif; ?>

<?php for ($i = 1; $i <= $totalHalaman; $i++): ?>
    <a class="btn"
       style="<?= ($i == $hal) ? 'background:#0f5fcc;' : '' ?>"
       href="index.php?page=user/list&hal=<?= $i ?>&keyword=<?= $keyword ?>">
       <?= $i ?>
    </a>
<?php endfor; ?>

<?php if ($hal < $totalHalaman): ?>
    <a class="btn"
       href="index.php?page=user/list&hal=<?= $hal + 1 ?>&keyword=<?= $keyword ?>">
       Next
    </a>
<?php endif; ?>

</div>
