<?php

use Faker\Provider\Base;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title><?= $title; ?></title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="<?= base_url('assets/css/mdb.min.css'); ?>" />

    <!-- OwlCarousel -->
    <link rel=" stylesheet" href="<?= base_url('assets/dist/assets/owl.carousel.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/dist/assets/owl.theme.default.min.css'); ?>" />

    <!-- Custom styles -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>" />

    <!-- jQuery -->
    <script type="text/javascript" src="<?= base_url('assets/js/jquery-3.6.0.min.js'); ?>"></script>

</head>

<body>
    <!--Main Navigation-->
    <header>
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <!-- Container wrapper -->
            <div class="container">
                <!-- Navbar brand -->
                <a class="navbar-brand" href="<?= base_url(); ?>">
                    <img src="<?= base_url('assets/img/logo.png'); ?>" height="40" alt="" loading="lazy" style="margin-top: -1px; margin-right:15px;" />

                    <small class="" style="font-family: 'Bree Serif', serif; font-size:28px; color: red; "><strong>KOTA</strong></small>
                    <small style="font-size:28px;"><strong>digital</strong></small>
                </a>

                <!-- Toggle button -->
                <button class="navbar-toggler text-black" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarButtonsExample">
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">

                        </li>
                    </ul>
                    <!-- Left links -->

                    <div class="d-flex align-items-center">
                        <a type="button" class="btn btn-outline-danger px-3 me-2" href="<?= base_url('/cekpesanan'); ?>">
                            <i class="fas fa-search me-2"></i>
                            Cek Pesanan
                        </a>
                        <a type="button" class="btn btn-outline-success me-2" href="https://bit.ly/3iMpDUu">
                            <i class="me-2 fab fa-whatsapp"></i>
                            Help Desk
                        </a>
                    </div>
                </div>
                <!-- Collapsible wrapper -->
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main class="mt-5 pt-5">
        <div class="">