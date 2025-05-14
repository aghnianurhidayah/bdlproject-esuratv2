<?php
session_start();
require "../connect/db_connect.php";

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == "admin") {
        header("Location: dashboard.php");
        exit();
    } else if ($_SESSION['role'] == "user") {
        header("Location: menu.php");
        exit();
    }
}

if (isset($_POST['login'])) {
    $nik = $_POST['nik'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    if ($nik == "123" && $name == "admin" && $password == "admin123") {
        $_SESSION['role'] = "admin";
        header("Location: dashboard.php");
    } else {
        $result = mysqli_query($conn, "SELECT * FROM users WHERE nik='$nik'");
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($nik == $row['nik']) {
                if ($name == $row['nama']) {
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['role'] = "user";
                        $_SESSION['name'] = $row['nama'];
                        $_SESSION['nik'] = $row['nik'];
                        header("Location: menu.php");
                    } else {
                        echo "<script>alert('Password tidak sesuai')</script>";
                    }
                } else {
                    echo "<script>alert('Nama tidak sesuai')</script>";
                }
            }
        } else {
            echo "<script>alert('Akun Anda belum terdaftar')</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-SukMa | Masuk</title>
    <link rel="stylesheet" href="../styles/signinup.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="form-container">
        <form action="login.php" method="post">
            <h2>Login</h2>
            <label>NIK</label>
            <input type="text" name="nik" onkeypress="isInputNumber(event)" placeholder="Masukan NIK" required>

            <label>Nama</label>
            <input type="text" name="name" placeholder="Masukan Nama" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukan Password" required>

            <input class="login-button" type="submit" value="Login" name="login">
            <p class="link">Belum memiliki akun? <a href="signup.php">Daftar</a></p>
        </form>
    </div>

    <script src="../scripts/script.js"></script>
</body>

</html>