<?php
session_start();
require "../connect/db_connect.php";

if (!(isset($_SESSION['role'])) || $_SESSION['role'] != "admin") {
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$from = $_POST['ta'] ?? '';
$to = $_POST['ti'] ?? '';
$jenis = $_POST['jenis_surat'] ?? '';
$status = $_POST['status'] ?? '';

$query = "SELECT tgl_masuk, jenis_surat, status, COUNT(*) AS jumlah 
          FROM surat 
          WHERE 1=1";

if (!empty($from)) {
    $query .= " AND tgl_masuk >= '$from'";
}

if (!empty($to)) {
    $query .= " AND tgl_masuk <= '$to'";
}

if (!empty($jenis) && $jenis !== "Jenis Surat") {
    $query .= " AND jenis_surat = '$jenis'";
}

if (!empty($status) && $status !== "Status") {
    $query .= " AND status = '$status'";
}

$query .= " GROUP BY tgl_masuk, jenis_surat, status 
            ORDER BY tgl_masuk DESC";

$sql_surat = mysqli_query($conn, $query);

$surat = [];
while ($row = mysqli_fetch_assoc($sql_surat)) {
    $surat[] = $row;
}

echo json_encode($surat);
?>
