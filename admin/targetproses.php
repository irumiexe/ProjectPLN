<?php
include '../assets/conn/config.php';

if (isset($_GET['proses']) && $_GET['proses'] == 'prosestambah') {
    $kd_akun = $_POST['kd_akun'];
    $idpel = $_POST['idpel'];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    $query = "INSERT INTO tbl_target (kd_akun, idpel, latitude, longitude, tanggal) 
          VALUES ('$kd_akun', '$idpel', '$latitude', '$longitude', CURDATE())";
    mysqli_query($db, $query);
} elseif ($_GET['proses'] == 'ubah') {
    $kd_idpel = $_GET['kode'];
    $idpel = $_POST['idpel'];
    $nama_pel = $_POST['nama_pel'];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    move_uploaded_file($_FILES['pmet']['tmp_name'], '../file/' . $nama_file_baru);
    $ket = $_POST["ket"];
    $ket2 = $_POST["ket2"];

    $hasil = $db->query("UPDATE tbl_pelanggan set nama_pel='$nama_pel', daya='$daya', tipe='$tipe', pmet='$nama_file_baru', ket='$ket', ket2='$ket2' where idpel='$idpel'");
    if ($hasil) {
        echo "<script>alert('Update berhasil');</script>";
    } else {
        echo "<script>alert('Update gagal: " . mysqli_error($db) . "');</script>";
    }
    echo '<script>window.location.href = "pelangganinput.php";</script>';
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
