<?php
session_start();
require "../connect/db_connect.php";

if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
} else {
    if ($_SESSION['role'] == "admin") {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>e-SukMa | Preview Surat</title>
            <link rel="stylesheet" href="../styles/adminsurat.css" />
            <link rel="stylesheet" href="../styles/detail_surat.css" />
        </head>

        <body>

            <?php include 'sidebar.php'; ?>

            <section class="main-content">
                <div class="content">
                    <div class="header-wrapper">
                        <div class="header">
                            <h2>Surat Masuk</h2>
                            <p><?php echo date('l, d F Y'); ?></p>
                            <p><?php date_default_timezone_set('Asia/Makassar');
                                echo date('h:i a'); ?></p>
                        </div>
                    </div>
                    <div class="detail-form" id="detail-form">

                    </div>
                </div>
            </section>

        </body>

        </html>
<?php
    } else if ($_SESSION['role'] == "user") {
        header("Location: menu.php");
    }
}
?>