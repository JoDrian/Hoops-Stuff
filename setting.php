<?php
session_start();

require 'server/function.php';

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}
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
    <?php include '_header.php'; ?>

    <div class="px-4 lg:px-12 lg:px-20">
        <div class="text-left py-5 lg:py-10">
            <h3 class="font-medium text-xl lg:text-3xl text-gray-700">
                Settings
            </h3>
            <hr class="w-16 h-1 my-3 lg:my-4 bg-gray-400 border-0 rounded md:my-10" />
            <p class="text-sm lg:text-lg text-gray-500">
                <a href="?logout" class="text-red-600 hover:text-red-700 hover:underline font-medium text-md py-2.5 me-2 mb-2">Logout</a>
            </p>
        </div>
    </div>
    <br><br><br>

    <?php include '_footer.php'; ?>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>