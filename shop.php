<?php
session_start();

require 'server/function.php';

// Initialize $kategori_produk to an empty string if not set
$kategori_produk = '';

if (isset($_GET['kategori_produk'])) {
  $kategori_produk = $_GET['kategori_produk'];
}

$limit = 16;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($page - 1) * $limit;

// Get the search query if it exists
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Initialize the SQL query
$sql = "SELECT 
            p.id_produk,
            p.nama_produk,
            p.kategori_produk,
            p.deskripsi_produk,
            p.harga_produk,
            p.diskon_produk,
            p.stok_produk,
            i.image_produk,
            i.image2_produk,
            i.image3_produk,
            i.image4_produk,
            s.size1_produk,
            s.size2_produk,
            s.size3_produk,
            s.size4_produk,
            w.warna1_produk,
            w.warna2_produk,
            w.warna3_produk,
            w.warna4_produk
        FROM tb_produk p
        LEFT JOIN tb_image i ON p.id_produk = i.id_produk
        LEFT JOIN tb_size s ON p.id_produk = s.id_produk
        LEFT JOIN tb_warna w ON p.id_produk = w.id_produk";

// Append WHERE clause for search query if it exists
if (!empty($search_query)) {
  $sql .= " WHERE p.nama_produk LIKE ?";
}

// Append WHERE clause for category filter if it exists
if (!empty($kategori_produk)) {
  $sql .= (empty($search_query) ? " WHERE" : " AND") . " p.kategori_produk = ?";
}

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind parameters
if (!empty($search_query)) {
  $search_param = "%{$search_query}%";
  $stmt->bind_param('s', $search_param);
}

if (!empty($kategori_produk)) {
  $stmt->bind_param('s', $kategori_produk);
}

// Execute the SQL statement
$stmt->execute();

// Get the result set
$product = $stmt->get_result();


$total_products_sql = "SELECT COUNT(*) AS total FROM tb_produk";
$total_products_result = $conn->query($total_products_sql);
$total_products_row = $total_products_result->fetch_assoc();
$total_products = $total_products_row['total'];

$total_pages = ceil($total_products / $limit);
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
  <?php include "_header.php"; ?>

  <!-- Shop -->
  <section id="shop" class="px-4 lg:px-12 lg:px-20">
    <div class="text-center py-5 lg:py-10">
      <h3 class="font-bold text-xl lg:text-3xl text-gray-700">
        Our Shop
      </h3>
      <p class="mt-4 text-sm lg:text-lg text-gray-500">
        Here you can check out our high quality products
      </p>
    </div>

    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-gray-700 font-medium rounded-lg text-md px-5 py-2.5 inline-flex items-center" type="button">Category <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
      </svg>
    </button>

    <!-- Dropdown menu -->
    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
        <li>
          <a href="shop.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">All</a>
        </li>
        <li>
          <a href="shop.php?kategori_produk=basketball" class="block px-4 py-2 <?php echo ($kategori_produk === 'basketball') ? 'bg-orange-200 text-orange-700' : 'hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'; ?>">Basketball</a>
        </li>
        <li>
          <a href="shop.php?kategori_produk=shoes" class="block px-4 py-2 <?php echo ($kategori_produk === 'shoes') ? 'bg-orange-200 text-orange-700' : 'hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'; ?>">Shoes</a>
        </li>
        <li>
          <a href="shop.php?kategori_produk=other" class="block px-4 py-2 <?php echo ($kategori_produk === 'other') ? 'bg-orange-200 text-orange-700' : 'hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white'; ?>">Other</a>
        </li>
      </ul>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8 pt-4 pb-8">
      <?php while ($row = $product->fetch_assoc()) { ?>
        <div data-category="<?= strtolower($row['kategori_produk']); ?>" onclick="window.location.href='<?= "single_product.php?id_produk=" . $row['id_produk']; ?>'" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 <?= ($count % 4 == 0) ? 'lg:col-span-1' : ''; ?> product">
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

  <!-- Pagination -->
  <nav aria-label="Page navigation example">
    <ul class="flex items-center justify-center -space-x-px h-8 text-sm mt-10">
      <?php if ($page > 1) : ?>
        <li>
          <a href="?page=<?= ($page - 1); ?>" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-orange-200 hover:text-gray-700">
            <span class="sr-only">Previous</span>
            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
            </svg>
          </a>
        </li>
      <?php endif; ?>
      <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
        <li>
          <a href="?page=<?= $i; ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 <?= $page == $i ? 'text-orange-600 border-orange-400 bg-orange-100 hover:bg-orange-200 hover:text-orange-700' : 'hover:bg-orange-200 hover:text-gray-700'; ?>">
            <?= $i; ?>
          </a>
        </li>
      <?php endfor; ?>
      <?php if ($page < $total_pages) : ?>
        <li>
          <a href="?page=<?= ($page + 1); ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-orange-200 hover:text-gray-700">
            <span class="sr-only">Next</span>
            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
            </svg>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>

  <!-- Footer -->
  <?php include "_footer.php" ?>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>