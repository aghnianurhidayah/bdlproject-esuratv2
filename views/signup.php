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

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $nik = $_POST['nik'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password === $cpassword) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $check = mysqli_query($conn, "SELECT * FROM users WHERE nik='$nik'");
        if (!$check->num_rows > 0) {
            $result = mysqli_query($conn, "INSERT INTO users VALUES ('', '$nik', '$name', '$password')");
            if ($result) {
                echo "<script>alert('Registrasi Berhasil')</script>";
                header("Location: login.php");
            } else {
                echo "<script>alert('Terjadi kesalahan')</script>";
            }
        } else {
            echo "<script>alert('NIK Sudah Terdaftar')</script>";
        }
    } else {
        echo "
                <script>
                    alert('Konformasi Password Anda Tidak Sesuai');
                    document.location.href = 'signup.php';
                </script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-SukMa | Daftar</title>
    <link rel="stylesheet" href="../styles/signinup.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="form-container">
        <form action="signup.php" method="post">
            <h2>Buat Akun</h2>
            <label>NIK</label>
            <input type="text" onkeypress="isInputNumber(event)" name="nik" minlength="16" maxlength="16" placeholder="Masukan NIK" required>

            <label>Nama</label>
            <input type="text" name="name" placeholder="Masukan Nama" required>

            <label>Password</label>
            <input type="password" name="password" pattern=".{8,12}" title="8 charachters minimum" placeholder="Masukan Password" required>

            <label>Konfirmasi Password</label>
            <input type="password" name="cpassword" placeholder="Masukan Password" required>

            <input class="signup-button" type="submit" value="Daftar" name="signup">
            <p class="link">Sudah memiliki akun? <a href="login.php">Login</a></p>
        </form>
    </div>

    <script src="../scripts/script.js"></script>
</body>

</html>