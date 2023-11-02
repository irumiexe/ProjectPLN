<?php
session_start();
include '../assets/conn/cek.php';
include '../assets/conn/config.php';

if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] === UPLOAD_ERR_OK) {
    $excelFile = $_FILES['excelFile']['tmp_name'];

    // Gunakan library PHPSpreadsheet untuk membaca file Excel
    require '../vendor/autoload.php'; // Sesuaikan dengan lokasi library

    // Inisialisasi objek pembaca Excel
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($excelFile);
    $worksheet = $spreadsheet->getActiveSheet();

    // Loop melalui baris-baris dalam file Excel untuk mengimpor data
    foreach ($worksheet->getRowIterator() as $row) {
        $rowData = [];
        foreach ($row->getCellIterator() as $cell) {
            $rowData[] = $cell->getValue();
        }

        // Ambil data yang sesuai dari file Excel
        $idpel = $rowData[0]; // Kolom 1
        $kd_akun = $rowData[1]; // Kolom 2
        $rbm = $rowData[2]; // Kolom 3
        $tanggal = $rowData[3]; // Kolom 4
        $tanggal_akhir = $rowData[4]; // Kolom 5
        $latitude = $rowData[5]; // Kolom 6
        $longitude = $rowData[6]; // Kolom 7
        $status = $rowData[7]; // Kolom 8

        // Lakukan operasi penyimpanan ke database
        // Misalnya, menggunakan MySQLi atau PDO
        $query = "INSERT INTO tbl_target (idpel, kd_akun, rbm, tanggal, tanggal_akhir, latitude, longitude, status) VALUES ('$idpel', '$kd_akun', '$rbm', '$tanggal', '$tanggal_akhir', '$latitude', '$longitude', '$status')";

        // Eksekusi query

        // Di sini, Anda dapat menambahkan validasi dan penanganan kesalahan yang sesuai
    }
}
