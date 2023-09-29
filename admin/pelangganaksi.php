<?php
include 'header.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'tambah') {
        if (isset($_POST["submit"])) {
            $idpel = $_POST['idpel'];
            $nama_pel = $_POST['nama_pel'];
            $daya = $_POST['daya'];
            $tipe = $_POST['tipe'];
            $latitude = $_POST["latitude"];
            $longitude = $_POST["longitude"];

            $query = "INSERT INTO tbl_pelanggan VALUES(' $idpel','$nama_pel','$daya',' $tipe','$latitude','$longitude')";
            mysqli_query($db, $query);

            echo
            "
            <script>
            alert('Data Berhasil Di Tambahkan');
            document.location.href = 'pelangganinput.php';
            </script>
            ";
        }
?>

        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <h4>DATA PELANGGAN/ TAMBAH DATA</h4>
                </ol>
            </div>

            <?php

            $carikode = $db->query("SELECT max(idpel) FROM tbl_pelanggan");
            ?>

            <div class="panel-container">
                <div class="bootstrap-tabel">
                    <form class="myForm" action="" method="post" autocomplete="off">
                        <div class="form-group">
                            <label for="">ID Pelanggan</label>
                            <input type="text" name="idpel" class="form-control" value="" placeholder="id pelanggan">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pelanggan</label>
                            <input type="text" name="nama_pel" class="form-control" value="" placeholder="nama pelanggan">
                        </div>
                        <div class="form-group">
                            <label for="">Daya</label>
                            <input type="text" name="daya" class="form-control" value="" placeholder="daya">
                        </div>
                        <div class="form-group">
                            <label for="">Tipe Pembayaran</label>
                            <select name="tipe" id="" class="form-control">
                                <option value="Pascabayar">Pascabayar</option>
                                <option value="Prabayar">Prabayar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Lokasi</label>
                            <tr>
                                <td><input type="text" name="latitude" class="form-control" value=""></td>
                                <td><input type="text" name="longitude" class="form-control" value=""></td>
                            </tr>
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
                                <input type="text" name="idpel" class="form-control" value="<?php echo $d['idpel'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                                <input type="text" name="nama_pel" class="form-control" value="<?php echo $d['nama_pel'] ?>" placeholder="nama pelanggan">
                            </div>
                            <div class="form-group">
                                <label for="">Daya</label>
                                <input type="text" name="daya" class="form-control" value="<?php echo $d['daya'] ?>" placeholder="daya">
                            </div>
                            <div class="form-group">
                                <label for="">Tipe Pembayaran</label>
                                <select name="tipe" id="" class="form-control" value="<?php echo $d['tipe'] ?>">
                                    <option value="<?php echo $d['tipe'] ?>"><?php echo $d['tipe'] ?></option>
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