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

            $pmet = $_FILES['pmet']['name'];
            move_uploaded_file($_FILES['pmet']['tmp_name'], '../file/' . $_FILES['pmet']['name']);

            $ket = $_POST["ket"];

            $query = "INSERT INTO tbl_pelanggan VALUES(' $idpel','$nama_pel','$daya',' $tipe','$latitude','$longitude','$pmet','$ket')";
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
                    <form class="myForm" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">ID Pelanggan</label>
                            <input type="number" name="idpel" class="form-control" value="" placeholder="id pelanggan">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pelanggan</label>
                            <input type="text" name="nama_pel" class="form-control" value="" placeholder="nama pelanggan">
                        </div>
                        <div class="form-group">
                            <label for="">Daya</label>
                            <select name="daya" id="" class="form-control">
                                <option value="0">-</option>
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
                            <select name="tipe" id="" class="form-control">
                                <option value="0">-</option>
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
                            <input type="file" name="pmet" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" name="ket" class="form-control" value="" placeholder="keterangan">
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
    <?php 
    }
}
?>