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
            $query = "SELECT skm_id FROM sk_kematian ORDER BY skm_id DESC LIMIT 1";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Ambil bagian angkanya saja dari ID (contoh: dari EKTP-0025 jadi 25)
                $last_id_num = (int)substr($row['skm_id'], 5);
                $new_id_num = $last_id_num + 1;
            } else {
                // Jika belum ada data, mulai dari 1
                $new_id_num = 1;
            }

            $skm_id = "KMT-" . str_pad($new_id_num, 4, '0', STR_PAD_LEFT);
            $nik_user = $_SESSION['nik'];
            $nik = $_POST['nik'];
            $nokk = $_POST['nokk'];
            $nama = $_POST['nama'];
            $tl = $_POST['tl'];
            $tm = $_POST['tm'];
            $jk = $_POST['jk'];
            $agama = $_POST['agama'];
            $alamat = $_POST['alamat'];
            $fkk = strtolower(end(explode('.', $_FILES['fkk']['name'])));
            $fktp = strtolower(end(explode('.', $_FILES['fktp']['name'])));

            $file_kk = "kk.$nama.$fkk";
            $file_ktp = "ktp.$nama.$fktp";
            $tmp_kk = $_FILES['fkk']['tmp_name'];
            $tmp_ktp = $_FILES['fktp']['tmp_name'];

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

            $insert_surat = "INSERT INTO surat VALUES ('$skm_id', '$nik_user', 'Surat Keterangan Kematian', 'Surat Keterangan','0', '$tgl_masuk', '0', 'Proses')";
            $result = $conn->query($insert_surat);
            
            if ($result) {
                
                $insert_form = "INSERT INTO sk_kematian VALUES ('$skm_id', '$nik', '$nokk', '$nama', '$tl', '$tm', '$jk', '$agama', '$alamat', '$wn', '$file_kk', '$file_ktp')";
                $result = $conn->query($insert_surat);

                echo "
                    <script>
                        alert('Formulir Berhasil Diisi!');
                        document.location.href = '../hist.php';
                    </script>";
            } else {
                echo ", '$file_fot
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
            <form action="surat/keterangan_kematian.php" method="post" enctype="multipart/form-data">
                <div class="input-box d-none" id="input-nik">
                    <label for="nik">NIK</label>
                    <input type="number" name="nik" id="nik" class="textfield" onkeypress="isInputNumber(event)" minlength="16" maxlength="16" class="textfield" placeholder="Masukan No. KK">
                </div>
                <div class="input-box d-none" id="input-nokk">
                    <label for="nokk">No KK</label>
                    <input type="number" name="nokk" id="nokk" class="textfield" onkeypress="isInputNumber(event)" minlength="16" maxlength="16" class="textfield" placeholder="Masukan No. KK">
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
                <div class="input-box d-none" id="input-tk">
                    <label for="tl">Tanggal Kematian</label>
                    <input type="date" name="tk" id="tk" class="textfield" placeholder="Masukan Tanggal Kematian">
                </div>
                <div class="input-box d-none" id="input-fkk">
                    <label for="fkk">Upload File KK</label>
                    <input type="file" name="fkk" id="fkk" class="filefield" placeholder="Upload File KK">
                </div>
                <div class="input-box d-none" id="input-fktp">
                    <label for="fktp">Upload File KTP</label>
                    <input type="file" name="fktp" id="fktp" class="filefield" placeholder="Upload File KTP">
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