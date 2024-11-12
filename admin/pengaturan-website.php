<?php
session_start();
include 'koneksi.php';

// jika button simpan ditekan 
$queryPengaturan = mysqli_query($koneksi, "SELECT * FROM general_setting ORDER BY id DESC");
$rowPengaturan = mysqli_fetch_assoc($queryPengaturan);

if (isset($_POST['simpan'])) {
    $website_name       = $_POST['website_name'];
    $website_link       = $_POST['website_link'];
    $id                 = $_POST['id'];
    $website_phone      = $_POST['website_phone'];
    $website_email      = $_POST['website_email'];
    $website_address    = $_POST['website_address'];





    //mencari data di dalam table pengaturan, jika ada data akan diupdate
    //jika tidak ada, akan diinsert


    if (mysqli_num_rows($queryPengaturan) > 0) {
        if (!empty($_FILES['foto']['name'])) {
            $nama_foto =  $_FILES['foto']['name'];
            $ukuran_foto =  $_FILES['foto']['size'];

            $ext = array('png', 'jpg', 'jpeg');
            $extFoto  = pathinfo($nama_foto, PATHINFO_EXTENSION);

            //jika extension foto tidak ada ext yang terdaftar di array ext maka foto tidak boleh diupload
            if (!in_array($extFoto, $ext)) {
                echo "Ext tidak ditemukan";
                die;
            } else {
                //pindahkan gambar dari tmp folder ke folder yang sudah kita buat
                // unlink() : menghapus file
                unlink('upload/' . $rowPengaturan['logo']);
                move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);

                $update =  mysqli_query($koneksi, "UPDATE general_setting SET website_name='$website_name', website_link='$website_link', logo ='$nama_foto', website_phone='$website_phone', website_email='$website_email', website_address='$website_address' WHERE id = '$id'");
            }
        } else {
            $update =  mysqli_query($koneksi, "UPDATE general_setting SET website_name='$website_name', website_link='$website_link', website_phone='$website_phone', website_email='$website_email', website_address='$website_address' WHERE id = '$id'");
        }
    } else {

        if (!empty($_FILES['foto']['name'])) {
            $nama_foto =  $_FILES['foto']['name'];
            $ukuran_foto =  $_FILES['foto']['size'];

            $ext = array('png', 'jpg', 'jpeg');
            $extFoto  = pathinfo($nama_foto, PATHINFO_EXTENSION);

            //jika extension foto tidak ada ext yang terdaftar di array ext maka foto tidak boleh diupload
            if (!in_array($extFoto, $ext)) {
                echo "Ext tidak ditemukan";
                die;
            } else {
                //pindahkan gambar dari tmp folder ke folder yang sudah kita buat
                move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nama_foto);

                $insert =  mysqli_query($koneksi, "INSERT INTO general_setting (website_name, website_link, logo, website_phone, website_email, website_address) VALUES ('$website_name', '$website_link', '$nama_foto', '$website_phone', '$website_email', '$website_address')");
            }
        } else {
            $insert =  mysqli_query($koneksi, "INSERT INTO general_setting (website_name, website_link, website_phone, website_email, website_address) VALUES ('$website_name', '$website_link', '$website_phone', '$website_email', '$website_address')");
        }
    }

    //$_POST: form input name=''
    //$_GET : url ?param='nilai'

    //$_FILES : ngambil nilai dari input type file

    header("location:pengaturan-website.php?tambah=berhasil");
}






$id  = isset($_GET['edit']) ?  $_GET['edit'] : '';
$editUser = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
$rowEdit = mysqli_fetch_assoc($editUser);

if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    //jika button edit di klik
    if (isset($_POST['edit'])) {
        $password  = $_POST['password'];
    } else {
        $password  = $rowEdit['password'];
    }
    $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama', password='$password' WHERE id = '$id'");
    header("location:user.php?ubah=berhasil");
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

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

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
                                    <h3 class="card-header">Pengaturan Website</h3>
                                    <div class="card-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo isset($rowPengaturan['id']) ? $rowPengaturan['id'] : '' ?>">
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Nama Website</label>
                                                        <input type="text" class="form-control" id="" name="website_name" placeholder="Masukkan Nama Website" required
                                                            value="<?php echo isset($rowPengaturan['website_name']) ? $rowPengaturan['website_name'] : '' ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Telepon</label>
                                                        <input type="text" class="form-control" id="" name="website_phone" placeholder="Masukkan Telepon Website" required
                                                            value="<?php echo isset($rowPengaturan['website_phone']) ? $rowPengaturan['website_phone'] : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Link Website</label>
                                                        <input type="url" class="form-control" id="" name="website_link" placeholder="Masukkan Link Website Anda" required
                                                            value="<?php echo isset($rowPengaturan['website_link']) ? $rowPengaturan['website_link'] : '' ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Email Website</label>
                                                        <input type="text" class="form-control" id="" name="website_email" placeholder="Masukkan Email Website" required
                                                            value="<?php echo isset($rowPengaturan['website_email']) ? $rowPengaturan['website_email'] : '' ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class=" mb-3 row">
                                                <div class="col-sm-12">
                                                    <label for="" class="form-label">Alamat</label>
                                                    <input type="text" class="form-control" id="" name="website_address" placeholder="Masukkan Alamat Anda" required
                                                        value="<?php echo isset($rowPengaturan['website_address']) ? $rowPengaturan['website_address'] : '' ?>">
                                                </div>
                                            </div>
                                            <div class=" mb-3 row">
                                                <div class="col-sm-12">
                                                    <label for="" class="form-label">Foto</label>
                                                    <input type="file" name="foto">
                                                    <img width="150" src="upload/<?php echo isset($rowPengaturan['logo']) ? $rowPengaturan['logo'] : '' ?>" alt="">
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