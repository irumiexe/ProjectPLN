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

// Inisialisasi tanggal hari ini jika tidak ada tanggal yang dipilih
$tanggal_dipilih = date('Y-m-d');

// Jika pengguna memilih tanggal
if (isset($_POST['pilih_tanggal'])) {
    $tanggal_dipilih = $_POST['tanggal'];
}

// Query untuk menghitung jumlah data pada tanggal yang dipilih untuk kd_akun tertentu
$query_hitung_data = "SELECT COUNT(*) as jumlah_data FROM tbl_pelanggan WHERE tanggal = '$tanggal_dipilih' AND kd_akun = '$kd_akun_user'";
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
            </div>
            <br>
            <form method="post">
                <div class="form-group">
                    <label for="tanggal">Pilih Tanggal: </label>
                    <input type="date" name="tanggal" class="form-control" value="<?php echo $tanggal_dipilih; ?>">
                    <button type="submit" name="pilih_tanggal" class="btn btn-success mt-2">Pilih</button>
                </div>

            </form>
            <br>
            <div>
                <p>Tanggal Dipilih: <?php echo $tanggal_dipilih; ?></p>
                <p>Jumlah Data: <?php echo $jumlah_data; ?></p>
            </div>
        </div>
    </div>