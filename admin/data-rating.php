<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "failytail");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

include '../view/layout/header.php';
?>

<!-- Bungkus seluruh isi dengan div fleksibel -->
<div class="min-h-screen flex flex-col">

  <!-- Konten utama -->
  <div class="p-6 flex-grow">
    <h1 class="text-2xl font-bold mb-4">Data Rating Pengguna</h1>
    <div class="overflow-x-auto">
      <table class="w-full table-auto border-collapse border border-gray-300">
        <thead class="bg-gradient-to-r from-cyan-500 to-cyan-300 text-white">
          <tr>
            <th class="border p-2">ID</th>
            <th class="border p-2">Film</th>
            <th class="border p-2">Pengguna</th>
            <th class="border p-2">Rating</th>
            <th class="border p-2">Komentar</th>
            <th class="border p-2">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <tr>
            <td class="border p-2">1</td>
            <td class="border p-2">Contoh Film</td>
            <td class="border p-2">user123</td>
            <td class="border p-2">4.5</td>
            <td class="border p-2">Bagus banget!</td>
            <td class="border p-2 text-center">
              <a href="hapus-rating.php?id=1" 
                 onclick="return confirm('Yakin ingin menghapus rating ini?')" 
                 class="inline-block bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700">
                 Hapus
              </a>
            </td>
          </tr>
          <!-- Tambahkan baris rating lainnya di sini -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- Footer tetap di bawah -->
  <?php include '../view/layout/footer.php'; ?>
</div>
