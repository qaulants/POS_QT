<?php session_start();
include 'koneksi.php';

if (!isset($_SESSION['nama'])) {
    header("location: login.php?error=access-failed");
}
$query = mysqli_query($koneksi,  "SELECT * FROM products");
$produk = mysqli_query($koneksi, "SELECT categories.category_name, products.* FROM products LEFT JOIN categories ON categories.id = products.category_id ORDER BY id DESC");
$id = $_SESSION['id'];
$queryUser = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'");
$rowUser = mysqli_fetch_assoc($queryUser);

// Total semua produk (jumlah item)
$queryTotalProduk = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM products");
$totalProduk = mysqli_fetch_assoc($queryTotalProduk)['total'];

// Total kategori
$queryTotalKategori = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM categories");
$totalKategori = mysqli_fetch_assoc($queryTotalKategori)['total'];

// Produk stok rendah, qty < 10
$queryStokRendah = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM products WHERE product_qty < 10");
$stokRendah = mysqli_fetch_assoc($queryStokRendah)['total'];

// Total qty seluruh produk
$queryTotalQty = mysqli_query($koneksi, "SELECT SUM(product_qty) as total FROM products");
$totalQty = mysqli_fetch_assoc($queryTotalQty)['total'];

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

    <title>Dashboard</title>

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
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Halo <?php echo $rowUser['name'] ?>👋</h5>
                                <p class="mb-4">
                                    Have a nice day
                                </p>
                            </div>


                            <div class="row g-4 mb-2 p-4">
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                    <div class="card">
                                        <div class="card-body d-flex align-items-center gap-3">
                                            <div class="card-icon rounded-circle me-3 p-3 bg-label-primary">
                                                <i class="bx bx-box fs-4"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted">Jenis Produk</small>
                                                <h4 class="mb-0"><?php echo $totalProduk ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                    <div class="card">
                                        <div class="card-body d-flex align-items-center gap-3">
                                            <div class="card-icon rounded-circle me-3 p-3 bg-label-success">
                                                <i class="bx bx-category fs-4"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted">Total Kategori</small>
                                                <h4 class="mb-0"><?php echo $totalKategori ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                    <div class="card">
                                        <div class="card-body d-flex align-items-center gap-3">
                                            <div class="card-icon rounded-circle me-3 p-3 bg-label-info">
                                                <i class="bx bx-layer fs-4"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted">Total Stok</small>
                                                <h4 class="mb-0"><?php echo $totalQty ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                    <div class="card">
                                        <div class="card-body d-flex align-items-center gap-3">
                                            <div class="card-icon rounded-circle me-3 p-3 bg-label-danger">
                                                <i class="bx bx-error-circle fs-4"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted">Stok Rendah</small>
                                                <h4 class="mb-0 text-danger"><?php echo $stokRendah ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-4">
                                <!-- <div class="card"> -->
                                <div class="card-header">
                                    <h5>Stok Produk</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th>Nama Produk</th>
                                                <th>Jumlah Produk</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            while ($row = mysqli_fetch_assoc($produk)) { ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo $row['category_name'] ?></td>
                                                    <td><?php echo $row['product_name'] ?></td>
                                                    <td><?php echo $row['product_qty'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
    
                                <!-- </div> -->
                            </div>
                        </div>



                      

                    </div>
                    <!-- / Content -->
                    <!-- Footer -->
                    <?php include 'inc/footer.php' ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <?php include 'inc/js.php' ?>
</body>

</html>