<?php
session_start();
require 'database/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['id'];

            if ($_SESSION['role'] == 'admin') {
                header("Location: /FAILYTAIL/admin/dashboard-admin.php");
            } else {
                header("Location: /FAILYTAIL/index.php");
            }
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }

    $stmt->close();
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #001f3f 0%, #00bfe7 100%);
    }
    
    .form-input:focus {
      box-shadow: 0 0 0 3px rgba(0, 191, 231, 0.2);
    }
    
    .btn-primary {
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-6xl bg-white rounded-xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
    
    <!-- LEFT SIDE: IMAGE + TEXT -->
    <div class="md:w-1/2 relative hidden md:flex items-center justify-center bg-[#001f3f] text-white p-10">
      <div class="absolute inset-0 bg-gradient-to-b from-[#001f3f]/10 to-[#00bfe7]/10 z-10"></div>
      <div class="absolute inset-0 w-full h-full object-cover opacity-30"
           style="background: url('https://readdy.ai/api/search-image?query=cinematic%20scene%20with%20movie%20theater%20audience%20watching%20an%20exciting%20film%2C%20dramatic%20lighting%2C%20immersive%20experience%2C%20people%20sharing%20emotions%2C%20high%20quality%20professional%20photography&width=1280&height=500&seq=1&orientation=landscape') center/cover;"></div>
      
      <div class="relative z-20 text-center px-6">
        <h1 class="text-4xl font-bold leading-tight mb-4">Temukan Pengalaman Film<br>Luar Biasa</h1>
        <p class="text-lg mb-8">Bergabunglah dengan ribuan orang menikmati film dan acara terbaik!</p>
      </div>
    </div>

    <!-- RIGHT SIDE: FORM -->
    <div class="md:w-1/2 w-full p-6 md:p-10">
      <div class="flex flex-col items-center mb-6">
        <div class="bg-[#00bfe7] p-3 rounded-full mb-4">
          <i class="fas fa-film text-white text-2xl"></i>
        </div>
        <h2 class="text-3xl font-bold text-[#00bfe7] text-center">Failytail</h2>
        <p class="text-center text-gray-600 mt-1">Masuk ke akunmu untuk mulai menjelajah</p>
      </div>

      <?php if (!empty($error)): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex items-center">
          <i class="fas fa-exclamation-circle mr-2"></i>
          <span><?= $error ?></span>
        </div>
      <?php endif; ?>

      <form method="POST" class="space-y-4">
        <div>
          <label class="block text-gray-700 text-sm font-medium mb-1" for="username">
            Username
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-user text-gray-400"></i>
            </div>
            <input type="text" name="username" placeholder="Masukkan username" 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:ring-2 focus:ring-[#00bfe7]" 
                   required>
          </div>
        </div>
        
        <div>
          <label class="block text-gray-700 text-sm font-medium mb-1" for="password">
            Password
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-lock text-gray-400"></i>
            </div>
            <input type="password" name="password" placeholder="Masukkan password" 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:ring-2 focus:ring-[#00bfe7]" 
                   required>
          </div>
        </div>

        <button type="submit"
                class="w-full bg-[#00bfe7] hover:bg-[#009fc6] transition text-white font-semibold py-3 rounded-lg shadow-md btn-primary">
          Masuk
        </button>
      </form>

      <div class="mt-6 text-center text-sm text-gray-600">
        <p class="mb-2">Belum punya akun? <a href="register.php" class="text-[#00bfe7] font-semibold hover:underline">Daftar Sekarang</a></p>
      </div>
    </div>
  </div>
  
  <script>
    // Animasi untuk elemen input saat focus
    document.querySelectorAll('.form-input').forEach(input => {
      input.addEventListener('focus', () => {
        input.parentElement.classList.add('ring-2', 'ring-[#00bfe7]', 'ring-opacity-50');
      });
      
      input.addEventListener('blur', () => {
        input.parentElement.classList.remove('ring-2', 'ring-[#00bfe7]', 'ring-opacity-50');
      });
    });
  </script>
</body>
</html>