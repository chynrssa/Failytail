<?php
session_start();
require '../koneksi/koneksi.php'; // Pastikan koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $poster = $_FILES['poster'];

    $conn = new mysqli($host, $user, $pass, $db); // Pastikan koneksi benar
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil poster lama untuk penghapusan jika ada file baru
    $sqlGetPoster = "SELECT poster FROM film WHERE id='$id'";
    $result = $conn->query($sqlGetPoster);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $oldPosterFile = "../image/posters/" . $row['poster'];
    }

    // Proses upload poster baru jika ada
    $updatePosterQuery = "";
    if (!empty($poster["name"])) {
        $targetDir = "../image/posters/";
        $newPosterName = time() . "_" . basename($poster["name"]);
        $targetFile = $targetDir . $newPosterName;

        if (move_uploaded_file($poster["tmp_name"], $targetFile)) {
            // Hapus poster lama jika file baru diunggah
            if (file_exists($oldPosterFile)) {
                unlink($oldPosterFile);
            }
            $updatePosterQuery = ", poster='$newPosterName'";
        }
    }

    // Update data film dengan sintaks SQL yang benar
    $sqlUpdateFilm = "UPDATE film SET judul='$judul', genre='$genre' $updatePosterQuery WHERE id='$id'";

    if ($conn->query($sqlUpdateFilm) === TRUE) {
        echo "<script>alert('Film berhasil diperbarui!'); window.location.href='dashboard.html';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui film, coba lagi!'); window.history.back();</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Edit Film</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 p-8 rounded-lg shadow-xl w-full max-w-md text-center">
        <h2 class="text-3xl font-bold mb-6 text-[#00bfe7]">Status Perubahan Film 🎬</h2>

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
