<?php
session_start();
include 'koneksi.php';

// jika button simpan ditekan 
if (isset($_POST['simpan'])) {
  $level_name = $_POST['level_name'];

  $insert =  mysqli_query($koneksi, "INSERT INTO levels (level_name) VALUES ('$level_name')");

  header("location:level.php?tambah=berhasil");
}

$id  = isset($_GET['edit']) ?  $_GET['edit'] : '';
$editLevel = mysqli_query($koneksi, "SELECT * FROM levels WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($editLevel);

if (isset($_POST['edit'])) {
  $level_name = $_POST['level_name'];
  //jika button edit di klik

  $update = mysqli_query($koneksi, "UPDATE levels SET level_name='$level_name' WHERE id = '$id'");
  header("location:level.php?ubah=berhasil");
}

?>


<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
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

  <title>Tambah Level</title>

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

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Level</div>
                  <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="mb-3 row">
                        <div class="col-sm-6">
                          <label for="" class="form-label">Nama Level</label>
                          <input type="text" class="form-control" id="" name="level_name" placeholder="Masukkan nama level" required
                            value="<?php echo isset($_GET['edit']) ? $rowEdit['level_name'] : '' ?>">
                        </div>
                      </div>


                      <div class="mb-3">
                        <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">Simpan</button>
                      </div>
                    </form>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                , made with ❤️ by
                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
              </div>
              <div>
                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                <a
                  href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                  target="_blank"
                  class="footer-link me-4">Documentation</a>

                <a
                  href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                  target="_blank"
                  class="footer-link me-4">Support</a>
              </div>
            </div>
          </footer>
          <!-- / Footer -->

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
</body>

</html>