<?php
session_start();
require "../../connect/db_connect.php";

if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
} else {
    if ($_SESSION['role'] == "user") {

        $surat_id = $_GET['surat_id'];
        $get = mysqli_query($conn, "SELECT * FROM surat JOIN sp_e_ktp ON surat.surat_id = sp_e_ktp.spektp_id WHERE surat_id = '$surat_id'");
        $surat = [];

        while ($row = mysqli_fetch_assoc($get)) {
            $surat[] = $row;
        }
        $surat = $surat[0];

        if (isset($_POST['editform'])) {
            $nik = $_POST['nik'];
            $nokk = $_POST['nokk'];
            $nama = $_POST['nama'];
            $tl = $_POST['tl'];
            $jk = $_POST['jk'];
            $agama = $_POST['agama'];
            $alamat = $_POST['alamat'];
            $wn = $_POST['wn'];
            $fkk = strtolower(end(explode('.', $_FILES['fkk']['name'])));
            $fktp = strtolower(end(explode('.', $_FILES['fktp']['name'])));

            $file_kk = "kk.$nama.$fkk";
            $file_ktp = "ktp.$nama.$fktp";
            $tmp_kk = $_FILES['fkk']['tmp_name'];
            $tmp_ktp = $_FILES['fktp']['tmp_name'];

            if (is_uploaded_file($tmp_kk) && file_exists($tmp_kk)) {
                move_uploaded_file($tmp_kk, "../../img/kk/" . $file_kk);
            } else {
                $file_kk = '';
            }

            if (is_uploaded_file($tmp_ktp) && file_exists($tmp_ktp)) {
                move_uploaded_file($tmp_ktp, "../../img/ktp/" . $file_ktp);
            } else {
                $file_ktp = '';
            }

            $update_form = "UPDATE sp_e_ktp SET nik = '$nik', no_kk = '$nokk', nama = '$nama', tgl_lahir = '$tl', jenis_kelamin = '$jk', agama = '$agama', alamat = '$alamat', kewarganagaraan = '$wn', file_kk = '$file_kk', file_ktp = '$file_ktp' WHERE spektp_id = '$surat_id'";
            $result = $conn->query($update_form);

            if ($result) {
                echo "
                    <script>
                        alert('Formulir Berhasil Diubah!');
                        document.location.href = '../hist.php';
                    </script>";
            } else {
                echo "
                    <script>
                        alert('Formulir Gagal Diubah!');
                    </script>";
            }
        }
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>e-SukMa | Detail Surat</title>

            <link rel="stylesheet" href="/e-suratv2/styles/userstyle.css">
        </head>

        <body>
            <?php include '../navbar.php'; ?>

            <div class="detail">
                <div class="detail-text">
                    <p>Detail Surat</p>
                </div>
            </div>
            <div class="detail-form">
                <div class="form">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="input-box">
                            <label for="surat">Nama Surat</label>
                            <input type="text" name="surat" class="textfield" value="<?= $surat['nama_surat'] ?>" disabled>
                        </div>
                        <div class="input-box d-none" id="input-nik">
                            <label for="nik">NIK</label>
                            <input type="number" name="nik" id="nik" class="textfield" value="<?= $surat['nik'] ?>" placeholder="Masukan NIK" disable>
                        </div>
                        <div class="input-box d-none" id="input-nokk">
                            <label for="nokk">No KK</label>
                            <input type="number" name="nokk" id="nokk" class="textfield" value="<?= $surat['no_kk'] ?>" placeholder="Masukan No. KK">
                        </div>
                        <div class="input-box d-none" id="input-nama">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="textfield" value="<?= $surat['nama'] ?>" placeholder="Masukan Nama Lengkap">
                        </div>
                        <div class="input-box d-none" id="input-tl">
                            <label for="tl">Tanggal Lahir</label>
                            <input type="date" name="tl" id="tl" class="textfield" value="<?= $surat['tgl_lahir'] ?>" placeholder="Masukan Tanggal Lahir">
                        </div>
                        <div class="input-box d-none" id="input-jk">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" id="jk">
                                <option value="<?= $surat['jenis_kelamin'] ?>" selected><?= $surat['jenis_kelamin'] ?></option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="input-box d-none" id="input-agama">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama">
                                <option value="<?= $surat['agama'] ?>" selected><?= $surat['agama'] ?></option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                        <div class="input-box d-none" id="input-alamat">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="textfield" value="<?= $surat['alamat'] ?>" placeholder="Masukan Alamat">
                        </div>
                        <div class="input-box d-none" id="input-wn">
                            <label for="wn">Kewarganegaraan</label>
                            <input type="text" name="wn" id="wn" class="textfield" value="<?= $surat['kewarganagaraan'] ?>" placeholder="Masukan Kewarganegaraan">
                        </div>
                        <div class="input-box d-none" id="input-fkk">
                            <label for="fkk">Upload File KK</label>
                            <input type="file" name="fkk" id="fkk" class="filefield" value="<?= $surat['file_kk'] ?>" placeholder="Upload File KK">
                        </div>
                        <div class="input-box d-none" id="input-fktp">
                            <label for="fktp">Upload File KTP</label>
                            <input type="file" name="fktp" id="fktp" class="filefield" value="<?= $surat['file_ktp'] ?>" placeholder="Upload File KTP">
                        </div>
                        <div class="btn-op">
                            <a class="button" href="../hist.php">Kembali</a>
                            <input class="button" type="submit" value="Ubah" name="editform">
                            <a class="button" href="../cancelform.php?surat_id=<? $surat_id ?>">Batalkan</a>
                        </div>
                    </form>
                </div>
            </div>
            <script src="../scripts/script.js"></script>
        </body>
        </body>

        </html>
<?php
    } else if ($_SESSION['role'] == "admin") {
        header("Location: dashboard.php");
    }
}
?>