<?php
include 'header.php';

// Ambil tanggal hari ini
$tanggal_hari_ini = date('Y-m-d');

// Query untuk menghitung jumlah data pada tanggal hari ini
$query_hitung_data = "SELECT COUNT(*) as jumlah_data FROM tbl_pelanggan WHERE tanggal = '$tanggal_hari_ini'";
$result_hitung_data = mysqli_query($db, $query_hitung_data);
$data_hitung = mysqli_fetch_assoc($result_hitung_data);
$jumlah_data = $data_hitung['jumlah_data'];
?>

<div class="container-xl">
    <div class="row">
        <ol class="breadcrumb">
            <h4>INPUT DATA PELANGGAN</h4>
        </ol>
    </div>
    <div class="panel-container">
        <div class="bootstrap-tabel">
            <div class="d-flex justify-content-between mb-3">
                <a href="pelangganaksi.php?aksi=tambah" class="btn btn-primary">Tambah Data</a>

                <!-- Tampilkan tanggal dan jumlah data -->
                <div>
                    <p>Tanggal Hari Ini: <?php echo $tanggal_hari_ini; ?></p>
                    <p>Jumlah Data Hari Ini: <?php echo $jumlah_data; ?></p>
                </div>
            </div>
            <hr>

        </div>
    </div>
</div>