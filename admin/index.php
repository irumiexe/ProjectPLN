<?php
include 'header.php';
?>

<div class="container">
    <div class="row">
        <ol class="breadcrumb">
            <h4>DASHBOARD</h4>
        </ol>
    </div>
    <div class="panel-container">
        <div class="bootstrap-tabel">
            <center>
                <h3>SELAMAT DATANG ADMIN</h3>
            </center>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <a href="pelangganaksi.php?aksi=tambah" class="btn btn-primary">Tambah User</a>
            <form class="d-flex ml-auto">
                <input class="form-control mr-1" name="cari" type="search" placeholder="Search" aria-label="Search" value="<?php if (isset($_GET['cari'])) {
                                                                                                                                echo $_GET['cari'];
                                                                                                                            } ?>">
                <button class="btn btn-outline-success" type="cari">Search</button>
            </form>
        </div>

    </div>
</div>