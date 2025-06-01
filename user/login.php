<?php
session_start();
require 'koneksi/koneksi.php'; // Pastikan koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username='$username' AND password=MD5('$password')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role']; // Menyimpan peran pengguna
        
        if ($row['role'] == 'admin') {
            header("Location: admin/dashboard.html");
        } else {
            header("Location: user/dashboard.html");
        }
        exit();
    } else {
        echo "Login gagal! Periksa kembali username dan password.";
    }

    $conn->close();
}
?>
