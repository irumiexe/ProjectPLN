<?php
include 'header.php';
?>

<style>
    .excel-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
        transition: background-color 0.2s ease;
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
                <a href="pelangganaksi.php?aksi=tambah" class="btn btn-primary">Tambah Data</a>

            </div>
            <a href="excel.php" target="_blank">
                <button class="excel-btn btn-success">Excel</button>
            </a>
            <hr>
            <div class="card">
                <div class=" d-flex justify-content-between mb-3 card-header">
                    <h3 class=" card-title ">Data Pelanggan</h3>
                    <form class="d-flex ml-auto">
                        <input class="form-control mr-1" name="cari" type="search" placeholder="Search" aria-label="Search" value="<?php if (isset($_GET['cari'])) {
                                                                                                                                        echo $_GET['cari'];
                                                                                                                                    } ?>">
                        <button class="btn btn-outline-success" type="cari">Search</button>
                    </form>
                </div>
                <div class=" mx-3 table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">ID Pelanggan</th>
                                <th class="text-center">Nama Pelanggan</th>
                                <th class="text-center">Daya (VA)</th>
                                <th class="text-center">Tipe Pembayaran</th>
                                <th class="text-center">Maps</th>
                                <th class="text-center">Photo Meteran</th>
                                <th class="text-center">Keterangann</th>
                                <th class="text-center">Rincian</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['cari'])) {
                                $pencarian = $_GET['cari'];
                                $hasil = "SELECT * from tbl_pelanggan where idpel like '%" . $pencarian . "%' or nama_pel like '%" . $pencarian . "%' 
                                                                            or ket like '%" . $pencarian . "%' or daya like '%" . $pencarian . "%' or tipe like '%" . $pencarian . "%' order by idpel asc";
                            } else {
                                $dataPerPage = 1; // Jumlah data per halaman
                                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Halaman saat ini, default: 1
                                $startFrom = ($currentPage - 1) * $dataPerPage; // Mulai dari data ke berapa

                                $hasil = "SELECT * from tbl_pelanggan order by idpel asc LIMIT $startFrom, $dataPerPage";
                            }
                            $tampil = mysqli_query($db, $hasil);
                            while ($d = $tampil->fetch_array()) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $d['idpel'] ?></td>
                                    <td class="text-center" style="max-width: 100px;">
                                        <div style="word-wrap: break-word; ">
                                            <?php echo $d['nama_pel'] ?>
                                        </div>
                                    </td>
                                    <td class="text-center"><?php echo $d['daya'] ?></td>
                                    <td class="text-center"><?php echo $d['tipe'] ?></td>
                                    <td style="width: 200px; height: 200px;">
                                        <iframe src='https://www.google.com/maps?q=<?Php echo $d["latitude"] ?>,<?php echo $d["longitude"]; ?>&hl=es;z=14&output=embed' style="width:100%; height:100%;"></iframe>
                                    </td>
                                    <td class="text-center"><img src="../file/<?php echo $d['pmet']; ?>" style="width: 100px; height:200px"></td>
                                    <td class="text-center"><?php echo $d['ket'] ?></td>
                                    <td class="text-center" style="max-width: 100px;">
                                        <div style="word-wrap: break-word; ">
                                            <?php echo $d['ket2'] ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="pelangganaksi.php?kode=<?php echo $d['kd_idpel'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
                                        <a href="javascript:void(0);" class="btn btn-danger" onclick="hapusData('<?php echo $d['kd_idpel']; ?>')">Hapus</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <?php
                        $query = "SELECT COUNT(*) AS total FROM tbl_pelanggan";
                        $result = mysqli_query($db, $query);
                        $row = mysqli_fetch_assoc($result);
                        $totalPages = ceil($row['total'] / $dataPerPage);
                        $startRange = max(1, $currentPage - 2);
                        $endRange = min($totalPages, $currentPage + 2);
                        if ($currentPage > 1) {
                            echo '<a href="?page=' . ($currentPage - 1) . '" class="btn btn-primary">&laquo;</a>';
                        }

                        if ($currentPage > 3) {
                            echo '<a href="?page=1" class="btn btn-primary">1</a>';
                            echo '<span class="btn btn-secondary">...</span>';
                        }
                        for ($i = $startRange; $i <= $endRange; $i++) {
                            echo '<a href="?page=' . $i . '" class="btn ' . (($i == $currentPage) ? 'btn-info' : 'btn-secondary') . '">' . $i . '</a>';
                        }
                        if ($currentPage < $totalPages - 2) {
                            echo '<span class="btn btn-secondary">...</span>';
                            echo '<a href="?page=' . $totalPages . '" class="btn btn-primary">' . $totalPages . '</a>';
                        }

                        if ($currentPage < $totalPages) {
                            echo '<a href="?page=' . ($currentPage + 1) . '" class="btn btn-primary">&raquo;</a>';
                        }
                        ?>
                    </div>
                </div>
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