<?php
session_start();
include 'koneksi.php'; // Hubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan semua input tidak kosong
    if (empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['no_hp'])) {
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
        exit();
    }

    // Ambil data dari form
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $no_hp = trim($_POST['no_hp']);

    // Cek apakah email sudah terdaftar
    $cek_email = $conn->prepare("SELECT email FROM daftar WHERE email = ?");
    $cek_email->bind_param("s", $email);
    $cek_email->execute();
    $cek_email->store_result();

    if ($cek_email->num_rows > 0) {
        echo "<script>alert('Email sudah digunakan! Gunakan email lain.'); window.history.back();</script>";
        exit();
    }
    $cek_email->close();

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO daftar (nama, email, password, no_hp) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $email, $password, $no_hp);

    if ($stmt->execute()) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan!'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
