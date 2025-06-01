<?php
session_start();
require '../koneksi/koneksi.php'; // Pastikan koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $tahun_rilis = $_POST['tahun_rilis']; // Tambahan sesuai SQL
    $rating = $_POST['rating']; // Tambahan sesuai SQL
    $komentar = $_POST['komentar']; // Tambahan sesuai SQL
    $poster = $_FILES['poster'];

    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil poster lama untuk penghapusan jika ada file baru
    $sqlGetPoster = "SELECT poster FROM film WHERE id='$id'";
    $result = $conn->query($sqlGetPoster);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $oldPosterFile = "../assets/posters/" . $row['poster'];
    }

    // Proses upload poster baru jika ada
    if (!empty($poster["name"])) {
        $targetDir = "../assets/posters/";
        $newPosterName = time() . "_" . basename($poster["name"]);
        $targetFile = $targetDir . $newPosterName;

        if (move_uploaded_file($poster["tmp_name"], $targetFile)) {
            // Hapus poster lama jika file baru diunggah
            if (file_exists($oldPosterFile)) {
                unlink($oldPosterFile);
            }
            $updatePoster = ", poster='$newPosterName'";
        } else {
            $status = "Gagal mengupload poster!";
            $isSuccess = false;
        }
    } else {
        $updatePoster = "";
    }

    // Update data film agar sesuai dengan tabel yang diberikan
    $sqlUpdateFilm = "UPDATE film SET 
        judul='$judul', 
        genre='$genre', 
        tahun_rilis='$tahun_rilis', 
        rating='$rating', 
        komentar='$komentar'
        $updatePoster 
        WHERE id='$id'";

    if ($conn->query($sqlUpdateFilm) === TRUE) {
        $status = "Film berhasil diperbarui!";
        $isSuccess = true;
    } else {
        $status = "Gagal memperbarui film, coba lagi!";
        $isSuccess = false;
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
