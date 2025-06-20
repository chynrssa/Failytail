<?php
session_start();
// Otorisasi: Pastikan hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Akses ditolak. Anda bukan admin.");
}

include '../view/layout/header.php';
require '../database/koneksi.php';

// 1. Ambil ID pengguna dari URL
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($user_id === 0) {
    die("ID pengguna tidak valid.");
}

// 2. Ambil data pengguna yang akan diedit dari database
// Hindari mengambil password
$sql = "SELECT id, username, email, phone, alamat, role FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Pengguna tidak ditemukan.");
}
$user = $result->fetch_assoc();
$stmt->close();
?>

<body class="bg-gray-50">
  <div class="container mx-auto max-w-2xl py-12 px-4">
    <div class="bg-white p-8 rounded-xl shadow-lg">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Data Pengguna: <?= htmlspecialchars($user['username']) ?></h1>
      
      <form action="proses-edit-pengguna.php" method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <div class="mb-4">
          <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
          <input type="text" name="username" id="username" required value="<?= htmlspecialchars($user['username']) ?>"
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
        </div>

        <div class="mb-4">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
           <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>"
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
        </div>

        <div class="mb-4">
          <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Telepon:</label>
          <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>"
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
        </div>

        <div class="mb-4">
          <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat:</label>
          <textarea name="alamat" id="alamat" rows="3" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700"><?= htmlspecialchars($user['alamat'] ?? '') ?></textarea>
        </div>

        <div class="mb-6">
          <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
          <select name="role" id="role" class="shadow border rounded w-full py-2 px-3 text-gray-700">
            <option value="user" <?= ($user['role'] == 'user') ? 'selected' : '' ?>>User</option>
            <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
          </select>
        </div>

        <div class="flex items-center justify-end gap-4">
          <a href="data-pengguna.php" class="text-gray-600 hover:text-gray-800">Batal</a>
          <button type="submit" 
                  class="bg-primary hover:bg-opacity-90 text-white font-bold py-2 px-4 rounded-button">
              Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</body>

<?php
$conn->close();
include '../view/layout/footer.php';
?>