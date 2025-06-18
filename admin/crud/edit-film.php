<?php
// --- KONEKSI DATABASE ---
$conn = new mysqli("localhost", "root", "", "failytail");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah ID ada dan merupakan angka
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("ID film tidak valid.");
}
$id = $_GET['id'];

// prepared statement untuk mengambil data, mencegah SQL Injection
$sql = "SELECT id, poster, judul, genre, deskripsi FROM filmadmin WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); // 'i' untuk integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  die("Film tidak ditemukan.");
}
// Simpan data film lama ke dalam variabel
$film = $result->fetch_assoc();
$stmt->close();


// --- PROSES FORM JIKA ADA SUBMIT (METHOD POST) ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $judul = $_POST["judul"];
  $genre = $_POST["genre"];
  $deskripsi = $_POST["deskripsi"];
  $posterPath = $film['poster']; // Defaultnya, gunakan poster lama

 
  // Periksa apakah pengguna mengupload file baru dan tidak ada error
  if (isset($_FILES["poster"]) && $_FILES["poster"]["error"] == 0 && !empty($_FILES["poster"]["name"])) {
    

    $oldPosterServerPath = "../../" . substr($film['poster'], 3); // Konversi ../image/ -> ../../image/
    if (file_exists($oldPosterServerPath)) {
      unlink($oldPosterServerPath);
    }
    
   
    $posterName = $_FILES["poster"]["name"];
    $posterTmp = $_FILES["poster"]["tmp_name"];
    
    // Path tujuan untuk MENYIMPAN file di server
    $uploadDestination = "../../image/posters/" . basename($posterName);
    
    // Path yang akan DISIMPAN KE DATABASE
    $databasePath = "../image/posters/" . basename($posterName);

    if (move_uploaded_file($posterTmp, $uploadDestination)) {
      $posterPath = $databasePath; // Jika upload berhasil, gunakan path gambar baru
    }
  }
  // Jika tidak ada file baru yang diupload, $posterPath akan tetap berisi path gambar lama.

  // --- UPDATE DATA KE DATABASE (SUDAH AMAN) ---
  $updateSql = "UPDATE filmadmin SET poster=?, judul=?, genre=?, deskripsi=? WHERE id=?";
  $stmt = $conn->prepare($updateSql);
  // 'ssssi' -> 4 string (poster, judul, genre, deskripsi) dan 1 integer (id)
  $stmt->bind_param("ssssi", $posterPath, $judul, $genre, $deskripsi, $id);

  if ($stmt->execute()) {
    header("Location: ../data-film.php");
    exit();
  } else {
    echo "Gagal mengedit film: " . $stmt->error;
  }
  $stmt->close();
}
$conn->close();
?>

<?php include '../../view/layout/header.php'; ?>

<div class="p-6">
  <h2 class="text-2xl font-bold mb-4">Edit Film</h2>
  <form method="POST" enctype="multipart/form-data" class="space-y-4 max-w-xl">
    <input type="text" name="judul" value="<?= $film['judul'] ?>" class="w-full p-2 border rounded" required>
    <input type="text" name="genre" value="<?= $film['genre'] ?>" class="w-full p-2 border rounded" required>
    <textarea name="deskripsi" class="w-full p-2 border rounded" required><?= $film['deskripsi'] ?></textarea>
    <input type="file" name="poster" class="w-full">
    <button type="submit" class="bg-cyan-500 text-white px-4 py-2 rounded hover:bg-cyan-600">Update</button>
  </form>
</div>

<?php include '../../view/layout/footer.php'; ?>
