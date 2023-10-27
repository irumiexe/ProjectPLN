<?php
include 'header.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $level = $_SESSION['level'];

    if (isset($_GET['cari'])) {
        $cari = $db->real_escape_string($_GET['cari']);
        $query = $db->query("SELECT * FROM tbl_akun WHERE nama_lengkap LIKE '%$cari%' OR level = '$cari'");
    } else {
        $query = $db->query("SELECT * FROM tbl_akun");
    }

    // Hitung jumlah total data
    $totalData = $query->num_rows;

    // Tentukan jumlah data per halaman
    $dataPerPage = 10;

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
} else {
    header("location: ../index.php");
    exit();
}
?>

<style>
    .list-group {
        border: none;
    }

    .list-group-item {
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .list-group-item a {
        font-weight: bold;
    }

    .card {
        max-width: 300px;
    }

    .card-body {
        padding: 10px;
    }

    .card-primary {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container-xl">
    <div class="row">
        <ol class="breadcrumb">
            <h4>INPUT DATA HAK AKSES</h4>
        </ol>
    </div>
    <div class="panel-container">
        <div class="bootstrap-tabel">
            <div class="d-flex justify-content-between mb-3">
                <a href="akunaksi.php?aksi=tambah" class="btn btn-primary">Tambah Akun</a>
                <form class="d-flex ml-auto">
                    <input class="form-control mr-1" name="cari" type="search" placeholder="Search" aria-label="Search" value="<?php if (isset($_GET['cari'])) {
                                                                                                                                    echo $_GET['cari'];
                                                                                                                                } ?>">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            <hr>
            <div class="row">
                <?php for ($i = $startIndex; $i < $endIndex; $i++) : ?>
                    <?php if ($i >= count($petlap_data)) {
                        break;
                    }
                    $d = $petlap_data[$i];

                    $kd_akun = $d['kd_akun'];
                    $target_query = $db->query("SELECT COUNT(*) as jumlah_target FROM tbl_target WHERE kd_akun = '$kd_akun'");
                    $target_data = $target_query->fetch_assoc();
                    $jumlah_target = $target_data['jumlah_target'];
                    ?>
                    <div class="col-md-3">
                        <div class="card card-primary card-outline" style="border-top: 5px solid #007bff; margin-bottom: 20px;">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="../assets/dist/img/user4-128x128.jpg" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center"><?php echo $d['nama_lengkap']; ?></h3>
                                <p class="text-muted text-center">
                                    <?php
                                    if ($d['level'] == 0) {
                                        echo "Admin";
                                    } elseif ($d['level'] == 1) {
                                        echo "Petugas Lapangan";
                                    } else {
                                        echo $d['level'];
                                    }
                                    ?>
                                </p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Jumlah Target</b> <a class="float-right"><?php echo $jumlah_target; ?></a>
                                    </li>
                                </ul>

                                <a href="targetaksi.php?aksi=tambah&kd_akun=<?php echo $d['kd_akun']; ?>" class="btn btn-success btn-block"><b>Tambah Target</b></a>
                                <a href="targetdetail.php" class="btn btn-primary btn-block"><b>Detail Target</b></a>
                            </div>

                            <!-- /.card-body -->
                        </div>
                    </div>
                <?php endfor; ?>
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