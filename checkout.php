<?php
session_start();

require 'server/function.php';

if (!isset($_SESSION['id_user'])) {
  header("Location: login.php");
  exit();
}

$id_user = $_SESSION['id_user'];

if (!isset($_SESSION['cart_empty']) || $_SESSION['cart_empty'] === true) {
  header('Location: cart.php?error=empty_cart');
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checked_items'])) {
  $checked_items = $_POST['checked_items'];

  $id_checked = array_map('intval', $checked_items);

  $tb_cart = [];
  foreach ($id_checked as $id_cart) {
    $sql_cart = "SELECT ci.id_cart, ci.jumlah_produk, ci.id_produk, ci.size_produk, ci.warna_produk, p.nama_produk, p.harga_produk, p.diskon_produk, i.image_produk
    FROM tb_cart ci
    JOIN tb_produk p ON ci.id_produk = p.id_produk
    JOIN tb_image i ON ci.id_produk = i.id_produk
    WHERE ci.id_cart = ? AND ci.id_user = ?";

    $stmt = $conn->prepare($sql_cart);

    $stmt->bind_param("ii", $id_cart, $id_user);

    $stmt->execute();

    $result_cart = $stmt->get_result();

    if ($result_cart->num_rows > 0) {
      while ($row_cart = $result_cart->fetch_assoc()) {
        $tb_cart[] = $row_cart;
      }
    }
  }
} else {
  header('Location: cart.php?error=empty_cart');
  exit();
}

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_cart']) && isset($_POST['action'])) {
//   $id_cart = $_POST['id_cart'];
//   $action = $_POST['action'];

//   if ($action == 'increment') {
//     $sql_update_quantity = "UPDATE tb_cart SET jumlah_produk = jumlah_produk + 1 WHERE id_cart = ?";
//   } elseif ($action == 'decrement') {
//     $sql_update_quantity = "UPDATE tb_cart SET jumlah_produk = GREATEST(jumlah_produk - 1, 1) WHERE id_cart = ?";
//   }

//   $stmt = $conn->prepare($sql_update_quantity);
//   $stmt->bind_param("i", $id_cart);
//   $stmt->execute();
// }

$total = 0;

$sql_produk = "SELECT id_produk, harga_produk, diskon_produk FROM tb_produk WHERE id_produk IN (SELECT id_produk FROM tb_cart WHERE id_user = ?)";
$stmt = $conn->prepare($sql_produk);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result_produk = $stmt->get_result();

$produk_details = [];
while ($row = $result_produk->fetch_assoc()) {
  $produk_details[$row['id_produk']] = $row;
}

foreach ($tb_cart as $item) {
  $product = $produk_details[$item['id_produk']];

  $harga_produk = $product['harga_produk'];
  $diskon_produk = $product['diskon_produk'];
  $harga_setelah_diskon = $harga_produk - ($harga_produk * $diskon_produk / 100);

  $subtotal = $item['jumlah_produk'] * $harga_setelah_diskon;

  $total += $subtotal;
}

$is_cart_empty = empty($tb_cart);

$shippingCost = 39900;

