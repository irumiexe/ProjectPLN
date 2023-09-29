<?php
session_start();
include '../assets/conn/cek.php';
include '../assets/conn/config.php';
?>

<html>

<head>
    <title>Web Sederhana</title>
    <link rel="stylesheet" href="../assets/css/cosmo.min.css">
</head>

<body onload="getLocation();">
    <nav class="navbar-inverse navbar-static-right">

        <div class="container">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href=""></a></li>
                    <li><a href="index.php">DASHBOARD</a></li>
                    <li><a href="pelangganinput.php">DATA PELANGGAN</a></li>
                    <li><a href="logout.php">LOGOUT 2 </a></li>
                </ul>
            </div>
        </div>

    </nav>
</body>

</html>