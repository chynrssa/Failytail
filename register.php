<?php
session_start();
require 'database/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $role = 'user';

    // Gunakan prepared statement untuk keamanan
    $checkUser = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $checkUser->bind_param("s", $username);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        $error = "Username sudah digunakan!";
    } else {
        // Gunakan password_hash untuk keamanan
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO users (username, password, role, email, phone, alamat) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $hashedPassword, $role, $email, $phone, $alamat);
        
        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Registrasi gagal, silakan coba lagi!";
        }
        $stmt->close();
    }

    $checkUser->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar - Failytail</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#00bfe7',
            secondary: '#001f3f',
            accent: '#009fc6'
          }
        }
      }
    }
  </script>
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
    
    .animate-float {
      animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

  <div class="w-full max-w-6xl bg-white rounded-xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
    
    <!-- KIRI: Gambar dan promosi -->
    <div class="md:w-1/2 relative hidden md:flex items-center justify-center bg-secondary text-white p-10">
      <div class="absolute inset-0 bg-gradient-to-b from-secondary/10 to-primary/10 z-10"></div>
      <div class="absolute inset-0 w-full h-full object-cover opacity-30"
           style="background: url('https://readdy.ai/api/search-image?query=cinematic%20scene%20with%20movie%20theater%20audience%20watching%20an%20exciting%20film%2C%20dramatic%20lighting%2C%20immersive%20experience%2C%20people%20sharing%20emotions%2C%20high%20quality%20professional%20photography&width=1280&height=500&seq=1&orientation=landscape') center/cover;"></div>
      
      <div class="relative z-20 text-center px-6">
        <div class="bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/20">
          <h1 class="text-4xl font-bold leading-tight mb-4">Jadilah Bagian Komunitas Pecinta Film</h1>
          <p class="text-lg mb-8">Daftar sekarang dan mulai bagikan ulasanmu!</p>
          
          <div class="flex flex-col space-y-4 text-left max-w-md mx-auto">
            <div class="flex items-start">
              <div class="bg-primary p-2 rounded-full mr-3 mt-1">
                <i class="fas fa-film text-white text-sm"></i>
              </div>
              <div>
                <h3 class="font-semibold">Review Film Terbaru</h3>
                <p class="text-sm opacity-80">Akses dan beri ulasan untuk film-film terkini</p>
              </div>
            </div>
            
            <div class="flex items-start">
              <div class="bg-primary p-2 rounded-full mr-3 mt-1">
                <i class="fas fa-users text-white text-sm"></i>
              </div>
              <div>
                <h3 class="font-semibold">Komunitas Aktif</h3>
                <p class="text-sm opacity-80">Bergabung dengan komunitas pecinta film</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- KANAN: Formulir Daftar -->
    <div class="md:w-1/2 w-full p-6 md:p-10">
      <div class="flex flex-col items-center mb-6">
        <a href="URL_ANDA_DISINI" class="block w-16 h-16 mb-4 animate-float">
          <img 
            src="/FAILYTAIL/image/logo_failytail.png" 
            alt="Failytail Logo" 
            class="w-full h-full object-contain"
          />
        </a>
        <h2 class="text-3xl font-bold text-primary text-center">Failytail</h2>
        <p class="text-center text-gray-600 mt-1">Buat akun untuk mulai menikmati fitur eksklusif</p>
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
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:ring-2 focus:ring-primary" 
                   required>
          </div>
        </div>
        
        <div>
          <label class="block text-gray-700 text-sm font-medium mb-1" for="email">
            Email
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-envelope text-gray-400"></i>
            </div>
            <input type="email" name="email" placeholder="Masukkan email" 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:ring-2 focus:ring-primary" 
                   required>
          </div>
        </div>
        
        <div>
          <label class="block text-gray-700 text-sm font-medium mb-1" for="phone">
            Nomor HP
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-phone text-gray-400"></i>
            </div>
            <input type="tel" name="phone" placeholder="Masukkan nomor HP" 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:ring-2 focus:ring-primary" 
                   required>
          </div>
        </div>
        
        <div>
          <label class="block text-gray-700 text-sm font-medium mb-1" for="alamat">
            Alamat
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
              <i class="fas fa-home text-gray-400"></i>
            </div>
            <textarea name="alamat" placeholder="Masukkan alamat lengkap" 
                      class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:ring-2 focus:ring-primary h-32" 
                      required></textarea>
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
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg form-input focus:outline-none focus:ring-2 focus:ring-primary" 
                   required>
          </div>
        </div>
        
        <div class="flex items-center">
          <input type="checkbox" id="terms" class="h-4 w-4 text-primary rounded focus:ring-primary border-gray-300">
          <label for="terms" class="ml-2 block text-sm text-gray-700">
            Saya menyetujui <a href="#" class="text-primary font-medium hover:underline">Syarat & Ketentuan</a>
          </label>
        </div>

        <button type="submit"
                class="w-full bg-primary hover:bg-accent transition text-white font-semibold py-3 rounded-lg shadow-md btn-primary">
          Daftar Sekarang
        </button>
      </form>

      <div class="mt-6 text-center text-sm text-gray-600">
        <p class="mb-2">Sudah punya akun? <a href="login.php" class="text-primary font-semibold hover:underline">Masuk di sini</a></p>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    // Animasi untuk elemen input saat focus
    document.querySelectorAll('.form-input').forEach(input => {
      input.addEventListener('focus', () => {
        input.parentElement.classList.add('ring-2', 'ring-primary', 'ring-opacity-50');
      });
      
      input.addEventListener('blur', () => {
        input.parentElement.classList.remove('ring-2', 'ring-primary', 'ring-opacity-50');
      });
    });
  </script>
</body>
</html>