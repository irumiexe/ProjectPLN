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
                        $hasil = "SELECT * FROM tbl_target WHERE kd_akun = '$kd_akun_user' AND kd_akun LIKE '$kd_akun_user%'";
                        $tampil = mysqli_query($db, $hasil);
                        while ($d = $tampil->fetch_array()) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $counter; ?></td>
                                <td class="text-center"><?php echo $d['idpel'] ?></td>
                                <td class="text-center">
                                    <a href='https://www.google.com/maps?q=<?php echo $d["latitude"] ?>,<?php echo $d["longitude"]; ?>' target="_blank">Lihat di Google Maps</a>
                                </td>
                                <td class="text-center">
                                    <a href="targetaksi.php?kode=<?php echo $d['kd_akun'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
                                    <a href="javascript:void(0);" class="btn btn-danger" onclick="hapusData('<?php echo $d['kd_akun']; ?>')">Hapus</a>
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
    <script>
        function hapusData(idpelanggan) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                window.location.href = 'pelangganproses.php?kode=' + idpelanggan + '&proses=proseshapus';
            }
        }
    </script>