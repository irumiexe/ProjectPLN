<?php
include 'header.php';

if (!isset($_SESSION['kd_akun_user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tambah') {
        $kd_akun_user = $_SESSION['kd_akun_user'];

        $alert_message = "Mohon untuk Mengaktifkan Location dan Membuka Aplikasi Gmaps Terlebih Dahulu Agar Memperkuat Akurasi Titik Koordinat!";
?>

        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <h4>DATA PELANGGAN/ TAMBAH DATA</h4>
                </ol>
            </div>

            <div class="panel-container">
                <center>
                    <?php
                    if (isset($alert_message)) {
                        echo '<div class="alert alert-warning">' . $alert_message . '</div>';
                    }
                    ?>
                </center>
                <div class="bootstrap-tabel">
                    <form class="myForm" action="pelangganproses.php?proses=prosestambah" method="post" autocomplete="off" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <div class="input-group">
                                <input type="text" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="form-group" hidden>
                            <label for="">kd_idpel</label>
                            <!-- Tidak perlu menyertakan kd_idpel dalam formulir -->
                        </div>
                        <div class="form-group">
                            <label for="">ID Pelanggan</label>
                            <div class="input-group">
                                <input type="text" name="idpel" class="form-control" value="" placeholder="Masukkan ID Pelanggan Minimal 11 Angka dan Maksimal 12 Angka" required autofocus minlength="11" maxlength="12">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pelanggan</label>
                            <div class="input-group">
                                <input type="text" name="nama_pel" class="form-control" value="" placeholder="Masukkan Nama Pelanggan" required minlength="2">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="">Daya (VA)</label>
                            <p style="font-size: 10px; color: red;"><i>*Isi salah satu kolom yang dibawah ini</i></p>
                            <div class="input-group">
                                <div class="row">
                                    <div class="col">
                                        <select name="daya_select" id="dayaSelect" class="form-control" onchange="toggleDayaInput()">
                                            <option value="" selected>Pilih Opsi</option>
                                            <option value="450">450</option>
                                            <option value="900">900</option>
                                            <option value="1300">1300</option>
                                            <option value="2200">2200</option>
                                            <option value="3500">3500</option>
                                            <option value="4400">4400</option>
                                            <option value="5500">5500</option>
                                            <option value="6600">6600</option>
                                            <option value="7700">7700</option>
                                            <option value="7700">9000</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="daya_input" id="dayaInput" placeholder="Masukkan Jika Tidak Ada Pilihan Daya" disabled>
                                    </div>
                                </div>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-flash"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Tipe Pembayaran</label>
                            <div class="input-group">
                                <select name="tipe" id="" class="form-control" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Pascabayar">Pascabayar</option>
                                    <option value="Prabayar">Prabayar</option>
                                </select>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-shopping-cart"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <tr>
                                <td><input type="hidden" name="latitude" class="form-control" value=""></td>
                                <td><input type="hidden" name="longitude" class="form-control" value=""></td>
                            </tr>
                        </div>
                        <div class="form-group">
                            <label for="">Photo Meteran</label>
                            <div class="input-group">
                                <input type="file" name="pmet" class="form-control" value="" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-cloud-upload"></i></span>
                            </div>

                        </div>
                        <div class="form-group">

                            <div class="input-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Keterangan</label>
                                        <select name="ket" class="form-control" required>
                                            <option value="">Pilih opsi</option>
                                            <option value="macet">macet</option>
                                            <option value="Tinggi">Tinggi</option>
                                            <option value="Buram">Buram</option>
                                            <option value="Normal">Normal</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">Rincian</label>
                                        <input type="text" name="ket2" class="form-control" placeholder="Masukkan Jika Ada Keterangan Lebih Lanjut">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" hidden>kode_akun</label>
                            <input type="hidden" name="kd_akun" class="form-control" value="<?php echo $kd_akun_user; ?>" readonly>
                        </div>
                        <div class="modal-footer">
                            <a href="pelangganinput.php" class="btn btn-primary">Kembali</a>
                            <button type="button" class="btn btn-success" onclick="confirmSubmit()">Submit</button>
                        </div>
                    </form>
                    <script type="text/javascript">
                        function toggleDayaInput() {
                            var dayaSelect = document.getElementById('dayaSelect');
                            var dayaInput = document.getElementById('dayaInput');
                            dayaInput.disabled = (dayaSelect.value !== "");
                        }
                        document.addEventListener('DOMContentLoaded', function() {
                            toggleDayaInput();
                        });


                        function confirmSubmit() {
                            if (confirm('Yakin data sudah benar?')) {
                                document.querySelector('.myForm').submit();
                            } else {
                                // Tidak melakukan apa-apa jika pengguna membatalkan
                            }
                        }

                        function getLocation() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(showPosition, showError);
                            }
                        }

                        function showPosition(position) {
                            document.querySelector('.myForm input[name= "latitude"]').value = position.coords.latitude;
                            document.querySelector('.myForm input[name= "longitude"]').value = position.coords.longitude;
                        }

                        function showError(error) {
                            switch (error.code) {
                                case error.PERMISSION_DENIED:
                                    alert("aktifkan location");
                                    location.reload();
                                    break;

                                default:
                                    break;
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    <?php } 
}
?>