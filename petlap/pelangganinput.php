<?php
include 'header.php';

// Inisialisasi tanggal hari ini
$tanggal_hari_ini = date('Y-m-d');

// Ambil daftar tanggal unik dari database
$query_tanggal_unik = "SELECT DISTINCT tanggal FROM tbl_pelanggan";
$result_tanggal_unik = mysqli_query($db, $query_tanggal_unik);
$tanggal_unik = mysqli_fetch_all($result_tanggal_unik, MYSQLI_ASSOC);

// Inisialisasi jumlah data dengan 0
$jumlah_data = 0;

// Pengecekan apakah tanggal dipilih dan mendapatkan jumlah data
// ...

if (isset($_GET['tanggal'])) {
    $tanggal_terpilih = $_GET['tanggal'];
    $tanggal_terpilih_formatted = date_create_from_format('d/m/Y', $tanggal_terpilih);
    $tanggal_terpilih_sql_format = date_format($tanggal_terpilih_formatted, 'Y-m-d');

    // Tambahkan baris echo untuk menampilkan query
    echo "Query: SELECT COUNT(*) as jumlah_data FROM tbl_pelanggan WHERE tanggal = '$tanggal_terpilih_sql_format'";

    $query_hitung_data = "SELECT COUNT(*) as jumlah_data FROM tbl_pelanggan WHERE tanggal = '$tanggal_terpilih_sql_format'";
    $result_hitung_data = mysqli_query($db, $query_hitung_data);

    if ($result_hitung_data) {
        $data_hitung = mysqli_fetch_assoc($result_hitung_data);
        $jumlah_data = $data_hitung['jumlah_data'];
    } else {
        echo "Error: " . mysqli_error($db);
    }

    echo "Jumlah Data: " . $jumlah_data; // Debugging purpose
}

// ...

?>

<div class="container-xl">
    <div class="row">
        <ol class="breadcrumb">
            <h4>INPUT DATA PELANGGAN</h4>
        </ol>
    </div>
    <div class="panel-container">
        <div class="bootstrap-tabel">
            <div class="d-flex justify-content-between mb-3">
                <a href="pelangganaksi.php?aksi=tambah" class="btn btn-primary">Tambah Data</a>

                <!-- Pilihan tanggal -->
                <div>
                    <label for="tanggal">Pilih Tanggal: </label>
                    <select id="tanggal" name="tanggal">
                        <?php
                        foreach ($tanggal_unik as $tanggal_item) {
                            echo "<option value='{$tanggal_item['tanggal']}'>{$tanggal_item['tanggal']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Menampilkan tanggal dan jumlah data -->
                <div>
                    <p>Tanggal yang Dipilih: <span id="tanggal_terpilih"><?php echo $tanggal_hari_ini; ?></span></p>
                    <p>Jumlah Data: <span id="jumlah_data"><?php echo $jumlah_data; ?></span></p>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk memperbarui tanggal dan jumlah data
    function updateData() {
        var tanggal_terpilih = document.getElementById('tanggal').value;

        // Kirim permintaan AJAX untuk mendapatkan jumlah data
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var jumlah_data = JSON.parse(this.responseText).jumlah_data;

                // Perbarui elemen HTML
                document.getElementById('tanggal_terpilih').innerText = tanggal_terpilih;
                document.getElementById('jumlah_data').innerText = jumlah_data;
            }
        };
        xhr.open("GET", "hitung_data.php?tanggal=" + tanggal_terpilih, true);
        xhr.send();
    }

    // Panggil fungsi updateData saat halaman dimuat dan saat tanggal diubah
    window.onload = updateData;
    document.getElementById('tanggal').addEventListener('change', updateData);
</script>