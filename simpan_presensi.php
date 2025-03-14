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
    $tanggal = $_POST['tanggal'];
    $jam_masuk = $_POST['jam_masuk'];
    $status = $_POST['status'];

    $sql = "INSERT INTO presensi (tanggal, jam_masuk, status) 
            VALUES ('$tanggal', '$jam_masuk', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Presensi masuk berhasil disimpan.";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>