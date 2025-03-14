<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "userr";

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "UPDATE presensi SET jam_keluar = NOW() WHERE jam_keluar IS NULL";

    if ($conn->query($sql) === TRUE) {
        echo "Presensi keluar berhasil disimpan.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
