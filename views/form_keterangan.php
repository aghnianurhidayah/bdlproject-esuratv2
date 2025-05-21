<?php
session_start();

if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
} else {
    if ($_SESSION['role'] == "user") {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>e-SukMa | Formulir Keterangan</title>

            <link rel="stylesheet" href="../styles/userstyle.css">
        </head>

        <body>
            <?php include 'navbar.php'; ?>

            <div class="form">
                <div class="form-title">
                    <p>Silahkan Isi Formulir Berikut</p>
                </div>
                <div class="select-box">
                    <div class="input-box">
                        <label for="surat">Pilih Surat</label>
                        <select name="surat" onchange="loadForm(this)" required>
                            <option value="">Pilih Surat</option>
                            <option value="keterangan_kelahiran">Surat Keterangan Kelahiran</option>
                            <option value="keterangan_kematian">Surat Keterangan Kematian</option>
                            <option value="keterangan_domisili">Surat Keterangan Domisili</option>
                            <option value="keterangan_tidak_mampu">Surat Keterangan Tidak Mampu</option>
                        </select>
                    </div>
                </div>
                <div class="form-box" id="form-container">

                </div>
            </div>
            <script src="../scripts/script.js"></script>
        </body>

        </html>
<?php
    } else if ($_SESSION['role'] == "admin") {
        header("Location: dashboard.php");
    }
}
?>