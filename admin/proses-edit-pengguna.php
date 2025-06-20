<?php
session_start();
// Otorisasi: Pastikan hanya admin yang bisa memproses ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Akses ditolak. Anda bukan admin.");
}

require '../database/koneksi.php';

// 1. Pastikan metode adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Metode tidak valid.");
}

// 2. Ambil semua data dari form
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : null;
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : null;
$alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : null;
$role = isset($_POST['role']) ? $_POST['role'] : 'user';

// Validasi dasar
if ($id === 0 || empty($username)) {
    die("ID atau Username tidak boleh kosong.");
}
if (!in_array($role, ['user', 'admin'])) {
    die("Role tidak valid.");
}

// 3. Lakukan UPDATE ke database
$sql = "UPDATE users SET username = ?, email = ?, phone = ?, alamat = ?, role = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
// Tipe data: 'sssssi' -> string, string, string, string, string, integer
$stmt->bind_param("sssssi", $username, $email, $phone, $alamat, $role, $id);

if ($stmt->execute()) {
    // Jika berhasil, redirect kembali ke halaman daftar pengguna
    header("Location: data-pengguna.php?status=updated");
    exit();
} else {
    // Jika gagal, tampilkan error
    // Tambahkan pengecekan duplikat username
    if ($conn->errno == 1062) {
        echo "Error: Gagal memperbarui data. Username '" . htmlspecialchars($username) . "' sudah digunakan.";
    } else {
        echo "Error: Gagal memperbarui data. " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>