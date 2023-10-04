<?php
include 'header.php';
if (isset($_GET['user'])) {
    if ($_GET['user'] == 'tambahuser') {
        $kd_akun = $_POST['kd_akun'];
        $nama_lengkap = $_POST['nama_pelangkap'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];

        $user = $db->query("INSERT into tbl_akun (kd_akun,nama_lengkap,username,password,level) values
        ('$idpel','$nama_pel','$daya','$tipe','$password','$level')");
        header("location:userinput.php");
    } elseif ($_GET['user'] == 'ubahuser') {
        $kd_akun = $_POST['kd_akun'];
        $nama_lengkap = $_POST['nama_pelangkap'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];

        $hasil = $db->query("UPDATE tbl_akun set nama_lengkap='$nama_lengkap', username='$username',password='$password',level='$level' where kd_akun='$kd_akun'");
        header("location:userinput.php");
    } elseif ($_GET['user'] == 'hapususer') {
        $kd_akun = $_GET['kode'];
        $hasil = $db->query("DELETE FROM tbl_akun WHERE kd_akun='$kd_akun'");
        header("location:userinput.php");
    }
}
