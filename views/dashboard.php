<?php
session_start();
require "../connect/db_connect.php";

if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
} else {
    if ($_SESSION['role'] == "admin") {

        if (isset($_POST['cari'])) {
            $keyword = $_POST['cari'];
            $sql_form = mysqli_query($conn, "SELECT * FROM forms JOIN surat ON forms.form_id = surat.fk_form_id WHERE no_surat LIKE '%$keyword%'");
        } else {
            $sql_form = mysqli_query($conn, "SELECT * FROM forms JOIN surat ON forms.form_id = surat.fk_form_id");
        }

        $forms = [];
        while ($row = mysqli_fetch_assoc($sql_form)) {
            $forms[] = $row;
        }

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>e-SukMa | Dashboard</title>
            <link rel="stylesheet" href="../styles/dashboard2.css" />
            <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
        </head>

        <body>

            <?php include 'sidebar.php'; ?>

            <section class="main-content">
                <div class="content">
                    <div class="header-wrapper">
                        <div class="header">
                            <h2>Dashboard</h2>
                            <p><?php echo date('l, d F Y'); ?></p>
                            <p><?php date_default_timezone_set('Asia/Makassar');
                                echo date('h:i a'); ?></p>
                        </div>
                        <div class="search">
                            <i class="bx bx-search"></i><input type="submit" name="search" hidden>
                            <form action="" method="post">
                                <input type="text" name="cari" placeholder="Search">
                            </form>
                        </div>
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>NIK</th>
                                    <th>Nama Surat</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($forms as $form) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $form['tgl_masuk'] ?></td>
                                        <td><?= $form['nik'] ?></td>
                                        <td><?= $form['nama_surat'] ?></td>
                                        <td><?= $form['status'] ?></td>
                                        <td>
                                            <a href="../views/previewsurat.php?form_id=<?= $form['form_id'] ?>">Lihat</a>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <script src="../scripts/script.js"></script>
        </body>

        </html>
<?php
    } else if ($_SESSION['role'] == "user") {
        header("Location: menu.php");
    }
}
?>