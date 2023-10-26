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
    $kd_akun = $_POST['kd_akun'];
    $tanggal = $_POST['tanggal'];
    $tanggal_akhir = $_POST['tanggal_akhir'];
    $idpel = $_GET['kode'];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    $hasil = $db->query("UPDATE tbl_target set tanggal='$tanggal', tanggal_akhir='$tanggal_akhir', latitude='$latitude', longitude='$longitude' where idpel='$idpel'");
    if ($hasil) {
        echo "<script>alert('Update berhasil');</script>";
    } else {
        echo "<script>alert('Update gagal: " . mysqli_error($db) . "');</script>";
    }
    echo '<script>window.location.href = "targetdetail.php";</script>';
} elseif ($_GET['proses'] == 'proseshapus') {
    $idpel = $_GET['kode'];

    $query = "SELECT * FROM tbl_target WHERE idpel='$idpel'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        $deleteQuery = "DELETE FROM tbl_target WHERE idpel='$idpel'";
        $deleteResult = mysqli_query($db, $deleteQuery);

        if ($deleteResult) {
            echo "<script>alert('Data berhasil dihapus');</script>";
        } else {
            echo "<script>alert('Gagal menghapus data: " . mysqli_error($db) . "');</script>";
        }
    } else {
        echo "<script>alert('Data tidak ditemukan');</script>";
    }

    echo '<script>window.location.href = "targetdetail.php";</script>';
}
