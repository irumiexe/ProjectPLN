<?php
include 'header.php';
?>
<style>
    .table-striped tbody tr:nth-child(odd) {
        background-color: #E0F4FF !important;
    }

    .table-striped tbody tr:nth-child(even) {
        background-color: #FFF6F6 !important;
    }
</style>

<div class="container-xl">
    <div class="row">
        <ol class="breadcrumb px-2 pt-2">
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
                    <button class="btn" type="submit">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
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
                                <td class="text-center">
                                    <?php
                                    if ($d['level'] == 0) {
                                        echo "Admin";
                                    } elseif ($d['level'] == 1) {
                                        echo "Petugas Lapangan";
                                    } else {
                                        echo $d['level'];
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="akunaksi.php?kode=<?php echo $d['kd_akun'] ?>&aksi=ubah" class="btn btn-success">Ubah</a>
                                    <a href="javascript:void(0);" class="btn btn-danger" onclick="hapusData('<?php echo $d['kd_akun']; ?>')">Hapus</a>
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
<?php include '../assets/footer.php'; ?>

<script>
    function hapusData(akun) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = 'akunproses.php?kode=' + akun + '&proses=proseshapus';
        }
    }
</script>