<?php
if (!isset($_SESSION)) session_start();
include "config/koneksi.php";

if (!empty($_SESSION['is_login'])) {
    header("Location: index.php?page=home");
    exit;
}

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$username' AND password='$password'");
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        $_SESSION['is_login'] = true;
        $_SESSION['user'] = $user;
        $_SESSION['role'] = $user['role']; // admin atau user
        header("Location: index.php?page=home");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<link rel="stylesheet" href="style-login.css">

<div class="login-container">
    <h2>Login</h2>

    <?php if ($error != ""): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="email" placeholder="Masukkan Nama" class="input" required>
        <input type="password" name="password" placeholder="Masukkan Password" class="input" required>
        <button type="submit" name="login" class="btn">Login</button>
    </form>
</div>
