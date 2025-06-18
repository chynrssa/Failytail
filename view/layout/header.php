<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $is_logged_in ? $_SESSION['username'] : '';
$role = $is_logged_in ? $_SESSION['role'] : 'user';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= ($role == 'admin') ? 'Admin Dashboard' : 'Failytail - Berbagi Pengalaman Menonton Film' ?></title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com/<?= ($role == 'admin') ? '' : '3.4.16' ?>"></script>
  
  <?php if ($role == 'admin'): ?>
    <!-- Konfigurasi Tailwind untuk Admin -->
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: { 
              primary: "#00BCD4",
              'cyan-500': '#06b6d4',
              'cyan-300': '#67e8f9'
            },
            borderRadius: {
              DEFAULT: "8px",
              button: "8px",
            },
          },
        },
      };
    </script>
  <?php else: ?>
    <!-- Konfigurasi Tailwind untuk User -->
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: { 
              primary: "#00BCD4", 
              secondary: "#0097A7",
              'cyan-500': '#06b6d4',
              'cyan-300': '#67e8f9'
            },
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
  <?php endif; ?>

  <!-- Font dan Ikon -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />
  
  <style>
    body { font-family: 'Inter', sans-serif; }
    
    <?php if ($role != 'admin'): ?>
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
    <?php endif; ?>
  </style>
</head>
<body class="<?= ($role == 'admin') ? 'bg-gray-100' : 'bg-gray-50' ?>">

<?php if ($role == 'admin'): ?>
  <!-- HEADER ADMIN -->
  <header class="bg-gradient-to-r from-cyan-500 to-cyan-300 p-4 flex items-center justify-between shadow-md">
    <div class="flex items-center space-x-4">
      <img src="/FAILYTAIL/image/logo_failytail.png" alt="Logo" class="h-10 w-10">
       <a href="/FAILYTAIL/index.php" class="font-['Pacifico'] text-2xl text-white">Failytail</a>
      <nav class="ml-8 space-x-6 text-white font-medium">
        <a href="dashboard-admin.php" class="hover:underline">Beranda</a>
        <a href="data-rating.php" class="hover:underline">Data Rating</a>
        <a href="data-pengguna.php" class="hover:underline">Pengguna</a>
        <a href="data-film.php" class="hover:underline">Data Film</a>
      </nav>
    </div>
    <div class="flex items-center space-x-4">
      <div class="text-right text-black font-semibold leading-tight">
        Hai,<br><span class="font-bold"><?= htmlspecialchars($username) ?></span>
      </div>
      <a href="/FAILYTAIL/logout.php" class="bg-white text-cyan-500 font-semibold px-4 py-1 rounded-lg hover:bg-gray-100 transition">
        Logout
      </a>
    </div>
  </header>

<?php else: ?>
  <!-- HEADER USER -->
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
          <li><a href="/FAILYTAIL/pengguna/profile.php" class="text-white hover:text-black transition">Profile</a></li>
          <li><a href="/FAILYTAIL/pengguna/ulasan/ulasan.php" class="text-white hover:text-black transition">Top Ulasan</a></li>
          <li><a href="/FAILYTAIL/pengguna/faq/website.php" class="text-white hover:text-black transition">FAQ</a></li>
        </ul>
      </div>

      <!-- Login/Daftar atau Akun -->
      <div class="flex items-center space-x-3">
        <div class="flex items-center space-x-3">
          <?php if ($is_logged_in): ?>
            <span class="text-black font-semibold text-sm shadow-sm">
              Hai, <?= htmlspecialchars($username) ?>
            </span>
            <a href="/FAILYTAIL/logout.php" class="bg-white text-primary px-5 py-2 rounded-button font-medium text-sm whitespace-nowrap hover:bg-gray-100 transition">
              Logout
            </a>
          <?php else: ?>
            <a href="/FAILYTAIL/login.php" class="bg-white text-primary px-5 py-2 rounded-button font-medium text-sm whitespace-nowrap hover:bg-gray-100 transition">
              Login
            </a>
            <a href="/FAILYTAIL/register.php" class="bg-primary text-white px-5 py-2 rounded-button font-medium text-sm whitespace-nowrap hover:bg-opacity-90 transition">
              Daftar
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>
  
  <!-- Spacer agar konten tidak tertutupi header -->
  <div class="pt-32"></div>
<?php endif; ?>