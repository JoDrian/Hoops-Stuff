<?php
session_start();

require 'server/function.php';

$email = $password = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM tb_user WHERE email_user = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password_user'])) {
      $_SESSION['id_user'] = $user['id_user'];
      $_SESSION['email'] = $user['email_user'];
      $_SESSION['username'] = $user['nama_user'];

      if (!empty($_POST["remember"])) {
        setcookie("user_email", $email, time() + (10 * 365 * 24 * 60 * 60), "/");
        setcookie("user_password", $password, time() + (10 * 365 * 24 * 60 * 60), "/");
      } else {
        if (isset($_COOKIE["user_email"])) {
          setcookie("user_email", "");
        }
        if (isset($_COOKIE["user_password"])) {
          setcookie("user_password", "");
        }
      }

      header("Location: index.php");
      exit();
    } else {
      $error = "Incorrect password. Please try again.";
    }
  } else {
    $error = "User with this email does not exist.";
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
  <header id="header" class="py-4 shadow-sm bg-white fixed top-0 w-full z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
      <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="assets/img/basketball-logo.svg" class="h-8" alt="Logo" />
        <span class="self-center text-2xl font-black whitespace-nowrap dark:text-white"><span class="text-orange-600">HOOPS </span>STUFF</span>
      </a>
  </header>

  <!-- Login -->
  <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse pb-4">
        <img src="assets/img/basketball-logo.svg" class="h-8" alt="Logo" />
        <span class="self-center text-2xl font-black whitespace-nowrap dark:text-white"><span class="text-orange-600">HOOPS </span>STUFF</span>
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Sign in to your account
          </h1>
          <form class="space-y-4 md:space-y-6" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- Display error message if any -->
            <?php if (!empty($error)) : ?>
              <div class="text-red-600"><?php echo $error; ?></div>
            <?php endif; ?>
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
              <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="Your Email" required="" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
              <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-orange-600 focus:border-orange-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" required="">
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-orange-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-orange-600 dark:ring-offset-gray-800" <?php echo isset($_POST['remember']) ? 'checked' : ''; ?>>
                </div>
                <div class="ml-3 text-sm">
                  <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                </div>
              </div>
              <a href="reset-password.php" class="text-sm font-medium text-orange-600 hover:underline dark:text-orange-500">Forgot password?</a>
            </div>
            <button type="submit" class="w-full text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">Sign in</button>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
              Don’t have an account yet? <a href="register.php" class="font-medium text-orange-600 hover:underline dark:text-orange-500">Sign up</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include '_footer.php'; ?>


  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>