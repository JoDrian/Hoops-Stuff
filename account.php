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

$id_user = $_SESSION['id_user'];

$stmt = $conn->prepare("SELECT * FROM tb_user WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
  $user = $result->fetch_assoc();
  $username = $user['nama_user'];
  $email = $user['email_user'];
} else {
  header("Location: login.php");
  exit();
}

if (isset($_POST['edit_nama'])) {
  $nama_user = $_POST['nama_user'];
  $sql = "UPDATE tb_user SET nama_user = ? WHERE id_user = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $nama_user, $id_user);
  $stmt->execute();
  $stmt->close();

  $username = $nama_user;
}

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
  $image_name = $_FILES['image']['name'];
  $image_tmp = $_FILES['image']['tmp_name'];
  $image_destination = 'assets/img/' . $image_name;

  if (move_uploaded_file($image_tmp, $image_destination)) {
    $stmt_image = $conn->prepare("UPDATE tb_user SET image_user = ? WHERE id_user = ?");
    $stmt_image->bind_param("si", $image_name, $id_user);
    $stmt_image->execute();
    $stmt_image->close();
  } else {
    echo "Failed to move uploaded file.";
  }
}

$stmt_orders = $conn->prepare("SELECT DISTINCT tb_order.id_order, tb_order.tanggal_order, tb_user.nama_user 
                                FROM tb_order
                                INNER JOIN tb_user ON tb_order.id_user = tb_user.id_user
                                WHERE tb_order.id_user = ?");
$stmt_orders->bind_param("i", $id_user);
$stmt_orders->execute();
$result_orders = $stmt_orders->get_result();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account Info</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <!-- Header -->
  <?php include '_header.php'; ?>

  <!-- Account Info -->
  <div class="grid place-items-center my-12">
    <div class="max-w-2xl mx-auto px-12">
      <div class="text-left">
        <h3 class="font-medium text-xl lg:text-3xl text-gray-700">
          Account Info
        </h3>
        <hr class="w-16 h-1 mx-auto my-3 ml-0 lg:my-4 lg:mb-6 bg-orange-600 border-0 rounded md:my-10" />
      </div>
      <div>
        <dl>
          <form id="editFullNameForm" action="" method="POST">
            <div class="px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-500">Name</dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <span id="nameText"><?php echo $username; ?></span>
                <input id="nameInput" type="text" name="nama_user" value="<?php echo $username; ?>" style="display: none;" class="text-sm text-gray-900">
              </dd>
              <button type="submit" name="edit_nama" class="fas fa-save cursor-pointer text-center" style="display: none;"></button>
              <i id="editButton" class="fas fa-edit cursor-pointer text-center"></i>
            </div>
          </form>
          <div class="px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Email address</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <?php echo $email; ?>
            </dd>
          </div>
          <div class="px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">Password</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              ••••••••••
            </dd>
            <a href="reset-password.php" class="fas fa-edit cursor-pointer text-center"></a>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <label for="imageUpload" class="text-sm font-medium text-gray-500 px-4 pt-5 sm:grid sm:gap-4 sm:px-6">Upload / Change Profile Image</label>
            <div class="px-4 py-5 sm:grid grid-cols-4 sm:gap-4 sm:px-6">

              <input type="file" name="image" id="imageUpload" accept="image/*" class="sm:col-span-3 mt-1 sm:mt-0 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              <button type="submit" class="fas fa-edit cursor-pointer text-center">
            </div>
          </form>
          <hr class="w-full h-1 bg-gray-600 border-0 rounded my-4" />
          <div class="px-4 py-5 sm:grid sm:grid-cols-4 sm:gap-4 sm:px-6">
            <div class="sm:col-span-3">
              <button id="scrollToOrder" class="text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                Your Orders
              </button>
            </div>
            <div class="sm:col-span-4">
              <a href="?logout" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Logout</a>
            </div>
          </div>
        </dl>
      </div>
    </div>
  </div>

  <!-- Order -->
  <section id="orderSection" class="cart px-20 my-5 py-5">
    <div class="text-center">
      <h3 class="font-medium text-xl lg:text-3xl text-gray-700">
        Your Order
      </h3>
      <hr class="w-full lg:w-16 h-1 mx-auto my-3 ml-0 lg:ml-auto lg:mr-auto lg:my-4 lg:mb-6 bg-orange-600 border-0 rounded md:my-10" />
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-center text-gray-500">
        <thead class="text-xs text-white uppercase bg-orange-600">
          <tr>
            <th scope="col" class="px-6 py-3">Product</th>
            <th scope="col" class="px-6 py-3 text-right">Date</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result_orders->fetch_assoc()) { ?>
            <tr class="bg-white border-b hover:bg-gray-50" onclick="redirectToOrderDetail(<?php echo $row['id_order']; ?>)">
              <td class="px-6 py-4">
                Order #<?= $row['id_order']; ?>
              </td>
              <td class="text-right px-6 py-4">
                <?php echo date('d F Y H:i', strtotime($row['tanggal_order'])); ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Footer -->
  <?php include '_footer.php'; ?>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
  <script>
    function redirectToOrderDetail(orderId) {
      window.location.href = 'order_detail.php?id_order=' + orderId + '&order_status=Your+Order';
    }

    const editButton = document.getElementById('editButton');
    const nameText = document.getElementById('nameText');
    const nameInput = document.getElementById('nameInput');
    const saveButton = document.querySelector('button[name="edit_nama"]');

    editButton.addEventListener('click', function() {
      if (nameText.style.display === 'none') {
        nameText.style.display = 'inline';
        nameInput.style.display = 'none';
        saveButton.style.display = 'none';
        editButton.classList.remove('fa-save');
        editButton.classList.add('fa-edit');
      } else {
        nameText.style.display = 'none';
        nameInput.style.display = 'inline';
        saveButton.style.display = 'inline';
        editButton.style.display = 'none';
      }
    });

    document.getElementById('scrollToOrder').addEventListener('click', function() {
      document.getElementById('orderSection').scrollIntoView({
        behavior: 'smooth'
      });
    });

    function scrollToOrder() {
      document.getElementById('orderSection').scrollIntoView({
        behavior: 'smooth'
      });
    }

    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');
    if (action === 'scrollToOrder') {
      scrollToOrder();
    }
  </script>

</body>

</html>