<?php
session_start();
require "../connect/db_connect.php";


if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
} else {
    if ($_SESSION['role'] == "user") {

        $form_id = $_GET['form_id'];
        $get = mysqli_query($conn, "SELECT * FROM forms WHERE form_id = $form_id");
        $form = [];

        while ($row = mysqli_fetch_assoc($get)) {
            $form[] = $row;
        }
        $form = $form[0];

        if (isset($_POST['editform'])) {
            $nik = $_POST['nik'];
            $nokk = $_POST['nokk'];
            $nama = $_POST['nama'];
            $tl = $_POST['tl'];
            $tk = $_POST['tk'];
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
            $surat = $form['nama_surat'];

            $file_kk = "kk_$surat_$nama.$fkk";
            $file_ktp = "ktp_$surat_$nama.$fktp";
            $file_foto = "foto_$surat_$nama.$ffoto";
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

            $update_form = "UPDATE forms SET nik = '$nik', no_kk = '$nokk', nama = '$nama', tgl_lahir = '$tl', tgl_kematian = '$tk', jenis_kelamin = '$jk', agama = '$agama', alamat = '$alamat', pekerjaan = '$pekerjaan', kewarganegaraan = '$wn', nama_ayah = '$ayah', nama_ibu = '$ibu', file_kk = '$fkk', file_ktp = '$fktp', file_foto = '$ffoto' WHERE form_id = '$form_id'";
            $result = $conn->query($update_form);

            if ($result) {
                echo "
                    <script>
                        alert('Formulir Berhasil Diubah!');
                        document.location.href = 'hist.php';
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
            <title>e-SukMa | Ubah Form</title>

            <link rel="stylesheet" href="../styles/userstyle.css">
        </head>

        <body>
            <?php include 'navbar.php'; ?>

            <div class="form">
                <div class="form-title">
                    <p>Ubah Form</p>
                </div>
                <div class="form-box">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="input-box">
                            <label for="surat">Nama Surat</label>
                            <input type="text" name="surat" class="textfield" value="<?= $form['nama_surat'] ?>" disabled>
                        </div>
                        <div class="input-box d-none" id="input-nik">
                            <label for="nik">NIK</label>
                            <input type="number" name="nik" id="nik" class="textfield" value="<?= $form['nik'] ?>" placeholder="Masukan NIK" disable>
                        </div>
                        <div class="input-box d-none" id="input-nokk">
                            <label for="nokk">No KK</label>
                            <input type="number" name="nokk" id="nokk" class="textfield" value="<?= $form['no_kk'] ?>" placeholder="Masukan No. KK">
                        </div>
                        <div class="input-box d-none" id="input-nama">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="textfield" value="<?= $form['nama'] ?>" placeholder="Masukan Nama Lengkap">
                        </div>
                        <div class="input-box d-none" id="input-tl">
                            <label for="tl">Tanggal Lahir</label>
                            <input type="date" name="tl" id="tl" class="textfield" value="<?= $form['tgl_lahir'] ?>" placeholder="Masukan Tanggal Lahir">
                        </div>
                        <div class="input-box d-none" id="input-tk">
                            <label for="tl">Tanggal Kematian</label>
                            <input type="date" name="tk" id="tk" class="textfield" value="<?= $form['tgl_kematian'] ?>" placeholder="Masukan Tanggal Kematian">
                        </div>
                        <div class="input-box d-none" id="input-jk">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" id="jk">
                                <option value="<?= $form['jenis_kelamin'] ?>" selected><?= $form['jenis_kelamin'] ?></option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="input-box d-none" id="input-agama">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama">
                                <option value="<?= $form['agama'] ?>" selected><?= $form['agama'] ?></option>
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
                            <input type="text" name="alamat" id="alamat" class="textfield" value="<?= $form['alamat'] ?>" placeholder="Masukan Alamat">
                        </div>
                        <div class="input-box d-none" id="input-pekerjaan">
                            <label for="pekerjaan">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" class="textfield" value="<?= $form['pekerjaan'] ?>" placeholder="Masukan Pekerjaan">
                        </div>
                        <div class="input-box d-none" id="input-wn">
                            <label for="wn">Kewarganegaraan</label>
                            <input type="text" name="wn" id="wn" class="textfield" value="<?= $form['kewarganegaraan'] ?>" placeholder="Masukan Kewarganegaraan">
                        </div>
                        <div class="input-box d-none" id="input-ayah">
                            <label for="ayah">Nama Ayah Kandung</label>
                            <input type="text" name="ayah" id="ayah" class="textfield" value="<?= $form['ayah'] ?>" placeholder="Masukan Nama Ayah">
                        </div>
                        <div class="input-box d-none" id="input-ibu">
                            <label for="ibu">Nama Ibu Kandung</label>
                            <input type="text" name="ibu" id="ibu" class="textfield" value="<?= $form['ibu'] ?>" placeholder="Masukan Nama Ibu">
                        </div>
                        <div class="input-box d-none" id="input-fkk">
                            <label for="fkk">Upload File KK</label>
                            <input type="file" name="fkk" id="fkk" class="filefield" value="<?= $form['file_kk'] ?>" placeholder="Upload File KK">
                        </div>
                        <div class="input-box d-none" id="input-fktp">
                            <label for="fktp">Upload File KTP</label>
                            <input type="file" name="fktp" id="fktp" class="filefield" value="<?= $form['file_ktp'] ?>" placeholder="Upload File KTP">
                        </div>
                        <div class="input-box d-none" id="input-ffoto">
                            <label for="ffoto">Upload File Foto 3x4</label>
                            <input type="file" name="ffoto" id="ffoto" class="filefield" value="<?= $form['file_foto'] ?>" placeholder="Upload File Foto 3x4">
                        </div>
                        <input class="button" type="submit" value="Kirim" name="editform">
                    </form>
                </div>
            </div>


            <script>
                var nama_surat = "<?= $form['nama_surat'] ?>";
                if (nama_surat == "Surat Keterangan Kelahiran") {
                    document.getElementById('input-nik').classList.add('d-none');
                    document.getElementById('input-nokk').classList.remove('d-none');
                    document.getElementById('input-nama').classList.remove('d-none');
                    document.getElementById('input-tl').classList.remove('d-none');
                    document.getElementById('input-tk').classList.add('d-none');
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
                    document.getElementById('tk').removeAttribute('required');
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
                } else if (nama_surat == "Surat Keterangan Kematian") {
                    document.getElementById('input-nik').classList.remove('d-none');
                    document.getElementById('input-nokk').classList.remove('d-none');
                    document.getElementById('input-nama').classList.remove('d-none');
                    document.getElementById('input-tl').classList.add('d-none');
                    document.getElementById('input-tk').classList.remove('d-none');
                    document.getElementById('input-jk').classList.remove('d-none');
                    document.getElementById('input-agama').classList.remove('d-none');
                    document.getElementById('input-alamat').classList.remove('d-none');
                    document.getElementById('input-pekerjaan').classList.add('d-none');
                    document.getElementById('input-wn').classList.add('d-none');
                    document.getElementById('input-ayah').classList.add('d-none');
                    document.getElementById('input-ibu').classList.add('d-none');
                    document.getElementById('input-fkk').classList.remove('d-none');
                    document.getElementById('input-fktp').classList.add('d-none');
                    document.getElementById('input-ffoto').classList.add('d-none');
                    //  set required
                    document.getElementById('nik').setAttribute('required', '');
                    document.getElementById('nokk').setAttribute('required', '');
                    document.getElementById('nama').setAttribute('required', '');
                    document.getElementById('tl').removeAttribute('required');
                    document.getElementById('tk').setAttribute('required', '');
                    document.getElementById('jk').setAttribute('required', '');
                    document.getElementById('agama').setAttribute('required', '');
                    document.getElementById('alamat').setAttribute('required', '');
                    document.getElementById('pekerjaan').removeAttribute('required');
                    document.getElementById('wn').removeAttribute('required');
                    document.getElementById('ayah').removeAttribute('required');
                    document.getElementById('ibu').removeAttribute('required');
                    document.getElementById('fkk').setAttribute('required', '');
                    document.getElementById('fktp').removeAttribute('required');
                    document.getElementById('ffoto').removeAttribute('required');
                } else if (nama_surat == "Surat Keterangan Domisili") {
                    document.getElementById('input-nik').classList.remove('d-none');
                    document.getElementById('input-nokk').classList.remove('d-none');
                    document.getElementById('input-nama').classList.remove('d-none');
                    document.getElementById('input-tl').classList.remove('d-none');
                    document.getElementById('input-tk').classList.add('d-none');
                    document.getElementById('input-jk').classList.remove('d-none');
                    document.getElementById('input-agama').classList.remove('d-none');
                    document.getElementById('input-alamat').classList.remove('d-none');
                    document.getElementById('input-pekerjaan').classList.add('d-none');
                    document.getElementById('input-wn').classList.remove('d-none');
                    document.getElementById('input-ayah').classList.add('d-none');
                    document.getElementById('input-ibu').classList.add('d-none');
                    document.getElementById('input-fkk').classList.remove('d-none');
                    document.getElementById('input-fktp').classList.remove('d-none');
                    document.getElementById('input-ffoto').classList.add('d-none');
                    // set required
                    document.getElementById('nik').setAttribute('required', '');
                    document.getElementById('nokk').setAttribute('required', '');
                    document.getElementById('nama').setAttribute('required', '');
                    document.getElementById('tl').setAttribute('required', '');
                    document.getElementById('tk').removeAttribute('required');
                    document.getElementById('jk').setAttribute('required', '');
                    document.getElementById('agama').setAttribute('required', '');
                    document.getElementById('alamat').setAttribute('required', '');
                    document.getElementById('pekerjaan').removeAttribute('required');
                    document.getElementById('wn').setAttribute('required', '');
                    document.getElementById('ayah').removeAttribute('required');
                    document.getElementById('ibu').removeAttribute('required');
                    document.getElementById('fkk').setAttribute('required', '');
                    document.getElementById('fktp').setAttribute('required', '');
                    document.getElementById('ffoto').removeAttribute('required');
                } else if (nama_surat == "Surat Keterangan Tidak Mampu") {
                    document.getElementById('input-nik').classList.remove('d-none');
                    document.getElementById('input-nokk').classList.remove('d-none');
                    document.getElementById('input-nama').classList.remove('d-none');
                    document.getElementById('input-tl').classList.remove('d-none');
                    document.getElementById('input-tk').classList.add('d-none');
                    document.getElementById('input-jk').classList.remove('d-none');
                    document.getElementById('input-agama').classList.remove('d-none');
                    document.getElementById('input-alamat').classList.remove('d-none');
                    document.getElementById('input-pekerjaan').classList.remove('d-none');
                    document.getElementById('input-wn').classList.add('d-none');
                    document.getElementById('input-ayah').classList.add('d-none');
                    document.getElementById('input-ibu').classList.add('d-none');
                    document.getElementById('input-fkk').classList.remove('d-none');
                    document.getElementById('input-fktp').classList.remove('d-none');
                    document.getElementById('input-ffoto').classList.add('d-none');
                    // set required
                    document.getElementById('nik').setAttribute('required', '');
                    document.getElementById('nokk').setAttribute('required', '');
                    document.getElementById('nama').setAttribute('required', '');
                    document.getElementById('tl').setAttribute('required', '');
                    document.getElementById('tk').removeAttribute('required');
                    document.getElementById('jk').setAttribute('required', '');
                    document.getElementById('agama').setAttribute('required', '');
                    document.getElementById('alamat').setAttribute('required', '');
                    document.getElementById('pekerjaan').setAttribute('required', '');
                    document.getElementById('wn').removeAttribute('required');
                    document.getElementById('ayah').removeAttribute('required');
                    document.getElementById('ibu').removeAttribute('required');
                    document.getElementById('fkk').setAttribute('required', '');
                    document.getElementById('fktp').setAttribute('required', '');
                    document.getElementById('ffoto').removeAttribute('required');
                } else if (nama_surat == "Surat Pengantar e-KTP") {
                    document.getElementById('input-nik').classList.remove('d-none');
                    document.getElementById('input-nokk').classList.remove('d-none');
                    document.getElementById('input-nama').classList.remove('d-none');
                    document.getElementById('input-tl').classList.remove('d-none');
                    document.getElementById('input-tk').classList.add('d-none');
                    document.getElementById('input-jk').classList.remove('d-none');
                    document.getElementById('input-agama').classList.remove('d-none');
                    document.getElementById('input-alamat').classList.remove('d-none');
                    document.getElementById('input-pekerjaan').classList.add('d-none');
                    document.getElementById('input-wn').classList.remove('d-none');
                    document.getElementById('input-ayah').classList.add('d-none');
                    document.getElementById('input-ibu').classList.add('d-none');
                    document.getElementById('input-fkk').classList.remove('d-none');
                    document.getElementById('input-fktp').classList.add('d-none');
                    document.getElementById('input-ffoto').classList.remove('d-none');
                    // set required
                    document.getElementById('nik').setAttribute('required', '');
                    document.getElementById('nokk').setAttribute('required', '');
                    document.getElementById('nama').setAttribute('required', '');
                    document.getElementById('tl').setAttribute('required', '');
                    document.getElementById('tk').removeAttribute('required');
                    document.getElementById('jk').setAttribute('required', '');
                    document.getElementById('agama').setAttribute('required', '');
                    document.getElementById('alamat').setAttribute('required', '');
                    document.getElementById('pekerjaan').setAttribute('required', '');
                    document.getElementById('wn').setAttribute('required', '');
                    document.getElementById('ayah').removeAttribute('required', '');
                    document.getElementById('ibu').removeAttribute('required', '');
                    document.getElementById('fkk').setAttribute('required', '');
                    document.getElementById('fktp').removeAttribute('required');
                    document.getElementById('ffoto').setAttribute('required', '');
                } else if (nama_surat == "Surat Pengantar Nikah") {
                    document.getElementById('input-nik').classList.remove('d-none');
                    document.getElementById('input-nokk').classList.remove('d-none');
                    document.getElementById('input-nama').classList.remove('d-none');
                    document.getElementById('input-tl').classList.remove('d-none');
                    document.getElementById('input-tk').classList.add('d-none');
                    document.getElementById('input-jk').classList.remove('d-none');
                    document.getElementById('input-agama').classList.remove('d-none');
                    document.getElementById('input-alamat').classList.remove('d-none');
                    document.getElementById('input-pekerjaan').classList.remove('d-none');
                    document.getElementById('input-wn').classList.remove('d-none');
                    document.getElementById('input-ayah').classList.add('d-none');
                    document.getElementById('input-ibu').classList.add('d-none');
                    document.getElementById('input-fkk').classList.remove('d-none');
                    document.getElementById('input-fktp').classList.remove('d-none');
                    document.getElementById('input-ffoto').classList.remove('d-none');
                    // set required
                    document.getElementById('nik').setAttribute('required', '');
                    document.getElementById('nokk').setAttribute('required', '');
                    document.getElementById('nama').setAttribute('required', '');
                    document.getElementById('tl').setAttribute('required', '');
                    document.getElementById('tk').removeAttribute('required');
                    document.getElementById('jk').setAttribute('required', '');
                    document.getElementById('agama').setAttribute('required', '');
                    document.getElementById('alamat').setAttribute('required', '');
                    document.getElementById('pekerjaan').setAttribute('required', '');
                    document.getElementById('wn').setAttribute('required', '');
                    document.getElementById('ayah').removeAttribute('required', '');
                    document.getElementById('ibu').removeAttribute('required', '');
                    document.getElementById('fkk').setAttribute('required', '');
                    document.getElementById('fktp').setAttribute('required', '');
                    document.getElementById('ffoto').setAttribute('required', '');
                } else if (nama_surat == "Surat Pengantar SKCK") {
                    document.getElementById('input-nik').classList.remove('d-none');
                    document.getElementById('input-nokk').classList.remove('d-none');
                    document.getElementById('input-nama').classList.remove('d-none');
                    document.getElementById('input-tl').classList.remove('d-none');
                    document.getElementById('input-tk').classList.add('d-none');
                    document.getElementById('input-jk').classList.remove('d-none');
                    document.getElementById('input-agama').classList.remove('d-none');
                    document.getElementById('input-alamat').classList.remove('d-none');
                    document.getElementById('input-pekerjaan').classList.remove('d-none');
                    document.getElementById('input-wn').classList.add('d-none');
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
                    document.getElementById('tk').removeAttribute('required');
                    document.getElementById('jk').setAttribute('required', '');
                    document.getElementById('agama').setAttribute('required', '');
                    document.getElementById('alamat').setAttribute('required', '');
                    document.getElementById('pekerjaan').setAttribute('required', '');
                    document.getElementById('wn').removeAttribute('required');
                    document.getElementById('ayah').removeAttribute('required', '');
                    document.getElementById('ibu').removeAttribute('required', '');
                    document.getElementById('fkk').removeAttribute('required');
                    document.getElementById('fktp').setAttribute('required', '');
                    document.getElementById('ffoto').removeAttribute('required');
                } else if (nama_surat == "Surat Pernyataan Tidak Memiliki Akte Kelahiran") {
                    document.getElementById('input-nik').classList.add('d-none');
                    document.getElementById('input-nokk').classList.remove('d-none');
                    document.getElementById('input-nama').classList.remove('d-none');
                    document.getElementById('input-tl').classList.remove('d-none');
                    document.getElementById('input-tk').classList.add('d-none');
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
                    document.getElementById('tk').removeAttribute('required');
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
                } else if (nama_surat == "Surat Pernyataan Janda/Duda") {
                    document.getElementById('input-nik').classList.remove('d-none');
                    document.getElementById('input-nokk').classList.remove('d-none');
                    document.getElementById('input-nama').classList.remove('d-none');
                    document.getElementById('input-tl').classList.remove('d-none');
                    document.getElementById('input-tk').classList.add('d-none');
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
                    document.getElementById('tk').removeAttribute('required');
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
                }
            </script>

        </body>

        </html>
<?php
    } else if ($_SESSION['role'] == "admin") {
        header("Location: dashboard.php");
    }
}
?>