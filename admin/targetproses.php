<?php
include '../assets/conn/config.php';

if (isset($_GET['proses']) && $_GET['proses'] == 'prosestambah') {
    $tanggal = $_POST['tanggal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $kd_akun = $_POST['kd_akun'];
    $idpel = $_POST['idpel'];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    $query = "INSERT INTO tbl_target (tanggal,tanggal_akhir,kd_akun, idpel, latitude, longitude) 
          VALUES ('$tanggal','$tanggal_akhir','$kd_akun', '$idpel', '$latitude', '$longitude')";
    mysqli_query($db, $query);
    echo '<script>window.location.href = "targetinput.php";</script>';
} elseif ($_GET['proses'] == 'ubah') {
    $kd_akun = $_GET['kode'];
    $tanggal = $_POST['tanggal'];
    $idpel = $_POST['idpel'];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    $hasil = $db->query("UPDATE tbl_target set idpel='$idpel', tanggal='$tanggal', latitude='$latitude', longitude='$longitude' where kd_akun='$kd_akun'");
    if ($hasil) {
        echo "<script>alert('Update berhasil');</script>";
    } else {
        echo "<script>alert('Update gagal: " . mysqli_error($db) . "');</script>";
    }
    echo '<script>window.location.href = "targetdetail.php";</script>';
} elseif ($_GET['proses'] == 'proseshapus') {
    $idpel = $_GET['kode'];

    $query = "SELECT pmet FROM tbl_pelanggan WHERE idpel='$idpel'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $fileToDelete = $row['pmet'];
    $filePath = '../file/' . $fileToDelete;

    if (file_exists($filePath)) {
        unlink($filePath);
    }

    $deleteQuery = "DELETE FROM tbl_pelanggan WHERE idpel='$idpel'";
    $deleteResult = mysqli_query($db, $deleteQuery);

    if ($deleteResult) {
        echo "<script>alert('Data dan file berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }

    echo '<script>window.location.href = "pelangganinput.php";</script>';
}
