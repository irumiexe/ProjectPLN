<?php
include 'header.php';

if (!isset($_SESSION['kd_akun_user'])) {
    header("Location: login.php");
    exit();
}

$kd_akun_user = $_SESSION['kd_akun_user'];

$tanggal_dipilih = date('Y-m-d');

if (isset($_POST['pilih_tanggal'])) {
    $tanggal_dipilih = $_POST['tanggal'];
}

$query_hitung_data = "SELECT COUNT(*) as jumlah_data FROM tbl_pelanggan WHERE tanggal = '$tanggal_dipilih' AND kd_akun = '$kd_akun_user'";
$result_hitung_data = mysqli_query($db, $query_hitung_data);
$data_hitung = mysqli_fetch_assoc($result_hitung_data);
$jumlah_data = $data_hitung['jumlah_data'];
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
            <div class="d-flex justify-content-between mb-3">
                <a href="pelangganaksi.php?aksi=tambah&kd_akun_user=<?php echo $kd_akun_user; ?>&tanggal_dipilih=<?php echo $tanggal_dipilih; ?>" class="btn btn-primary">Tambah Data</a>
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
</div>