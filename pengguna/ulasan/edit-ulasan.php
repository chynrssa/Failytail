<?php
session_start();
include '../../view/layout/header.php';
require '../../database/koneksi.php';

// 1. Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../view/auth/login.php"); // Arahkan ke halaman login
    exit();
}

// 2. Ambil ID ulasan dari URL
$ulasan_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($ulasan_id === 0) {
    die("ID ulasan tidak valid.");
}

// 3. Ambil data ulasan yang ada dari database
$sql = "SELECT * FROM ulasan WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ulasan_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Ulasan tidak ditemukan.");
}
$ulasan = $result->fetch_assoc();
$stmt->close();

// 4. Otorisasi: Pastikan pengguna yang login adalah pemilik ulasan
if ($ulasan['user_id'] != $_SESSION['user_id']) {
    die("Akses ditolak. Anda hanya bisa mengedit ulasan Anda sendiri.");
}
?>

<body class="bg-gray-50">
  <div class="container mx-auto max-w-2xl py-12 px-4">
    <div class="bg-white p-8 rounded-xl shadow-lg">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Ulasan Anda</h1>
      
      <form action="proses-edit-ulasan.php" method="POST">
        <input type="hidden" name="ulasan_id" value="<?= $ulasan['id'] ?>">

        <div class="mb-4">
          <label for="rating" class="block text-gray-700 text-sm font-bold mb-2">Rating (1-10):</label>
          <input type="number" name="rating" id="rating" min="1" max="10" step="0.1" required 
                 value="<?= htmlspecialchars($ulasan['rating']) ?>"
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-6">
          <label for="komentar" class="block text-gray-700 text-sm font-bold mb-2">Komentar:</label>
          <textarea name="komentar" id="komentar" rows="6" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?= htmlspecialchars($ulasan['komentar']) ?></textarea>
        </div>

        <div class="flex items-center justify-end gap-4">
          <a href="ulasan.php" class="text-gray-600 hover:text-gray-800">Batal</a>
          <button type="submit" 
                  class="bg-primary hover:bg-opacity-90 text-white font-bold py-2 px-4 rounded-button focus:outline-none focus:shadow-outline">
              Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</body>

<?php
$conn->close();
include '../../view/layout/footer.php';
?>