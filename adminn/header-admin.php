<?php // header-admin.php ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Header Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <header class="bg-gradient-to-r from-cyan-500 to-cyan-300 p-4 flex items-center justify-between shadow-md">
    <div class="flex items-center space-x-4">
      <img src="../image/logo_failytail.png" alt="Logo" class="h-10 w-10">
      <span class="text-white text-2xl font-bold">Failytail</span>
      <nav class="ml-8 space-x-6 text-white font-medium">
        <a href="data-film.php" class="hover:underline">Data Film</a>
        <a href="data-rating.php" class="hover:underline">Data Rating</a>
        <a href="data-pengguna.php" class="hover:underline">Pengguna failytail</a>
        <a href="dashboard-admin.php" class="hover:underline">Halaman Utama</a>
      </nav>
    </div>
    <div class="flex items-center space-x-4">
      <div class="text-right text-black font-semibold leading-tight">
        Hai,<br><span class="font-bold">admin</span>
      </div>
      <a href="logout.php" class="bg-white text-cyan-500 font-semibold px-4 py-1 rounded-lg hover:bg-gray-100 transition">
        Logout
      </a>
    </div>
  </header>
</body>
</html>