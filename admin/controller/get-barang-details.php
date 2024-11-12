<?php 
require_once "../koneksi.php";

if (isset($_GET['produk_id'])) {
    $produk_id = $_GET['produk_id'];

    $query = mysqli_query($koneksi, "SELECT product_qty, product_price FROM products WHERE id='$produk_id'");

    if (mysqli_num_rows($query) > 0) {
        $item = mysqli_fetch_assoc($query);

        header('Content-Type: application/json');
        echo json_encode($item);
    }
}
?>