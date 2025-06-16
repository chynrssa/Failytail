<?php
session_start();
require 'database/koneksi.php'; // File ini sudah membuat $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 'user'; // Default role

    // Cek apakah username sudah terdaftar
    $checkUser = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkUser);

    if ($result->num_rows > 0) {
        $error = "Username sudah digunakan!";
    } else {
        // Simpan data user baru
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', MD5('$password'), '$role')";
        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Registrasi gagal, silakan coba lagi!";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar - Failytail</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen font-sans">

  <div class="bg-gray-800 p-8 rounded-lg shadow-xl w-full max-w-md">
    <h2 class="text-3xl font-bold mb-6 text-center text-[#00bfe7]">Daftar Akun Baru 🚀</h2>

    <?php if (!empty($error)): ?>
      <div class="bg-red-500 text-white p-3 rounded mb-4 text-center">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
      <input type="text" name="username" placeholder="Username"
             class="w-full px-4 py-3 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#00bfe7]" required>

      <input type="password" name="password" placeholder="Password"
             class="w-full px-4 py-3 rounded bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#00bfe7]" required>

      <button type="submit"
              class="w-full bg-[#00bfe7] hover:bg-[#00aac5] transition text-white font-semibold py-3 rounded shadow">
        Daftar
      </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-400">
      Sudah punya akun? <a href="login.php" class="text-[#00bfe7] hover:underline">Masuk di sini</a>
    </p>
  </div>

</body>
</html>
