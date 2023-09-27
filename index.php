<?php
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'login') {
        session_start();
        include 'assets/conn/config.php';
        $username = $_POST['username'];
        $password = $_POST['password'];

        $hasil = $db->query("SELECT * from tbl_akun where username='$username' AND password='$password'");
        $cek = mysqli_num_rows($hasil);
        if ($hasil > 0) {
            $data = $hasil->fetch_assoc();
            if ($data['level'] == 'Admin') {
                $_SESSION['username'] = $username;
                $_SESSION['level'] = 'Admin';
                header("location:admin/index.php");
            } else {
                header("location:index.php?pesan=gagal");
            }
        }
    }
}
?>

<html>

<head>
    <title>Web Sederhana</title>
    <link rel="stylesheet" href="assets/css/cosmo.min.css">
    <style type="text/css">
        .kotak {
            margin-top: 150px;
            padding-left: 300px;
        }

        .kotak .input-group {
            margin-left: 20px;
        }

        .container {
            width: 1000px;
            height: 600px;
            background: rgb(255, 255, 255);
            margin: 180px auto;
            padding: 10px 30px;
            border-radius: 30px;
            box-shadow: 7px 7px 10px;
        }

    </style>
</head>

<body style="background-color:skyblue">

    <?php
    if (isset($_GET['aksi'])) {
        if ($_GET['aksi'] == 'login') {
            echo "<div style='margin-bottom:-1px;' class='alert alert-danger' role='alert'>Login anda gagal username dan password salah</div>";
        }
    }
    ?>
    <div class="container">
        <form action="index.php?aksi=login" method="post" enctype="multipart/form-data">
            <div class="col-md-9 col-offset-4 kotak">
                <div class="text-center">
                    <h3>LOGIN SISTEM</h3>
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="password">
                </div>
                <div class="form-group">
                    <input type="submit" value="LOGIN" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</body>

</html>