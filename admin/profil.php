<?php
include 'header.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $level = $_SESSION['level'];

    $query = $db->query("SELECT * FROM tbl_akun");
    $petlap_data = array();

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
} else {
    header("location: ../index.php");
    exit();
}
?>

<style>
    .list-group {
        border: none;
    }

    /* Menambahkan garis pembatas di atas dan di bawah setiap elemen list-group-item */
    .list-group-item {
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        display: flex;
        /* Menggunakan display flex */
        justify-content: space-between;
        /* Mendorong elemen ke ujung kanan */
        align-items: center;
        /* Mengatur vertikal tengah */
    }

    /* Membuat teks tebal (bold) untuk angka di sebelah kanan */
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
        border-top: 2px solid #007bff;
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
                    <button class="btn" type="submit">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>
            </div>
            <hr>
            <div class="row">
                <?php foreach ($petlap_data as $petlap) : ?>
                    <?php if (isset($_GET['cari']) && strpos($petlap['nama_lengkap'], $cari) === false && $petlap['level'] != $cari) {
                        continue;}?>
                    <div class="col-md-3">
                        <div class="card card-primary card-outline" style="border-top: 5px solid #007bff; margin-bottom: 20px;">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="../assets/dist/img/user4-128x128.jpg" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center"><?php echo $petlap['nama_lengkap']; ?></h3>
                                <p class="text-muted text-center">
                                    <?php
                                    if ($petlap['level'] == 0) {
                                        echo "Admin";
                                    } elseif ($petlap['level'] == 1) {
                                        echo "Petugas Lapangan";
                                    } else {
                                        echo $petlap['level'];
                                    }
                                    ?>
                                </p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Followers</b> <a class="float-right">1,322</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Following</b> <a class="float-right">543</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Friends</b> <a class="float-right">13,287</a>
                                    </li>
                                </ul>

                                <a href="targetaksi.php?aksi=tambah" class="btn btn-success btn-block"><b>Tambah Target</b></a>
                                <a href="#" class="btn btn-primary btn-block"><b>Detail Target</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>