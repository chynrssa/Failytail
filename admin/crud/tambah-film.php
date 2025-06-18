<?php
// --- KONEKSI DATABASE ---
$conn = new mysqli("localhost", "root", "", "failytail");
if ($conn->connect_error) {
  // Hentikan eksekusi jika koneksi gagal
  die("Koneksi gagal: " . $conn->connect_error);
}

// --- PROSES FORM JIKA ADA SUBMIT (METHOD POST) ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $judul = $_POST["judul"];
  $genre = $_POST["genre"];
  $deskripsi = $_POST["deskripsi"];

  // --- LOGIKA UPLOAD POSTER (SUDAH DIPERBAIKI) ---
  $posterName = $_FILES["poster"]["name"];
  $posterTmp = $_FILES["poster"]["tmp_name"];

  // Dari admin/crud/ -> naik 2x ke root -> masuk ke image/posters/
  $uploadDestination = "../../image/posters/" . basename($posterName);

  // Path relatif dari file data-film.php (di folder admin/)
  $databasePath = "../image/posters/" . basename($posterName);

  // Pindahkan file HANYA JIKA file tersebut adalah hasil upload yang valid
  if (move_uploaded_file($posterTmp, $uploadDestination)) {

    // Mencegah SQL Injection
    $sql = "INSERT INTO filmadmin (poster, judul, genre, deskripsi) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // 'ssss' berarti semua variabel adalah string
    $stmt->bind_param("ssss", $databasePath, $judul, $genre, $deskripsi);

    // Eksekusi query yang sudah aman
    if ($stmt->execute()) {
      // Jika berhasil, redirect ke halaman data film
      header("Location: ../data-film.php");
      exit(); // Penting untuk menghentikan eksekusi setelah redirect
    } else {
      echo "Gagal menambahkan film: " . $stmt->error;
    }
    $stmt->close();
  } else {
    echo "Gagal meng-upload file poster. Pastikan folder `image/posters/` ada dan bisa ditulis (writable).";
  }
}
$conn->close();
?>

<?php include '../../view/layout/header.php'; ?> <!-- gunakan path relatif dari folder 'crud/' -->

<div class="p-6">
  <h2 class="text-2xl font-bold mb-4">Tambah Film</h2>
  <form method="POST" enctype="multipart/form-data" class="space-y-4 max-w-xl">
    <input type="text" name="judul" placeholder="Judul Film" class="w-full p-2 border rounded" required>
    <input type="text" name="genre" placeholder="Genre" class="w-full p-2 border rounded" required>
    <textarea name="deskripsi" placeholder="Deskripsi" class="w-full p-2 border rounded" required></textarea>
    <input type="file" name="poster" class="w-full" required>
    <button type="submit" class="bg-cyan-500 text-white px-4 py-2 rounded hover:bg-cyan-600">Simpan</button>
  </form>
</div>

<?php include '../../view/layout/footer.php'; ?>
