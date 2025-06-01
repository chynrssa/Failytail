<?php
session_start();
require '../koneksi/koneksi.php'; // Pastikan koneksi ke database

if (!isset($_GET['id'])) {
    header("Location: dashboard.html"); // Redirect jika tidak ada ID
    exit();
}

$id = $_GET['id'];
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data poster film untuk dihapus dari folder
$sqlGetPoster = "SELECT poster FROM films WHERE id='$id'";
$result = $conn->query($sqlGetPoster);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $posterFile = "../image/posters/" . $row['poster'];
    
    // Hapus file poster dari folder jika ada
    if (file_exists($posterFile)) {
        unlink($posterFile);
    }
}

// Hapus film dari database
$sqlDeleteFilm = "DELETE FROM films WHERE id='$id'";
if ($conn->query($sqlDeleteFilm) === TRUE) {
    $status = "Film berhasil dihapus!";
    $isSuccess = true;
} else {
    $status = "Gagal menghapus film, coba lagi!";
    $isSuccess = false;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Hapus Film</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 p-8 rounded-lg shadow-xl w-full max-w-md text-center">
        <h2 class="text-3xl font-bold mb-6 text-[#00bfe7]">Status Penghapusan Film 🚀</h2>

        <div class="<?= $isSuccess ? 'bg-green-500' : 'bg-red-500' ?> text-white p-3 rounded mb-4">
            <?= $status ?>
        </div>

        <div class="mt-4">
            <a href="dashboard.html" class="bg-[#00bfe7] hover:bg-[#00aac5] transition text-white font-semibold py-3 px-6 rounded shadow">
                Kembali ke Dashboard
            </a>
        </div>
    </div>

</body>
</html>
