<?php
session_start();
require '../../database/koneksi.php'; // Sesuaikan path ke file koneksi

// Cek apakah pengguna sudah login, jika tidak, jangan tampilkan form ulasan
$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$user_id = $_SESSION['user_id'] ?? null;

// Ambil ID film dari URL, pastikan valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID film tidak valid.");
}
$film_id = $_GET['id'];

$error = null;
$success = isset($_GET['success']);

// --- PROSES FORM JIKA ADA SUBMIT (METHOD POST) ---
if ($_SERVER["REQUEST_METHOD"] === "POST" && $is_logged_in) {
    $komentar = trim($_POST['komentar']);
    $rating = floatval($_POST['rating']);

    if (!$komentar || !$rating || !$user_id) {
        $error = "Komentar dan rating wajib diisi.";
    } else {
        // Gunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("INSERT INTO ulasan (user_id, film_id, komentar, rating) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisd", $user_id, $film_id, $komentar, $rating);

        if ($stmt->execute()) {
            header("Location: detail-film.php?id=" . urlencode($film_id) . "&success=1");
            exit;
        } else {
            $error = "Gagal menyimpan ulasan: " . $stmt->error;
        }
    }
}

// Ambil data film yang akan ditampilkan
$stmt = $conn->prepare("SELECT * FROM filmadmin WHERE id = ?");
$stmt->bind_param("i", $film_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Film tidak ditemukan.");
}
$film = $result->fetch_assoc();
$stmt->close();
$conn->close();

// Perbaiki path poster untuk halaman ini
$posterPath = str_replace('../', '../../', $film['poster']);

// Sertakan header setelah semua logika PHP selesai
include '../../view/layout/header.php';
?>

<body class="bg-gray-50">
<div class="container mx-auto max-w-4xl py-12 px-4">
    
    <div class="bg-white rounded-xl shadow-lg overflow-hidden md:flex mb-10">
        <div class="md:w-1/3">
            <img src="<?= htmlspecialchars($posterPath) ?>" alt="<?= htmlspecialchars($film['judul']) ?>" class="w-full h-full object-cover">
        </div>
        <div class="md:w-2/3 p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($film['judul']) ?></h1>
            <p class="text-gray-500 text-sm mb-4">Genre: <?= htmlspecialchars($film['genre']) ?></p>
            <p class="text-gray-700 leading-relaxed">
                <?= nl2br(htmlspecialchars($film['deskripsi'])) ?>
            </p>
        </div>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <div class="flex items-center justify-center mb-6">
            <i class="ri-edit-2-line text-3xl text-cyan-500 mr-2"></i>
            <h2 class="text-2xl font-bold text-cyan-500">Tulis Ulasan Anda</h2>
        </div>

        <?php if (!$is_logged_in): ?>
            <div class="bg-yellow-100 text-yellow-800 p-4 mb-4 rounded-md text-center">
                <a href="/FAILYTAIL/pengguna/login.php" class="font-bold underline">Login terlebih dahulu</a> untuk dapat memberikan ulasan.
            </div>
        <?php else: ?>
            <?php if ($success): ?>
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded-md text-sm">Ulasan berhasil dikirim! Terima kasih.</div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-md text-sm"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" action="detail-film.php?id=<?= $film_id ?>" class="space-y-5">
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Rating (0-10)</label>
                    <input type="number" name="rating" step="0.1" min="0" max="10" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" placeholder="Nilai antara 0.0 hingga 10.0" required>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Komentar</label>
                    <textarea name="komentar" rows="4" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500" placeholder="Tuliskan ulasanmu di sini..." required></textarea>
                </div>
                <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-600 text-white font-semibold py-3 rounded-lg transition">
                    Kirim Ulasan
                </button>
            </form>
        <?php endif; ?>
    </div>

</div>
</body>

<?php include '../../view/layout/footer.php'; ?>