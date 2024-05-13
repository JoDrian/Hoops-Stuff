<?php
global $conn;

$conn = mysqli_connect("localhost", "root", "", "hoops_stuff")
    or die("Couldn't connect to database");

if (!function_exists('rupiah')) {
    function rupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Edit Jumlah Data
    if (isset($_POST['increment-button'])) {
        $newJumlah = $_POST['new_jumlah'] + 1;
        $idCart = $_POST['id_cart'];
        $sql = "UPDATE tb_cart SET jumlah_produk = $newJumlah WHERE id_cart = $idCart";
        if (mysqli_query($conn, $sql)) {
        } else {
        }
    } elseif (isset($_POST['decrement-button'])) {
        if ($_POST['new_jumlah'] > 1) {
            $newJumlah = $_POST['new_jumlah'] - 1;
            $idCart = $_POST['id_cart'];
            $sql = "UPDATE tb_cart SET jumlah_produk = $newJumlah WHERE id_cart = $idCart";
            if (mysqli_query($conn, $sql)) {
            } else {
            }
        }
    } elseif (isset($_POST['remove_produk'])) {
        if (isset($_POST['id_cart'])) {
            $id_cart = $_POST['id_cart'];

            $sql = "DELETE FROM tb_cart WHERE id_cart = $id_cart";

            if ($conn->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: id_cart is not set.";
        }
    }
}
