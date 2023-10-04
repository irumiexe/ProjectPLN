<?php
include 'header.php';
if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'prosestambah') {
        $idpel = $_POST['idpel'];
        $nama_pel = $_POST['nama_pel'];
        $daya = $_POST['daya'];
        $tipe = $_POST['tipe'];
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        $pmet = $_FILES['pmet']['name'];

        $pmet = $_FILES['pmet']['name'];
        move_uploaded_file($_FILES['pmet']['tmp_name'], '../file/' . $_FILES['pmet']['name']);
        $ket = $_POST["ket"];

        $ket = $_POST["ket"];

        $query = "INSERT INTO tbl_pelanggan VALUES(' $idpel','$nama_pel','$daya',' $tipe','$latitude','$longitude','$pmet','$ket')";
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

        $pmet = $_FILES['pmet']['name'];
        move_uploaded_file($_FILES['pmet']['tmp_name'], '../file/' . $_FILES['pmet']['name']);
        $ket = $_POST["ket"];

        $hasil = $db->query("UPDATE tbl_pelanggan set nama_pel='$nama_pel', daya='$daya', tipe='$tipe',pmet='$pmet',ket='$ket' where idpel='$idpel'");
        header("location:pelangganinput.php");
    } elseif ($_GET['proses'] == 'proseshapus') {
        $idpel = $_GET['kode'];
        $hasil = $db->query("DELETE FROM tbl_pelanggan WHERE idpel='$idpel'");
        header("location:pelangganinput.php");
    }
}
