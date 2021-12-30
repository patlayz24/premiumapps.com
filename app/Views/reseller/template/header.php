<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?> - Kota Digital</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/'); ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?= base_url('/assets/img/logo.png'); ?>" height="35px" width="35px">
                </div>
                <div class="sidebar-brand-text mx-3" style="font-family: 'Cabin Sketch', cursive;">Kota Digital</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?= (($request->uri->getSegment(1) == 'reseller' && $request->uri->getSegment(2) == '' ? 'active' : null)); ?>">
                <a class="nav-link" href="<?= base_url('reseller'); ?>">
                    <i class="fas fa-gamepad"></i>
                    <span>Top Up Game</span></a>
            </li>

            <li class="nav-item <?= (($request->uri->getSegment(2) == 'product' ? 'active' : null)); ?>">
                <a class="nav-link" href="<?= base_url('reseller/product'); ?>">
                    <i class="fas fa-coins"></i>
                    <span>Products</span></a>
            </li>

            <li class="nav-item <?= (($request->uri->getSegment(2) == 'pesanan' ? 'active' : null)); ?>">
                <a class="nav-link" href="<?= base_url('reseller/pesanan'); ?>">
                    <i class="fas fa-money-check-alt"></i>
                    <span>Pesanan</span></a>
            </li>

            <li class="nav-item <?= (($request->uri->getSegment(2) == 'info' ? 'active' : null)); ?>">
                <a class="nav-link" href="<?= base_url('reseller/info'); ?>">
                    <i class="fas fa-money-check"></i>
                    <span>Berita & Informasi</span></a>
            </li>

            <li class="nav-item <?= (($request->uri->getSegment(2) == 'report' ? 'active' : null)); ?>">
                <a class="nav-link" href="<?= base_url('reseller/report'); ?>">
                    <i class="fas fa-book"></i>
                    <span>Report</span></a>
            </li>

            <li class="nav-item <?= (($request->uri->getSegment(2) == 'bill' ? 'active' : null)); ?>">
                <a class="nav-link" href="<?= base_url('reseller/bill'); ?>">
                    <i class="fas fa-book"></i>
                    <span>Tagihan</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                User Config
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">username :</h6>
                        <a class="collapse-item <?= (($request->uri->getSegment(2) == 'detailuser' ? 'active' : null)); ?>" href='<?= base_url('reseller/detailuser'); ?>' class="btn btn-primary">Edit Profile</a>
                        <a class="collapse-item <?= (($request->uri->getSegment(2) == 'change-password' ? 'active' : null)); ?>" href='<?= base_url('reseller/change-password'); ?>' class="btn btn-primary">Change Password</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <strong id="date"><?= date('l, d F Y'); ?></strong>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><i class="fas fa-user mr-1"></i><?= session('name_reseller'); ?></span>
                                <i class="fas fa-chevron-down"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" type="button" class="btn btn-primary" href='<?= base_url('reseller/detailuser'); ?>'>
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Edit Profile
                                </a>
                                <!-- <a class="dropdown-item" type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Edit Profile
                                </a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">