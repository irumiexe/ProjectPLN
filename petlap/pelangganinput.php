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
$tanggal_terpilih = $tanggal_hari_ini;  // Set default tanggal

if (isset($_GET['tanggal'])) {
    $tanggal_terpilih = $_GET['tanggal'];

    $query_hitung_data = "SELECT COUNT(*) as jumlah_data FROM tbl_pelanggan WHERE tanggal = '$tanggal_terpilih'";
    $result_hitung_data = mysqli_query($db, $query_hitung_data);

    if ($result_hitung_data) {
        $data_hitung = mysqli_fetch_assoc($result_hitung_data);
        $jumlah_data = $data_hitung['jumlah_data'];
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
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
                <form class="d-flex ml-auto" id="form_tanggal">
                    <label for="tanggal">Pilih Tanggal:</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" value="<?php echo $tanggal_terpilih; ?>" max="<?php echo date('Y-m-d'); ?>">
                    <button class="btn btn-outline-success" type="button" onclick="updateData()">Terap</button>
                </form>

                <!-- Menampilkan tanggal dan jumlah data -->
                <div>
                    <p>Tanggal yang Dipilih: <span id="tanggal_terpilih"><?php echo $tanggal_terpilih; ?></span></p>
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
                var response = JSON.parse(this.responseText);

                // Perbarui elemen HTML
                document.getElementById('tanggal_terpilih').innerText = tanggal_terpilih;
                document.getElementById('jumlah_data').innerText = response.jumlah_data;
            }
        };
        xhr.open("GET", "hitung_data.php?tanggal=" + tanggal_terpilih, true);
        xhr.send();
    }

    // Panggil fungsi updateData saat halaman dimuat
    window.onload = updateData;
</script>