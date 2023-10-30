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

// Hitung jumlah total data yang akan ditampilkan
$query_total_data = "SELECT COUNT(*) as total_data FROM tbl_target WHERE kd_akun = '$kd_akun_user' AND ('$tanggal_dipilih' BETWEEN tanggal AND tanggal_akhir)";
$result_total_data = mysqli_query($db, $query_total_data);
$data_total = mysqli_fetch_assoc($result_total_data);
$total_data = $data_total['total_data'];

// Tentukan jumlah data per halaman
$data_per_page = 5;

// Hitung jumlah halaman yang dibutuhkan
$total_pages = ceil($total_data / $data_per_page);

// Dapatkan nomor halaman yang sedang aktif dari parameter URL
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Sesuaikan query untuk mengambil data dengan memperhitungkan halaman yang sedang aktif
$offset = ($current_page - 1) * $data_per_page;
$hasil = "SELECT * FROM tbl_target WHERE kd_akun = '$kd_akun_user' AND ('$tanggal_dipilih' BETWEEN tanggal AND tanggal_akhir) LIMIT $data_per_page OFFSET $offset";

$tampil = mysqli_query($db, $hasil);
?>

<style>
    /* Gaya CSS untuk tautan navigasi halaman */
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        text-align: center;
        justify-content: center;
        align-items: center
    }

    .pagination a {
        margin: 0 1px;
        text-decoration: none;
        padding: 5px 10px;
        background-color: #337ab7;
        color: #fff;
        border-radius: 5px;
    }

    .pagination a:hover {
        background-color: #23527c;
    }

    .pagination .ellipsis {
        margin: 0 1px;
        text-decoration: none;
        padding: 5px 10px;
        background-color: #d3d3d3;
        opacity: 0.5;
        color: #337ab7;
        border-radius: 5px;
    }

    .card-header {
        background-color: #CDF5FD
    }
</style>

</styl.pagination>

<div class="container-xl">
    <div class="row">
        <ol class="breadcrumb">
            <h4>INPUT DATA PELANGGAN</h4>
        </ol>
    </div>
    <div class="panel-container">
        <div class="bootstrap-tabel">
            <div class="mb-3">
                <!-- Tambahkan tombol Tambah Data di sini -->
                <a href="pelangganaksi.php?aksi=tambah&kd_akun_user=<?php echo $kd_akun_user; ?>&tanggal_dipilih=<?php echo $tanggal_dipilih; ?>" class="btn btn-primary" id="button_target">Tambah Data</a>
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
                <p>Jumlah Data yang di input : <?php echo $total_data; ?></p>
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
            <!-- Tampilkan link navigasi halaman -->
            <div class="pagination">
                <?php
                $max_links = 3; // Jumlah maksimum tautan halaman yang ditampilkan
                $half_max_links = floor($max_links / 2);

                $start_page = max($current_page - $half_max_links, 1);
                $end_page = min($start_page + $max_links - 1, $total_pages);

                if ($current_page > 1) {
                    echo '<a href="?page=' . ($current_page - 1) . '&tanggal=' . $tanggal_dipilih . '">&laquo;</a>';
                }

                if ($start_page > 1) {
                    echo '<a href="?page=1&tanggal=' . $tanggal_dipilih . '">1</a>';
                    if ($start_page > 2) {
                        echo '<span class="ellipsis">...</span>';
                    }
                }

                for ($page = $start_page; $page <= $end_page; $page++) {
                    echo '<a href="?page=' . $page . '&tanggal=' . $tanggal_dipilih . '"';
                    if ($page == $current_page) {
                        echo ' class="current-page"';
                    }
                    echo '>' . $page . '</a>';
                }

                if ($end_page < $total_pages) {
                    if ($end_page < $total_pages - 1) {
                        echo '<span class="ellipsis">...</span>';
                    }
                    echo '<a href="?page=' . $total_pages . '&tanggal=' . $tanggal_dipilih . '">' . $total_pages . '</a>';
                }

                if ($current_page < $total_pages) {
                    echo '<a href="?page=' . ($current_page + 1) . '&tanggal=' . $tanggal_dipilih . '">&raquo;</a>';
                }
                ?>
            </div>
        </div>

    </div>

</div>