<?php
include('function.php');

$stmt = $conn->prepare("SELECT p.*, 
                               i.image_produk, i.image2_produk, i.image3_produk, i.image4_produk,
                               s.size1_produk, s.size2_produk, s.size3_produk, s.size4_produk,
                               w.warna1_produk, w.warna2_produk, w.warna3_produk, w.warna4_produk
                        FROM tb_produk p 
                        LEFT JOIN tb_image i ON p.id_produk = i.id_produk 
                        LEFT JOIN tb_size s ON p.id_produk = s.id_produk
                        LEFT JOIN tb_warna w ON p.id_produk = w.id_produk
                        WHERE p.kategori_produk='basketball' 
                        LIMIT 4");

$stmt->execute();

$basketball_product = $stmt->get_result();
