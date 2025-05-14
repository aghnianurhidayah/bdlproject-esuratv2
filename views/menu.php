<?php
session_start();
require "../connect/db_connect.php";

if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
} else {
    if ($_SESSION['role'] == "user") {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>e-SukMa | Menu Surat</title>

            <link rel="stylesheet" href="../styles/userstyle.css">
        </head>

        <body>
            <?php include 'navbar.php'; ?>

            <div class="menu">
                <div class="greeting-text">
                    <p>Selamat Datang, <?php echo $_SESSION['name'] ?>!</p>
                </div>
                <div class="menu-box">
                    <a href="form_keterangan.php">
                        <div class="menu-item">
                            <div class="box">
                                <img src="../assets/copy.png" alt="">
                            </div>
                            <p>Surat<br>Keterangan</p>
                        </div>
                    </a>
                    <a href="form_pengantar.php">
                        <div class="menu-item">
                            <div class="box">
                                <img src="../assets/copy.png" alt="">
                            </div>
                            <p>Surat<br>Pengantar</p>
                        </div>
                    </a>
                    <a href="form_pernyataan.php">
                        <div class="menu-item">
                            <div class="box">
                                <img src="../assets/copy.png" alt="">
                            </div>
                            <p>Surat<br>Pernyataan</p>
                        </div>
                    </a>
                </div>
            </div>
        </body>

        </html>
<?php
    } else if ($_SESSION['role'] == "admin") {
        header("Location: dashboard.php");
    }
}
?>