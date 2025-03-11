<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "userr";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $jurusan = $_POST["jurusan"];
    $tanggal_mulai = $_POST["tanggal_mulai"];
    $tanggal_selesai = $_POST["tanggal_selesai"];

    $sql = "INSERT INTO siswa_magang (nama, jurusan, tanggal_mulai, tanggal_selesai) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nama, $jurusan, $tanggal_mulai, $tanggal_selesai);

    if ($stmt->execute()) {
        header("Location: pengajuan.php");
        exit();
    } else {
        echo "Gagal menyimpan data!";
    }
    $stmt->close();
}

$conn->close();
?>
