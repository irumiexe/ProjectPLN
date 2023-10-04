<?php
include 'header.php';
?>

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
                    <button class="btn btn-outline-success" type="cari">Search</button>
                </form>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['cari'])) {
                            $pencarian = $_GET['cari'];
                            $hasil = "SELECT * from tbl_akun where nama_lengkap like '%" . $pencarian . "%' or level like '%" . $pencarian . "%' 
                                                                            or username like '%" . $pencarian . "%' order by kd_akun asc";
                        } else {
                            $hasil = "SELECT * from tbl_akun order by kd_akun asc";
                        }
                        $tampil = mysqli_query($db, $hasil);
                        while ($d = $tampil->fetch_array()) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $d['nama_lengkap'] ?></td>
                                <td class="text-center"><?php echo $d['username'] ?></td>
                                <td class="text-center"><?php echo $d['level'] ?></td>
                                <td class="text-center">
                                    <a href="akunaksi.php?kode=<?php echo $d['kd_akun'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
                                    <a href="#" class="btn btn-danger" onclick="hapusAkun('<?php echo $d['kd_akun']; ?>')">Hapus</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <script>
                            function hapusAkun(kode) {
                                var konfirmasi = confirm('Apakah Anda yakin ingin menghapus data ini?');
                                if (konfirmasi) {
                                    window.location.href = 'akunproses.php?kode=' + kode + '&proses=proseshapus';
                                }
                            }
                        </script>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>