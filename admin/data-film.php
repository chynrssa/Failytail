<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "failytail");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

include '../view/layout/header.php';
?>

<!-- Bungkus seluruh isi dengan div flex column -->
<div class="min-h-screen flex flex-col">

  <div class="p-6 flex-grow">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold text-gray-700">Manajemen Data Film</h1>
      <a href="crud/tambah-film.php" class="bg-cyan-600 text-white px-4 py-2 rounded-md shadow hover:bg-cyan-700 transition">
        + Tambah Film
      </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-xl shadow-lg p-4">
      <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
        <thead class="bg-gradient-to-r from-cyan-500 to-cyan-300 text-white rounded-t-xl">
          <tr>
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Poster</th>
            <th class="px-4 py-3">Judul</th>
            <th class="px-4 py-3">Genre</th>
            <th class="px-4 py-3">Deskripsi</th>
            <th class="px-4 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white text-gray-800">
          <?php
          $no = 1;
          $query = $conn->query("SELECT * FROM filmadmin");
          while ($row = $query->fetch_assoc()) {
          ?>
          <tr class="border-b hover:bg-gray-50">
            <td class="px-4 py-3"><?= $no++ ?></td>
            <td class="px-4 py-3">
              <img src="<?= htmlspecialchars($row['poster']) ?>" alt="<?= htmlspecialchars($row['judul']) ?>" class="h-16 w-16 object-cover rounded shadow border" />
            </td>
            <td class="px-4 py-3 font-semibold"><?= htmlspecialchars($row['judul']) ?></td>
            <td class="px-4 py-3"><?= htmlspecialchars($row['genre']) ?></td>
            <td class="px-4 py-3"><?= htmlspecialchars($row['deskripsi']) ?></td>
            <td class="px-4 py-3 space-x-3">
              <a href="crud/edit-film.php?id=<?= $row['id'] ?>" class="text-cyan-600 font-semibold hover:underline">Edit</a>
              <a href="crud/hapus-film.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus film ini?');" class="text-red-600 font-semibold hover:underline">Hapus</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php include '../view/layout/footer.php'; ?>
</div>
