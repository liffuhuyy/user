<?php
// Mulai sesi untuk menampilkan pesan notifikasi
session_start();
include 'koneksi.php'; // Hubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan semua input tidak kosong
    if (empty($_POST['bulan']) || empty($_POST['tahun']) || empty($_POST['tugas'])) {
        // Jika input ada yang kosong
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
        exit();
    }

    // Ambil data dari form
    $bulan = trim($_POST['bulan']);
    $tahun = trim($_POST['tahun']);
    $tugas = trim($_POST['tugas']);

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO tugas (nama_tugas, bulan, tahun) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $tugas, $bulan, $tahun);

    if ($stmt->execute()) {
        // Berhasil menyimpan data
        $_SESSION['pesan'] = "Tugas berhasil ditambahkan!";
        header("Location: manajemen-tugas.php"); // Redirect ke halaman utama
        exit();
    } else {
        // Jika terjadi kesalahan
        echo "<script>alert('Terjadi kesalahan saat menyimpan data!'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
