<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require "../connect/db_connect.php";

$from = $_POST['ta'] ?? '';
$to = $_POST['ti'] ?? '';
$jenis = $_POST['jenis_surat'] ?? '';
$status = $_POST['status'] ?? '';


$query = "SELECT tgl_masuk, tgl_keluar, jenis_surat, status, COUNT(*) AS jumlah 
          FROM surat 
          WHERE 1=1";

if (!empty($from)) {
    $query .= " AND tgl_masuk >= '$from'";
}

if (!empty($to)) {
    $query .= " AND tgl_keluar <= '$to'";
}

if (!empty($jenis)) {
    $query .= " AND jenis_surat = '$jenis'";
}

if (!empty($status)) {
    $query .= " AND status = '$status'";
}

$query .= " GROUP BY tgl_masuk, tgl_keluar, jenis_surat, status 
            ORDER BY tgl_masuk DESC";

$sql_surat = mysqli_query($conn, $query);

$surat = [];
while ($row = mysqli_fetch_assoc($sql_surat)) {
    $surat[] = $row;
}

echo json_encode($surat);
