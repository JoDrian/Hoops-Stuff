<?php
session_start();

require 'server/function.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: login.php");
  exit();
}

$id_user = $_SESSION['id_user'];

if (isset($_POST['add_to_cart'])) {
  $id_produk = $_POST['id_produk'];
  $jumlah_produk = $_POST['jumlah_produk'];
  $selectedSize = $_POST['selectedSize'];
  $selectedColor = $_POST['selectedColor'];

  $stmt = $conn->prepare("SELECT * FROM tb_cart WHERE id_produk = ? AND size_produk = ? AND warna_produk = ? AND id_user = ?");
  $stmt->bind_param("issi", $id_produk, $selectedSize, $selectedColor, $id_user);
  $stmt->execute();
  $result_cart = $stmt->get_result();

  if ($result_cart->num_rows > 0) {
    $row_cart = $result_cart->fetch_assoc();
    $jumlah_produk += $row_cart['jumlah_produk'];
    $sql = "UPDATE tb_cart SET jumlah_produk = ? WHERE id_cart = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $jumlah_produk, $row_cart['id_cart']);
    $stmt->execute();
  } else {
    $sql = "INSERT INTO tb_cart (id_produk, size_produk, warna_produk, jumlah_produk, id_user) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issii", $id_produk, $selectedSize, $selectedColor, $jumlah_produk, $id_user);
    $stmt->execute();
  }

  // $url = 'single_product.php' . '?id_produk=' . $id_produk;
  // header('Location: ' . $url);
  // exit();
}

$sql_cart = "SELECT ci.id_cart, ci.jumlah_produk, ci.id_produk, ci.size_produk, ci.warna_produk, p.nama_produk, p.harga_produk, p.diskon_produk, i.image_produk 
             FROM tb_cart ci 
             JOIN tb_produk p ON ci.id_produk = p.id_produk 
             JOIN tb_image i ON ci.id_produk = i.id_produk 
             WHERE ci.id_user = ?";
$stmt = $conn->prepare($sql_cart);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result_cart = $stmt->get_result();
$tb_cart = [];

if ($result_cart->num_rows > 0) {
  while ($row_cart = $result_cart->fetch_assoc()) {
    $tb_cart[] = $row_cart;
  }
}

$_SESSION['cart_empty'] = empty($tb_cart);

$checked_items = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['checked_items']) && is_array($_POST['checked_items'])) {
    $checked_items = $_POST['checked_items'];
  }
}

// Calculate total
$total = 0;

foreach ($tb_cart as $item) {
  $harga_produk = $item['harga_produk'];
  $diskon_produk = $item['diskon_produk'];
  $harga_setelah_diskon = $harga_produk - ($harga_produk * $diskon_produk / 100);

  $subtotal = $item['jumlah_produk'] * $harga_setelah_diskon;

  $total += $subtotal;
}

$is_cart_empty = empty($tb_cart);

if (isset($_POST['checkout'])) {
  if ($is_cart_empty) {
    header('Location: cart.php?error=empty_cart');
    exit();
  } else {
    header('Location: checkout.php');
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hoops Stuff - Cart</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <?php include '_header.php'; ?>

  <!-- Cart -->
  <section class="cart px-5 md:px-20 my-5 py-5">
    <div class="text-left">
      <h3 class="font-medium text-xl lg:text-3xl text-gray-700">Your Cart</h3>
      <hr class="w-16 h-1 mx-auto my-3 ml-0 lg:my-4 lg:mb-6 bg-orange-600 border-0 rounded md:my-10" />
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <form id="checkoutForm" action="checkout.php" method="POST">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-white uppercase bg-orange-600">
            <tr>
              <th scope="col" class="px-6 py-3">Product</th>
              <th scope="col" class="px-6 py-3">Price</th>
              <th scope="col" class="px-6 py-3">Quantity</th>
              <th scope="col" class="px-6 py-3">Subtotal</th>
              <th scope="col" class="px-6 py-3">
                <span class="sr-only">Remove</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tb_cart as $item) {
              $harga_produk = $item['harga_produk'];
              $diskon_produk = $item['diskon_produk'];
              $harga_setelah_diskon = $harga_produk - ($harga_produk * $diskon_produk / 100);

              $subtotal = $item['jumlah_produk'] * $harga_setelah_diskon;
            ?>
              <tr class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="px-6 py-4 flex items-center">
                  <input type="checkbox" checked name="checked_items[]" value="<?= $item['id_cart']; ?>" class="mr-6 w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                  <div class="w-20 h-20 mr-4 rounded-lg overflow-hidden">
                    <img src="assets/img/<?= $item['image_produk']; ?>" class="w-full h-full object-cover" />
                  </div>
                  <div class="flex flex-col">
                    <span class="font-medium text-gray-900 whitespace-nowrap"><?= $item['nama_produk']; ?></span>
                    <?php if (!empty($item['size_produk'])) : ?>
                      <span class="font-medium text-gray-600 whitespace-nowrap">Size - <?= $item['size_produk']; ?></span>
                    <?php endif; ?>

                    <?php if (!empty($item['warna_produk'])) : ?>
                      <span class="font-medium text-gray-600 whitespace-nowrap">Variant - <?= $item['warna_produk']; ?></span>
                    <?php endif; ?>
                  </div>
                </th>
                <td class="px-6 py-4"><?= rupiah($harga_setelah_diskon); ?></td>
                <td class="px-6 py-4">
                  <form method="POST" action="cart.php">
                    <div class="relative flex items-center justify-center max-w-[6rem] -ml-4">
                      <button type="submit" name="decrement-button" data-input-counter-decrement="quantity" class=" hover:bg-gray-100 border border-gray-300 rounded-l-lg p-2 h-8 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                        <span class="w-1.5 h-1.5 flex items-center justify-center">-</span>
                      </button>
                      <span name="jumlah" class="bg-gray-50 border border-gray-300 h-8 text-center text-gray-900 text-sm block w-full flex items-center justify-center"><?= $item['jumlah_produk']; ?></span>
                      <input type="hidden" name="id_cart" value="<?= $item['id_cart']; ?>">
                      <input type="hidden" name="new_jumlah" value="<?= $item['jumlah_produk']; ?>">
                      <button type="submit" name="increment-button" class=" hover:bg-gray-100 border border-gray-300 rounded-r-lg p-2 h-8 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                        <span class="w-1.5 h-1.5 flex items-center justify-center">+</span>
                      </button>
                    </div>
                  </form>
                </td>
                <td class="px-6 py-4">
                  <span><?= rupiah($subtotal); ?></span>
                </td>
                <td class="px-6 py-4">
                  <form method="POST" action="cart.php">
                    <input type="hidden" name="id_cart" value="<?= $item['id_cart']; ?>">
                    <input type="submit" name="remove_produk" class="font-medium text-red-500 hover:underline cursor-pointer" value="Remove">
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>

        <div class="text-right px-8 py-5">
          <button type="submit" name="checkout" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
            Checkout
          </button>
        </div>
      </form>
    </div>
  </section>

  <?php include '_footer.php'; ?>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script>
    document.getElementById('checkoutForm').addEventListener('submit', function(event) {
      if (<?= $is_cart_empty ? 'true' : 'false' ?>) {
        event.preventDefault();
        alert('Your cart is empty!');
      }
    });
  </script>
</body>

</html>