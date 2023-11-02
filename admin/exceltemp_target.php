<?php
include '../assets/conn/config.php';



$filename = "Daftar Pelanggan.xls";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=" . $filename);

echo '<table border="1">
    <tr>
    <th>NO</th>
    <th>ID PELANGGAN</th>
    <th>NAMA PELANGGAN</th>
    <th>DAYA</th>
    <th>TIPE PEMBAYARAN</th>
    <th>MAPS</th>
    <th>FOTO KWH</th>
    <th>Merk KWH Meteran</th>
    <th>Type KWH Meteran</th>
    <th>Nomor KWH Meteran</th>
    <th>KETERANGAN</th>
    <th>RINCIAN</th>
    </tr>';
echo '</table>';

mysqli_close($db);
