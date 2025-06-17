<?php
$conn = new mysqli("localhost", "root", "", "failytail");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];

// Hapus poster dari server (opsional)
$getPoster = $conn->query("SELECT poster FROM filmadmin WHERE id = $id");
if ($getPoster->num_rows > 0) {
  $data = $getPoster->fetch_assoc();
  if (file_exists("../" . $data['poster'])) {
    unlink("../" . $data['poster']);
  }
}

// Hapus dari database
$sql = "DELETE FROM filmadmin WHERE id = $id";
if ($conn->query($sql) === TRUE) {
  header("Location: ../data-film.php");
  exit();
} else {
  echo "Gagal menghapus film: " . $conn->error;
}
?>
