<?php
session_start();
require '../koneksi/koneksi.php'; // Pastikan koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Proses upload poster
    $targetDir = "../assets/posters/";
    $posterName = time() . "_" . basename($poster["name"]);
    $targetFile = $targetDir . $posterName;

    if (move_uploaded_file($poster["tmp_name"], $targetFile)) {
        // Simpan data ke database dengan format sesuai SQL
        $sql = "INSERT INTO film (judul, genre, tahun_rilis, rating, komentar, poster) 
                VALUES ('$judul', '$genre', '$tahun_rilis', '$rating', '$komentar', '$posterName')";

        if ($conn->query($sql) === TRUE) {
            $status = "Film berhasil ditambahkan!";
            $isSuccess = true;
        } else {
            $status = "Gagal menyimpan data, coba lagi!";
            $isSuccess = false;
        }

        $conn->close();
    } else {
        $status = "Gagal mengupload poster!";
        $isSuccess = false;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Tambah Film</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 p-8 rounded-lg shadow-xl w-full max-w-md text-center">
        <h2 class="text-3xl font-bold mb-6 text-[#00bfe7]">Status Penambahan Film 🎬</h2>

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
