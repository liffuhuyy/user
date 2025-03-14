<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    $perusahaan = isset($_POST["perusahaan"]) ? trim($_POST["perusahaan"]) : "";
    if (empty($perusahaan)) {
        $error_message = "Kolom perusahaan wajib diisi.";
        echo $error_message;
        exit();
    }
    

    if ($tanggal_mulai > $tanggal_selesai) {
        $error_message = "Tanggal mulai tidak boleh lebih dari tanggal selesai.";
        echo $error_message;
        exit();
    }

    $sql = "INSERT INTO siswa_magang (nama, jurusan, tanggal_mulai, tanggal_selesai, perusahaan) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nama, $jurusan, $tanggal_mulai, $tanggal_selesai, $perusahaan);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan";
        header("Location: pengajuan.php");
        exit();
    } else {
        echo "Gagal menyimpan data: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
