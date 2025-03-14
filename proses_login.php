<?php
session_start();
include 'koneksi.php'; // Hubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Cek apakah email dan password tidak kosong
    if (empty($email) || empty($password)) {
        echo "<script>alert('Email atau passwor salah'); window.history.back();</script>";
        exit();
    }

    // Ambil data pengguna dari database
    $sql = "SELECT * FROM daftar WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah email ditemukan
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verifikasi password dengan `password_verify`
        if (password_verify($password, $row['password'])) {
            // Simpan data user ke session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['email'] = $row['email'];

            echo "<script>alert('Login Berhasil!'); window.location.href='beranda.php';</script>";
        } else {
            echo "<script>alert('Password salah!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan!'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
