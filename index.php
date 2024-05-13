<?php
require 'server/function.php';

session_start();

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

  <!-- Home -->
  <section id="home">
    <div class="text-white">
      <h5 class="font-bold">
        <span class="text-orange-600">HOOPS </span>STUFF
      </h5>
      <p class="font-semibold text-4xl pb-2">
        Everything about<span class="text-orange-600"> Basketball</span>
      </p>
      <p class="pb-4">
        Shop offers the best products for the most affordable prices
      </p>
      <button type="button" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
        <a href="shop.php">Shop Now</a>
      </button>
    </div>
  </section>

  <!-- Brand -->
  <section id="brand">
    <div class="grid grid-cols-4 gap-12 sm:gap-16 md:gap-24 lg:gap-28 mx-8 sm:mx-12 md:mx-16 lg:mx-24 py-8 sm:py-12 md:py-16 lg:py-24">
      <div class="flex justify-center items-center">
        <img class="h-auto max-w-full" src="assets/img/adidas-logo.png" alt="" />
      </div>
      <div class="flex justify-center items-center">
        <img class="h-auto max-w-full" src="assets/img/nike-logo.png" alt="" />
      </div>
      <div class="flex justify-center items-center">
        <img class="h-auto max-w-full" src="assets/img/lining-logo.png" alt="" />
      </div>
      <div class="flex justify-center items-center">
        <img class="h-auto max-w-full" src="assets/img/puma-logo.png" alt="" />
      </div>
    </div>
  </section>

  <!-- Hover -->
  <section id="gallery" class="px-4 sm:px-12 lg:px-20">
    <div id="gallery" class="relative w-full" data-carousel="slide">
      <!-- Carousel wrapper -->
      <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="assets/img/mid-banner.jpg" class="absolute inset-0 w-full h-full object-cover" alt="" />
        </div>
        <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
          <img src="assets/img/banner-champion-hs.jpg" class="absolute inset-0 w-full h-full object-cover" alt="" />
        </div>
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="assets/img/official-hs-img.jpg" class="absolute inset-0 w-full h-full object-cover" alt="" />
        </div>
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="assets/img/banner-kit-hs.jpg" class="absolute inset-0 w-full h-full object-cover" alt="" />
        </div>
        <!-- <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-5.jpg" class="absolute inset-0 w-full h-full object-cover" alt="" />
        </div> -->
      </div>
      <!-- Slider controls -->
      <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
          </svg>
          <span class="sr-only">Previous</span>
        </span>
      </button>
      <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
          </svg>
          <span class="sr-only">Next</span>
        </span>
      </button>
    </div>
  </section>

  <!-- Section -->
  <section id="category" class="px-4 lg:px-20 pt-6 lg:pt-12">
    <div class="text-center mt-2 lg:mt-5 pb-5 lg:pb-6">
      <h3 class="font-medium text-xl lg:text-3xl text-gray-700">Category</h3>
      <hr class="w-16 h-1 mx-auto my-3 lg:my-4 bg-gray-400 border-0 rounded md:my-10" />
    </div>
    <div class="grid grid-cols-3 gap-4">
      <a href="shop.php?kategori_produk=basketball" class="relative overflow-hidden rounded-lg hover:opacity-100 h-96">
        <img class="w-full h-full rounded-lg object-cover" src="assets/img/section-basketball.jpg" alt="" />
        <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300 hover:opacity-100 bg-black/40">
          <button class="text-white hover:text-yellow-400 focus:outline-none">
            <p class="text-2xl lg:text-3xl">Basketball</p>
          </button>
        </div>
      </a>
      <a href="shop.php?kategori_produk=shoes" class="relative overflow-hidden rounded-lg hover:opacity-100 h-96">
        <img class="w-full h-full rounded-lg object-cover" src="assets/img/section-sport-shoes.jpg" alt="" />
        <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300 hover:opacity-100 bg-black/40">
          <button class="text-white hover:text-yellow-400 focus:outline-none">
            <p class="text-2xl lg:text-3xl">Awesome Sport Shoes</p>
          </button>
        </div>
      </a>
      <a href="shop.php?kategori_produk=other" class="relative overflow-hidden rounded-lg hover:opacity-100 h-96">
        <img class="w-full h-full rounded-lg object-cover" src="assets/img/section-other.jpg" alt="" />
        <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-300 hover:opacity-100 bg-black/40">
          <button class="text-white hover:text-yellow-400 focus:outline-none">
            <p class="text-2xl lg:text-3xl">Other Incredible Kit</p>
          </button>
        </div>
      </a>
    </div>
  </section>

  <!-- Featured -->
  <section id="featured" class="px-4 sm:px-12 lg:px-20">
    <div class="text-center mt-2 lg:mt-5 py-5 lg:py-10">
      <h3 class="font-medium text-xl lg:text-3xl text-gray-700">
        Our Featured
      </h3>
      <hr class="w-16 h-1 mx-auto my-3 lg:my-4 bg-gray-400 border-0 rounded md:my-10" />
      <p class="text-sm lg:text-lg text-gray-500">
        Here you can check out our featured products
      </p>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8 pb-8">
      <?php include('server/featured_product.php'); ?>

      <?php while ($row = $featured_product->fetch_assoc()) { ?>
        <div onclick="window.location.href='<?= "single_product.php?id_produk=" . $row['id_produk']; ?>'" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <img class="p-8 w-72 h-72 rounded-t-lg ml-3" src="assets/img/<?= $row['image_produk']; ?>" alt="product image" />
          <div class="px-5 pb-5">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
              <?= $row['nama_produk']; ?>
            </h5>
            <div class="flex items-center mt-2.5 mb-5">
              <div class="flex items-center space-x-1 rtl:space-x-reverse">
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
              </div>
              <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-orange-600 ms-3">5.0</span>
            </div>
            <div class="flex items-center justify-between">
              <?php if ($row['diskon_produk'] > 0) : ?>
                <div class="flex flex-col">
                  <span class="text-lg font-semibold text-gray-500 line-through"><?= rupiah($row['harga_produk']); ?></span>
                  <span class="text-xl font-bold text-gray-900"><?= rupiah($row['harga_produk'] - ($row['harga_produk'] * $row['diskon_produk']) / 100); ?></span>
                </div>
              <?php else : ?>
                <span class="text-xl font-bold text-gray-900"><?= rupiah($row['harga_produk']); ?></span>
              <?php endif; ?>
              <button class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-200 font-medium rounded-lg text-sm px-3 py-2.5 text-center">Buy Now</button>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>

  <!-- Banner -->
  <section id="banner" class="mt-12 lg:mt-20 bg-fixed"></section>

  <!-- Basketball -->
  <section id="basketball" class="px-4 sm:px-12 lg:px-20">
    <div class="text-center mt-2 lg:mt-5 py-5 lg:py-10">
      <h3 class="font-medium text-xl lg:text-3xl text-gray-700">
        Basketball
      </h3>
      <hr class="w-16 h-1 mx-auto my-3 lg:my-4 bg-orange-600 border-0 rounded md:my-10" />
      <p class="text-sm lg:text-lg text-gray-500">
        Find your best size and style of basketball
      </p>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8 pb-8">

      <?php include('server/get_basketball.php') ?>

      <?php while ($row = $basketball_product->fetch_assoc()) { ?>

        <div onclick="window.location.href='<?= "single_product.php?id_produk=" . $row['id_produk']; ?>'" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <img class="p-8 w-72 h-72 rounded-t-lg ml-3" src="assets/img/<?= $row['image_produk']; ?>" alt="product image" />
          <div class="px-5 pb-5">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
              <?= $row['nama_produk']; ?>
            </h5>
            <div class="flex items-center mt-2.5 mb-5">
              <div class="flex items-center space-x-1 rtl:space-x-reverse">
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
              </div>
              <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-orange-600 ms-3">5.0</span>
            </div>
            <div class="flex items-center justify-between">
              <?php if ($row['diskon_produk'] > 0) : ?>
                <div class="flex flex-col">
                  <span class="text-lg font-semibold text-gray-500 line-through"><?= rupiah($row['harga_produk']); ?></span>
                  <span class="text-xl font-bold text-gray-900"><?= rupiah($row['harga_produk'] - ($row['harga_produk'] * $row['diskon_produk']) / 100); ?></span>
                </div>
              <?php else : ?>
                <span class="text-xl font-bold text-gray-900"><?= rupiah($row['harga_produk']); ?></span>
              <?php endif; ?>
              <button class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-200 font-medium rounded-lg text-sm px-3 py-2.5 text-center">Buy Now</button>
            </div>
          </div>
        </div>

      <?php } ?>
    </div>
  </section>

  <!-- Shoes -->
  <section id="shoes" class="px-4 sm:px-12 lg:px-20">
    <div class="text-center mt-2 lg:mt-5 py-5 lg:py-10">
      <h3 class="font-medium text-xl lg:text-3xl text-gray-700">
        Sport Shoes
      </h3>
      <hr class="w-16 h-1 mx-auto my-3 lg:my-4 bg-orange-600 border-0 rounded md:my-10" />
      <p class="text-sm lg:text-lg text-gray-500">
        Find and wear your awesome and cool style of sport shoes
      </p>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8 pb-8">
      <?php include('server/get_shoes.php') ?>

      <?php while ($row = $shoes_product->fetch_assoc()) { ?>

        <div onclick="window.location.href='<?= "single_product.php?id_produk=" . $row['id_produk']; ?>'" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <img class="p-8 w-72 h-72 rounded-t-lg ml-3" src="assets/img/<?= $row['image_produk']; ?>" alt="product image" />
          <div class="px-5 pb-5">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
              <?= $row['nama_produk']; ?>
            </h5>
            <div class="flex items-center mt-2.5 mb-5">
              <div class="flex items-center space-x-1 rtl:space-x-reverse">
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
              </div>
              <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-orange-600 ms-3">5.0</span>
            </div>
            <div class="flex items-center justify-between">
              <?php if ($row['diskon_produk'] > 0) : ?>
                <div class="flex flex-col">
                  <span class="text-lg font-semibold text-gray-500 line-through"><?= rupiah($row['harga_produk']); ?></span>
                  <span class="text-xl font-bold text-gray-900"><?= rupiah($row['harga_produk'] - ($row['harga_produk'] * $row['diskon_produk']) / 100); ?></span>
                </div>
              <?php else : ?>
                <span class="text-xl font-bold text-gray-900"><?= rupiah($row['harga_produk']); ?></span>
              <?php endif; ?>
              <button class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-200 font-medium rounded-lg text-sm px-3 py-2.5 text-center">Buy Now</button>
            </div>
          </div>
        </div>

      <?php } ?>
    </div>
  </section>

  <!-- Other -->
  <section id="other" class="px-4 sm:px-12 lg:px-20">
    <div class="text-center mt-2 lg:mt-5 py-5 lg:py-10">
      <h3 class="font-medium text-xl lg:text-3xl text-gray-700">Other</h3>
      <hr class="w-16 h-1 mx-auto my-3 lg:my-4 bg-orange-600 border-0 rounded md:my-10" />
      <p class="text-sm lg:text-lg text-gray-500">
        Sport kit and tool to life your sports day
      </p>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8 pb-8">
      <?php include('server/get_other.php') ?>

      <?php while ($row = $other_product->fetch_assoc()) { ?>

        <div onclick="window.location.href='<?= "single_product.php?id_produk=" . $row['id_produk']; ?>'" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
          <img class="p-8 w-72 h-72 rounded-t-lg ml-3" src="assets/img/<?= $row['image_produk']; ?>" alt="product image" />
          <div class="px-5 pb-5">
            <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
              <?= $row['nama_produk']; ?>
            </h5>
            <div class="flex items-center mt-2.5 mb-5">
              <div class="flex items-center space-x-1 rtl:space-x-reverse">
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
              </div>
              <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-orange-600 ms-3">5.0</span>
            </div>
            <div class="flex items-center justify-between">
              <?php if ($row['diskon_produk'] > 0) : ?>
                <div class="flex flex-col">
                  <span class="text-lg font-semibold text-gray-500 line-through"><?= rupiah($row['harga_produk']); ?></span>
                  <span class="text-xl font-bold text-gray-900"><?= rupiah($row['harga_produk'] - ($row['harga_produk'] * $row['diskon_produk']) / 100); ?></span>
                </div>
              <?php else : ?>
                <span class="text-xl font-bold text-gray-900"><?= rupiah($row['harga_produk']); ?></span>
              <?php endif; ?>
              <button class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-200 font-medium rounded-lg text-sm px-3 py-2.5 text-center">Buy Now</button>
            </div>
          </div>
        </div>

      <?php } ?>
    </div>
  </section>

  <?php include '_footer.php'; ?>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>