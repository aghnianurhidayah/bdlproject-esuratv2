<?php

$ta = $_GET['ta'] ?? '';
$ti = $_GET['ti'] ?? '';
$jenis_surat = $_GET['jenis_surat'] ?? '';
$status = $_GET['status'] ?? '';

$query = "SELECT tgl_masuk, tgl_keluar, jenis_surat, status, COUNT(*) as jumlah 
          FROM surat 
          WHERE 1=1";

$params = [];
$types = "";

if (!empty($ta)) {
    $query .= " AND tgl_masuk >= ?";
    $params[] = $ta;
    $types .= "s";
}
if (!empty($ti)) {
    $query .= " AND tgl_masuk <= ?";
    $params[] = $ti;
    $types .= "s";
}
if (!empty($jenis_surat)) {
    $query .= " AND jenis_surat = ?";
    $params[] = $jenis_surat;
    $types .= "s";
}
if (!empty($status)) {
    $query .= " AND status = ?";
    $params[] = $status;
    $types .= "s";
}

$query .= " GROUP BY tgl_masuk, tgl_keluar, jenis_surat, status ORDER BY tgl_masuk DESC";

$stmt = $conn->prepare($query);

if ($params) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();

$result = $stmt->get_result();

$surat = [];
while ($row = $result->fetch_assoc()) {
    $surat[] = $row;
}

return $surat;
