<?php
$conn = new mysqli("localhost", "root", "", "failytail");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM filmadmin WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
  die("Film tidak ditemukan.");
}
$film = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $judul = $_POST["judul"];
  $genre = $_POST["genre"];
  $deskripsi = $_POST["deskripsi"];

  if (!empty($_FILES["poster"]["name"])) {
    $posterName = $_FILES["poster"]["name"];
    $posterTmp = $_FILES["poster"]["tmp_name"];
    $posterDest = "../poster/" . $posterName;
    move_uploaded_file($posterTmp, $posterDest);
  } else {
    $posterDest = $film['poster'];
  }

  $updateSql = "UPDATE filmadmin SET poster='$posterDest', judul='$judul', genre='$genre', deskripsi='$deskripsi' WHERE id=$id";
  if ($conn->query($updateSql) === TRUE) {
    header("Location: ../data-film.php");
    exit();
  } else {
    echo "Gagal mengedit film: " . $conn->error;
  }
}
?>

<?php include '../header-admin.php'; ?>

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

<?php include '../footer-admin.php'; ?>
