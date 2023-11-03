<?php
include 'header.php';

$jumlah_target = 0;
$jumlah_target2 = 0;

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $level = $_SESSION['level'];

    $query = $db->query("SELECT nama_lengkap, level, foto FROM tbl_akun WHERE username='$username'");
    $data = $query->fetch_assoc();
    $nama_lengkap = $data['nama_lengkap'];
    $welcome_message = "SELAMAT DATANG";
    $imagePath = $data['foto'];
    $fotoProfilPath = '../assets/img/' . $imagePath;

    if ($level == '0') {
        $queryTarget = $db->query("SELECT COUNT(*) as jumlah_target FROM tbl_pelanggan");
        $dataTarget = $queryTarget->fetch_assoc();
        $jumlah_target = $dataTarget['jumlah_target'];

        $queryTarget2 = $db->query("SELECT COUNT(*) as jumlah_akun FROM tbl_akun WHERE level='1'");
        $dataTarget2 = $queryTarget2->fetch_assoc();
        $jumlah_target2 = $dataTarget2['jumlah_akun'];

        $nama = "$nama_lengkap";
        $role = "$level";
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
        border-top: 2px solid #007bff;
    }

    .card-primary {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container">
    <div class="row">
        <ol class="breadcrumb px-2 pt-2">
            <h4>DASHBOARD</h4>
        </ol>
    </div>
    <div class="panel-container">
        <div class="bootstrap-tabel">
            <center>
                <h3><?php echo $welcome_message; ?></h3>
                <div class="col-md-13">
                    <div class="card card-primary card-outline">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="<?php echo $fotoProfilPath; ?>" alt="User profile picture" </div>

                                    <h3 class="profile-username text-center"><?php echo $data['nama_lengkap']; ?></h3>
                                    <p class="text-muted text-center">
                                        <?php
                                        if ($data['level'] == 0) {
                                            echo "Admin";
                                        } else {
                                            echo $data['level'];
                                        }
                                        ?>
                                    </p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Jumlah Data Pelanggan</b> <a class="float-right"><?php echo $jumlah_target; ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Jumlah Petugas</b> <a class="float-right"><?php echo $jumlah_target2; ?></a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
            </center>
        </div>
    </div>
</div>
<?php include '../assets/footer.php'; ?>