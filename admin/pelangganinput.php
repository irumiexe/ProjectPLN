<?php
include 'header.php';

$dataPerPage = 2;

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

    .pagination {
        text-align: center;
        margin-top: 20px;
    }

    .pagination a {
        margin: 0 1px;
<<<<<<< HEAD
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .modal-header {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: start;
        align-items: flex-start;
        -ms-flex-pack: justify;
        justify-content: space-between;
        padding: 1rem;
        border-bottom: 1px solid #e9ecef;
        border-top-left-radius: calc(0.3rem - 1px);
        border-top-right-radius: calc(0.3rem - 1px);
    }

    .modal-content {
        display: block;
        margin: 0 auto;
        max-width: 30%;
    }

    .modal-body {
        position: relative;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1rem;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        color: #fff;
        font-size: 24px;
        font-weight: bold;
        cursor: pointer;
=======
>>>>>>> aa511fd3a50fdcd31bbc8e7202899f696eb09fed
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
                <div class="row">
                    <div class="col">
                        <a href="pelangganaksi.php?aksi=tambah" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <div class="col">
                        <a href="excel.php" target="_blank">
                            <button class="btn btn-success">Excel</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="d-flex justify-content-between mb-3 card-header">
                    <h4 class="card-title">Data Pelanggan</h4>
                    <form class="d-flex ml-auto" method="GET">
                        <input class="form-control mr-1" name="cari" type="search" placeholder="Search" aria-label="Search" value="<?php if (isset($_GET['cari'])) {
                                                                                                                                        echo $_GET['cari'];
                                                                                                                                    } ?>">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                <div class="mx-3 table-responsive">
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
                                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                                $startFrom = ($currentPage - 1) * $dataPerPage;

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
<<<<<<< HEAD
                    <div id="gambarPopUp" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3>Bukti Dokumentasi</h3>
                                <span class="close" onclick="tutupPopUp()">&times;</span>
                            </div>
                            <div class="modal-body">
                                <img id="gambarModal" style="width: 100%; item-align: center;">
                            </div>
                        </div>
                    </div>
                    <div class="pagination">
                        <?php
                        $query = "SELECT COUNT(*) AS total FROM tbl_pelanggan";
                        if (isset($_GET['cari'])) {
                            $pencarian = $_GET['cari'];
                            $query .= " WHERE idpel LIKE '%$pencarian%' OR nama_pel LIKE '%$pencarian%' OR ket LIKE '%$pencarian%' OR daya LIKE '%$pencarian%' OR tipe LIKE '%$pencarian%'";
                        }
                        $result = mysqli_query($db, $query);
                        $row = mysqli_fetch_assoc($result);
                        $totalPages = ($row['total'] > 0) ? ceil($row['total'] / $dataPerPage) : 1;
                        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                        $startFrom = ($currentPage - 1) * $dataPerPage; // Mulai dari data ke berapa

                        // Tambahkan LIMIT ke dalam query data
                        $queryData = "SELECT * FROM tbl_pelanggan";
                        if (isset($_GET['cari'])) {
                            $queryData .= " WHERE idpel LIKE '%$pencarian%' OR nama_pel LIKE '%$pencarian%' OR ket LIKE '%$pencarian%' OR daya LIKE '%$pencarian%' OR tipe LIKE '%$pencarian%'";
=======
                </div>
                <div class="pagination">
                    <?php
                    $query = "SELECT COUNT(*) AS total FROM tbl_pelanggan";
                    if (isset($_GET['cari'])) {
                        $pencarian = $_GET['cari'];
                        $query .= " WHERE idpel LIKE '%$pencarian%' OR nama_pel LIKE '%$pencarian%' OR ket LIKE '%$pencarian%' OR daya LIKE '%$pencarian%' OR tipe LIKE '%$pencarian%'";
                    }
                    $result = mysqli_query($db, $query);
                    $row = mysqli_fetch_assoc($result);
                    $totalPages = ($row['total'] > 0) ? ceil($row['total'] / $dataPerPage) : 1;
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $startFrom = ($currentPage - 1) * $dataPerPage; // Mulai dari data ke berapa

                    // Tambahkan LIMIT ke dalam query data
                    $queryData = "SELECT * FROM tbl_pelanggan";
                    if (isset($_GET['cari'])) {
                        $queryData .= " WHERE idpel LIKE '%$pencarian%' OR nama_pel LIKE '%$pencarian%' OR ket LIKE '%$pencarian%' OR daya LIKE '%$pencarian%' OR tipe LIKE '%$pencarian%'";
                    }
                    $queryData .= " ORDER BY idpel ASC LIMIT $startFrom, $dataPerPage";

                    $resultData = mysqli_query($db, $queryData);
                    while ($d = $resultData->fetch_array()) {
                    }
                    if ($totalPages > 1) {
                        echo '<nav aria-label="Page navigation example">';
                        echo '<ul class="pagination">';
                        if ($currentPage > 1) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '">&laquo;</a></li>';
>>>>>>> aa511fd3a50fdcd31bbc8e7202899f696eb09fed
                        }
                        $queryData .= " ORDER BY idpel ASC LIMIT $startFrom, $dataPerPage";

                        $resultData = mysqli_query($db, $queryData);
                        while ($d = $resultData->fetch_array()) {
                        }
                        if ($totalPages > 1) {
                            echo '<nav aria-label="Page navigation example">';
                            echo '<ul class="pagination">';
                            if ($currentPage > 1) {
                                echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '">&laquo;</a></li>';
                            }
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo '<li class="page-item ' . (($i == $currentPage) ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                            }
                            if ($currentPage < $totalPages) {
                                echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '">&raquo;</a></li>';
                            }
                            echo '</ul>';
                            echo '</nav>';
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
<<<<<<< HEAD

        function tampilkanGambar(namaGambar) {
            var gambarPopUp = document.getElementById('gambarPopUp');
            var modalContent = document.querySelector('.modal-content');
            var gambarModal = document.getElementById('gambarModal');

            // Set lebar modal sesuai dengan gambar asli
            var gambarAsli = new Image();
            gambarAsli.src = namaGambar;
            gambarAsli.onload = function() {
                var lebarAsli = this.width;
                modalContent.style.width = lebarAsli + 'px';
                gambarModal.src = namaGambar;
                gambarPopUp.style.display = "block";
            };
        }

        function tutupPopUp() {
            var gambarPopUp = document.getElementById('gambarPopUp');
            gambarPopUp.style.display = "none";
        }
    </script>
=======
    }
</script>
>>>>>>> aa511fd3a50fdcd31bbc8e7202899f696eb09fed
