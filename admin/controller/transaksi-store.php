<?php
session_start();
session_regenerate_id(true);
date_default_timezone_set("Asia/Jakarta");
require_once "../koneksi.php";

// Memastikan session memiliki ID user yang valid
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect ke halaman login jika session ID tidak ada
    exit();
}

$id_user = $_SESSION['id'];  // Mengambil ID dari session
$trans_code = $_POST['trans_code'];
$trans_date = $_POST['trans_date'];
$trans_total_price = $_POST['trans_total_price'];
$nominal_bayar = $_POST['trans_paid'];
$kembalian = $_POST['trans_change'];

// Menyimpan transaksi utama
$queryPenjualan = mysqli_query($koneksi, "INSERT INTO sales (trans_code, trans_date, trans_total_price, trans_paid, trans_change) 
VALUES ('$trans_code', '$trans_date', $trans_total_price, '$nominal_bayar', '$kembalian')");

if ($queryPenjualan) {
    // Mendapatkan ID penjualan yang baru saja dimasukkan
    $id_penjualan = mysqli_insert_id($koneksi);
    $trans_total_price = 0;
    // Menyimpan detail penjualan
    foreach ($_POST['produk_id'] as $key => $produk_id) {
        $qty = $_POST['qty'][$key];
        $sub_total = $_POST['sub_total'][$key];

        // Mengambil harga produk dari tabel produk
        $queryProduk = mysqli_query($koneksi, "SELECT product_price FROM products WHERE id = '$produk_id'");
        $produk = mysqli_fetch_assoc($queryProduk);
        $harga = $produk['product_price'];

        // Menghitung subtotal
        $sub_total = $qty * $harga;
        $trans_total_price += $sub_total;
 
        // Menyimpan detail penjualan ke dalam tabel detail_sales
        $detailPenjualan = mysqli_query($koneksi, "INSERT INTO detail_sales (sales_id, produk_id, sub_total, qty) 
                                                  VALUES ('$id_penjualan', '$produk_id', '$sub_total', '$qty')");

        // Mengupdate stok barang setelah penjualan
        $updateQty = mysqli_query($koneksi, "UPDATE products SET product_qty = product_qty - $qty WHERE id = '$produk_id'");
    }

    // Redirect ke halaman print setelah berhasil
    header("Location: ../print.php?id=" . $id_penjualan);
    exit();
} else {
    // Jika query insert penjualan gagal
    echo "Error: " . mysqli_error($koneksi);
}
?>
