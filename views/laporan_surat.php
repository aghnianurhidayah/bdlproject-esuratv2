<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <section class="main-content">
        <div class="content">
            <div class="header-wrapper">
                <div class="header">
                    <h2>Laporan</h2>
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
                                    <a href="../views/previewsurat.php?surat_id=<?= $srt['surat_id'] ?>">Lihat</a>
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