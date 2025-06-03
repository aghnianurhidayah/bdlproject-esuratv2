<?php
session_start();
require "../../connect/db_connect.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    http_response_code(403);
    exit('Akses ditolak');
} else {
    if ($_SESSION['role'] == "user") {

        if (isset($_POST['submitform'])) {
            $query = "SELECT spn_akte_kelahiran_id FROM spn_akte_kelahiran ORDER BY spn_akte_kelahiran_id DESC LIMIT 1";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $last_id_num = (int)substr($row['spn_akte_kelahiran_id'], 5);
                $new_id_num = $last_id_num + 1;
            } else {
                $new_id_num = 1;
            }

            $spn_akte_kelahiran_id = "AKL-" . str_pad($new_id_num, 4, '0', STR_PAD_LEFT);
            $nik_user = $_SESSION['nik'];
            $nokk = $_POST['nokk'];
            $nama = $_POST['nama'];
            $tl = $_POST['tl'];
            $jk = $_POST['jk'];
            $agama = $_POST['agama'];
            $alamat = $_POST['alamat'];
            $wn = $_POST['wn'];
            $ayah = $_POST['ayah'];
            $ibu = $_POST['ibu'];
            $fkk = strtolower(end(explode('.', $_FILES['fkk']['name'])));

            $file_kk = "kk.$nama.$fkk";
            $tmp_kk = $_FILES['fkk']['tmp_name'];

            $tgl_masuk = date('Y-m-d');

            if (is_uploaded_file($tmp_kk) && file_exists($tmp_kk)) {
                move_uploaded_file($tmp_kk, "../../img/kk/" . $file_kk);
            } else {
                $file_kk = '';
            }

            $insert_surat = "INSERT INTO surat VALUES ('$spn_akte_kelahiran_id', '$nik_user', 'Surat Pernyataan Tidak Memiliki Akte Kelahiran', 'Surat Pernyataan', '0', '$tgl_masuk', '0', 'Proses')";
            $result = $conn->query($insert_surat);

            if ($result) {
                $insert_form = "INSERT INTO spn_akte_kelahiran VALUES ('$spn_akte_kelahiran_id', '$nokk', '$nama', '$tl', '$jk', '$agama', '$alamat', '$wn', '$ayah', '$ibu', '$file_kk')";
                $result = $conn->query($insert_form);

                echo "
                    <script>
                        alert('Formulir Berhasil Diisi!');
                        document.location.href = '../hist.php';
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
        </head>

        <body>
            <form action="surat/pernyataan_akte_kelahiran.php" method="post" enctype="multipart/form-data">
                <div class="input-box d-none" id="input-nokk">
                    <label for="nokk">No KK</label>
                    <input type="number" name="nokk" id="nokk" onkeypress="isInputNumber(event)" minlength="16" maxlength="16" class="textfield" placeholder="Masukan No. KK">
                </div>
                <div class="input-box d-none" id="input-nama">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="textfield" placeholder="Masukan Nama Lengkap">
                </div>
                <div class="input-box d-none" id="input-tl">
                    <label for="tl">Tanggal Lahir</label>
                    <input type="date" name="tl" id="tl" class="textfield" placeholder="Masukan Tanggal Lahir">
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
                <input class="button" type="submit" value="Kirim" name="submitform">
            </form>
        </body>

        </html>
<?php
    } else if ($_SESSION['role'] == "admin") {
        header("Location: dashboard.php");
    }
}
?>