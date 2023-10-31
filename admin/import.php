<?php
session_start();
include '../assets/conn/cek.php';
include '../assets/conn/config.php';

$csv_file = 'mydata.csv';

// Baca file CSV ke dalam array
$data = array_map('str_getcsv', file($csv_file));

// Loop melalui data dan masukkan ke dalam database
foreach ($data as $row) {
    $idpel = mysqli_real_escape_string($db, $row[0]);
    $kd_akun = mysqli_real_escape_string($db, $row[1]);
    $tanggal = mysqli_real_escape_string($db, $row[2]);
    $tanggal_akhir = mysqli_real_escape_string($db, $row[3]);
    $latitude = mysqli_real_escape_string($db, $row[4]);
    $longitude = mysqli_real_escape_string($db, $row[5]);

    // Ganti 'nama_tabel' dengan nama tabel yang ingin Anda gunakan
    $query = "INSERT INTO tbl_target (idpel, kd_akun, tanggal, tanggal_akhir, latitude, longitude) 
              VALUES ('$idpel', '$kd_akun', '$tanggal', '$tanggal_akhir', $latitude, $longitude)";

    if (mysqli_query($db, $query)) {
        echo "Data berhasil diimpor: $idpel, $kd_akun, $tanggal, $tanggal_akhir, $latitude, $longitude<br>";
    } else {
        echo "Gagal mengimpor data: " . mysqli_error($db) . "<br>";
    }
}

// Tutup koneksi
mysqli_close($db);
