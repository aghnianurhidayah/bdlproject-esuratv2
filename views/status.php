<?php
session_start();
require "../connect/db_connect.php";

if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
} else {
    if ($_SESSION['role'] == "admin") {

        $form_id = $_GET['form_id'];
        $get = mysqli_query($conn, "SELECT * FROM forms JOIN surat ON forms.form_id = surat.fk_form_id WHERE form_id = $form_id");
        $form = [];

        while ($row = mysqli_fetch_assoc($get)) {
            $form[] = $row;
        }
        $form = $form[0];

        if (isset($_POST['editformadmin'])) {
            $y = date("Y");
            $get_no_surat = $_POST['no_surat'];
            $no_surat = "172/SK/$y/$get_no_surat";
            $status = $_POST['status'];
            if ($status == "Setuju") {
                $tgl_keluar = date('Y-m-d');
            } else if ($status == "Tolak") {
                $tgl_keluar = "";
            }

            $update_surat = "UPDATE surat SET tgl_keluar = '$tgl_keluar' WHERE fk_form_id = '$form_id'";
            $result = $conn->query($update_surat);

            if ($result) {
                $update_form = "UPDATE forms SET no_surat = '$no_surat', status = '$status' WHERE form_id = '$form_id'";
                $result = $conn->query($update_form);
                if ($result) {
                    echo "
                    <script>
                        alert('Status Berhasil Diubah!');
                        document.location.href = 'dashboard.php';
                    </script>";
                }
            } else {
                echo "
                    <script>
                        alert('Status Gagal Diubah!');
                    </script>";
            }
        }

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>e-SukMa | Status Surat</title>
            <link rel="stylesheet" href="../styles/status.css" />
            <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
        </head>

        <body>

            <?php include 'sidebar.php'; ?>

            <section class="main-content">
                <div class="content">
                    <div class="left">
                        <div class="container">
                            <h3>Keterangan Surat</h3>
                        </div>
                        <div class="main">
                            <br>
                            <p>NIK : <?= $form['nik'] ?></p>
                            <p>Nama Lengkap : <?= $form['nama'] ?></p>
                            <p>Nama Surat : <?= $form['nama_surat'] ?></p>
                            <p>Jenis Surat : <?= $form['jenis_surat'] ?></p>
                            <div class="file">
                                <img src="../img/kk/<?= $form['file_kk'] ?>" width="120" alt="">
                                <img src="../img/ktp/<?= $form['file_ktp'] ?>" width="120" alt="">
                                <img src="../img/foto/<?= $form['file_foto'] ?>" width="120" alt="">
                            </div>
                            <form action="" method="post">
                                <div class="status-select">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" required>
                                        <option value="<?= $form['status'] ?>"><?= $form['status'] ?></option>
                                        <option value="Proses">Proses</option>
                                        <option value="Setuju">Setuju</option>
                                        <option value="Tolak">Tolak</option>
                                    </select>
                                </div>
                                <div class="no-surat">
                                    <label for="surat">No Surat</label>
                                    <?php
                                    if ($form['status'] == "Proses") {
                                    ?>
                                        <input type="text" name="no_surat" id="no_surat" onkeypress="isInputNumber(event)" minlength="3" maxlength="3" class="textfield" value="<?= $form['no_surat'] ?>" required>
                                    <?php
                                    } else {
                                    ?>
                                    <input type="text" name="no_surat" id="no_surat" onkeypress="isInputNumber(event)" minlength="3" maxlength="3" class="textfield" value="<?= $form['no_surat'] ?>" disabled>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if ($form['status'] == "Proses") {
                                ?>
                                    <input class="button" type="submit" value="Kirim" name="editformadmin">
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <div class="container">
                            <h3>Preview File</h3>
                            <br>
                        </div>
                        <div class="display">
                            <iframe src="../surat/<?= $form['nama_surat'] ?>.php?form_id=<?= $form['form_id'] ?>" frameborder="0" class="content-iframe"></iframe>
                        </div>
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