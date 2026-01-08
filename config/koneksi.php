<?php
$host = "localhost";
$user = "root";
$pass = "070406";
$db   = "latihan1";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
