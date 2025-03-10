<?php
$host = "localhost"; // atau 127.0.0.1
$user = "root"; // Ganti jika ada username lain
$pass = ""; // Isi password MySQL jika ada
$db   = "userr"; // Nama database baru

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
