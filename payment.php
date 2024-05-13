<?php
session_start();

require 'server/function.php';

if (!isset($_SESSION['payment_access'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id_order'])) {
    $id_order = $_GET['id_order'];

    $sql = "SELECT biaya_order FROM tb_order WHERE id_order = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_order);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $biaya_order = $row['biaya_order'];

        $totalPayment = $biaya_order;
    } else {
        $totalPayment = 0;
    }
} else {
    $totalPayment = 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['id_order'])) {
        $id_order = $_GET['id_order'];
        $stmt_order = $conn->prepare("SELECT id_produk, jumlah_produk FROM tb_order_item WHERE id_order = ?");
        $stmt_order->bind_param('i', $id_order);
        $stmt_order->execute();
        $result_order = $stmt_order->get_result();

        while ($row_order = $result_order->fetch_assoc()) {
            $id_produk = $row_order['id_produk'];
            $jumlah_produk = $row_order['jumlah_produk'];

            $stmt_update_stock = $conn->prepare("UPDATE tb_produk SET stok_produk = stok_produk - ? WHERE id_produk = ?");
            $stmt_update_stock->bind_param('ii', $jumlah_produk, $id_produk);
            $stmt_update_stock->execute();
        }

        $stmt_update_order_status = $conn->prepare("UPDATE tb_order SET status_order = 'paid' WHERE id_order = ?");
        $stmt_update_order_status->bind_param('i', $id_order);
        $stmt_update_order_status->execute();

        $url = 'order_detail.php?id_order=' . $id_order . '&order_status=Payment+Successful!';
        header('Location: ' . $url);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hoops Stuff</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <!-- Header -->
    <?php include '_header.php'; ?>

    <!-- Checkout -->
    <section class="checkout px-40 lg:px-84 my-5 py-5">
        <div class="container mx-auto mt-10 flex justify-center">
            <div class="w-full lg:w-1/2">
                <div class="shadow-md my-10">
                    <div id="summary" class="px-8 py-10">
                        <form id="payment_form" method="POST" action="payment.php?id_order=<?php echo $id_order; ?>">
                            <h1 class="font-semibold text-2xl pb-2">Payment</h1>
                            <hr class="w-full h-1 mx-auto my-3 ml-0 lg:my-4 lg:mb-6 bg-orange-600 border-0 rounded md:my-10" />
                            <div class="flex font-semibold justify-center flex-col text-sm uppercase">
                                <label class="font-bold inline-block mb-4 text-lg text-orange-600 uppercase">
                                    <?= $_GET['order_status']; ?>
                                </label>
                                <div class="flex justify-between h-full pb-5">
                                    <span class="font-bold">Method</span>
                                    <span>Credit Card</span>
                                </div>
                                <div class="flex justify-between h-full pb-5">
                                    <span class="font-bold">Total payment</span>
                                    <span><?= rupiah($totalPayment); ?></span>
                                </div>
                                <button type="submit" class="bg-orange-600 font-semibold hover:bg-orange-700 py-3 text-sm text-white uppercase w-full">
                                    Pay Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <?php include '_footer.php'; ?>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-UxhjSkWUZwYsFOVwIyPJcJjAu4C8evH5zjUJ/z9etmNliALyA+PEfmSQjlaclCqIWIkzQxAAqKf0Rn6VK+vk3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>