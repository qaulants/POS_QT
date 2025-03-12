<?php
session_start();
session_regenerate_id(true);
require_once "koneksi.php";


$queryDetail = mysqli_query($koneksi, "SELECT * FROM sales");

?>

<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Laporan Penjualan</title>

    <meta name="description" content="" />

    <?php include 'inc/head.php'; ?>




</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include 'inc/sidebar.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include 'inc/nav.php'; ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container justify-content-center align-items-center" style="margin-top: 30px; margin-bottom: 70px;min-height: 100vh;">
                        <div class="row justify-content-center align-items-center">

                            <div class="col-12 print-area">
                                <div class="card shadow-lg ">
                                    <!-- <div class="card-header text-center">
                                        <h1 style="letter-spacing: -3px" class="fw-bold text-primary">Laporan Penjualan</h1>
                                    </div> -->
                                    <div class="card-header text-center d-flex justify-content-between align-items-center">
                                        <h1 style="letter-spacing: -3px" class="fw-bold text-primary">Laporan Penjualan</h1>
                                        <a href="print-pimpinan.php" class="btn btn-md btn-primary text-center px-3"><i class="fa-solid fa-print"></i> Print Laporan</a>
                                    </div>


                                    <div class="card-body">
                                        <div class="table table-responsive">

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kode Transaksi</th>
                                                        <th>Tanggal Transaksi</th>
                                                        <th>Nominal Pembayaran</th>
                                                        <th>Total Pembayaran</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    while ($rowDetail = mysqli_fetch_assoc($queryDetail)): ?>
                                                        <tr class="text-center">
                                                            <td><?php echo $no++; ?></td>
                                                            <td><?php echo $rowDetail['trans_code'] ?></td>
                                                            <td><?php echo $rowDetail['trans_date'] ?></td>
                                                            <td><?php echo "Rp. " . number_format($rowDetail['trans_paid']) ?></td>
                                                            <td><?php echo "Rp. " . number_format($rowDetail['trans_total_price']) ?></td>

                                                        </tr>
                                                    <?php endwhile ?>
                                                    <!-- <tr>
                                            <td colspan="6" class="text-center">Tidak ada data</td>
                                        </tr> -->

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>

                    <!-- Tombol Print -->

                </div>

                <!-- / Content -->


                <div class="content-backdrop fade"></div>

                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/admin/assets/admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/admin/assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/admin/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/admin/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>