<?php
session_start();
session_regenerate_id(true);
date_default_timezone_set("Asia/Jakarta");
require_once "koneksi.php";



// Waktu :
$currentTime = date('Y-m-d');

// generate function (method)
function generateTransactionCode()
{
    $kode = date('dMyhis');

    return $kode;
}
// click count
if (empty($_SESSION['click_count'])) {
    $_SESSION['click_count'] = 0;
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

    <title>Tambah Produk</title>

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

                    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
                        <div class="card p-4 shadow-lg" style="width: 80%; max-width: 1000px;">
                            <div class="card-header bg-primary opacity-50 text-center">
                                <h1 class="fw-bold text-light">Add Transaction</h1>
                            </div>
                            <div class="card-body bg-transparent" style="backdrop-filter: blur(10px);">
                                <form action="controller/transaksi-store.php" method="post">
                                    <div class="mb-3">
                                        <label for="trans_code" class="form-label text-white">No. Transaksi</label>
                                        <input style="border-radius: 20px;" class="form-control" name="trans_code"
                                            id="kode_transaksi" type="text" value="<?php echo 'QT-' . generateTransactionCode(); ?>"
                                            readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="trans_date" class="form-label text-white">Tanggal Transaksi</label>
                                        <input style="border-radius: 20px;" class="form-control" name="trans_date"
                                            id="tanggal_transaksi" type="date" value="<?php echo $currentTime; ?>" readonly>
                                    </div>
                                    <div class="mb-3 d-flex align-items-center">
                                        <button style="border-radius: 20px;" class="btn btn-primary me-3" type="button"
                                            id="counterBtn">Tambah</button>
                                        
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Kategori</th>
                                                    <th>Nama Produk</th>
                                                    <th>Qty</th>
                                                    <th>Sisa Produk</th>
                                                    <th>Harga</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                <!-- Data ditambah disini -->
                                            </tbody>
                                            <tfoot class="text-center">
                                                <tr>
                                                    <th colspan="6">Total Harga</th>
                                                    <td><input type="number" id="total_harga_keseluruhan" name="trans_total_price"
                                                            class="form-control" readonly></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="6">Nominal Bayar</th>
                                                    <td><input type="number" id="nominal_bayar_keseluruhan" name="trans_paid"
                                                            class="form-control" required></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="6">Kembalian</th>
                                                    <td><input type="number" class="form-control" id="kembalian_keseluruhan"
                                                            name="trans_change" readonly></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="text-center mt-4">
                                        <input type="submit" class="btn btn-primary" name="simpan" value="Hitung">
                                        <a class="btn btn-danger" href="kasir.php">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM categories");
                    $categories = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    ?>
                    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            //Fungsi tambah baris
                            const button = document.getElementById('counterBtn');
                            const countDisplay = document.getElementById('countDisplay');
                            const tbody = document.getElementById('tbody');
                            const table = document.getElementById('table');

                            let no = 0;
                            button.addEventListener('click', function() {
                                no++;

                                //Fungsi tambah td
                                let newRow = "<tr>"
                                newRow += "<td>" + no + "</td>";
                                newRow += "<td><select class='form-control category-select' name='category_id[]' type='number' required>";
                                newRow += "<option value=''>--Pilih Kategori--</option>";
                                <?php foreach ($categories as $category) { ?>
                                    newRow += "<option value='<?php echo $category['id'] ?> '><?php echo $category['category_name'] ?></option>";
                                <?php
                                } ?>
                                newRow += "</select></td>";
                                newRow += "<td><select class='form-control item-select' name='produk_id[]' type='number' required>";
                                newRow += "<option value=''>--Pilih Barang--</option>";
                                newRow += "<td><input type='number' name='qty[]' class='form-control jumlah-input' value='0' required></td>";
                                newRow += "<td><input type='number' name='sisa_produk[]' class='form-control' value='0' readonly></td>";
                                newRow += "<td><input type='number' name='harga[]' class='form-control' readonly></td>";
                                newRow += "<td><input type='number' name='sub_total[]' class='form-control sub-total' readonly></td>";

                                newRow += "</tr>";

                                tbody.insertAdjacentHTML('beforeend', newRow);


                                attachCategoryChangeListener();
                                attachItemChangeListener();
                                attachJumlahChangeListener();

                            });

                            // fungsi untuk menampilkan barang berdasarkan kategori /// 
                            function attachCategoryChangeListener() {
                                const categorySelects = document.querySelectorAll('.category-select');
                                categorySelects.forEach(select => {
                                    select.addEventListener('change', function() {
                                        const categoryId = this.value;
                                        const itemSelect = this.closest('tr').querySelector('.item-select');

                                        if (categoryId) {
                                            fetch(`controller/get-product-dari-category.php?category_id=${categoryId}`)
                                                .then(response => response.json())
                                                .then(data => {
                                                    itemSelect.innerHTML = "<option value=''>--Pilih Barang--</option>";
                                                    data.forEach(item => {
                                                        itemSelect.innerHTML += `<option value='${item.id}'>${item.product_name}</option>`;
                                                    });
                                                })
                                        } else {
                                            itemSelect.innerHTML = "<option value=''>--Pilih Barang--</option>";
                                        }
                                    });


                                });
                            }

                            function attachItemChangeListener() {
                                const itemSelects = document.querySelectorAll('.item-select');
                                itemSelects.forEach(select => {
                                    select.addEventListener('change', function() {
                                        const itemId = this.value;
                                        const row = this.closest('tr');
                                        const sisaProdukInput = row.querySelector('input[name="sisa_produk[]"]');
                                        const hargaInput = row.querySelector('input[name="harga[]"]');

                                        if (itemId) {
                                            fetch('controller/get-barang-details.php?produk_id=' + itemId)
                                                .then(response => response.json())
                                                .then(data => {
                                                    sisaProdukInput.value = data.product_qty;
                                                    hargaInput.value = data.product_price;
                                                })
                                        } else {
                                            sisaProdukInput.value = '';
                                            hargaInput.value = '';
                                        }
                                    });
                                });
                            }

                            const totalHargaKeseluruhan = document.getElementById('total_harga_keseluruhan');

                            const nominalBayarKeseluruhanInput = document.getElementById('nominal_bayar_keseluruhan');
                            const kembaliKeseluruhanInput = document.getElementById('kembalian_keseluruhan');
                            // fungsi untuk mebuat alert jumlah > sisaProduk
                            function attachJumlahChangeListener() {
                                const jumlahInputs = document.querySelectorAll('.jumlah-input');
                                jumlahInputs.forEach(input => {
                                    input.addEventListener('input', function() {
                                        const row = this.closest('tr');
                                        const sisaProdukInput = row.querySelector('input[name="sisa_produk[]"]');
                                        const hargaInput = row.querySelector('input[name="harga[]"]');
                                        const totalHargaInput = document.getElementById('total_harga_keseluruhan');
                                        const nominalBayarInput = document.getElementById('nominal_bayar_keseluruhan');
                                        const kembalianInput = document.getElementById('kembalian_keseluruhan');

                                        const jumlah = parseInt(this.value) || 0;
                                        const sisaProduk = parseInt(sisaProdukInput.value) || 0;
                                        const harga = parseFloat(hargaInput.value) || 0;

                                        if (jumlah > sisaProduk) {
                                            alert("Jumlah tidak boleh melebihi sisa produk");
                                            this.value = sisaProduk;
                                            return;
                                        }
                                        updateTotalKeseluruhan();
                                    });
                                });
                            }

                            function updateTotalKeseluruhan() {
                                let total = 0;
                                let totalKeseluruhan = 0;
                                const jumlahInput = document.querySelectorAll('.jumlah-input');
                                jumlahInput.forEach(input => {
                                    const row = input.closest('tr');
                                    const hargaInput = row.querySelector('input[name="harga[]"]');
                                    const harga = parseFloat(hargaInput.value) || 0;
                                    const jumlah = parseInt(input.value) || 0;


                                    const subTotal = row.querySelector('.sub-total');
                                    total = jumlah * harga;
                                    subTotal.value = total;
                                });
                                const subTotal = document.querySelectorAll('.sub-total');
                                subTotal.forEach(totalItem => {
                                    let subTotal = parseFloat(totalItem.value) || 0;
                                    totalKeseluruhan += subTotal
                                })

                                totalHargaKeseluruhan.value = totalKeseluruhan;
                            }
                            // mencari kembalian
                            nominalBayarKeseluruhanInput.addEventListener('input', function() {
                                const nominalBayar = parseFloat(this.value) || 0;
                                const totalHarga = parseFloat(totalHargaKeseluruhan.value) || 0;

                                if (nominalBayar >= totalHarga) {
                                    let kembalian = nominalBayar - totalHarga;
                                    kembaliKeseluruhanInput.value = kembalian;
                                } else if (nominalBayar == 0) {
                                    kembaliKeseluruhanInput.value = 0;
                                }
                            });

                        });
                    </script>

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