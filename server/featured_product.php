<?php
include('function.php');

$stmt = $conn->prepare("SELECT p.*, i.image_produk FROM tb_produk p 
                        LEFT JOIN tb_image i ON p.id_produk = i.id_produk LIMIT 4");

$stmt->execute();

$featured_product = $stmt->get_result();
