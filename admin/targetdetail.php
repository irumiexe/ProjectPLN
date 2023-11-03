<?php
include 'header.php';


if (!isset($_SESSION['kd_akun_user'])) {

    header("Location: login.php");
    exit();
}

$kd_akun_user = $_SESSION['kd_akun_user'];
$kd_akun = $_GET['kd_akun']; // Ambil nilai kd_akun dari URL



?>

<style>
    .card-title {
        text-align: center;
    }

    .card-header {
        background-color: #CDF5FD
    }
</style>

<div class="container-xl">
    <div class="row">
        <ol class="breadcrumb">
            <h4>DATA TARGET</h4>
        </ol>
    </div>
    <div class="panel-container">
        <div class="card">
            <div class=" mb-3 card-header">
                <h4 class=" card-title"> Target Pelanggan</h4>
            </div>
            <div class="mx-3 table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">ID PELANGGAN</th>
                            <th class="text-center">MAPS</th>
                            <th class="text-center">OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        $hasil = "SELECT * FROM tbl_target WHERE kd_akun = '$kd_akun'";
                        $tampil = mysqli_query($db, $hasil);

                        while ($db = $tampil->fetch_array()) {
                            // Tampilkan data dari tabel tbl_target sesuai dengan kd_akun
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $counter; ?></td>
                                <td class="text-center"><?php echo $db['idpel'] ?></td>
                                <td class="text-center">
                                    <a href='https://www.google.com/maps?q=<?php echo $db["latitude"] ?>,<?php echo $db["longitude"]; ?>' target="_blank">Lihat di Google Maps</a>
                                </td>
                                <td class="text-center">
                                    <a href="targetaksi.php?kode=<?php echo $db['idpel'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
                                    <a href="javascript:void(0);" class="btn btn-danger" onclick="hapusData('<?php echo $db['idpel']; ?>')">Hapus</a>

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
<?php include '../assets/footer.php'; ?>
<script>
    function hapusData(idpelanggan) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = 'targetproses.php?kode=' + idpelanggan + '&proses=proseshapus';

        }
    }
</script>
<?php include '../assets/footer.php'; ?>