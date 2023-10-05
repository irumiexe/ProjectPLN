<?php
include 'koneksi.php'; // Sesuaikan dengan nama file koneksi yang Anda gunakan

// Inisialisasi tanggal_terpilih dari $_GET
$tanggal_terpilih = $_GET['tanggal'];

// Query untuk menghitung jumlah data pada tanggal_terpilih
$query_hitung_data = "SELECT COUNT(*) as jumlah_data FROM tbl_pelanggan WHERE tanggal = '$tanggal_terpilih'";
$result_hitung_data = mysqli_query($db, $query_hitung_data);

$response = array();

if ($result_hitung_data) {
    $data_hitung = mysqli_fetch_assoc($result_hitung_data);
    $response['jumlah_data'] = $data_hitung['jumlah_data'];
} else {
    $response['error'] = mysqli_error($db);
}

// Mengembalikan data dalam format JSON
echo json_encode($response);
