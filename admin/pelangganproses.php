<?php
include 'header.php';
if (isset($_GET['proses'])) {
        if ($_GET['proses'] == 'prosestambah') {
                $idpel=$_POST['idpel'];
                $nama_pel =$_POST['nama_pel'];
                $daya = $_POST['daya'];
                $tipe = $_POST['tipe'];

            $hasil = $db->query("INSERT into tbl_pelanggan (idpel,nama_pel,daya,tipe) values
                                                            ('$idpel','$nama_pel','$daya','$tipe')");
            header("location:pelangganinput.php");
        
        }elseif ($_GET['proses'] == 'ubah') {
                $idpel = $_POST['idpel'];
                $nama_pel = $_POST['nama_pel'];
                $daya = $_POST['daya'];
                $tipe = $_POST['tipe'];

            $hasil = $db->query("UPDATE tbl_pelanggan set nama_pel='$nama_pel', daya='$daya', tipe='$tipe' where idpel='$idpel'");
            header("location:pelangganinput.php");

        }elseif ($_GET['proses'] == 'proseshapus') {
            $idpel = $_GET['kode'];
            $hasil = $db->query("DELETE FROM tbl_pelanggan WHERE idpel='$idpel'");
            header("location:pelangganinput.php");
        }
    }
?>