$totalCost = $total + $shippingCost;
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
  <section class="checkout px-20 my-5 py-5">
    <div class="text-left">
      <h3 class="font-medium text-xl lg:text-3xl text-gray-700">Checkout</h3>
      <hr class="w-16 h-1 mx-auto my-3 ml-0 lg:my-4 bg-orange-600 border-0 rounded md:my-10" />
    </div>
    <div class="container mx-auto mt-10">
      <div class="sm:flex shadow-md my-10">
        <div class="w-full sm:w-3/4 bg-white px-10 py-10">
          <div class="flex justify-between border-b pb-8">
            <h1 class="font-semibold text-2xl">Products</h1>
            <h2 class="font-semibold text-2xl"><?= count($tb_cart); ?> Items</h2>
          </div>
          <?php foreach ($tb_cart as $item) {
            $product = $produk_details[$item['id_produk']];

            $harga_produk = $product['harga_produk'];
            $diskon_produk = $product['diskon_produk'];
            $harga_setelah_diskon = $harga_produk - ($harga_produk * $diskon_produk / 100);

            $subtotal = $item['jumlah_produk'] * $harga_setelah_diskon; ?>
            <div class="md:flex items-strech py-8 md:py-10 lg:py-8 border-t border-gray-50">
              <div class="md:w-4/12 2xl:w-1/4 w-full flex justify-center items-center rounded-lg overflow-hidden">
                <img src="assets/img/<?= $item['image_produk']; ?>" alt="<?= $item['nama_produk']; ?>" class="h-64 md:h-full object-center object-cover" />
              </div>
              <div class="md:pl-3 md:w-8/12 2xl:w-3/4 flex flex-col justify-center">
                <div class="flex items-center justify-between w-full">
                  <div class="flex flex-col justify-between gap-y-2">
                    <p class="text-base font-bold leading-none text-gray-800">
                      <?= $item['nama_produk']; ?>
                    </p>
                    <p class="text-xs leading-3 text-gray-600 pt-3">
                      Variant - <?= $item['warna_produk']; ?>
                    </p>
                    <p class="text-xs leading-3 text-gray-600 pt-3">
                      Size - <?= $item['size_produk']; ?>
                    </p>
                    <div class="flex items-center justify-between pt-1">
                      <div class="flex items-center">
                        <form method="POST" action="">
                          <input type="hidden" name="id_cart" value="<?= $item['id_cart']; ?>">
                          <input type="submit" name="remove_produk" class="text-xs leading-3 font-medium text-red-500 cursor-pointer hover:underline" value="Remove">
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-col justify-between items-end gap-y-5">
                    <!-- <form method="POST" action=""> -->
                    <div class="relative flex items-center justify-center max-w-[6rem]">
                      <!-- <button type="submit" name="decrement-button" data-input-counter-decrement="quantity" class="hover:bg-gray-100 border border-gray-300 rounded-l-lg p-2 h-10 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                          <span class="w-1.5 h-1.5 flex items-center justify-center">-</span>
                        </button> -->
                      <div class="relative">
                        <div class="text-center pb-0.5 text-[0.65rem] uppercase text-gray-400 tracking-wide font-semibold">
                          Qty
                        </div>
                        <span name="jumlah" class="border border-gray-300 h-10 text-center text-gray-900 text-sm block w-full min-w-[3rem] flex items-center justify-center rounded-lg"><?= $item['jumlah_produk']; ?></span>
                      </div>

                      <!-- <input type="hidden" name="id_cart" value="<?= $item['id_cart']; ?>">
                        <input type="hidden" name="new_jumlah" value="<?= $item['jumlah_produk']; ?>"> -->
                      <!-- <button type="submit" name="increment-button" class="hover:bg-gray-100 border border-gray-300 rounded-r-lg p-2 h-10 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                          <span class="w-1.5 h-1.5 flex items-center justify-center">+</span>
                        </button> -->
                    </div>
                    <!-- </form> -->
                    <p class="text-base font-medium leading-none text-gray-800 pt-2">
                      <span><?= rupiah($subtotal); ?></span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div id="summary" class="w-full sm:w-1/4 md:w-1/2 px-8 py-10">
          <form id="checkout_form" method="POST" action="server/place_order.php">
            <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
            <div>
              <label class="font-medium inline-block mt-10 mb-3 text-sm uppercase">
                Phone Number
              </label>
              <input name="phone" class="block p-2 text-gray-600 w-full border border-black text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600" placeholder="Phone Number" required />
            </div>
            <div>
              <label class="font-medium inline-block mt-10 mb-3 text-sm uppercase">
                City
              </label>
              <input name="city" class="block p-2 text-gray-600 w-full border border-black text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600" placeholder="City" required />
            </div>
            <div>
              <label class="font-medium inline-block mt-10 mb-3 text-sm uppercase">
                Address
              </label>
              <input name="address" class="block p-2 text-gray-600 w-full border border-black text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600" placeholder="Address" required />
            </div>
            <div class="pt-10">
              <label class="font-medium inline-block mb-3 text-sm uppercase">
                Payment Method
              </label>
              <select class="block p-2 text-gray-600 w-full text-sm rounded-lg">
                <option>Credit Card</option>
              </select>
            </div>
            <div class="py-10">
              <label class="font-medium inline-block mb-3 text-sm uppercase">
                Shipping
              </label>
              <select class="block p-2 text-gray-600 w-full text-sm rounded-lg">
                <option>Standard - <?= rupiah(39900); ?></option>
              </select>
            </div>
            <div class="border-t mt-8">
              <div class="flex font-semibold justify-between pt-6 text-sm uppercase">
                <span>Subtotal</span>
                <span><?= rupiah($total); ?></span>
              </div>
              <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                <span>Shipping Cost</span>
                <span><?= rupiah($shippingCost); ?></span>
              </div>
              <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                <span>Total cost</span>
                <span><?= rupiah($totalCost); ?></span>
                <input type="hidden" name="totalCost" value="<?= $totalCost ?>">
              </div>
            </div>
            <input type="hidden" name="tb_cart" value="<?= htmlspecialchars(json_encode($tb_cart)); ?>">
            <button type="submit" class="bg-orange-600 font-semibold hover:bg-orange-700 py-3 text-sm text-white uppercase w-full">
              Place Order
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include '_footer.php'; ?>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-UxhjSkWUZwYsFOVwIyPJcJjAu4C8evH5zjUJ/z9etmNliALyA+PEfmSQjlaclCqIWIkzQxAAqKf0Rn6VK+vk3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    // Fungsi untuk memperbarui input tersembunyi dengan data yang diperlukan sebelum form dikirimkan
    document.addEventListener('DOMContentLoaded', function() {
      // Cek apakah ada data produk yang dipilih
      var selectedItems = <?= isset($selectedItems) ? json_encode($selectedItems) : '[]' ?>;
      var selectedItemsInput = document.getElementById('selectedItems');

      // Jika ada data produk yang dipilih, perbarui nilai input tersembunyi
      if (selectedItems.length > 0) {
        selectedItemsInput.value = JSON.stringify(selectedItems);
      }
    });
  </script>
</body>

</html>