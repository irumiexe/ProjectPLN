<?php
include 'header.php';

// Pastikan user sudah login dan ada informasi kd_akun_user di sesi
if (!isset($_SESSION['kd_akun_user'])) {
    // Jika tidak, mungkin redirect ke halaman login atau lakukan tindakan lain
    header("Location: login.php");
    exit();
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tambah') {
        // Mengambil kd_akun_user dari sesi
        $kd_akun_user = $_SESSION['kd_akun_user'];
?>

        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <h4>DATA PELANGGAN/ TAMBAH DATA</h4>
                </ol>
            </div>

            <div class="panel-container">
                <div class="bootstrap-tabel">
                    <form class="myForm" action="pelangganproses.php?proses=prosestambah" method="post" autocomplete="off" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="text" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">ID Pelanggan</label>
                            <input type="text" name="idpel" class="form-control" value="" placeholder="id pelanggan harus 12 digit" required autofocus maxlength="12">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pelanggan</label>
                            <input type="text" name="nama_pel" class="form-control" value="" placeholder="nama pelanggan" required minlength="2">
                        </div>
                        <div class="form-group">
                            <label for="">Daya</label>
                            <select name="daya" id="" class="form-control" required>
                                <option value="">-</option>
                                <option value="450VA">450VA</option>
                                <option value="900VA">900VA</option>
                                <option value="1300VA">1300VA</option>
                                <option value="2200VA">2200VA</option>
                                <option value="3500VA">3500VA</option>
                                <option value="6600VA">6600VA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tipe Pembayaran</label>
                            <select name="tipe" id="" class="form-control" required>
                                <option value="">-</option>
                                <option value="Pascabayar">Pascabayar</option>
                                <option value="Prabayar">Prabayar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <tr>
                                <td><input type="hidden" name="latitude" class="form-control" value=""></td>
                                <td><input type="hidden" name="longitude" class="form-control" value=""></td>
                            </tr>
                        </div>
                        <div class="form-group">
                            <label for="">Photo Meteran</label>
                            <input type="file" name="pmet" class="form-control" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" name="ket" class="form-control" value="" placeholder="keterangan" required>
                        </div>
                        <div class="form-group">
                            <label for="" hidden>kode_akun</label>
                            <input type="hidden" name="kd_akun" class="form-control" value="<?php echo $kd_akun_user; ?>" readonly>
                        </div>
                        <div class="modal-footer">
                            <a href="pelangganinput.php" class="btn btn-primary">Kembali</a>
                            <button type="submit" class="btn btn-success" name="submit"> Submit</button>
                        </div>
                    </form>
                    <script type="text/javascript">
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
    <?php } elseif ($_GET['aksi'] == 'ubah') { ?>
        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <h4>PELANGGAN/ UBAH</h4>
                </ol>
            </div>

            <div class="panel-container">
                <div class="bootstrap-tabel">
                    <?php
                    $data = $db->query("SELECT * From tbl_pelanggan where idpel='$_GET[kode]'");
                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                        <form action="pelangganproses.php?proses=ubah" method="post" enctype="multipart/form-data">
                            <div>
                                <label for="">ID Pelanggan</label>
                                <input type="text" name="idpel" class="form-control" value="<?php echo $d['idpel'] ?>" placeholder="id pelanggan harus 12 digit" pattern="^([1-9])[0-9]{11}$" required autofocus maxlength="12">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                                <input type="text" name="nama_pel" class="form-control" value="<?php echo $d['nama_pel'] ?>" placeholder="nama pelanggan" required>
                            </div>
                            <div class="form-group">
                                <label for="">Daya</label>
                                <select name="daya" id="" class="form-control" required>
                                    <option value="450VA">450VA</option>
                                    <option value="900VA">900VA</option>
                                    <option value="1300VA">1300VA</option>
                                    <option value="2200VA">2200VA</option>
                                    <option value="3500VA">3500VA</option>
                                    <option value="6600VA">6600VA</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tipe Pembayaran</label>
                                <select name="tipe" id="" class="form-control" required>
                                    <option value=<?php echo $d['tipe'] ?>""><?php echo $d['tipe'] ?></option>
                                    <option value="Pascabayar">Pascabayar</option>
                                    <option value="Prabayar">Prabayar</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Lokasi</label>
                                <tr>
                                    <td><input type="text" name="latitude" class="form-control" value="<?php echo $d['latitude'] ?>"></td>
                                    <td><input type="text" name="longitude" class="form-control" value="<?php echo $d['longitude'] ?>"></td>
                                </tr>
                            </div>
                            <div class="form-group">
                                <label for="">Photo Meteran</label>
                                <input type="file" name="pmet" class="form-control" value="<?php echo $d['pmet'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" name="ket" class="form-control" value="<?php echo $d['ket'] ?>" placeholder="keterangan" required>
                            </div>
                            <div class="form-group">
                                <label for="">kode_akun</label>
                                <input type="hidden" name="kd_akun" class="form-control" value="<?php echo $d['kd_akun']; ?>" readonly>
                            </div>
                            <div class="modal-footer">
                                <a href="pelangganinput.php" class="btn btn-primary">Kembali</a>
                                <input type="submit" class="btn btn-success" value="Ubah">
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
<?php
    }
}
?>