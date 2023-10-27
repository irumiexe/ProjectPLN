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

    $petlap_data = array();

    while ($row = $query->fetch_assoc()) {
        $petlap_data[] = $row;
    }

    $query = $db->query("SELECT * FROM tbl_akun");
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
                <?php foreach ($petlap_data as $d) : ?>
                    <?php if (isset($_GET['cari']) && strpos($d['nama_lengkap'], $cari) === false && $d['level'] != $cari) {
                        continue;
                    }

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
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>