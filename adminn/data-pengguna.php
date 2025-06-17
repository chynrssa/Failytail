<?php include 'header-admin.php'; ?>

<!-- Bungkus seluruh isi dengan div fleksibel -->
<div class="min-h-screen flex flex-col">

  <!-- Konten utama -->
  <div class="p-6 flex-grow">
    <h1 class="text-2xl font-bold mb-4">Data Pengguna</h1>
    <div class="overflow-x-auto">
      <table class="w-full table-auto border-collapse border border-gray-300">
        <thead class="bg-gradient-to-r from-cyan-500 to-cyan-300 text-white">
          <tr>
            <th class="border p-2 text-left">ID</th>
            <th class="border p-2 text-left">Nama Pengguna</th>
            <th class="border p-2 text-left">Tanggal Daftar</th>
            <th class="border p-2 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr class="hover:bg-gray-50">
            <td class="border p-2">1</td>
            <td class="border p-2">user123</td>
            <td class="border p-2">2025-06-17</td>
            <td class="border p-2 text-center">
              <a href="hapus-pengguna.php?id=1" 
                 onclick="return confirm('Yakin ingin menghapus pengguna ini?')"
                 class="inline-block bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700">
                Hapus
              </a>
            </td>
          </tr>
          <!-- Tambahkan data pengguna lainnya di sini -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- Footer tetap di bawah -->
  <?php include 'footer-admin.php'; ?>
</div>
