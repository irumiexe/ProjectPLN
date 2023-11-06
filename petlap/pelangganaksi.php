<?php
include 'header.php';

if (!isset($_SESSION['kd_akun_user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tambah') {
        // Ambil parameter dari URL
        $kd_akun_user = $_GET['kd_akun_user'];
        $tanggal_dipilih = $_GET['tanggal_dipilih'];

        $alert_message = "Mohon untuk Mengaktifkan Location dan Membuka Aplikasi Gmaps Terlebih Dahulu Agar Memperkuat Akurasi Titik Koordinat!";

        $idpelanggan = $_GET['idpel']; // Anda sudah mengambilnya dari $_GET

        // Lakukan kueri ke database
        $query = "SELECT * FROM tbl_target WHERE idpel = '$idpelanggan'";
        $result = mysqli_query($db, $query);
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

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $nama_pel = $row['nama_pel'];
                        $tipe_pembayaran = $row['tipe'];
                        $merek_kwh = $row['merk'];
                        $type_kwh = $row['tipe_kwh'];
                        $nomet = $row['nomet'];
                    ?>
                </center>
                <div class="bootstrap-tabel">


                    <form class="myForm" action="pelangganproses.php?proses=prosestambah" method="post" enctype="multipart/form-data" autocomplete="off" required>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <div class="input-group">
                                <input type="text" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">ID Pelanggan</label>
                            <p style="font-size: 10px; color: red;"><i>*Mohon isi ID pelanggan dengan benar</i></p>
                            <div class="input-group">
                                <input type="text" name="idpel" class="form-control" value="<?php echo isset($_GET['idpel']) ? htmlspecialchars($_GET['idpel']) : ''; ?>" placeholder="Masukkan ID Pelanggan Minimal 11 Angka dan Maksimal 12 Angka" autofocus minlength="11" maxlength="12" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pelanggan</label>
                            <div class="input-group">
                                <input type="text" name="nama_pel" class="form-control" value="<?php echo $nama_pel; ?>" placeholder="Masukkan Nama Pelanggan" required minlength="2">
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
                                <select name="tipe" class="form-control" required>
                                    <option value="">Pilih Opsi</option>
                                    <option value="Pascabayar" <?php if ($tipe_pembayaran == 'Pascabayar') echo 'selected'; ?>>Pascabayar</option>
                                    <option value="Prabayar" <?php if ($tipe_pembayaran == 'Prabayar') echo 'selected'; ?>>Prabayar</option>
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
                            <label for="">Merk kWh Meter</label>
                            <select name="merk" class="form-control" required>
                                <option value="">Pilih Opsi</option>
                                <option value="SMARTMETER" <?php if ($merek_kwh == 'SMARTMETER') echo 'selected'; ?>>SMARTMETER</option>
                                <option value="HEXING" <?php if ($merek_kwh == 'HEXING') echo 'selected'; ?>>HEXING</option>
                                <option value="ITRON" <?php if ($merek_kwh == 'ITRON') echo 'selected'; ?>>ITRON</option>
                                <option value="MELCOINDA" <?php if ($merek_kwh == 'MELCOINDA') echo 'selected'; ?>>MELCOINDA</option>
                                <option value="CANNET" <?php if ($merek_kwh == 'CANNET') echo 'selected'; ?>>CANNET</option>
                                <option value="SANXING" <?php if ($merek_kwh == 'SANXING') echo 'selected'; ?>>SANXING</option>
                                <option value="FUJI" <?php if ($merek_kwh == 'FUJI') echo 'selected'; ?>>FUJI</option>
                                <option value="METBELOSA" <?php if ($merek_kwh == 'METBELOSA') echo 'selected'; ?>>METBELOSA</option>
                                <option value="WASION" <?php if ($merek_kwh == 'WASION') echo 'selected'; ?>>WASION</option>
                                <option value="STAR" <?php if ($merek_kwh == 'STAR') echo 'selected'; ?>>STAR</option>
                                <option value="ACTARIS" <?php if ($merek_kwh == 'ACTARIS') echo 'selected'; ?>>ACTARIS</option>
                                <option value="EDMI" <?php if ($merek_kwh == 'EDMI') echo 'selected'; ?>>EDMI</option>
                                <option value="SIGMA" <?php if ($merek_kwh == 'SIGMA') echo 'selected'; ?>>SIGMA</option>
                                <option value="SCHLUMBERGER" <?php if ($merek_kwh == 'SCHLUMBERGER') echo 'selected'; ?>>SCHLUMBERGER</option>
                                <option value="MEISYS" <?php if ($merek_kwh == 'MEISYS') echo 'selected'; ?>>MEISYS</option>
                                <option value="SAINT" <?php if ($merek_kwh == 'SAINT') echo 'selected'; ?>>SAINT</option>
                                <option value="MECOINDO" <?php if ($merek_kwh == 'MECOINDO') echo 'selected'; ?>>MECOINDO</option>
                                <option value="GLOMET" <?php if ($merek_kwh == 'GLOMET') echo 'selected'; ?>>GLOMET</option>
                                <option value="LIPUVINDO" <?php if ($merek_kwh == 'LIPUVINDO') echo 'selected'; ?>>LIPUVINDO</option>
                                <option value="LANDIS+GYR" <?php if ($merek_kwh == 'LANDIS+GYR') echo 'selected'; ?>>LANDIS+GYR</option>
                                <option value="MITSUBISHI" <?php if ($merek_kwh == 'MITSUBISHI') echo 'selected'; ?>>MITSUBISHI</option>
                                <option value="OSAKI" <?php if ($merek_kwh == 'OSAKI') echo 'selected'; ?>>OSAKI</option>
                                <option value="SCHNEIDER" <?php if ($merek_kwh == 'SCHNEIDER') echo 'selected'; ?>>SCHNEIDER</option>
                                <option value="KRIZIK" <?php if ($merek_kwh == 'KRIZIK') echo 'selected'; ?>>KRIZIK</option>
                                <option value="GANZ" <?php if ($merek_kwh == 'GANZ') echo 'selected'; ?>>GANZ</option>
                                <option value="LANDIS" <?php if ($merek_kwh == 'LANDIS') echo 'selected'; ?>>LANDIS</option>
                                <option value="SGRID" <?php if ($merek_kwh == 'SGRID') echo 'selected'; ?>>SGRID</option>
                                <option value="EMAIL" <?php if ($merek_kwh == 'EMAIL') echo 'selected'; ?>>EMAIL</option>
                                <option value="ENERTEC" <?php if ($merek_kwh == 'ENERTEC') echo 'selected'; ?>>ENERTEC</option>
                                <option value="CHANGSHA" <?php if ($merek_kwh == 'CHANGSHA') echo 'selected'; ?>>CHANGSHA</option>
                                <option value="GALVANIZE" <?php if ($merek_kwh == 'GALVANIZE') echo 'selected'; ?>>GALVANIZE</option>
                                <option value="GE" <?php if ($merek_kwh == 'GE') echo 'selected'; ?>>GE</option>
                                <option value="PRODIGY" <?php if ($merek_kwh == 'PRODIGY') echo 'selected'; ?>>PRODIGY</option>
                                <option value="ELSTER" <?php if ($merek_kwh == 'ELSTER') echo 'selected'; ?>>ELSTER</option>
                                <option value="AEG" <?php if ($merek_kwh == 'AEG') echo 'selected'; ?>>AEG</option>
                                <option value="ADTECH" <?php if ($merek_kwh == 'ADTECH') echo 'selected'; ?>>ADTECH</option>
                                <option value="ELIPS SYSTEM" <?php if ($merek_kwh == 'ELIPS SYSTEM') echo 'selected'; ?>>ELIPS SYSTEM</option>
                                <option value="METRICO" <?php if ($merek_kwh == 'METRICO') echo 'selected'; ?>>METRICO</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Type kWh Meter</label>
                            <input type="text" name="tipemet" class="form-control" placeholder="Masukkan Type kWh Meter" value="<?php echo $type_kwh; ?>" require>
                        </div>
                        <div class="form-group">
                            <label for="">Nomor kWh Meter</label>
                            <input type="text" name="nomet" class="form-control" placeholder="Masukkan Nomor Meter Minimal 11 Angka dan Maksimal 12 Angka" value="<?php echo $nomet; ?>" autofocus minlength="11" maxlength="12" require>
                        </div>
                        <div class="form-group" hidden>
                            <label for="kd_akun">Status</label>
                            <div class="input-group">
                                <input type="number" name="status" value="1" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Keterangan</label>
                                        <select name="ket" class="form-control" required>
                                            <option value="">Pilih opsi</option>
                                            <option value="Macet">macet</option>
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
                            <button type="submit" class="btn btn-success" name="submit" onclick="confirmSubmit()">Submit</button>
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
                <?php } ?>
                </div>
            </div>
        </div>

<?php
    }
}
?>