<?php
session_start();
require "../connect/db_connect.php";

if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
} else {
    if ($_SESSION['role'] == "user") {

        $get_nik = $_SESSION['nik'];
        $sql_form = mysqli_query($conn, "SELECT * FROM forms JOIN surat ON forms.form_id = surat.fk_form_id WHERE forms.nik = $get_nik");

        $forms = [];
        while ($row = mysqli_fetch_assoc($sql_form)) {
            $forms[] = $row;
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
                                <th>Jenis Surat</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($forms as $form) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $form['nama_surat'] ?></td>
                                    <td><?= $form['jenis_surat'] ?></td>
                                    <td><?= $form['tgl_masuk'] ?></td>
                                    <td><?= $form['tgl_keluar'] ?></td>
                                    <td><?= $form['status'] ?></td>
                                    <td>
                                        <?php
                                        if ($form['status'] == "Proses") {
                                        ?>
                                            <div class="action">
                                                <a href="editform.php?form_id=<?= $form['form_id'] ?>"><i class="bx bxs-edit" style="font-size: 25px; color: #ffc801"></i></a>
                                                <a href="deleteform.php?form_id=<?= $form['form_id'] ?>"><i class="bx bxs-trash" style="font-size: 25px; color: #DF2E38"></i></a>
                                            </div>
                                        <?php
                                        } else if ($form['status'] == "Setuju") {
                                        ?>
                                            <div class="action">
                                                <a href="../surat/<?= $form['nama_surat'] ?>.php?form_id=<?= $form['form_id'] ?>" target="_blank"><button>Unduh</button></a>
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