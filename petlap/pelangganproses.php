<?php
include '../assets/conn/config.php';

if (isset($_GET['proses'])) {
    if ($_GET['proses'] == 'prosestambah') {
        $idpel = $_POST['idpel'];
        $nama_pel = $_POST['nama_pel'];
        $kd_akun = $_POST['kd_akun'];
        $tanggal_dipilih = date('Y-m-d');

        $query_cek_target = "SELECT idpel FROM tbl_target WHERE kd_akun = '$kd_akun' AND idpel = '$idpel' AND '$tanggal_dipilih' BETWEEN tanggal AND tanggal_akhir";
        $result_cek_target = mysqli_query($db, $query_cek_target);

        if (mysqli_num_rows($result_cek_target) > 0) {
            if (isset($_POST['daya_select']) && !empty($_POST['daya_select'])) {
                $daya = $_POST['daya_select'];
            } elseif (isset($_POST['daya_input']) && !empty($_POST['daya_input'])) {
                $daya = $_POST['daya_input'];
            } else {
                $daya = null;
            }

            $tipe = $_POST['tipe'];
            $alamat = $_POST['alamat'];
            $latitude = $_POST["latitude"];
            $longitude = $_POST["longitude"];
            $pmet = $_FILES['pmet']['name'];

            $nama_file_baru = $idpel . ".jpg";

            move_uploaded_file($_FILES['pmet']['tmp_name'], '../file/' . $nama_file_baru);
            $merk = $_POST["merk"];
            $tipemet = $_POST["tipemet"];
            $nomet = $_POST["nomet"];
            $status = $_POST["status"];
            $ket = $_POST["ket"];
            $ket2 = $_POST["ket2"];

            $query = "INSERT INTO tbl_pelanggan (idpel, nama_pel, daya, tipe,alamat, latitude, longitude, pmet, merk, tipemet,nomet, ket, ket2,kd_akun, tanggal) 
            VALUES ('$idpel', '$nama_pel', '$daya', '$tipe','$alamat', '$latitude', '$longitude', '$nama_file_baru', '$merk', '$tipemet', '$nomet', '$ket', '$ket2','$kd_akun',CURDATE())";

            $query1 = "UPDATE tbl_target set status = '$status' where idpel='$idpel'";

            mysqli_query($db, $query);
            mysqli_query($db, $query1);

            echo "<script>
                    alert('Data Berhasil Ditambahkan');
                    document.location.href = 'pelangganinput.php';
                  </script>";
        } else {
            echo "<script>
                    alert('ID Pelanggan tidak valid, pastikan ID Pelanggan sesuai dengan Data Target');
                    document.location.href = 'pelangganinput.php';
                  </script>";
        }
    }
}
