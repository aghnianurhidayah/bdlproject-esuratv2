<?php
session_start();
require "../connect/db_connect.php";

if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
} else {
    if ($_SESSION['role'] == "user") {

        if (isset($_POST['submitform'])) {
            $nosurat = "0";
            $nik = $_SESSION['nik'];
            $nokk = $_POST['nokk'];
            $nama = $_POST['nama'];
            $tl = $_POST['tl'];
            $tk = '';
            $jk = $_POST['jk'];
            $agama = $_POST['agama'];
            $alamat = $_POST['alamat'];
            $pekerjaan = $_POST['pekerjaan'];
            $wn = $_POST['wn'];
            $ayah = $_POST['ayah'];
            $ibu = $_POST['ibu'];
            $fkk = strtolower(end(explode('.', $_FILES['fkk']['name'])));
            $fktp = strtolower(end(explode('.', $_FILES['fktp']['name'])));
            $ffoto = strtolower(end(explode('.', $_FILES['ffoto']['name'])));
            $surat = $_POST['surat'];
            $status = "Proses";

            $file_kk = "kk.$surat.$nama.$fkk";
            $file_ktp = "ktp$.surat.$nama.$fktp";
            $file_foto = "foto.$surat.$nama.$ffoto";
            $tmp_kk = $_FILES['fkk']['tmp_name'];
            $tmp_ktp = $_FILES['fktp']['tmp_name'];
            $tmp_foto = $_FILES['ffoto']['tmp_name'];

            $tgl_masuk = date('Y-m-d');

            if (is_uploaded_file($tmp_kk) && file_exists($tmp_kk)) {
                move_uploaded_file($tmp_kk, "../img/kk/" . $file_kk);
            } else {
                $file_kk = '';
            }

            if (is_uploaded_file($tmp_ktp) && file_exists($tmp_ktp)) {
                move_uploaded_file($tmp_ktp, "../img/ktp/" . $file_ktp);
            } else {
                $file_ktp = '';
            }

            if (is_uploaded_file($tmp_foto) && file_exists($tmp_foto)) {
                move_uploaded_file($tmp_foto, "../img/foto/" . $file_foto);
            } else {
                $file_foto = '';
            }

            $insert_form = "INSERT INTO forms VALUES ('', '$nosurat', '$nik', '$nokk', '$nama', '$tl', '$tk', '$jk', '$agama', '$alamat', '$pekerjaan', '$wn', '$ayah', '$ibu', '$file_kk', '$file_ktp', '$file_foto', '$surat', '$status')";
            $result = $conn->query($insert_form);

            if ($result) {

                $fk_form_id = $conn->insert_id;
                $insert_surat = "INSERT INTO surat VALUES ('$fk_form_id', '$nik', 'Surat Pernyataan', '$tgl_masuk', '0')";
                $result = $conn->query($insert_surat);

                echo "
                    <script>
                        alert('Formulir Berhasil Diisi!');
                        document.location.href = 'hist.php';
                    </script>";
            } else {
                echo "
                    <script>
                        alert('Formulir Gagal Diisi!');
                    </script>";
            }
        }

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>e-SukMa | Formulir Pernyataan</title>

            <link rel="stylesheet" href="../styles/userstyle.css">
        </head>

        <body>
            <?php include 'navbar.php'; ?>

            <div class="form">
                <div class="form-title">
                    <p>Silahkan Isi Formulir Berikut</p>
                </div>
                <div class="form-box">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="input-box">
                            <label for="surat">Pilih Surat</label>
                            <select name="surat" onchange="getValue(this)">
                                <option value="">Pilih Surat</option>
                                <option value="Surat Pernyataan Tidak Memiliki Akte Kelahiran">Surat Pernyataan Tidak Memiliki Akte Kelahiran</option>
                                <option value="Surat Pernyataan Janda Duda">Surat Pernyataan Janda/Duda</option>
                            </select>
                        </div>
                        <div class="input-box d-none" id="input-nik">
                            <label for="nik">NIK</label>
                            <input type="number" name="nik" id="nik" class="textfield" value="<?= $_SESSION['nik'] ?>" disabled>
                        </div>
                        <div class="input-box d-none" id="input-nokk">
                            <label for="nokk">No KK</label>
                            <input type="number" name="nokk" id="nokk" onkeypress="isInputNumber(event)" minlength="16" maxlength="16" class="textfield" placeholder="Masukan No. KK" required>
                        </div>
                        <div class="input-box d-none" id="input-nama">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="textfield" placeholder="Masukan Nama Lengkap" required>
                        </div>
                        <div class="input-box d-none" id="input-tl">
                            <label for="tl">Tanggal Lahir</label>
                            <input type="date" name="tl" id="tl" class="textfield" placeholder="Masukan Tanggal Lahir" required>
                        </div>
                        <div class="input-box d-none" id="input-jk">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" id="jk">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="input-box d-none" id="input-agama">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama">
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
                            <input type="text" name="alamat" id="alamat" class="textfield" placeholder="Masukan Alamat">
                        </div>
                        <div class="input-box d-none" id="input-pekerjaan">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" class="textfield" placeholder="Masukan Pekerjaan">
                        </div>
                        <div class="input-box d-none" id="input-wn">
                            <label for="wn">Kewarganegaraan</label>
                            <input type="text" name="wn" id="wn" class="textfield" placeholder="Masukan Kewarganegaraan">
                        </div>
                        <div class="input-box d-none" id="input-ayah">
                            <label for="ayah">Nama Ayah Kandung</label>
                            <input type="text" name="ayah" id="ayah" class="textfield" placeholder="Masukan Nama Ayah">
                        </div>
                        <div class="input-box d-none" id="input-ibu">
                            <label for="ibu">Nama Ibu Kandung</label>
                            <input type="text" name="ibu" id="ibu" class="textfield" placeholder="Masukan Nama Ibu">
                        </div>
                        <div class="input-box d-none" id="input-fkk">
                            <label for="fkk">Upload File KK</label>
                            <input type="file" name="fkk" id="fkk" class="filefield" placeholder="Upload File KK">
                        </div>
                        <div class="input-box d-none" id="input-fktp">
                            <label for="fktp">Upload File KTP</label>
                            <input type="file" name="fktp" id="fktp" class="filefield" placeholder="Upload File KTP">
                        </div>
                        <div class="input-box d-none" id="input-ffoto">
                            <label for="ffoto">Upload File Foto 3x4</label>
                            <input type="file" name="ffoto" id="ffoto" class="filefield" placeholder="Upload File Foto 3x4">
                        </div>
                        <input class="button" type="submit" value="Kirim" name="submitform">
                    </form>
                </div>
            </div>

            <script src="../scripts/script.js"></script>
            <script>
                function getValue(answer) {
                    if (answer.value == "Surat Pernyataan Tidak Memiliki Akte Kelahiran") {
                        document.getElementById('input-nik').classList.add('d-none');
                        document.getElementById('input-nokk').classList.remove('d-none');
                        document.getElementById('input-nama').classList.remove('d-none');
                        document.getElementById('input-tl').classList.remove('d-none');
                        document.getElementById('input-jk').classList.remove('d-none');
                        document.getElementById('input-agama').classList.remove('d-none');
                        document.getElementById('input-alamat').classList.remove('d-none');
                        document.getElementById('input-pekerjaan').classList.add('d-none');
                        document.getElementById('input-wn').classList.remove('d-none');
                        document.getElementById('input-ayah').classList.remove('d-none');
                        document.getElementById('input-ibu').classList.remove('d-none');
                        document.getElementById('input-fkk').classList.remove('d-none');
                        document.getElementById('input-fktp').classList.add('d-none');
                        document.getElementById('input-ffoto').classList.add('d-none');
                        // set required
                        document.getElementById('nik').removeAttribute('required');
                        document.getElementById('nokk').setAttribute('required', '');
                        document.getElementById('nama').setAttribute('required', '');
                        document.getElementById('tl').setAttribute('required', '');
                        document.getElementById('jk').setAttribute('required', '');
                        document.getElementById('agama').setAttribute('required', '');
                        document.getElementById('alamat').setAttribute('required', '');
                        document.getElementById('pekerjaan').removeAttribute('required');
                        document.getElementById('wn').setAttribute('required', '');
                        document.getElementById('ayah').setAttribute('required', '');
                        document.getElementById('ibu').setAttribute('required', '');
                        document.getElementById('fkk').setAttribute('required', '');
                        document.getElementById('fktp').removeAttribute('required');
                        document.getElementById('ffoto').removeAttribute('required');
                    } else if (answer.value == "Surat Pernyataan Janda Duda") {
                        document.getElementById('input-nik').classList.remove('d-none');
                        document.getElementById('input-nokk').classList.remove('d-none');
                        document.getElementById('input-nama').classList.remove('d-none');
                        document.getElementById('input-tl').classList.remove('d-none');
                        document.getElementById('input-jk').classList.remove('d-none');
                        document.getElementById('input-agama').classList.remove('d-none');
                        document.getElementById('input-alamat').classList.remove('d-none');
                        document.getElementById('input-pekerjaan').classList.add('d-none');
                        document.getElementById('input-wn').classList.remove('d-none');
                        document.getElementById('input-ayah').classList.add('d-none');
                        document.getElementById('input-ibu').classList.add('d-none');
                        document.getElementById('input-fkk').classList.add('d-none');
                        document.getElementById('input-fktp').classList.remove('d-none');
                        document.getElementById('input-ffoto').classList.add('d-none');
                        // set required
                        document.getElementById('nik').setAttribute('required', '');
                        document.getElementById('nokk').setAttribute('required', '');
                        document.getElementById('nama').setAttribute('required', '');
                        document.getElementById('tl').setAttribute('required', '');
                        document.getElementById('jk').setAttribute('required', '');
                        document.getElementById('agama').setAttribute('required', '');
                        document.getElementById('alamat').setAttribute('required', '');
                        document.getElementById('pekerjaan').removeAttribute('required');
                        document.getElementById('wn').setAttribute('required', '');
                        document.getElementById('ayah').removeAttribute('required');
                        document.getElementById('ibu').removeAttribute('required');
                        document.getElementById('fkk').removeAttribute('required');
                        document.getElementById('fktp').setAttribute('required', '');
                        document.getElementById('ffoto').removeAttribute('required');
                    } else {
                        document.getElementById('input-nik').classList.add('d-none');
                        document.getElementById('input-nokk').classList.add('d-none');
                        document.getElementById('input-nama').classList.add('d-none');
                        document.getElementById('input-tl').classList.add('d-none');
                        document.getElementById('input-jk').classList.add('d-none');
                        document.getElementById('input-agama').classList.add('d-none');
                        document.getElementById('input-alamat').classList.add('d-none');
                        document.getElementById('input-pekerjaan').classList.add('d-none');
                        document.getElementById('input-wn').classList.add('d-none');
                        document.getElementById('input-ayah').classList.add('d-none');
                        document.getElementById('input-ibu').classList.add('d-none');
                        document.getElementById('input-fkk').classList.add('d-none');
                        document.getElementById('input-fktp').classList.add('d-none');
                        document.getElementById('input-ffoto').classList.add('d-none');
                    }
                };
            </script>

        </body>

        </html>
<?php
    } else if ($_SESSION['role'] == "admin") {
        header("Location: dashboard.php");
    }
}
?>