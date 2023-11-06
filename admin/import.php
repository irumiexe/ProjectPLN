<?php
session_start();
include '../assets/conn/cek.php';
include '../assets/conn/config.php';

$successCount = 0;
$failCount = 0;

if (isset($_FILES['excelFile']) && $_FILES['excelFile']['error'] === UPLOAD_ERR_OK) {
    $excelFile = $_FILES['excelFile']['tmp_name'];

    require '../vendor/autoload.php'; // Sesuaikan dengan lokasi library

    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($excelFile);
    $worksheet = $spreadsheet->getActiveSheet();

    foreach ($worksheet->getRowIterator() as $row) {
        $rowData = [];
        foreach ($row->getCellIterator() as $cell) {
            $rowData[] = $cell->getValue();
        }

        $idpel = $rowData[0]; // Kolom 1
        $kd_akun = $rowData[1]; // Kolom 2
        $rbm = $rowData[2]; // Kolom 3
        $nama_pel = $rowData[2]; // Kolom 3
        $tipe = $rowData[2]; // Kolom 3
        $merk = $rowData[2]; // Kolom 3
        $tipe_kwh = $rowData[2]; // Kolom 3
        $nomet = $rowData[2]; // Kolom 3
        $tanggal = $rowData[3]; // Kolom 4
        $tanggal_akhir = $rowData[4]; // Kolom 5
        $latitude = $rowData[5]; // Kolom 6
        $longitude = $rowData[6]; // Kolom 7
        $status = $rowData[7]; // Kolom 8

        // Modifikasi kode untuk memeriksa keberadaan kd_akun dalam tbl_akun
        $checkValidKdAkunQuery = "SELECT COUNT(*) FROM tbl_akun WHERE kd_akun = '$kd_akun'";
        $result = mysqli_query($db, $checkValidKdAkunQuery);
        $row = mysqli_fetch_array($result);
        $count = $row[0];

        if ($count > 0) {
            // `kd_akun` valid, lanjutkan dengan INSERT
            $query = "INSERT INTO tbl_target (idpel, kd_akun,nama_pel, rbm, tipe, merk, tipe_kwh, nomet, tanggal, tanggal_akhir, latitude, longitude, status) VALUES ('$idpel', '$nama_pel', '$kd_akun', '$rbm','$tipe','$merk','$tipe_kwh','$nomet', '$tanggal', '$tanggal_akhir', '$latitude', '$longitude', '$status')";

            if (mysqli_query($db, $query)) {
                $successCount++;
            } else {
                $failCount++;
            }
        }
    }
}

if ($successCount > 0) {
    $successMessage = "Berhasil mengimpor $successCount data.";
    header('Location: targetinput.php?success_message=' . urlencode($successMessage));
} else {
    $errorMessage = "Gagal mengimpor $failCount data.";
    header('Location: targetinput.php?error_message=' . urlencode($errorMessage));
}
