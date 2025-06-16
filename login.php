<?php
session_start();
require 'database/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password=MD5('$password')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];

        if ($row['role'] == 'admin') {
            header("Location: /FAILYTAIL/admin/dashboard.html");
        } else {
            header("Location: /FAILYTAIL/index.php");
        }
        exit();
    } else {
        $error = "Login gagal! Periksa kembali username dan password.";
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
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#001f3f] to-[#00bfe7]">

  <div class="w-full max-w-6xl bg-white rounded-xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
    
    <!-- LEFT SIDE: IMAGE + TEXT -->
    <div class="md:w-1/2 relative hidden md:flex items-center justify-center bg-[#001f3f] text-white p-10">
      <img
        src="https://readdy.ai/api/search-image?query=cinematic%20scene%20with%20movie%20theater%20audience%20watching%20an%20exciting%20film%2C%20dramatic%20lighting%2C%20immersive%20experience%2C%20people%20sharing%20emotions%2C%20high%20quality%20professional%20photography&width=1280&height=500&seq=1&orientation=landscape"
        alt="Film Experience"
        class="absolute inset-0 w-full h-full object-cover opacity-50"
      />
      <div class="relative z-10 text-center">
        <h1 class="text-4xl font-extrabold leading-snug">Temukan Event<br>Luar Biasa</h1>
        <p class="mt-4 text-lg text-gray-200">Bergabunglah dengan ribuan orang menikmati konser dan acara terbaik!</p>
      </div>
    </div>

    <!-- RIGHT SIDE: FORM -->
    <div class="md:w-1/2 w-full p-10">
      <h2 class="text-3xl font-extrabold text-[#00bfe7] text-center">Failytail</h2>
      <p class="text-center text-gray-600 mt-1 mb-8">Masuk ke akunmu untuk mulai menjelajah event</p>

      <?php if (!empty($error)): ?>
        <div class="bg-red-500 text-white p-3 rounded mb-4 text-center animate-pulse">
          <?= $error ?>
        </div>
      <?php endif; ?>

      <form method="POST" class="space-y-5">
        <input type="text" name="username" placeholder="Username"
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00bfe7]" required>
        <input type="password" name="password" placeholder="Password"
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00bfe7]" required>
        <button type="submit"
                class="w-full bg-[#00bfe7] hover:bg-[#009fc6] transition text-white font-semibold py-3 rounded-lg shadow-md hover:shadow-lg hover:scale-[1.02] duration-200">
          Masuk
        </button>
      </form>

      <p class="mt-6 text-center text-sm text-gray-600">
        Belum punya akun? <a href="register.php" class="text-[#00bfe7] font-semibold hover:underline">Daftar Sekarang</a>
      </p>
    </div>
  </div>

</body>
</html>
