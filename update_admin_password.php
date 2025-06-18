<?php
require 'database/koneksi.php';

// Buat password baru untuk admin
$newPassword = 'admin123';
$newHash = password_hash($newPassword, PASSWORD_BCRYPT);

// Update password admin di database
$sql = "UPDATE users SET password = ? WHERE username = 'admin'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $newHash);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "<!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Admin Password Updated</title>
        <script src='https://cdn.tailwindcss.com'></script>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
            body { font-family: 'Poppins', sans-serif; }
        </style>
    </head>
    <body class='min-h-screen flex items-center justify-center bg-gray-100 p-4'>
        <div class='max-w-md w-full bg-white rounded-xl shadow-lg p-8 text-center'>
            <div class='text-green-500 text-6xl mb-4'>
                <i class='fas fa-check-circle'></i>
            </div>
            <h2 class='text-2xl font-bold text-gray-800 mb-2'>Password Admin Diperbarui!</h2>
            <p class='text-gray-600 mb-4'>
                Password untuk akun admin telah berhasil direset.
            </p>
            <div class='bg-gray-100 p-4 rounded-lg mb-6 text-left'>
                <p class='mb-2'><strong>Username:</strong> admin</p>
                <p class='mb-2'><strong>Password Baru:</strong> $newPassword</p>
                <p class='text-sm text-gray-500'>Harap simpan informasi ini dengan aman</p>
            </div>
            <a href='login.php' class='inline-block w-full bg-[#00bfe7] hover:bg-[#009fc6] text-white font-medium py-3 rounded-lg transition duration-300'>
                Kembali ke Halaman Login
            </a>
        </div>
    </body>
    </html>";
} else {
    echo "<div class='p-8 text-center'>
            <div class='text-red-500 text-6xl mb-4'><i class='fas fa-exclamation-triangle'></i></div>
            <h2 class='text-2xl font-bold mb-4'>Gagal Memperbarui Password</h2>
            <p class='mb-6'>Silakan cek koneksi database atau pastikan user admin ada di database.</p>
            <a href='login.php' class='text-[#00bfe7] hover:underline'>Kembali ke Login</a>
          </div>";
}

$stmt->close();
$conn->close();
?>