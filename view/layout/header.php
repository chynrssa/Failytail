<?php
session_start();
$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Failytail - Berbagi Pengalaman Menonton Film</title>
  <script src="https://cdn.tailwindcss.com/3.4.16"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: { primary: "#00BCD4", secondary: "#0097A7" },
          borderRadius: {
            none: "0px",
            sm: "4px",
            DEFAULT: "8px",
            md: "12px",
            lg: "16px",
            xl: "20px",
            "2xl": "24px",
            "3xl": "32px",
            full: "9999px",
            button: "8px",
          },
        },
      },
    };
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />
  <style>
    body { font-family: 'Inter', sans-serif; }
    .gradient-bg { background: linear-gradient(135deg, #00BCD4 0%, #B2EBF2 100%); }
    .hero-gradient { background: linear-gradient(90deg, rgba(0,188,212,0.9) 0%, rgba(0,151,167,0.8) 100%); }
    .search-input:focus { outline: none; }
    .custom-shadow { box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); }
    .film-card:hover {
      transform: translateY(-5px);
      transition: transform 0.3s ease;
    }
    .star-rating input { display: none; }
    .star-rating label {
      cursor: pointer;
    }
    .star-rating label:hover,
    .star-rating label:hover ~ label,
    .star-rating input:checked ~ label {
      color: #FFD700;
    }
  </style>
</head>
<body class="bg-gray-50">
  <!-- Header -->
  <header class="gradient-bg text-white fixed top-0 left-0 w-full z-50 shadow-md">
    <div class="container mx-auto px-4 py-3 flex flex-col md:flex-row items-center justify-between">
      
      <!-- Logo -->
      <div class="flex items-center mb-4 md:mb-0 md:mr-12">
        <div class="w-10 h-10 flex items-center justify-center mr-2 bg-white rounded-lg">
          <a href="#">
            <img src="/FAILYTAIL/image/logo_failytail.png" alt="Logo" class="w-10 h-10 object-contain" />
          </a>
        </div>
        <a href="/FAILYTAIL/index.php" class="font-['Pacifico'] text-2xl text-white">Failytail</a>
      </div>

      <!-- Menu Navigasi -->
      <div class="container mx-auto px-4">
        <ul class="flex overflow-x-auto whitespace-nowrap py-3 space-x-8 text-sm font-medium">
          <li><a href="/FAILYTAIL/index.php" class="text-white hover:text-black transition">Beranda</a></li>
          <li><a href="#" class="text-white hover:text-black transition">Film Terbaru</a></li>
          <li><a href="/FAILYTAIL/pengguna/ulasan/ulasan.php" class="text-white hover:text-black transition">Top Ulasan</a></li>
          <li><a href="/FAILYTAIL/pengguna/faq/website.php" class="text-white hover:text-black transition">FAQ</a></li>
        </ul>
      </div>

      <!-- Login/Daftar atau Akun (jika sudah login) -->
      <div class="flex space-x-3">
        <?php if ($is_logged_in): ?>
          <div class="flex items-center space-x-4">
            <span class="text-sm">Hai, <?= htmlspecialchars($_SESSION['username']) ?></span>
            <a href="logout.php" class="bg-white text-primary px-5 py-2 rounded-button font-medium text-sm whitespace-nowrap hover:bg-gray-100 transition">Logout</a>
          </div>
        <?php else: ?>
          <button class="bg-white text-primary px-5 py-2 rounded-button font-medium text-sm whitespace-nowrap hover:bg-gray-100 transition">Login</button>
          <button class="bg-primary text-white px-5 py-2 rounded-button font-medium text-sm whitespace-nowrap hover:bg-opacity-90 transition">Daftar</button>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- Spacer agar konten tidak tertutupi header -->
  <div class="pt-32"></div>
