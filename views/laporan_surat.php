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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laporan</title>
    <link rel="stylesheet" href="../styles/laporan_surat.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function () {
        let filteredData = [];
        function fetchFilteredData() {
            const data = {
                ta: $('#ta').val(),
                ti: $('#ti').val(),
                jenis_surat: $('#jenis_surat').val(),
                status: $('#status').val()
            };

            $.ajax({
                url: 'get_laporan_data.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (response) {
                    filteredData = response;
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

        function updateExportLink() {
            const ta = $('#ta').val();
            const ti = $('#ti').val();
            const jenis_surat = $('#jenis_surat').val();
            const status = $('#status').val();

            let href = `../laporan/export_laporan.php?ta=${encodeURIComponent(ta)}&ti=${encodeURIComponent(ti)}&jenis_surat=${encodeURIComponent(jenis_surat)}&status=${encodeURIComponent(status)}`;
            $('#btnEksport').attr('href', href);
        }

        fetchFilteredData();
        updateExportLink();

        $('#ta, #ti, #jenis_surat, #status').on('change', function () {
            fetchFilteredData();
            updateExportLink();
        });

        $('#btnEksport').on('click', function(e) {
            e.preventDefault();

            if (filteredData.length === 0) {
                alert('Data kosong, tidak bisa export PDF!');
            } else {
                window.location.href = $(this).attr('href');
            }
        });
    });
    </script>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <section class="main-content">
        <div class="content">
            <div class="header-wrapper">
                <div class="header">
                    <h2>Laporan</h2>
                    <p><?php echo date('l, d F Y'); ?></p>
                    <p><?php date_default_timezone_set('Asia/Makassar'); echo date('h:i a'); ?></p>
                </div>
            </div>

            <!-- Form Filter -->
            <div class="filter">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="ta">From</label>
                        <input type="date" name="ta" id="ta" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="ti">To</label>
                        <input type="date" name="ti" id="ti" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="jenis_surat">Jenis Surat</label>
                        <select name="jenis_surat" id="jenis_surat" class="form-control">
                            <option value="">Jenis Surat</option>
                            <option value="Surat Keterangan">Surat Keterangan</option>
                            <option value="Surat Pengantar">Surat Pengantar</option>
                            <option value="Surat Pernyataan">Surat Pernyataan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Status</option>
                            <option value="Proses">Proses</option>
                            <option value="Terima">Terima</option>
                            <option value="Tolak">Tolak</option>
                            <option value="Batal">Batal</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="export" style="margin-top: 20px;">
                <a id="btnEksport" href="../laporan/export_laporan.php" target="_blank" class="btn-export">Export PDF</a>
            </div>

            <!-- Tabel Data -->
            <div class="table" style="margin-top: 20px;">
                <table border="1" width="100%" cellpadding="10" cellspacing="0">
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
                        <!-- Data dari AJAX akan muncul di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>
