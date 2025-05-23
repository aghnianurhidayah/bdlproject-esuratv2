<?php

session_start();
require "../connect/db_connect.php";

if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
} else {
    if ($_SESSION['role'] == "user") {

        $surat_id = $_GET['surat_id'];
        $cancelsurat = mysqli_query($conn, "UPDATE surat SET status = 'Batal' WHERE surat_id = $surat_id");

        if ($cancelsurat) {
            echo "
            <script>
                alert('Form Berhasil Dibatalkan!');
                document.location.href = 'hist.php';
            </script>";
        } else {
            echo "
                <script>
                    alert('Form Gagal Dibatalkan!');
                    document.location.href = 'hist.php';
                </script>";
        }
    } else {
        echo "
            <script>
                alert('Form Gagal Dihapus!');
                document.location.href = 'hist.php';
            </script>";
    }
}
