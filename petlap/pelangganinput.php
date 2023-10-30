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

$query_hitung_data_target = "SELECT COUNT(*) as jumlah_data_target FROM tbl_target WHERE kd_akun = '$kd_akun_user' AND ('$tanggal_dipilih' BETWEEN tanggal AND tanggal_akhir)";
$result_hitung_data_target = mysqli_query($db, $query_hitung_data_target);
$data_hitung_target = mysqli_fetch_assoc($result_hitung_data_target);
$jumlah_data_target = $data_hitung_target['jumlah_data_target'];

// Hitung jumlah total data
$query = $db->query("SELECT * FROM tbl_target");
$totalData = $query->num_rows;

// Tentukan jumlah data per halaman
$dataPerPage = 1;

// Hitung jumlah halaman
$totalPages = ceil($totalData / $dataPerPage);

// Ambil parameter halaman dari URL
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Hitung indeks awal dan akhir data yang harus ditampilkan
$startIndex = ($currentPage - 1) * $dataPerPage;
$endIndex = $startIndex + $dataPerPage;

$petlap_data = array();

while ($row = $query->fetch_assoc()) {
    $petlap_data[] = $row;
}

$query = $db->query("SELECT * FROM tbl_akun WHERE level='1'");
$petlap_data = array();

while ($row = $query->fetch_assoc()) {
    $petlap_data[] = $row;
}


?>

<style>
    .card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        text-align: center;
    }

    .card-header {
        background-color: #CDF5FD
    }

    @media (max-width: 768px) {
        .mx-3 {
            margin-right: 0;
            margin-left: 0;
            /* Hapus margin kiri pada layar kecil */
        }
    }
</style>

<div class="container-xl">
    <div class="row">
        <ol class="breadcrumb">
            <h4>INPUT DATA PELANGGAN</h4>
        </ol>
    </div>
    <div class="panel-container">
        <div class="bootstrap-tabel">
            <div class="mb-3">
                <?php if ($jumlah_data_target == 0) : ?>
                    <a href="pelangganaksi2.php?aksi=tambah&kd_akun_user=<?php echo $kd_akun_user; ?>&tanggal_dipilih=<?php echo $tanggal_dipilih; ?>" class="btn btn-success" id="button_sisir">Tambah Data</a>
                <?php else : ?>
                    <a href="pelangganaksi.php?aksi=tambah&kd_akun_user=<?php echo $kd_akun_user; ?>&tanggal_dipilih=<?php echo $tanggal_dipilih; ?>" class="btn btn-primary" id="button_target">Tambah Data</a>
                <?php endif; ?>
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
                <p>Jumlah Data yang di input : <?php echo $jumlah_data; ?></p>
            </div>
        </div>
        <br>
        <div class="card mx-3 " style="max-height: 500px; overflow-y: auto;">
            <div class=" mb-3 card-header">
                <h4 class=" card-title"> Target Pelanggan</h4>
            </div>
            <div class=" px-3 table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">ID PELANGGAN</th>
                            <th class="text-center">MAPS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        $hasil = "SELECT * FROM tbl_target WHERE kd_akun = '$kd_akun_user' AND ('$tanggal_dipilih' BETWEEN tanggal AND tanggal_akhir)";

                        $tampil = mysqli_query($db, $hasil);
                        while ($d = $tampil->fetch_array()) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $counter; ?></td>
                                <td class="text-center"><?php echo $d['idpel'] ?></td>
                                <td class="text-center">
                                    <a href='https://www.google.com/maps?q=<?php echo $d["latitude"] ?>,<?php echo $d["longitude"]; ?>' target="_blank">Lihat di Google Maps</a>
                                </td>
                            </tr>
                        <?php
                            $counter++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    if ($totalPages > 1) {
        echo '<nav aria-label="Page navigation example">';
        echo '<ul class="pagination">';
        if (
            $currentPage > 1
        ) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '">&laquo;</a></li>';
        }

        // Loop untuk mencetak nomor halaman
        $numPagesToShow = 3; // Jumlah nomor halaman yang ingin ditampilkan
        $halfNumPages = floor($numPagesToShow / 2);
        $startPage = max(1, $currentPage - $halfNumPages);
        $endPage = min($totalPages, $startPage + $numPagesToShow - 1);

        if (
            $startPage > 1
        ) {
            echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
            if ($startPage > 2) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
        }

        for ($i = $startPage; $i <= $endPage; $i++) {
            echo '<li class="page-item ' . (($i == $currentPage) ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }

        if (
            $endPage < $totalPages
        ) {
            if (
                $endPage < $totalPages - 1
            ) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
            echo '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '">' . $totalPages . '</a></li>';
        }

        if (
            $currentPage < $totalPages
        ) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '">&raquo;</a></li>';
        }

        echo '</ul>';
        echo '</nav>';
    }
    ?>
</div>