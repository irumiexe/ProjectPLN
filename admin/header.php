<?php
session_start();
include '../assets/conn/cek.php';
include '../assets/conn/config.php';
?>

<html lang="en">

<head>
    <title>Web Sederhana</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Menggunakan Bootstrap CSS dari CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/cosmo.min.css">
    <style>
        .navbar-brand {
            margin: 0 auto;
            display: block;
            text-align: center;
        }

        @media (max-width: 576px) {
            .navbar-brand {
                margin-right: auto;
                text-align: left;
            }
        }
    </style>
</head>

<body onload="getLocation()">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Web Sederhana</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">DASHBOARD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pelangganinput.php">DATA PELANGGAN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Isi konten halaman di sini -->

    <!-- Menggunakan Bootstrap JS (jQuery, Popper.js, dan Bootstrap JS) dari CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>