<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Failytail - Berbagi Pengalaman Menonton Film</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: { primary: "#00BCD4", secondary: "#0097A7" },
            borderRadius: {
              none: "0px",
              sm: "4px",
              DEFAULT: "8px",
              md: "12px",
              lg: "16px",
              xl: "20px",
              "2xl": "24px",
              "3xl": "32px",
              full: "9999px",
              button: "8px",
            },
          },
        },
      };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"
    />
    <style>
      :where([class^="ri-"])::before { content: "\f3c2"; }
      body {
      font-family: 'Inter', sans-serif;
      }
      .gradient-bg {
      background: linear-gradient(135deg, #00BCD4 0%, #B2EBF2 100%);
      }
      .hero-gradient {
      background: linear-gradient(90deg, rgba(0,188,212,0.9) 0%, rgba(0,151,167,0.8) 100%);
      }
      .search-input:focus {
      outline: none;
      }
      .custom-shadow {
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      }
      .film-card:hover {
      transform: translateY(-5px);
      transition: transform 0.3s ease;
      }
      .star-rating input {
      display: none;
      }
      .star-rating label {
      cursor: pointer;
      }
      .star-rating label:hover,
      .star-rating label:hover ~ label,
      .star-rating input:checked ~ label {
      color: #FFD700;
      }
    </style>
  </head>
  <body class="bg-gray-50">
    
    <!-- Konten Utama Halaman -->
    <!-- ... konten website Anda di sini ... -->
    
    <!-- Footer Dinamis Berdasarkan Peran -->
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') : ?>
        <!-- Footer untuk Admin -->
        <footer class="bg-gradient-to-r from-cyan-500 to-cyan-300 text-white mt-10 py-4">
            <div class="container mx-auto text-center text-sm">
                &copy; <?= date("Y") ?> Failytail. All rights reserved.
            </div>
        </footer>
    <?php else : ?>
        <!-- Footer untuk Pengguna Biasa -->
        <footer class="bg-gray-800 text-white pt-12 pb-6">
            <div class="container mx-auto px-4">
                <div class="flex flex-col items-center">
                    <div class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-3 gap-8 mb-8 justify-items-center">
                        <!-- Kolom 1: Logo & Deskripsi -->
                        <div class="text-center">
                            <div class="flex items-center justify-center mb-4 md:mb-0">
                                <div class="w-10 h-10 flex items-center justify-center mr-2 bg-white rounded-lg">
                                    <a href="/FAILYTAIL/index.php">
                                        <img src="/FAILYTAIL/image/logo_failytail.png" alt="Logo" class="w-10 h-10 object-contain" />
                                    </a>
                                </div>
                                <a href="/FAILYTAIL/index.php" class="font-['Pacifico'] text-2xl text-white">Failytail</a>
                            </div>
                            <p class="text-gray-400 text-sm mb-4 max-w-xs mx-auto">
                                Platform berbagi pengalaman menonton film terbesar di Indonesia. Temukan film favorit dan bagikan ceritamu.
                            </p>
                            <div class="flex justify-center space-x-4">
                                <a href="#" class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center hover:bg-primary transition">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                                <a href="#" class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center hover:bg-primary transition">
                                    <i class="ri-twitter-x-fill"></i>
                                </a>
                                <a href="#" class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center hover:bg-primary transition">
                                    <i class="ri-instagram-line"></i>
                                </a>
                                <a href="#" class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center hover:bg-primary transition">
                                    <i class="ri-youtube-fill"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Kolom 2: Navigasi -->
                        <div class="text-center">
                            <h3 class="text-lg font-semibold mb-4">Jelajahi Failytail</h3>
                            <ul class="space-y-2 text-gray-400">
                                <li><a href="/FAILYTAIL/pengguna/ulasan/ulasan.php" class="hover:text-primary transition">Ulasan Terpopuler</a></li>
                                <li><a href="/FAILYTAIL/pengguna/faq/website.php" class="hover:text-primary transition">Pertanyaan Umum</a></li>
                                <?php if (!isset($_SESSION['user_id'])) : ?>
                                    <li><a href="/FAILYTAIL/login.php" class="hover:text-primary transition">Login/Register</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <!-- Kolom 3: Kontak -->
                        <div class="text-center">
                            <h3 class="text-lg font-semibold mb-4">Hubungi Kami</h3>
                            <ul class="space-y-3 text-gray-400">
                                <li class="flex justify-center items-center">
                                    <i class="ri-mail-line mr-2"></i>
                                    <span>support@failytail.id</span>
                                </li>
                                <li class="flex justify-center items-center">
                                    <i class="ri-phone-line mr-2"></i>
                                    <span>+62 21 1234 5678</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Copyright -->
                    <div class="w-full max-w-6xl border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center text-gray-400 text-sm">
                        <p class="mb-4 md:mb-0">&copy; <?= date("Y") ?> Failytail. Hak Cipta Dilindungi.</p>
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="#" class="hover:text-primary transition">Syarat & Ketentuan</a>
                            <a href="#" class="hover:text-primary transition">Bantuan</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    <?php endif; ?>
    
  </body>
</html>