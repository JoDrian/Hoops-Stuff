<?php
session_start();

require 'server/function.php';

if (!isset($_SESSION['id_user'])) {

  header("Location: login.php");
  exit();
}

if (isset($_GET['id_produk'])) {

  $id_product = $_GET['id_produk'];

  $stmt = $conn->prepare("SELECT p.*, 
                                  i.image_produk, i.image2_produk, i.image3_produk, i.image4_produk,
                                  s.size1_produk, s.size2_produk, s.size3_produk, s.size4_produk,
                                  w.warna1_produk, w.warna2_produk, w.warna3_produk, w.warna4_produk
                          FROM tb_produk p 
                          LEFT JOIN tb_image i ON p.id_produk = i.id_produk 
                          LEFT JOIN tb_size s ON p.id_produk = s.id_produk
                          LEFT JOIN tb_warna w ON p.id_produk = w.id_produk
                          WHERE p.id_produk = ?");
  $stmt->bind_param("i", $id_product);

  $stmt->execute();

  $product = $stmt->get_result()->fetch_assoc();
} else {
  header('location: index.php');
  exit();
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
  <?php include '_header.php'; ?>


  <!-- Single-product -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <div class="flex flex-col md:flex-row -mx-4">
      <div class="grid gap-4 items-center">
        <div class="h-[25rem] w-full flex items-center justify-center overflow-hidden rounded-lg bg-gray-100">
          <img class="max-w-full max-h-full object-cover" src="assets/img/<?= $product['image_produk']; ?>" alt="" id="mainImg" />
        </div>
        <div class="grid grid-cols-4 gap-4 justify-between">
          <div class="flex items-center justify-center overflow-hidden rounded-lg bg-gray-100 cursor-pointer">
            <img class="h-32 max-w-full small-img" src="assets/img/<?= $product['image_produk']; ?>" alt="" />
          </div>
          <div class="flex items-center justify-center overflow-hidden rounded-lg bg-gray-100 cursor-pointer">
            <img class="h-32 max-w-full small-img" src="assets/img/<?= $product['image2_produk']; ?>" alt="" />
          </div>
          <div class="flex items-center justify-center overflow-hidden rounded-lg bg-gray-100 cursor-pointer">
            <img class="h-32 max-w-full small-img" src="assets/img/<?= $product['image3_produk']; ?>" alt="" />
          </div>
          <div class="flex items-center justify-center overflow-hidden rounded-lg bg-gray-100 cursor-pointer">
            <img class="h-32 max-w-full small-img" src="assets/img/<?= $product['image4_produk']; ?>" alt="" />
          </div>
        </div>
      </div>

      <div class="md:flex-1 px-6">
        <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">
          <?= $product['nama_produk']; ?>
        </h2>
        <div class="flex items-center space-x-4">
          <div>
            <div class="rounded-lg flex py-2 pr-3 flex-col">
              <?php if ($product['diskon_produk'] == 0) : ?>
                <span class="text-gray-500 text-3xl"><?= rupiah($product['harga_produk']); ?></span>
              <?php endif; ?>
              <?php if ($product['diskon_produk'] != 0) : ?>
                <span class="text-gray-500 text-2xl line-through"><?= rupiah($product['harga_produk']); ?></span>
                <span class="font-bold text-orange-600 text-3xl"><?= rupiah($product['harga_produk'] - ($product['harga_produk'] * $product['diskon_produk']) / 100); ?></span>
              <?php endif; ?>
            </div>
          </div>
          <div class="flex-1">
            <p class="text-green-600 text-xl font-semibold">Save <?= $product['diskon_produk']; ?>%</p>
            <p class="text-gray-400 text-sm">Inclusive of all Taxes.</p>
          </div>
        </div>
        <div class="flex py-2 items-center">
          <div class="border border-green-500 text-green-600 rounded">
            <span class="py-2 pl-2">Stock</span>
            <span class="py-2 pr-2"><?= $product['stok_produk']; ?></span>
          </div>
        </div>
        <p class="text-gray-500 py-2 mb-2">
          <?= $product['deskripsi_produk']; ?>
        </p>
        <?php if (!empty($product['size1_produk'])) : ?>
          <span class="text-gray-700 font-medium py-2 pl-2">Size</span>
          <div class="flex py-2 mb-2 items-center">
            <?php for ($i = 1; $i <= 4; $i++) : ?>
              <?php $size = $product['size' . $i . '_produk']; ?>
              <?php if (!empty($size)) : ?>
                <label class="inline-flex items-center mr-1">
                  <input type="radio" name="size" value="<?= $size; ?>" class="form-radio text-orange-500 h-4 w-4" <?= $i === 1 ? 'checked' : '' ?> onclick="updateSelectedSize(this)" style="display: none;">
                  <span class="ml-2 text-gray-700 bg-gray-200 px-4 py-2 rounded-lg text-sm cursor-pointer" onclick="changeSelection(this, 'size');"><?= $size; ?></span>
                </label>
              <?php endif; ?>
            <?php endfor; ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($product['warna1_produk'])) : ?>
          <span class="text-gray-700 font-medium py-2 pl-2">Color</span>
          <div class="flex py-2 mb-2 items-center">
            <?php for ($i = 1; $i <= 4; $i++) : ?>
              <?php $color = $product['warna' . $i . '_produk']; ?>
              <?php if (!empty($color)) : ?>
                <label class="inline-flex items-center mr-1">
                  <input type="radio" name="color" value="<?= $color; ?>" class="form-radio text-orange-500 h-4 w-4" <?= $i === 1 ? 'checked' : '' ?> onclick="updateSelectedColor(this)" style="display: none;">
                  <span class="ml-2 text-gray-700 bg-gray-200 px-4 py-2 rounded-lg text-sm cursor-pointer" onclick="changeSelection(this, 'color');"><?= $color; ?></span>
                </label>
              <?php endif; ?>
            <?php endfor; ?>
          </div>
        <?php endif; ?>

        <form method="POST" action="cart.php">
          <input type="hidden" name="id_produk" value="<?= $product['id_produk']; ?>">
          <input type="hidden" name="image_produk" value="<?= $product['image_produk']; ?>">
          <input type="hidden" name="nama_produk" value="<?= $product['nama_produk']; ?>">
          <input type="hidden" name="harga_produk" value="<?= $product['harga_produk']; ?>">
          <input type="hidden" name="selectedSize" id="selectedSize">
          <input type="hidden" name="selectedColor" id="selectedColor">

          <div class="flex py-4 space-x-4">
            <div class="relative">
              <div class="text-center -left-7 right-0 pt-0.5 absolute block text-[0.65rem] uppercase text-gray-400 tracking-wide font-semibold">
                Qty
              </div>
              <input type="number" name="jumlah_produk" value="1" min="1" class="w-16 h-10 px-2 py-4 pb-2 border border-gray-300 rounded" />
            </div>

            <button type="submit" name="add_to_cart" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
              Add to Cart
            </button>
          </div>
        </form>

      </div>
    </div>


  </div>
  </div>

  <?php include '_footer.php'; ?>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script>
    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

    for (let i = 0; i < 4; i++) {
      smallImg[i].onclick = function() {
        mainImg.src = smallImg[i].src;
      };
    }

    window.addEventListener('DOMContentLoaded', (event) => {
      const firstSize = document.querySelector('input[type="radio"][name="size"]:checked');
      if (firstSize) {
        const firstSpan = firstSize.nextElementSibling;
        if (firstSpan) {
          firstSpan.classList.add('bg-orange-500');
          firstSpan.classList.add('text-white');
        }
        // Set default selected size
        updateSelectedSize(firstSize);
      }

      const firstColor = document.querySelector('input[type="radio"][name="color"][value="<?= $product['warna1_produk']; ?>"]');
      if (firstColor) {
        const firstSpan = firstColor.nextElementSibling;
        if (firstSpan) {
          firstSpan.classList.add('bg-orange-500');
          firstSpan.classList.add('text-white');
        }
        // Set default selected color
        updateSelectedColor(firstColor);
      }
    });

    function changeSelection(element, type) {
      const bgColor = 'bg-orange-500';
      const textColor = 'text-white';
      const spans = element.parentNode.parentNode.querySelectorAll('span');

      spans.forEach(span => {
        span.classList.remove(bgColor);
        span.classList.remove(textColor);
      });

      element.classList.add(bgColor);
      element.classList.add(textColor);

      const radios = element.parentNode.parentNode.querySelectorAll(`input[type="radio"][name="${type}"]`);
      radios.forEach(radio => {
        radio.checked = false;
      });

      const radio = element.previousElementSibling;
      if (radio) {
        radio.checked = true;
        if (type === 'size') {
          updateSelectedSize(radio);
        } else if (type === 'color') {
          updateSelectedColor(radio);
        }
      }
    }




    function updateSelectedSize(element) {
      document.getElementById('selectedSize').value = element.value;
    }

    function updateSelectedColor(element) {
      document.getElementById('selectedColor').value = element.value;
    }
  </script>

</body>

</html>