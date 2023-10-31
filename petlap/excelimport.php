<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Nama file Excel yang ingin diimpor
$excelFile = 'path_to_your_excel_file.xlsx';

try {
    // Baca file Excel
    $spreadsheet = IOFactory::load($excelFile);
    
    // Pilih lembar kerja (worksheet) yang ingin Anda impor
    $worksheet = $spreadsheet->getActiveSheet();

    // Dapatkan jumlah baris dan kolom
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();

    // Loop melalui baris-baris dalam lembar kerja
    for ($row = 1; $row <= $highestRow; $row++) {
        // Loop melalui kolom-kolom dalam baris
        for ($col = 'A'; $col <= $highestColumn; $col++) {
            // Dapatkan nilai sel
            $cellValue = $worksheet->getCell($col . $row)->getValue();
            
            // Lakukan sesuatu dengan nilai sel, misalnya, masukkan ke database
            // Di sini Anda dapat menambahkan kode untuk menangani nilai sel sesuai kebutuhan Anda.
        }
    }
} catch (Exception $e) {
    echo 'Terjadi kesalahan: ',  $e->getMessage();
}
