<?php
require "../connect/db_connect.php";

// Ambil semua data dari tabel surat
$get = mysqli_query($conn, "SELECT tgl_masuk, tgl_keluar, jenis_surat, status FROM surat");

$surat = [];
while ($row = mysqli_fetch_assoc($get)) {
    $surat[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Permintaan Surat Masuk dan Keluar</title>
    <link rel="stylesheet" href="../styles/laporan_surat.css" />
</head>

<body style="margin: 0px 50px;">
    <div class="header-surat" style="border-bottom: 2px solid black; text-align: center;">
        <h4 style="font-size: 18px; margin-bottom: 5px;">PEMERINTAHAN DESA SUKA MAJU<br>KECAMATAN KONGBENG KABUPATEN KUTAI TIMUR</h4>
        <p style="font-size: 12px;"><i>Alamat: Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, eos.</i></p>
    </div>

    <div class="title-surat">
        <h4 style="font-size: 18px; text-align: center;"><u>LAPORAN PERMINTAAN SURAT MASUK DAN KELUAR</u></h4>
    </div>

    <div class="content-surat" style="font-size: 18px; margin: 50px 0">
        <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
            <thead>
                <tr>
                    <th style="border: 1px solid black;">No</th>
                    <th style="border: 1px solid black;">Tanggal Masuk</th>
                    <th style="border: 1px solid black;">Tanggal Keluar</th>
                    <th style="border: 1px solid black;">Jenis Surat</th>
                    <th style="border: 1px solid black;">Status Surat</th>
                    <th style="border: 1px solid black;">Jumlah</th>
                </tr>
            </thead>
            <tbody style="text-align:center;">
                <?php
                $no = 1;
                foreach ($surat as $row) {
                    echo "<tr>";
                    echo "<td style='border: 1px solid black; text-align: center;'>$no</td>";
                    echo "<td style='border: 1px solid black;'>{$row['tgl_masuk']}</td>";
                    echo "<td style='border: 1px solid black;'>{$row['tgl_keluar']}</td>";
                    echo "<td style='border: 1px solid black;'>{$row['jenis_surat']}</td>";
                    echo "<td style='border: 1px solid black;'>{$row['status']}</td>";
                    echo "<td style='border: 1px solid black; text-align: center;'>1</td>"; // Bisa diganti dengan jumlah real jika ada
                    echo "</tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
