<?php
if (!isset($_SESSION)) session_start();
if ($_SESSION['role'] != "admin") {
    header("Location: index.php?page=user/list");
    exit;
}

include "class/Database.php";
$db = new Database();

$id = $_GET['id'];
$db->delete("data_barang", "id_barang='$id'");

header("Location: index.php?page=user/list");
