<?php
session_start();
require '../../database/koneksi.php'; // Sesuaikan path ke koneksi.php

// 1. Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    die("Akses ditolak. Anda harus login terlebih dahulu.");
}

// 2. Ambil data pengguna yang sedang login dari session
$current_user_id = $_SESSION['user_id'];
$current_user_role = $_SESSION['role'];

// 3. Ambil ID ulasan dari URL dan pastikan itu adalah angka
$ulasan_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($ulasan_id === 0) {
    die("ID ulasan tidak valid.");
}

// 4. Lakukan pemeriksaan keamanan di sisi server
//    Ambil data pemilik ulasan dari database
$sql_check = "SELECT user_id FROM ulasan WHERE id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $ulasan_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows === 0) {
    die("Ulasan tidak ditemukan.");
}

$ulasan = $result_check->fetch_assoc();
$owner_id = $ulasan['user_id'];
$stmt_check->close();

// 5. Otorisasi: Periksa apakah pengguna adalah admin ATAU pemilik ulasan
if ($current_user_role === 'admin' || $current_user_id == $owner_id) {
    // Jika diizinkan, lanjutkan proses penghapusan
    $sql_delete = "DELETE FROM ulasan WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $ulasan_id);

    if ($stmt_delete->execute()) {
        // Jika berhasil, redirect kembali ke halaman ulasan
        header("Location: ulasan.php?status=deleted");
        exit();
    } else {
        // Jika gagal, tampilkan error
        echo "Error: Gagal menghapus ulasan. " . $stmt_delete->error;
    }
    $stmt_delete->close();
} else {
    // Jika tidak diizinkan, tolak akses
    die("Akses ditolak. Anda tidak memiliki izin untuk menghapus ulasan ini.");
}

$conn->close();
?>