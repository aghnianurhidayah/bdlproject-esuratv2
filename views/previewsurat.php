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
            <link rel="stylesheet" href="../styles/previewsurat.css" />
            <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
        </head>

        <body>

            <?php include 'sidebar.php'; ?>

            <section class="main-content">
                <div class="content">
                    <div class="header-wrapper">
                        <div class="header">
                            <h2>Surat Masuk</h2>
                            <p><?php echo date('l, d F Y'); ?></p>
                            <p><?php date_default_timezone_set('Asia/Makassar');
                                echo date('h:i a'); ?></p>
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