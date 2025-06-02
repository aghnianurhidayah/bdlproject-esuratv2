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
            $sql_surat = mysqli_query($conn, "SELECT * FROM surat WHERE nik_user LIKE '%$keyword%'");
        } else {
            $sql_surat = mysqli_query($conn, "SELECT * FROM surat");
        }

        $surat = [];
        while ($row = mysqli_fetch_assoc($sql_surat)) {
            $surat[] = $row;
        }

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>e-SukMa | Dashboard</title>
            <link rel="stylesheet" href="../styles/adminsurat.css" />
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
                                foreach ($surat as $srt) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $srt['tgl_masuk'] ?></td>
                                        <td><?= $srt['nik_user'] ?></td>
                                        <td><?= $srt['nama_surat'] ?></td>
                                        <td><?= $srt['status'] ?></td>
                                        <td>
                                        <?php
                                        if ($srt['status'] == "Proses") {
                                        ?>

                                            <a href="../views/detail_surat.php?surat_id=<?= $srt['surat_id'] ?>">Lihat</a>

                                        <?php
                                        } else if ($srt['status'] == "Diterima") {
                                        ?>

                                            <a href="../surat/<?= $srt['nama_surat'] ?>.php?surat_id=<?= $srt['surat_id'] ?>" target="_blank">Unduh</a>

                                        <?php
                                        }
                                        ?>
                                    </td>
                                    </tr>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
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