<?php
session_start();

require 'server/function.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['id_user'];
$id_order = $_GET['id_order'];

$stmt_orders = $conn->prepare("SELECT DISTINCT tb_order.*, tb_user.nama_user, 
                                    tb_produk.nama_produk, tb_produk.harga_produk, tb_produk.diskon_produk, 
                                    tb_image.image_produk,
                                    tb_order_item.*
                                FROM tb_order
                                INNER JOIN tb_user ON tb_order.id_user = tb_user.id_user
                                INNER JOIN tb_order_item ON tb_order.id_order = tb_order_item.id_order
                                INNER JOIN tb_produk ON tb_order_item.id_produk = tb_produk.id_produk
                                LEFT JOIN tb_image ON tb_produk.id_produk = tb_image.id_produk
                                WHERE tb_order.id_user = ? AND tb_order.id_order = ?");
$stmt_orders->bind_param("ii", $id_user, $id_order);
$stmt_orders->execute();
$result_orders = $stmt_orders->get_result();

$tb_orders = [];
if ($result_orders->num_rows > 0) {
    while ($row_orders = $result_orders->fetch_assoc()) {
        $tb_orders[] = $row_orders;
    }
}

foreach ($tb_orders as $order) {
    $total = $order['biaya_order'];
    $id_order = $order['id_order'];
    $tanggal_order = $order['tanggal_order'];
    $nama_user = $order['nama_user'];
    $telepon_user = $order['telepon_user'];
    $kota_user = $order['kota_user'];
    $alamat_user = $order['alamat_user'];
}


$orderDetailsDisplayed = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoops Stuff</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <?php include "_header.php"; ?>
    <section class="py-20 relative">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
            <a href="account.php?action=scrollToOrder" class="text-left text-gray-600 hover:text-gray-800 text-size cursor-pointer"><i class="fa-solid fa-arrow-left"></i><span class="px-2 font-medium">Back</span></a>
            <h2 class="font-manrope font-bold text-4xl leading-10 text-black text-center mb-6">
                <?= $_GET['order_status']; ?>
            </h2>

            <div class="main-box border border-gray-200 rounded-xl pt-6 max-w-xl max-lg:mx-auto lg:max-w-full">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between px-6 pb-6 border-b border-gray-200">
                    <div class="data">
                        <p class="font-semibold text-base leading-7 text-black">Order Id: <span class="text-indigo-600 font-medium">#<?= $id_order; ?></span></p>
                        <p class="font-semibold text-base leading-7 text-black mt-4">Order Date : <span class="text-gray-400 font-medium"><?= $tanggal_order; ?></span></p>
                        <p class="font-semibold text-base leading-7 text-black mt-4">Name : <span class="text-gray-400 font-medium"><?= $nama_user; ?></span></p>
                        <p class="font-semibold text-base leading-7 text-black mt-4">Phone Number : <span class="text-gray-400 font-medium"><?= $telepon_user; ?></span></p>
                        <p class="font-semibold text-base leading-7 text-black mt-4">Address : <span class="text-gray-400 font-medium"><?= $kota_user . ", " . $alamat_user; ?></span></p>
                    </div>
                </div>
                <div class="w-full px-3 min-[400px]:px-6">
                    <div class="flex flex-col lg:flex-row items-center py-6 border-b border-gray-200 gap-6 w-full">
                        <div class="w-full px-3 min-[400px]:px-6">
                            <?php foreach ($tb_orders as $order) { ?>
                                <div class="flex flex-col lg:flex-row items-center py-6 border-b border-gray-200 gap-6 w-full">
                                    <div class="img-box max-lg:w-full">
                                        <img src="assets/img/<?= $order['image_produk']; ?>" alt="<?= $order['nama_produk']; ?>" class="aspect-square w-full lg:max-w-[140px]">
                                    </div>
                                    <div class="flex flex-row items-center w-full ">
                                        <div class="grid grid-cols-1 lg:grid-cols-2 w-full">
                                            <div class="flex items-center">
                                                <div class="">
                                                    <h2 class="font-semibold text-xl leading-8 text-black mb-3">
                                                        <?= $order['nama_produk']; ?></h2>
                                                    <div class="flex items-center ">
                                                        <p class="font-medium text-base leading-7 text-black pr-4 mr-4 border-r border-gray-200">
                                                            Size : <span class="text-gray-500"><?= $order['size_produk']; ?></span></p>
                                                        <p class="font-medium text-base leading-7 text-black pr-4 mr-4 border-r border-gray-200">
                                                            Variant : <span class="text-gray-500"><?= $order['warna_produk']; ?></span></p>
                                                        <p class="font-medium text-base leading-7 text-black ">Qty : <span class="text-gray-500">2</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-6">
                                                <div class="col-span-5 lg:col-span-2 flex items-center max-lg:mt-3">
                                                    <div class="flex gap-3 lg:block">
                                                        <p class="font-medium text-sm leading-7 text-black">Price</p>
                                                        <p class="lg:mt-4 font-medium text-sm leading-7 text-indigo-600"><?= rupiah($order['harga_produk'] - ($order['harga_produk'] * $order['diskon_produk']) / 100); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-span-5 lg:col-span-2 flex items-center max-lg:mt-3 ">
                                                    <div class="flex gap-3 lg:block">
                                                        <p class="font-medium text-sm leading-7 text-black">Status
                                                        </p>
                                                        <p class="font-medium text-sm leading-6 whitespace-nowrap py-0.5 px-3 rounded-full lg:mt-3 bg-emerald-50 text-emerald-600">
                                                            Ready for Delivery</p>
                                                    </div>
                                                </div>
                                                <div class="col-span-5 lg:col-span-2 flex items-center max-lg:mt-3">
                                                    <div class="flex gap-3 lg:block">
                                                        <p class="font-medium text-sm whitespace-nowrap leading-6 text-black">
                                                            Expected Delivery Time</p>
                                                        <p class="font-medium text-base text-right whitespace-nowrap leading-7 lg:mt-3 text-emerald-500">
                                                            <?= date('d F Y', strtotime($order['tanggal_order'] . ' +5 days')); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="w-full border-t border-gray-200 px-6 flex flex-col lg:flex-row items-center justify-between ">
                    <div class="flex flex-col sm:flex-row items-center max-lg:border-b border-gray-200">
                        <p class="font-medium text-lg text-gray-900 pl-6 py-3 max-lg:text-center">Paid using Credit Card</p>
                    </div>
                    <p class="font-semibold text-lg text-black py-6">Total Price : <span class="text-indigo-600"> <?= rupiah($total); ?></span></p>
                </div>
            </div>
        </div>
    </section>

    <?php include "_footer.php"; ?>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>