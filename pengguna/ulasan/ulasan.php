<?php
session_start();
include '../../view/layout/header.php';
require '../../database/koneksi.php'; // Sesuaikan path ke koneksi.php

// Ambil data pengguna yang sedang login dari session
// Pastikan di sistem login Anda, Anda menyimpan 'user_id' dan 'role'
$is_logged_in = isset($_SESSION['user_id']);
$current_user_id = $is_logged_in ? $_SESSION['user_id'] : 0;
$current_user_role = $is_logged_in ? $_SESSION['role'] : '';

$sql = "SELECT 
            ulasan.id,
            ulasan.komentar,
            ulasan.rating,
            ulasan.created_at,
            ulasan.user_id, 
            filmadmin.judul AS nama_film,
            filmadmin.poster,
            users.username AS nama_pengguna 
        FROM ulasan
        JOIN filmadmin ON ulasan.film_id = filmadmin.id
        JOIN users ON ulasan.user_id = users.id
        ORDER BY ulasan.created_at DESC";

$result = $conn->query($sql);

// Fungsi untuk membuat bintang rating
function generate_stars($rating) {
    $stars_html = '';
    $full_stars = floor($rating);
    $half_star = ($rating - $full_stars) >= 0.5 ? 1 : 0;
    $empty_stars = 5 - $full_stars - $half_star;

    for ($i = 0; $i < $full_stars; $i++) {
        $stars_html .= '<i class="ri-star-fill"></i>';
    }
    if ($half_star) {
        $stars_html .= '<i class="ri-star-half-fill"></i>';
    }
    for ($i = 0; $i < $empty_stars; $i++) {
        $stars_html .= '<i class="ri-star-line"></i>';
    }
    return $stars_html;
}
?>

<body class="bg-gray-50 text-gray-800 min-h-screen">
  <div class="container mx-auto max-w-7xl py-8 px-4 flex-grow">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold">Ulasan Terbaru</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($ulasan = $result->fetch_assoc()): ?>
          <?php
            $posterPath = str_replace('../', '../../', $ulasan['poster']);
            $posterPath = str_replace(' ', '%20', $posterPath);
          ?>
          <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-shadow p-5 border border-gray-100 flex flex-col">
            <div class="flex items-center mb-4">
              <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                <i class="ri-user-line text-gray-500 ri-lg"></i>
              </div>
              <div class="ml-3">
                <h3 class="font-medium text-gray-800"><?= htmlspecialchars($ulasan['nama_pengguna']) ?></h3>
                <p class="text-xs text-gray-500"><?= date('d F Y', strtotime($ulasan['created_at'])) ?></p>
              </div>
            </div>
            
            <div class="flex gap-4 mb-4">
              <div class="w-24 h-36 rounded overflow-hidden flex-shrink-0">
                <img src="<?= htmlspecialchars($posterPath) ?>" alt="<?= htmlspecialchars($ulasan['nama_film']) ?>" class="w-full h-full object-cover"/>
              </div>
              <div>
                <h2 class="font-bold text-lg mb-1"><?= htmlspecialchars($ulasan['nama_film']) ?></h2>
              </div>
            </div>

            <div class="flex text-yellow-500 mb-3 text-lg">
              <?= generate_stars($ulasan['rating'] / 2) ?>
              <span class="text-sm text-gray-500 ml-2">(<?= htmlspecialchars(number_format($ulasan['rating'], 1)) ?>/10.0)</span>
            </div>
            
            <p class="text-sm text-gray-700 mb-4 line-clamp-4 flex-grow">
              <?= htmlspecialchars($ulasan['komentar']) ?>
            </p>

            <?php if ($is_logged_in && ($current_user_role === 'admin' || $current_user_id == $ulasan['user_id'])): ?>
              <div class="mt-auto pt-4 border-t border-gray-100">
                <a href="hapus-ulasan.php?id=<?= $ulasan['id'] ?>"
                   onclick="return confirm('Anda yakin ingin menghapus ulasan ini?')"
                   class="text-red-500 hover:text-red-700 text-sm font-medium flex items-center">
                  <i class="ri-delete-bin-line mr-1"></i>
                  Hapus Ulasan
                </a>
              </div>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="col-span-full text-center text-gray-500 mt-10">Belum ada ulasan yang masuk.</p>
      <?php endif; ?>
      <?php $conn->close(); ?>
    </div>
  </div>
</body>

<?php include '../../view/layout/footer.php'; ?>