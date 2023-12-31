<?php
include 'header.php';

$kd_akun = isset($_GET['kd_akun']) ? $_GET['kd_akun'] : '';

if (!isset($_SESSION['kd_akun_user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tambah') {
        $kd_akun_user = $_SESSION['kd_akun_user'];
        $tanggal_dipilih = date('Y-m-d');
?>

        <style>
            .form-group {
                margin-top: 10px;

            }

            .container-xl {
                max-width: 1705px;
                /* Atur lebar maksimum kontainer sesuai dengan preferensi Anda */
            }

            .row {
                width: 100%;
            }
        </style>

        <div class="container-xl">
            <div class="row">
                <ol class="breadcrumb px-2 pt-2">
                    <h4>DATA PETUGAS/ TAMBAH TARGET</h4>
                </ol>
            </div>

            <div class="panel-container">
                <center>
                    <?php

                    ?>
                </center>
                <div class="bootstrap-tabel">
                    <form class="myForm" action="targetproses.php?proses=prosestambah" method="post" enctype="multipart/form-data" required>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <div class="input-group">
                                <input type="date" name="tanggal" class="form-control" value="<?php echo $tanggal_dipilih; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal akhir</label>
                            <div class="input-group">
                                <input type="date" name="tanggal_akhir" class="form-control" value="<?php echo $tanggal_dipilih; ?>">
                            </div>
                        </div>
                        <div class="form-group" hidden>
                            <label for="kd_akun">Akun Tujuan</label>
                            <div class="input-group">
                                <input type="hidden" name="kd_akun" class="form-control" value="<?php echo $kd_akun; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">ID Pelanggan</label>
                            <p style="font-size: 10px; color: red;"><i>*Mohon isi ID pelanggan dengan benar</i></p>
                            <div class="input-group">
                                <input type="text" name="idpel" class="form-control" value="" placeholder="Masukkan ID Pelanggan Minimal 11 Angka dan Maksimal 12 Angka" autofocus minlength="11" maxlength="12" required>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pelanggan</label>
                            <div class="input-group">
                                <input type="text" name="nama_pel" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kd_akun">Rute Meter</label>
                            <div class="input-group">
                                <input type="text" name="rbm" class="form-control" placeholder="">
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
                            <label for="">Alamat</label>
                            <div class="input-group">
                                <input type="text" name="alamat" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group" hidden>
                            <label for="kd_akun">Status</label>
                            <div class="input-group">
                                <input type="number" name="status" value="0" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Lokasi</label>
                            <div class="input-group">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" name="latitude" class="form-control" value="" placeholder="Garis Lintang">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="longitude" class="form-control" value="" placeholder="Garis Bujur">
                                    </div>
                                </div>
                                <span class="input-group-addon"><i class="bi bi-geo-alt"></i></span>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <a href="targetinput.php" class="btn btn-primary">Kembali</a>
                    <button type="submit" class="btn btn-success" name="submit" onclick="confirmSubmit()">Submit</button>
                </div>
                </form>
                <script type="text/javascript">
                    function confirmSubmit() {
                        if (confirm('Yakin data sudah benar?')) {
                            document.querySelector('.myForm').submit();
                        } else {
                            // Tidak melakukan apa-apa jika pengguna membatalkan
                        }
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
        <?php include '../assets/footer.php'; ?>
        </div>
    <?php } elseif ($_GET['aksi'] == 'ubah') { ?>

        <style>
            .form-group {
                margin-top: 10px;

            }

            .container-xl {
                max-width: 1705px;
                /* Atur lebar maksimum kontainer sesuai dengan preferensi Anda */
            }
        </style>
        <div class="container-xl">
            <div class="row">
                <ol class="breadcrumb px-2 pt-2">
                    <h4>TARGET/ UBAH</h4>
                </ol>
            </div>
            <div class="panel-container">
                <div class="bootstrap-tabel">
                    <?php
                    $data = $db->query("SELECT * From tbl_target where idpel='$_GET[kode]'");
                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                        <form class="myForm" action="targetproses.php?proses=ubah&kode=<?php echo $d['idpel']; ?>" method="post" enctype="multipart/form-data" required>
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <div class="input-group">
                                    <input type="date" name="tanggal" class="form-control" value="<?php echo $d['tanggal']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Akhir</label>
                                <div class="input-group">
                                    <input type="date" name="tanggal_akhir" class="form-control" value="<?php echo $d['tanggal_akhir']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kd_akun">Akun Tujuan</label>
                                <div class="input-group">
                                    <input type="text" name="kd_akun" class="form-control" value="<?php echo $d['kd_akun']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">ID Pelanggan</label>
                                <div class="input-group">
                                    <input type="text" name="idpel" class="form-control" value="<?php echo $d['idpel']; ?>" placeholder="Masukkan ID Pelanggan Minimal 11 Angka dan Maksimal 12 Angka" autofocus minlength="11" maxlength="12" required readonly>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                                <div class="input-group">
                                    <input type="text" name="nama_pel" value="<?php echo $d['nama_pel'] ?>" class="form-control" placeholder="" maxlength="50">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kd_akun">Rute Meter</label>
                                <div class="input-group">
                                    <input type="text" name="rbm" value="<?php echo $d['rbm'] ?>" class="form-control" placeholder="Masukkan Rute" maxlength="13">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Tipe Pembayaran</label>
                                <div class="input-group">
                                    <select name="tipe" id="" class="form-control" required>
                                        <option value="<?php echo $d['tipe'] ?>"><?php echo $d['tipe'] ?></option>
                                        <option value="Pascabayar">Pascabayar</option>
                                        <option value="Prabayar">Prabayar</option>
                                    </select>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-shopping-cart"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">alamat</label>
                                <div class="input-group">
                                    <input type="text" name="alamat" value="<?php echo $d['alamat'] ?>" class="form-control" placeholder="" maxlength="100">
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <label for="kd_akun">Status</label>
                                <div class="input-group">
                                    <input type="number" name="status" value="0" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Lokasi</label>
                                <div class="input-group">
                                    <div class="row">
                                        <div class="col">
                                            <td><input type="text" name="latitude" class="form-control" value="<?php echo $d['latitude']; ?>" placeholder="Garis Lintang"></td>
                                        </div>
                                        <div class="col">
                                            <td><input type="text" name="longitude" class="form-control" value="<?php echo $d['longitude']; ?>" placeholder="Garis Bujur"></td>
                                        </div>
                                    </div>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                </div>
                            </div>
                </div>
                <div class="modal-footer">
                    <a href="targetinput.php" class="btn btn-primary">Kembali</a>
                    <button type="submit" class="btn btn-success" name="submit" onclick="confirmSubmit()">Submit</button>
                </div>
                </form>
                <?php include '../assets/footer.php'; ?>
                <script>
                    function confirmUpdate() {
                        if (confirm('Yakin data sudah benar?')) {
                            document.querySelector('form').submit();
                        } else {}
                    }
                </script>
            <?php } ?>
    <?php
    }
}
    ?>