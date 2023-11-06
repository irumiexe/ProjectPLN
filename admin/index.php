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
    $welcome_message = "Selamat Datang di SIPLN (Sistem Informasi PLN) UP3 Banjarmasin";
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
    .container-xl {
        max-width: 1705px;
    }

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
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        margin-bottom: 1rem;
    }

    .card-title {
        float: left;
        font-size: 1.1rem;
        font-weight: 400;
        margin: 0;
    }
</style>

<div class="container-xl">
    <div class="row">
        <ol class="breadcrumb px-2 pt-2">
            <h4><?php echo $welcome_message; ?></h4>
        </ol>
    </div>
    <div class="panel-container">
        <div class="bootstrap-tabel">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Selamat Datang <?php echo $data['nama_lengkap']; ?></h3>
                </div>
                <div class="card-body">
                    <h3>Data Saat Ini</h3>
                    <table class="table table-striped table-bordered table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Jumlah Data Pelanggan</th>
                                <th class="text-center">Jumlah Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><?php echo $jumlah_target; ?></td>
                                <td class="text-center"><?php echo $jumlah_target2; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../assets/footer.php'; ?>