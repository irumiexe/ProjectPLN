<?php
include 'header.php';
?>

<div class="container-xl ">
    <div class="row">
        <ol class="breadcrumb">
            <h4>INPUT DATA PELANGGAN</h4>
        </ol>
    </div>
    <div class="panel-container">
        <div class="bootstrap-tabel">
            <a href="pelangganaksi.php?aksi=tambah" class="btn btn-primary">Tambah Data</a>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">ID Pelanggan</th>
                            <th class="text-center">Nama Pelanggan</th>
                            <th class="text-center">Daya</th>
                            <th class="text-center">Tipe Pembayaran</th>
                            <th class="text-center" colspan="">Maps</th>
                            <th class="text-center" colspan="">Photo Meteran</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $hasil = $db->query("SELECT * from tbl_pelanggan order by idpel asc");
                        $no = 1;
                        while ($d = $hasil->fetch_array()) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $d['idpel'] ?></td>
                                <td class="text-center"><?php echo $d['nama_pel'] ?></td>
                                <td class="text-center"><?php echo $d['daya'] ?></td>
                                <td class="text-center"><?php echo $d['tipe'] ?></td>
                                <td style="width: 450px; height : 450px;" colspan="2"> <iframe src='https://www.google.com/maps?q=<?Php echo $d["latitude"] ?>,<?php echo $d["longitude"]; ?>&hl=es;z=14&output=embed' style="width:100%;  height:100%; "></iframe> </td>
                                <td class="text-center"><img src="../file/<?php echo $d['pmet']; ?>" style="width: 100px;"></td>
                                <td class="text-center"><?php echo $d['ket'] ?></td>
                                <td class="text-center">
                                    <a href="pelangganaksi.php?kode=<?php echo $d['idpel'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
                                    <a href="pelangganproses.php?kode=<?php echo $d['idpel'] ?>&proses=proseshapus" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>