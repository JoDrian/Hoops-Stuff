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

  <!-- Container -->
  <div class="container my-24 mx-auto md:px-6">
    <!-- Section: Design Block -->
    <section class="mb-32">
      <div class="container mx-auto text-center lg:text-left xl:px-32">
        <div class="flex grid items-center lg:grid-cols-2">
          <div class="mb-12 lg:mb-0">
            <div class="relative z-[1] block rounded-lg bg-[hsla(0,0%,100%,0.55)] px-6 py-12 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] backdrop-blur-[30px] dark:bg-[hsla(0,0%,5%,0.55)] dark:shadow-black/20 md:px-12 lg:-mr-14">
              <h2 class="mb-8 text-3xl font-bold">HOOPS STUFF</h2>
              <p class="mb-8 pb-2 text-neutral-500 dark:text-neutral-300 lg:pb-0">
                HOOPS STUFF Feature, Meaning, Explanation
              </p>

              <div class="mx-auto mb-8 flex flex-col md:flex-row md:justify-around lg:justify-between">
                <p class="mx-auto mb-4 flex items-center md:mx-0 md:mb-2 lg:mb-0">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="mr-2 h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Fast Respond
                </p>

                <p class="mx-auto mb-4 flex items-center md:mx-0 md:mb-2 lg:mb-0">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="mr-2 h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Best quality
                </p>

                <p class="mx-auto mb-2 flex items-center md:mx-0 lg:mb-0">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="mr-2 h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Featured Items
                </p>
              </div>

              <p class="mb-0 text-neutral-500 dark:text-neutral-300">
                Logo Hoops Stuff terdiri dari 2 elemen sederhana yakni bola basket untuk menambahkan aksen yang tegas bahwa toko kami menjual peralatan basket, dan yang kedua adalah teks Hoops Stuff yang berarti kebutuhan untuk bermain basket, sehingga dengan nama dan logo tersebut customer dapat langsung mengetahui apa yang toko kami jual.
              </p>
            </div>
          </div>

          <div>
            <img src="assets/img/hoops-logo.png" class="w-full rounded-lg shadow-lg dark:shadow-black/20" alt="image" />
          </div>
        </div>
      </div>
      <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
  </div>

  <!-- Container 2 -->
  <div class="container my-24 mx-auto md:px-6">
    <!-- Section: Design Block -->
    <section class="mb-32">
      <h2 class="mb-16 text-center text-2xl font-bold">Latest articles</h2>

      <div class="mb-16 flex flex-wrap">
        <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pr-6">
          <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg dark:shadow-black/20" data-te-ripple-init data-te-ripple-color="light">
            <img src="assets/img/Cleveland-Cavaliers-Logo.jpg" class="w-full" alt="Louvre" />
            <a href="#!">
              <div class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
            </a>
          </div>
        </div>

        <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pl-6">
          <h3 class="mb-4 text-2xl font-bold">Teams with most No. 1 picks in NBA history</h3>
          <div class="mb-4 flex items-center text-sm font-medium text-danger dark:text-danger-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="mr-2 h-5 w-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 01-1.161.886l-.143.048a1.107 1.107 0 00-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 01-1.652.928l-.679-.906a1.125 1.125 0 00-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 00-8.862 12.872M12.75 3.031a9 9 0 016.69 14.036m0 0l-.177-.529A2.25 2.25 0 0017.128 15H16.5l-.324-.324a1.453 1.453 0 00-2.328.377l-.036.073a1.586 1.586 0 01-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 01-5.276 3.67m0 0a9 9 0 01-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
            </svg>
            Worlds
          </div>
          <p class="mb-6 text-sm text-neutral-500 dark:text-neutral-400">
            Published <u>12.05.2024</u> by
            <a href="#!" class="font-bold">Admin</a>
          </p>
          <p class="mb-6 text-neutral-500 dark:text-neutral-300">
            Recapping how many times each franchise has drafted the 1st overall pick since 1947. The Atlanta Hawks won the 2024 NBA Draft Lottery, earning the No. 1 overall pick for the fourth time in NBA history, and the first time since the Lottery began in 1985. The Hawks choose 1st in the 2024 NBA Draft presented by State Farm, which will be held on Thursday and Friday, June 26-27.
          </p>
          <p class="text-neutral-500 dark:text-neutral-300">
            <span class="font-bold">Cleveland Cavaliers</span>
            <br>
            No. 1 picks: 6
            <br>
            1971: Austin Carr <br>
            1986: Brad Daugherty <br>
            2003: LeBron James <br>
            2011: Kyrie Irving <br>
            2013: Anthony Bennett <br>
            2014 Andrew Wiggins
          </p>
        </div>
      </div>

      <div class="mb-16 flex flex-wrap lg:flex-row-reverse">
        <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pl-6">
          <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg dark:shadow-black/20" data-te-ripple-init data-te-ripple-color="light">
            <img src="assets/img/article-2.jpg" class="w-full" alt="Louvre" />
            <a href="#!">
              <div class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
            </a>
          </div>
        </div>

        <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pr-6">
          <h3 class="mb-4 text-2xl font-bold">Nuggets-Timberwolves: 4 things to look for in Game 4</h3>
          <div class="mb-4 flex items-center text-sm font-medium text-primary dark:text-primary-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="mr-2 h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" />
            </svg>
            Skill
          </div>
          <p class="mb-6 text-sm text-neutral-500 dark:text-neutral-400">
            Published <u>12.05.2024</u> by
            <a href="#!" class="font-bold">Admin</a>
          </p>
          <p class="text-neutral-500 dark:text-neutral-300">
            Can a home team finally bring the crowd to life and also bring some common sense to this Western Conference semifinal series?
            <br><br>
            It’s 0-3 for the hosts so far, with the Timberwolves hoping to stop that slide Sunday and take a commanding 3-1 lead over the Nuggets in the process.
            <br><br>
            No matter the result, this game shouldn’t lack for intensity, because the stakes are potentially massive. A Nuggets win would invite a different conversation and perhaps put the defending champs in a comfort zone. A Wolves win would put this franchise on the doorstep of the conference finals for only the second time in history.
          </p>
        </div>
      </div>

      <div class="flex flex-wrap">
        <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pr-6">
          <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg dark:shadow-black/20" data-te-ripple-init data-te-ripple-color="light">
            <img src="assets/img/article-3.jpg" class="w-full" alt="Louvre" />
            <a href="#!">
              <div class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
            </a>
          </div>
        </div>

        <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pl-6">
          <h3 class="mb-4 text-2xl font-bold">Atlanta Hawks win 2024 NBA Draft Lottery</h3>
          <div class="mb-4 flex items-center text-sm font-medium text-yellow-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="mr-2 h-5 w-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
            </svg>
            Lottery
          </div>
          <p class="mb-6 text-sm text-neutral-500 dark:text-neutral-400">
            Published <u>12.05.2024</u> by
            <a href="#!" class="font-bold">Admin</a>
          </p>
          <p class="text-neutral-500 dark:text-neutral-300">
            The Atlanta Hawks won the 2024 NBA Draft Lottery presented by State Farm, which was conducted at the McCormick Place Convention Center in Chicago.
            <br><br>
            The Hawks will have the first overall pick in NBA Draft 2024 presented by State Farm, which will be held Wednesday, June 26 (First Round) at Barclays Center in Brooklyn, N.Y., and Thursday, June 27 (Second Round) at ESPN’s Seaport District Studios in New York.


          </p>
        </div>
      </div>
    </section>
    <!-- Section: Design Block -->
  </div>

  <!-- Footer -->
  <?php include '_footer.php'; ?>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>