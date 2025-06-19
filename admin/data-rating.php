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
          <?php
          // PERBAIKAN: Query diubah untuk JOIN ke tabel `filmadmin` sesuai struktur database baru
          $sql = "SELECT ulasan.id, filmadmin.judul AS nama_film, users.username AS nama_pengguna, ulasan.rating, ulasan.komentar 
                  FROM ulasan
                  JOIN filmadmin ON ulasan.film_id = filmadmin.id
                  JOIN users ON ulasan.user_id = users.id
                  ORDER BY ulasan.id DESC"; // Diurutkan agar data terbaru di atas
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // Menampilkan data untuk setiap baris
            while($row = $result->fetch_assoc()) {
              echo "<tr class='hover:bg-gray-50'>";
              echo "<td class='border p-2'>" . $row["id"] . "</td>";
              echo "<td class='border p-2'>" . htmlspecialchars($row["nama_film"]) . "</td>";
              echo "<td class='border p-2'>" . htmlspecialchars($row["nama_pengguna"]) . "</td>";
              echo "<td class='border p-2'>" . htmlspecialchars($row["rating"]) . "</td>";
              echo "<td class='border p-2'>" . htmlspecialchars($row["komentar"]) . "</td>";
              echo "<td class='border p-2 text-center'>";
              echo "<a href='hapus-rating.php?id=" . $row["id"] . "' 
                       onclick=\"return confirm('Yakin ingin menghapus rating ini?')\" 
                       class='inline-block bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700'>
                       Hapus
                    </a>";
              echo "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='6' class='border p-2 text-center'>Belum ada data rating.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Footer tetap di bawah -->
  <?php include '../view/layout/footer.php'; ?>
</div>
