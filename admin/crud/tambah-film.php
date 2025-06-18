<?php
$conn = new mysqli("localhost", "root", "", "failytail");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $judul = $_POST["judul"];
  $genre = $_POST["genre"];
  $deskripsi = $_POST["deskripsi"];

  // Upload Poster
  $posterName = $_FILES["poster"]["name"];
  $posterTmp = $_FILES["poster"]["tmp_name"];
  $posterDest = "../poster/" . $posterName; // Arahkan ke folder yang tepat
  move_uploaded_file($posterTmp, $posterDest);

  $sql = "INSERT INTO filmadmin (poster, judul, genre, deskripsi) VALUES ('$posterDest', '$judul', '$genre', '$deskripsi')";
  if ($conn->query($sql) === TRUE) {
    header("Location: ../data-film.php"); // kembali ke luar folder
    exit();
  } else {
    echo "Gagal menambahkan film: " . $conn->error;
  }
}
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
