<?php
session_start();
require "../connect/db_connect.php";

if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
}

$ta = $_GET['ta'] ?? '';
$ti = $_GET['ti'] ?? '';
$jenis_surat = $_GET['jenis_surat'] ?? '';
$status = $_GET['status'] ?? '';

$surat = include '../views/filter_laporan.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Laporan Permintaan Surat Masuk dan Keluar</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }

        .header-surat {
            border-bottom: 2px solid black;
            text-align: center;
            margin-bottom: 20px;
        }

        .header-surat h4 {
            margin: 0;
            font-size: 16px;
        }

        .header-surat p {
            font-size: 12px;
            font-style: italic;
        }

        .title-surat {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 16px;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="header-surat">
        <h4>PEMERINTAHAN DESA SUKA MAJU<br>KECAMATAN KONGBENG KABUPATEN KUTAI TIMUR</h4>
        <p>Alamat: Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, eos.</p>
    </div>

    <div class="title-surat">LAPORAN PERMINTAAN SURAT MASUK DAN KELUAR</div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Keluar</th>
                <th>Jenis Surat</th>
                <th>Status Surat</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (!empty($surat)) {
                foreach ($surat as $row) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['tgl_masuk']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tgl_keluar']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['jenis_surat']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['jumlah']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Data tidak ditemukan</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
