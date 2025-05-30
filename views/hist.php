<?php
session_start();
require "../connect/db_connect.php";

if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
} else {
    if ($_SESSION['role'] == "user") {

        $get_nik = $_SESSION['nik'];
        $sql_surat = mysqli_query($conn, "SELECT * FROM surat WHERE surat.nik_user = $get_nik");

        $surat = [];
        while ($row = mysqli_fetch_assoc($sql_surat)) {
            $surat[] = $row;
        }
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>e-Surat | Riwayat Surat</title>

            <link rel="stylesheet" href="../styles/userstyle.css">
            <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
        </head>

        <body>
            <?php include 'navbar.php'; ?>


            <div class="hist">
                <div class="hist-text">
                    <p>Riwayat Surat</p>
                </div>
                <div class="hist-table">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Surat</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($surat as $srt) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $srt['nama_surat'] ?></td>
                                    <td><?= $srt['tgl_masuk'] ?></td>
                                    <td><?= $srt['tgl_keluar'] ?></td>
                                    <td><?= $srt['status'] ?></td>
                                    <td>
                                        <?php
                                        if ($srt['status'] == "Proses") {
                                        ?>
                                            <div class="action">
                                                <?php
                                                $surat_id = $srt['surat_id'];

                                                if (str_starts_with($surat_id, 'DOM')) {
                                                    $link = "detail/keterangan_domisili.php?surat_id=$surat_id";
                                                } elseif (str_starts_with($surat_id, 'LHR')) {
                                                    $link = "detail/keterangan_kelahiran.php?surat_id=$surat_id";
                                                }elseif (str_starts_with($surat_id, 'KMT')) {
                                                    $link = "detail/keterangan_kematian.php?surat_id=$surat_id";
                                                }elseif (str_starts_with($surat_id, 'KTM')) {
                                                    $link = "detail/keterangan_tidak_mampu.php?surat_id=$surat_id";
                                                }elseif (str_starts_with($surat_id, 'EKTP')) {
                                                    $link = "detail/pengantar_e_ktp.php?surat_id=$surat_id";
                                                }elseif (str_starts_with($surat_id, 'NKH')) {
                                                    $link = "detail/pengantar_nikah.php?surat_id=$surat_id";
                                                }elseif (str_starts_with($surat_id, 'KCK')) {
                                                    $link = "detail/pengantar_skck.php?surat_id=$surat_id";
                                                }elseif (str_starts_with($surat_id, 'AKL')) {
                                                    $link = "detail/pernyataan_akte_kelahiran.php?surat_id=$surat_id";
                                                }elseif (str_starts_with($surat_id, 'STS')) {
                                                    $link = "detail/pernyataan_status.php?surat_id=$surat_id";
                                                }
                                                ?>
                                                <a href="<?= $link ?>">Lihat</a>
                                            </div>
                                        <?php
                                        } else if ($srt['status'] == "Setuju") {
                                        ?>
                                            <div class="action">
                                                <a href="../surat/<?= $srt['nama_surat'] ?>.php?surat_id=<?= $form['surat_id'] ?>" target="_blank"><button>Unduh</button></a>
                                            </div>
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
        </body>

        </html>
<?php
    } else if ($_SESSION['role'] == "admin") {
        header("Location: dashboard.php");
    }
}
?>