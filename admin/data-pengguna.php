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
          <?php
          // Query untuk mengambil semua data dari tabel users
          $sql = "SELECT id, username, created_at FROM users";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // Menampilkan data untuk setiap baris
            while($row = $result->fetch_assoc()) {
              echo "<tr class='hover:bg-gray-50'>";
              echo "<td class='border p-2'>" . $row["id"] . "</td>";
              echo "<td class='border p-2'>" . htmlspecialchars($row["username"]) . "</td>";
              echo "<td class='border p-2'>" . date('Y-m-d', strtotime($row["created_at"])) . "</td>";
              echo "<td class='border p-2 text-center space-x-2'>";
              // Tombol Edit
              echo "<a href='edit-pengguna.php?id=" . $row["id"] . "' 
                       class='inline-block bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700'>
                      Edit
                    </a>";
              // Tombol Hapus
              echo "<a href='hapus-pengguna.php?id=" . $row["id"] . "' 
                       onclick=\"return confirm('Yakin ingin menghapus pengguna ini?')\"
                       class='inline-block bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700'>
                      Hapus
                    </a>";
              echo "</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='4' class='border p-2 text-center'>Tidak ada data pengguna.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php
    $conn->close();
    include '../view/layout/footer.php';
  ?>
</div>