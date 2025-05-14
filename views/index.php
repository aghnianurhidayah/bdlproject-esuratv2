<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-SukMa</title>

    <link rel="stylesheet" href="../styles/userstyle.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="hero">
        <div class="hero-text">
            <div class="hero-title">
                <p>Urus Surat<br><span>Mudah, Cepat, Praktis</span></p>
            </div>
            <div class="hero-pr">
                <p>e-SukMa merupakan aplikasi pembuat surat yang diperuntukkan untuk Desa Suka Maju. Aplikasi ini memberikan layanan pembuatan surat keterangan, surat pengantar, dan surat pernyataan secara daring atau online.</p>
            </div>
            <a href="menu.php"><button>Buat Surat Sekarang</button></a>
        </div>
        <div class="hero-image">
            <img src="../assets/landing.png" alt="landing">
        </div>

    </div>

</body>

</html>