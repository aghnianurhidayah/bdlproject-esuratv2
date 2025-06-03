<?php
session_start();
require "../../connect/db_connect.php";

$surat_id = $_GET['surat_id'];
$get = mysqli_query($conn, "SELECT * FROM surat JOIN sk_tidak_mampu ON surat.surat_id = sk_tidak_mampu.sktm_id WHERE surat_id = '$surat_id'");
$surat = [];

while ($row = mysqli_fetch_assoc($get)) {
    $surat[] = $row;
}
$surat = $surat[0];

if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
} else {
if (isset($_POST['accform'])) {
        $y = date("Y");
        $get_no_surat = $GET['no_surat'];
        list($kode_surat, $nomor_urut) = explode("-", $surat_id);
        $no_surat = "172/$kode_surat/$y/$nomor_urut";
        $tgl_keluar = date('Y-m-d');

        $acc_surat = "UPDATE surat SET no_surat = '$no_surat', tgl_keluar = '$tgl_keluar', status = 'Diterima' WHERE surat_id = '$surat_id'";
        $result = $conn->query($acc_surat);
        if ($result) {
            echo "
                    <script>
                        alert('Form Diterima!');
                        document.location.href = '../dashboard.php';
                    </script>";
        } else {
            echo "
                    <script>
                        alert('Form Gagal Diterima!');
                        document.location.href = '../dashboard.php';
                    </script>";
        }
    } else if (isset($_POST['rejform'])) {
        $rej_surat = "UPDATE surat SET status = 'Ditolak' WHERE surat_id = '$surat_id'";
        $result = $conn->query($rej_surat);
        if ($result) {
            echo "
                    <script>
                        alert('Form Ditolak!');
                        document.location.href = '../dashboard.php';
                    </script>";
        } else {
            echo "
                    <script>
                        alert('Form Gagal Ditolak!');
                        document.location.href = '../dashboard.php';
                    </script>";
        }
    } else if (isset($_POST['updateform'])) {
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
            $file_kk = $surat['file_kk'];
        }

        if (is_uploaded_file($tmp_ktp) && file_exists($tmp_ktp)) {
            move_uploaded_file($tmp_ktp, "../../img/ktp/" . $file_ktp);
        } else {
            $file_ktp = $surat['file_ktp'];
        }

        $update_form = "UPDATE sk_tidak_mampu SET nik = '$nik', no_kk = '$nokk', nama = '$nama', tgl_lahir = '$tl', jenis_kelamin = '$jk', agama = '$agama', alamat = '$alamat', kewarganagaraan = '$wn', file_kk = '$file_kk', file_ktp = '$file_ktp' WHERE sktm_id = '$surat_id'";
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
                        document.location.href = '../hist.php';
                    </script>";
            echo "Error: " . $conn->error;
        }
    }
}
?>
<div class="form">
    <form action="detail/keterangan_tidak_mampu.php?surat_id=<?= $surat_id ?>" method="post" enctype="multipart/form-data">
        <div class="input-box">
            <label for="surat">Nama Surat</label>
            <input type="text" name="surat" class="textfield" value="<?= $surat['nama_surat'] ?>" disabled>
        </div>
        <div class="input-box d-none" id="input-nik">
            <label for="nik">NIK</label>
            <input type="number" name="nik" id="nik" class="textfield" value="<?= $surat['nik'] ?>" placeholder="Masukan NIK" <?= ($_SESSION['role'] == 'admin' ? 'disabled' : '') ?>>
        </div>
        <div class="input-box d-none" id="input-nokk">
            <label for="nokk">No KK</label>
            <input type="number" name="nokk" id="nokk" class="textfield" value="<?= $surat['no_kk'] ?>" placeholder="Masukan No. KK" <?= ($_SESSION['role'] == 'admin' ? 'disabled' : '') ?>>
        </div>
        <div class="input-box d-none" id="input-nama">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="textfield" value="<?= $surat['nama'] ?>" placeholder="Masukan Nama Lengkap" <?= ($_SESSION['role'] == 'admin' ? 'disabled' : '') ?>>
        </div>
        <div class="input-box d-none" id="input-tl">
            <label for="tl">Tanggal Lahir</label>
            <input type="date" name="tl" id="tl" class="textfield" value="<?= $surat['tgl_lahir'] ?>" placeholder="Masukan Tanggal Lahir" <?= ($_SESSION['role'] == 'admin' ? 'disabled' : '') ?>>
        </div>
        <div class="input-box d-none" id="input-jk">
            <label for="jk">Jenis Kelamin</label>
            <select name="jk" id="jk" <?= ($_SESSION['role'] == 'admin' ? 'disabled' : '') ?>>
                <option value="<?= $surat['jenis_kelamin'] ?>" selected><?= $surat['jenis_kelamin'] ?></option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="input-box d-none" id="input-agama">
            <label for="agama">Agama</label>
            <select name="agama" id="agama" <?= ($_SESSION['role'] == 'admin' ? 'disabled' : '') ?>>
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
            <input type="text" name="alamat" id="alamat" class="textfield" value="<?= $surat['alamat'] ?>" placeholder="Masukan Alamat" <?= ($_SESSION['role'] == 'admin' ? 'disabled' : '') ?>>
        </div>
        <div class="input-box d-none" id="input-wn">
            <label for="wn">Kewarganegaraan</label>
            <input type="text" name="wn" id="wn" class="textfield" value="<?= $surat['kewarganagaraan'] ?>" placeholder="Masukan Kewarganegaraan" <?= ($_SESSION['role'] == 'admin' ? 'disabled' : '') ?>>
        </div>
        <div class="input-box">
            <img src="/e-suratv2/img/kk/<?= $surat['file_kk'] ?>" alt="" width="50%">
        </div>
        <div class="input-box d-none" id="input-fkk">
            <label for="fkk">Upload File KK</label>
            <input type="file" name="fkk" id="fkk" class="filefield" value="<?= $surat['file_kk'] ?>" placeholder="Upload File KK" <?= ($_SESSION['role'] == 'admin' ? 'disabled' : '') ?>>
        </div>
        <div class="input-box">
            <img src="/e-suratv2/img/ktp/<?= $surat['file_ktp'] ?>" alt="" width="50%">
        </div>
        <div class="input-box d-none" id="input-fktp">
            <label for="fktp">Upload File KTP</label>
            <input type="file" name="fktp" id="fktp" class="filefield" value="<?= $surat['file_ktp'] ?>" placeholder="Upload File KTP" <?= ($_SESSION['role'] == 'admin' ? 'disabled' : '') ?>>
        </div>
        <div class="btn-op">
            <?php if ($_SESSION['role'] == "admin") { ?>
                <a class="button" href="/e-suratv2/views/dashboard.php">Kembali</a>
                <?php if ($surat['status'] == 'Proses') { ?>
                    <input class="button" type="submit" value="Terima" name="accform">
                    <input class="button" type="submit" value="Tolak" name="rejform">
                <?php } ?>
            <?php } elseif ($_SESSION['role'] == "user") { ?>
                <a class="button" href="hist.php">Kembali</a>
                <?php if ($surat['status'] == 'Proses') { ?>
                    <input class="button" type="submit" value="Ubah" name="updateform">
                    <a class="button" href="cancelform.php?surat_id=<?= $surat_id ?>">Batalkan</a>
                <?php } ?>
            <?php } ?>
        </div>
    </form>
</div>