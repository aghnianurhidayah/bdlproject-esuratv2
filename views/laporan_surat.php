<?php
session_start();
require "../connect/db_connect.php";

if (!(isset($_SESSION['role']))) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="../styles/laporan_surat.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
</head>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    function fetchFilteredData() {
        const data = {
            ta: $('#ta').val(),
            ti: $('#ti').val(),
            jenis_surat: $('#jenis_surat').val(),
            status: $('#status').val()
        };

        $.ajax({
            url: 'filter_laporan.php',
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (response) {
                let tbody = '';
                if (response.length > 0) {
                    $.each(response, function (index, item) {
                        tbody += '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + item.tgl_masuk + '</td>' +
                            '<td>' + item.jenis_surat + '</td>' +
                            '<td>' + item.status + '</td>' +
                            '<td>' + item.jumlah + '</td>' +
                            '</tr>';
                    });
                } else {
                    tbody = '<tr><td colspan="5" style="text-align:center;">Data tidak ditemukan</td></tr>';
                }
                $('table tbody').html(tbody);
            },
            error: function () {
                alert('Terjadi kesalahan saat memuat data.');
            }
        });
    }

    fetchFilteredData();

    $('#ta, #ti, #jenis_surat, #status').on('change', function () {
        fetchFilteredData();
    });
});

</script>

<body>
    <?php include 'sidebar.php'; ?>
    <section class="main-content">
        <div class="content">
            <div class="header-wrapper">
                <div class="header">
                    <h2>Laporan</h2>
                    <p><?php echo date('l, d F Y'); ?></p>
                    <p><?php date_default_timezone_set('Asia/Makassar');
                        echo date('h:i a'); ?></p>
                </div>
            </div>

            <!-- Form Filter -->
            <div class="filter">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="ta">From</label>
                        <input type="date" name="ta" id="ta" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ti">To</label>
                        <input type="date" name="ti" id="ti" class="form-control">
                    </div>
                    <div class="form-group">
                        <select name="jenis_surat" id="jenis_surat" class="form-control">
                            <option value="">Jenis Surat</option>
                            <option value="Surat Keterangan">Surat Keterangan</option>
                            <option value="Surat Pengantar">Surat Pengantar</option>
                            <option value="Surat Pernyataan">Surat Pernyataan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="status" id="status" class="form-control">
                            <option value="">Status</option>
                            <option value="Proses">Proses</option>
                            <option value="Terima">Diterima</option>
                            <option value="Tolak">Ditolak</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Tabel Data -->
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Masuk</th>
                            <th>Jenis Surat</th>
                            <th>Status Surat</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script src="../scripts/script.js"></script>
</body>
</html>
