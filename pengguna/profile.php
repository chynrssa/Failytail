<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Saya - Failytail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="bg-gray-100 text-gray-800 font-sans">

    <!-- Header pakai include -->
    <?php include '../view/layout/header.php'; ?>

    <!-- Main content -->
    <main class="max-w-6xl mx-auto py-10 px-4">
      <!-- Profil Section -->
      <section class="bg-white shadow-md rounded-lg p-6 flex gap-6 items-center">
        <img
          src="../image/推し男子高校生メーカー.jpg"
          alt="Foto Profil"
          class="h-32 w-32 rounded-full object-cover border-4 border-[#00bfe7]"
        />
        <div>
          <h2 class="text-3xl font-bold">Zane</h2>
          <p class="text-gray-600">Pengguna sejak 2024</p>
          <p class="mt-2">
            <i class="fas fa-envelope text-[#00bfe7] mr-2"></i>zane@failytail.id
          </p>
          <p>
            <i class="fas fa-phone text-[#00bfe7] mr-2"></i>0871 - XXX - XXX
          </p>
        </div>
      </section>

      <!-- Statistik -->
      <section class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
        <div class="bg-white p-6 rounded-lg shadow-md">
          <h3 class="text-2xl font-bold text-[#00bfe7]">120</h3>
          <p class="text-gray-600 mt-2">Film Ditonton</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
          <h3 class="text-2xl font-bold text-[#00bfe7]">80</h3>
          <p class="text-gray-600 mt-2">Rating Diberikan</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
          <h3 class="text-2xl font-bold text-[#00bfe7]">35</h3>
          <p class="text-gray-600 mt-2">Ulasan Ditulis</p>
        </div>
      </section>

      <!-- Film Favorit -->
      <section class="mt-10">
        <h3 class="text-2xl font-bold mb-4">🎬 Film Favorit</h3>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img
              src="../image/Inception.jpg"
              alt="Film 1"
              class="w-full h-48 object-cover"
            />
            <div class="p-3">
              <h4 class="font-bold text-lg">Inception</h4>
              <p class="text-sm text-gray-600">Rating: ⭐ 4.8</p>
            </div>
          </div>
          <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img
              src="../image/oppenheimer.jpg"
              alt="Film 2"
              class="w-full h-48 object-cover"
            />
            <div class="p-3">
              <h4 class="font-bold text-lg">Judul Film 2</h4>
              <p class="text-sm text-gray-600">Rating: ⭐ 4.7</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Pengaturan -->
      <section class="mt-10 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold mb-4">⚙️ Pengaturan Akun</h3>
        <form class="space-y-4">
          <div>
            <label class="block mb-1 font-semibold">Nama Lengkap</label>
            <input
              type="text"
              value="Zane"
              class="w-full border border-gray-300 p-2 rounded-md"
            />
          </div>
          <div>
            <label class="block mb-1 font-semibold">Email</label>
            <input
              type="email"
              value="zane@failytail.id"
              class="w-full border border-gray-300 p-2 rounded-md"
            />
          </div>
          <div>
            <label class="block mb-1 font-semibold">No. HP</label>
            <input
              type="tel"
              value="0871 - XXX - XXX"
              class="w-full border border-gray-300 p-2 rounded-md"
            />
          </div>
          <button
            class="bg-[#00bfe7] text-white px-6 py-2 rounded-md font-bold hover:bg-[#009dbf]"
          >
            Simpan Perubahan
          </button>
        </form>
      </section>
    </main>

    <!-- Footer -->
    <footer class="bg-white text-center text-sm text-gray-500 py-4 mt-10 border-t">
      © 2025 Failytail. Semua Hak Dilindungi Computer Science.
    </footer>
  </body>
</html>
