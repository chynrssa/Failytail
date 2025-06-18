<?php include '../view/layout/header.php'; ?>

<div class="min-h-screen flex flex-col">

  <div class="p-6 flex-grow">
    <h1 class="text-3xl font-bold text-cyan-600 mb-6">
      Selamat datang di <span class="text-gray-700">Dashboard Admin!</span>
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Kartu Jumlah Film -->
      <div class="bg-gradient-to-br from-cyan-100 to-cyan-50 rounded-2xl p-6 shadow hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-lg font-semibold text-gray-600 mb-1">Jumlah Film</h2>
            <p class="text-4xl font-bold text-cyan-600">25</p>
          </div>
          <div class="text-cyan-500 text-4xl">🎬</div>
        </div>
      </div>

      <!-- Kartu Total Rating -->
      <div class="bg-gradient-to-br from-cyan-100 to-cyan-50 rounded-2xl p-6 shadow hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-lg font-semibold text-gray-600 mb-1">Total Rating</h2>
            <p class="text-4xl font-bold text-cyan-600">150</p>
          </div>
          <div class="text-cyan-500 text-4xl">⭐</div>
        </div>
      </div>

      <!-- Kartu Jumlah Pengguna -->
      <div class="bg-gradient-to-br from-cyan-100 to-cyan-50 rounded-2xl p-6 shadow hover:shadow-xl transition duration-300">
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-lg font-semibold text-gray-600 mb-1">Jumlah Pengguna</h2>
            <p class="text-4xl font-bold text-cyan-600">85</p>
          </div>
          <div class="text-cyan-500 text-4xl">👤</div>
        </div>
      </div>
    </div>
  </div>

  <?php include '../view/layout/footer.php'; ?>

</div>
