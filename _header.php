<?php
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];

    $stmt = $conn->prepare("SELECT * FROM tb_user WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $username = $user['nama_user'];
        $email = $user['email_user'];
        $ProfileImage = $user['image_user'];
    }
}

?>
<!-- Header -->
<header id="header" class="py-4 shadow-sm bg-white fixed top-0 w-full z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
        <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="assets/img/basketball-logo.svg" class="h-8" alt="Logo" />
            <span class="self-center text-2xl font-black whitespace-nowrap dark:text-white"><span class="text-orange-600">HOOPS </span>STUFF</span>
        </a>
        <!-- Search -->
        <form action="shop.php" method="GET" class="relative hidden md:block">
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="search">
                <div class="relative hidden md:block">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search icon</span>
                    </div>
                    <input type="text" id="search-navbar" name="search_query" class="block w-80 lg:w-96 p-2 pl-12 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-orange-600 focus:border-orange-600" placeholder="Search..." />
                    <button type="submit" class="hidden">Search</button>
                </div>
            </div>
        </form>
        <!-- Menu Kanan -->
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <ul class="flex flex-row items-center font-medium mt-4 rounded-lg bg-gray-50 md:space-x-6 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                <li>
                    <a href="wishlist.php" class="block py-2 px-3 text-gray-800 md:p-0 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-orange-600"><i class="fa-regular fa-heart fa-xl"></i></a>
                </li>
                <li>
                    <a href="cart.php" class="block py-2 px-3 text-gray-800 md:p-0 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-orange-600"><i class="fa-solid fa-bag-shopping fa-xl"></i></a>
                </li>
                <?php if (isset($_SESSION['id_user'])) : ?>
                    <!-- After login -->
                    <li>
                        <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-7 h-7 rounded-full" src="assets/img/<?= $ProfileImage; ?>" alt="user photo" />
                        </button>
                        <!-- Menu Kanan / Profile / Dropdown -->
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
                            <div class="px-4 py-3">
                                <span id="username" class="block text-sm text-gray-900 dark:text-white"><?= $username; ?></span>
                                <span id="email" class="block text-sm text-gray-500 truncate dark:text-gray-400"><?= $email; ?></span>
                            </div>
                            <ul class="py-2" aria-labelledby="user-menu-button">
                                <li>
                                    <a href="account.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">Account</a>
                                </li>
                                <li>
                                    <a href="setting.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">Settings</a>
                                </li>
                                <li>
                                    <a href="?logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php else : ?>
                    <!-- Before login -->
                    <li><a href="login.php" class="block py-2 px-3 text-gray-800 md:p-0 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-orange-600"><i class="fa-solid fa-user fa-lg"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>

<!-- Navbar -->
<nav class="border-gray-200 bg-gray-800 mt-[90px] md:mt-[70px] lg:mt-[70px]">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 px-4 md:px-8">
        <button data-collapse-toggle="navbar-solid-bg" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-solid-bg" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
            <ul class="flex flex-col font-medium mt-4 rounded-lg bg-gray-800 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                <li>
                    <a href="index.php" class="block py-2 px-3 md:p-0 text-white rounded hover:bg-gray-700 md:hover:bg-transparent md:border-0 md:hover:text-orange-600">Home</a>
                </li>
                <li>
                    <a href="shop.php" class="block py-2 px-3 md:p-0 text-white rounded hover:bg-gray-700 md:hover:bg-transparent md:border-0 md:hover:text-orange-600">Shop</a>
                </li>
                <li>
                    <a href="blog.php" class="block py-2 px-3 md:p-0 text-white rounded hover:bg-gray-700 md:hover:bg-transparent md:border-0 md:hover:text-orange-600">Blog</a>
                </li>
                <li>
                    <a href="contact.php" class="block py-2 px-3 md:p-0 text-white rounded hover:bg-gray-700 md:hover:bg-transparent md:border-0 md:hover:text-orange-600">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>