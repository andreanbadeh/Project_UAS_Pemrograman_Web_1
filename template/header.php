<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$page = isset($_GET['page']) ? $_GET['page'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Toko Komputer</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
<div class="container">

<header class="app-header">
    <?php if($page != 'login'): ?>
        <h1>Toko Komputer</h1>
    <?php endif; ?>
</header>

<?php if(isset($_SESSION['is_login']) && $page != 'login'): ?>
<div class="nav-table-container">
    <table class="nav-table">
        <tr>
            <td><a href="index.php?page=home">Halaman</a></td>
            <td><a href="index.php?page=about">Tentang</a></td>
            <td><a href="index.php?page=kontak">Kontak</a></td>
            <td><a href="index.php?page=user/list">Data Barang</a></td>
            <td><a href="index.php?page=profil">Profil (<?= $_SESSION['user']['nama']; ?>)</a></td>
            <td><a href="index.php?page=logout">Logout</a></td>
        </tr>
    </table>
</div>
<?php endif; ?>

<div class="content">
