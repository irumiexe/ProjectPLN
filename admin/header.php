<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include '../assets/conn/cek.php';
include '../assets/conn/config.php';
?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SI PLN</title>
    <link href="../assets/img/Logo_PLN.png" rel="icon" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .nav-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #000;
        }

        .nav-link:hover {
            background-color: #ccc;
        }

        .sb-nav-link-icon {
            margin-right: 10px;
        }

        .nav-submenu {
            display: none;
        }

        .nav-item.active .nav-submenu {
            display: block;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-info">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 text-center" href="index.php"><b>SI PLN</b></a>

        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">

            </div>
        </form>
        <!-- Navbar-->

        <ul class="navbar-nav d-md-inline-block form-inline  ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= strtoupper($_SESSION['username']) ?><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-footer">
                            <div class="d-flex align-items-center">
                                <img src="../assets/img/Logo_PLN.png" width="45px" height="60px" alt="Footer Image">
                                <div class="ms-3" style="color: #fff;">
                                    <b>SIPLN</b><br>
                                    <a>UP3 Banjarmasin</a>
                                </div>
                            </div>
                        </div>

                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="../admin/index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="nav-item">
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Data
                            </a>
                            <div class="nav-submenu">
                                <ul class="small">
                                    <a class="nav-link" href="../admin/pelangganinput.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></i></div>
                                        Pelanggan
                                    </a>
                                    <a class="nav-link" href="../admin/akuninput.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-user-lock"></i></div>
                                        Hak Akses
                                    </a>
                                    <a class="nav-link" href="../admin/targetinput.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-user-check"></i></div>
                                        Target
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">