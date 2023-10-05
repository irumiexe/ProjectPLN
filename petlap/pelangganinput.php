<?php
include 'header.php';

// Pastikan user sudah login dan ada informasi kd_akun_user di sesi
if (!isset($_SESSION['kd_akun_user'])) {
    // Jika tidak, mungkin redirect ke halaman login atau lakukan tindakan lain
    header("Location: login.php");
    exit();
}

// Ambil kd_akun_user dari sesi
$kd_akun_user = $_SESSION['kd_akun_user'];

// Ambil tanggal hari ini
$tanggal_hari_ini = date('Y-m-d');

// Query untuk menghitung jumlah data pada tanggal hari ini untuk kd_akun tertentu
$query_hitung_data = "SELECT COUNT(*) as jumlah_data FROM tbl_pelanggan WHERE tanggal = '$tanggal_hari_ini' AND kd_akun = '$kd_akun_user'";
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
            </div>
            <div>
                <br>
                <p>Tanggal Hari Ini: <?php echo $tanggal_hari_ini; ?></p>
                <p>Jumlah Data Hari Ini: <?php echo $jumlah_data; ?></p>
            </div>

        </div>
    </div>
</div>