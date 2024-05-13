<?php
session_start();

include('function.php');

$_SESSION['payment_access'] = true;

if (!empty($_POST['tb_cart'])) {
    $tb_cart = json_decode($_POST['tb_cart'], true);

    $telepon_user = $_POST['phone'];
    $alamat_user = $_POST['address'];
    $kota_user = $_POST['city'];
    $biaya_order = $_POST['totalCost'];
    $status_order = "on_hold";
    $id_user = $_SESSION['id_user'];
    $order_date = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO tb_order (biaya_order, status_order, id_user, telepon_user, kota_user, alamat_user, tanggal_order) 
    VALUES (?,?,?,?,?,?,?);");

    $stmt->bind_param('isissss', $biaya_order, $status_order, $id_user, $telepon_user, $kota_user, $alamat_user, $order_date);

    $stmt->execute();

    $id_order = $stmt->insert_id;

    foreach ($tb_cart as $item) {
        $id_produk = $item['id_produk'];
        $size_produk = $item['size_produk'];
        $warna_produk = $item['warna_produk'];
        $jumlah_produk = $item['jumlah_produk'];

        $stmt1 = $conn->prepare("INSERT INTO tb_order_item (id_order, id_produk, size_produk, warna_produk, jumlah_produk, id_user, tanggal_order)
        VALUES (?,?,?,?,?,?,?);");
        $stmt1->bind_param('iiisiis', $id_order, $id_produk, $size_produk, $warna_produk, $jumlah_produk, $id_user, $order_date);
        $stmt1->execute();
    }

    $stmt_delete_cart = $conn->prepare("DELETE FROM tb_cart WHERE id_produk IN (SELECT id_produk FROM tb_order_item WHERE id_order = ?)");
    $stmt_delete_cart->bind_param('i', $id_order);
    $stmt_delete_cart->execute();

    $url = '../payment.php?id_order=' . $id_order . '&order_status=Order+placed+successfully!';
    header('Location: ' . $url);
    exit();
}
