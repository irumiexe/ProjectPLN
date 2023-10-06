<?php
// Koneksi ke database
include '../assets/conn/config.php';

// Ambil data pelanggan dari database
$daftar_pelanggan = mysqli_query($db, "SELECT * from tbl_pelanggan");

// Membuat file Excel
$filename = "Daftar Pelanggan.xls";

// Header untuk mengunduh file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=" . $filename);

// Mengeluarkan data dalam format Excel
echo '<table border="1">
    <tr>
    <th>NO</th>
    <th>ID PELANGGAN</th>
    <th>NAMA PELANGGAN</th>
    <th>DAYA</th>
    <th>TIPE PEMBAYARAN</th>
    <th>MAPS</th>
    <th>FOTO KWH</th>
    <th>KETERANGAN</th>
    </tr>';
$no = 1;
while ($row = mysqli_fetch_assoc($daftar_pelanggan)) {
    $maps = $row['latitude'] . ', ' . $row['longitude'];
    echo "<tr>
    <td style='mso-number-format:\"\\@\";'>$no</td>
    <td style='mso-number-format:\"\\@\";'>" . $row['idpel'] . "</td>
    <!-- Sisipkan style='mso-number-format:\"\\@\";' pada kolom yang ingin diubah menjadi format teks -->
    <td>" . $row['nama_pel'] . "</td>
    <td>" . $row['daya'] . "</td>
    <td>" . $row['tipe'] . "</td>
    <td>" . $maps . "</td>
    <td>" . $row['pmet'] . "</td>
    <td>" . $row['ket'] . "</td>
</tr>";
    $no++;
}
echo '</table>';

// Tutup koneksi database
mysqli_close($db);
