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
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>e-SukMa | Detail Surat</title>
            <link rel="stylesheet" href="../styles/userstyle.css" />
            <link rel="stylesheet" href="../styles/detail_surat.css" />
        </head>

        <body>

            <?php include 'navbar.php'; ?>

            <div class="detail">
                <div class="detail-text">
                    <p>Detail Surat</p>
                </div>
            </div>
            <div class="detail-form" id="detail-form">

            </div>

        </body>

        </html>
<?php
    } else if ($_SESSION['role'] == "admin") {
        header("Location: dashboard.php");
    }
}
?>