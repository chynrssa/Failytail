<?php
session_start();
include '../../view/layout/header.php';

// Cek login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    die("Akses ditolak. Silakan login terlebih dahulu.");
}

require '../../database/koneksi.php'; // Sesuaikan path ke koneksi

$user_id = $_SESSION['user_id'] ?? null;
$film_id = $_GET['film_id'] ?? null;
$film = null;
$error = null;

// Ambil data film berdasarkan ID
if ($film_id) {
    $stmt = $conn->prepare("SELECT * FROM film WHERE id = ?");
    $stmt->bind_param("i", $film_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $film = $result->fetch_assoc();
} else {
    $error = "ID film tidak tersedia.";
}

// Proses form submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $komentar = trim($_POST['komentar']);
    $rating = floatval($_POST['rating']);

    if (!$film || !$komentar || !$rating) {
        $error = "Semua kolom wajib diisi.";
    } else {
        $stmt = $conn->prepare("INSERT INTO ulasan (user_id, film_id, komentar, rating) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisd", $user_id, $film_id, $komentar, $rating);

        if ($stmt->execute()) {
            // Redirect ke halaman ini kembali dengan parameter sukses dan film_id
            header("Location: beri_ulasan.php?film_id=" . urlencode($film_id) . "&success=1");
            exit;
        } else {
            $error = "Gagal menyimpan ulasan: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Beri Ulasan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-[#e0f7fa] to-[#ffffff] min-h-screen">
  <div class="flex justify-center ">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-xl w-full border border-gray-100">
      <div class="flex items-center justify-center ">
        <i class="ri-edit-2-line text-3xl text-[#00bfe7] mr-2"></i>
        <h1 class="text-2xl font-bold text-[#00bfe7]">Tulis Ulasanmu</h1>
      </div>

      <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded-md text-sm">Ulasan berhasil dikirim!</div>
      <?php endif; ?>

      <?php if ($film): ?>
        <div class="mb-4 text-center">
          <p class="text-gray-600 text-sm">Untuk film:</p>
          <p class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($film['judul']) ?></p>
        </div>
      <?php else: ?>
        <div class="mb-4 text-center text-red-500 font-semibold">Film tidak ditemukan.</div>
      <?php endif; ?>

      <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-md text-sm"><?= $error ?></div>
      <?php endif; ?>

      <form method="POST" class="space-y-5">
        <div>
          <label class="block mb-1 font-medium text-gray-700">Komentar</label>
          <textarea name="komentar" rows="4" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00bfe7]" placeholder="Tuliskan ulasanmu..." required></textarea>
        </div>
        <div>
          <label class="block mb-1 font-medium text-gray-700">Rating</label>
          <input type="number" name="rating" step="0.1" min="0" max="10" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00bfe7]" placeholder="Nilai antara 0.0 hingga 10.0" required>
        </div>
        <button type="submit" class="w-full bg-[#00bfe7] hover:bg-[#009fc6] text-white font-semibold py-3 rounded-lg transition">
          Kirim Ulasan
        </button>
      </form>

      <div class="text-center mt-6">
        <a href="/FAILYTAIL/index.php" class="text-sm text-gray-500 hover:underline">&larr; Kembali ke Beranda</a>
      </div>
    </div>
  </div>
</body>
</html>
