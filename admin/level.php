<?php
session_start();
include 'koneksi.php';
// munculkan atau pilih  sebuah atau semua kolom dari table user
$query = mysqli_query($koneksi,  "SELECT * FROM levels ORDER BY id DESC");

if (isset($_GET['delete'])) {
  $id =  $_GET['delete']; // untuk mengambil nilai parameter
  //masukin $query untuk melakukan perintah yg diinginkan
  $delete  = mysqli_query($koneksi, "DELETE FROM levels WHERE id = '$id'");
  header("location:level.php?hapus=berhasil");
}

?>


<!DOCTYPE html>

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

  <title>Level</title>

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
                  <div class="card-header">Level</div>
                  <div class="card-body">
                    <?php if (isset($_GET['hapus'])): ?>
                      <div class="alert alert-success" role="alert">
                        Data berhasil dihapus
                      </div>
                    <?php endif ?>
                    <div align="right" class="mb-3">
                      <a href="tambah-level.php" class="btn btn-primary">Tambah</a>
                    </div>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Level</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                        while ($row = mysqli_fetch_assoc($query)) { ?>
                          <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['level_name'] ?></td>
                            <td>
                              <a href="tambah-level.php?edit=<?php echo $row['id'] ?>" class="btn btn-success btn-sm">
                                <span class="tf-icon bx bx-pencil bx-18px"></span></a>
                              <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                href="level.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">
                                <span class="tf-icon bx bx-trash bx-18px"></span></a>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <!-- / Content -->

          <!-- Footer -->
          <?php include 'inc/footer.php' ?>
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