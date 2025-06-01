<?php
session_start();
require 'koneksi/koneksi.php'; // Pastikan koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username='$username' AND password=MD5('$password')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role']; // Menyimpan peran pengguna
        
        if ($row['role'] == 'admin') {
            header("Location: admin/dashboard.html");
        } else {
            header("Location: user/dashboard.html");
        }
        exit();
    } else {
        echo "Login gagal! Periksa kembali username dan password.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Failytail</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen font-sans">

  <div class="bg-gray-800 p-8 rounded-lg shadow-xl w-full max-w-md">
    <h2 class="text-3xl font-bold mb-6 text-center text-[#00bfe7]">Masuk ke Failytail 🎥</h2>

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
        Masuk
      </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-400">
      Belum punya akun? <a href="register.php" class="text-[#00bfe7] hover:underline">Daftar sekarang</a>
    </p>
  </div>

</body>
</html>
