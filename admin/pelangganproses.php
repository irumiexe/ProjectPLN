<?php
include '../assets/conn/config.php';

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'prosestambah') {
        $idpel = $_POST['idpel'];
        $nama_pel = $_POST['nama_pel'];
        $daya = $_POST['daya'];
        $tipe = $_POST['tipe'];
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        $pmet = $_FILES['pmet']['name'];

        // Hapus nama asli dan ganti dengan idpel
        $nama_file_baru = $idpel . ".jpg"; // Ganti .jpg dengan ekstensi file yang sesuai

        move_uploaded_file($_FILES['pmet']['tmp_name'], '../file/' . $nama_file_baru);
        $ket = $_POST["ket"];
        $kd_akun = $_POST['kd_akun'];

        $query = "INSERT INTO tbl_pelanggan (idpel, nama_pel, daya, tipe, latitude, longitude, pmet, ket, tanggal, kd_akun) 
          VALUES ('$idpel', '$nama_pel', '$daya', '$tipe', '$latitude', '$longitude', '$nama_file_baru', '$ket', CURDATE(), '$kd_akun')";

        mysqli_query($db, $query);

        echo
        "<script>
            alert('Data Berhasil Di Tambahkan');
            document.location.href = 'pelangganinput.php';
        </script>";
        header("location:pelangganinput.php");
    } elseif ($_GET['proses'] == 'ubah') {
        $idpel = $_POST['idpel'];
        $nama_pel = $_POST['nama_pel'];
        $daya = $_POST['daya'];
        $tipe = $_POST['tipe'];
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        $pmet = $_FILES['pmet']['name'];

        // Hapus nama asli dan ganti dengan idpel
        $nama_file_baru = $idpel . ".jpg"; // Ganti .jpg dengan ekstensi file yang sesuai

        move_uploaded_file($_FILES['pmet']['tmp_name'], '../file/' . $nama_file_baru);
        $ket = $_POST["ket"];

        $hasil = $db->query("UPDATE tbl_pelanggan set nama_pel='$nama_pel', daya='$daya', tipe='$tipe',pmet='$nama_file_baru',ket='$ket' where idpel='$idpel'");
        header("location:pelangganinput.php");
    } elseif ($_GET['proses'] == 'proseshapus') {
        $idpel = $_GET['kode'];

        // Ambil nama file yang akan dihapus dari database
        $query = "SELECT pmet FROM tbl_pelanggan WHERE idpel='$idpel'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $fileToDelete = $row['pmet'];

        // Hapus file dari direktori
        $filePath = '../file/' . $fileToDelete;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus data dari database
        $deleteQuery = "DELETE FROM tbl_pelanggan WHERE idpel='$idpel'";
        $deleteResult = mysqli_query($db, $deleteQuery);

        if ($deleteResult) {
            echo "<script>alert('Data dan file berhasil dihapus');</script>";
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }

        header("location:pelangganinput.php");
    }
}
