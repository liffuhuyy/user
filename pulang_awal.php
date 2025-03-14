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
    // Ambil data dari form
    $jam_keluar = isset($_POST['jam_keluar']) ? $_POST['jam_keluar'] : null;
    $alasan = isset($_POST['alasan']) ? $_POST['alasan'] : null;

    // Validasi input
    if (!empty($jam_keluar) && !empty($alasan)) {
        // Perbarui data presensi dengan jam keluar dan alasan
        $sql = "UPDATE presensi 
                SET jam_keluar = ?, alasan = ? 
                WHERE jam_keluar IS NULL";

        // Gunakan prepared statement untuk keamanan
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $jam_keluar, $alasan);

        if ($stmt->execute()) {
            echo "Data pulang lebih awal berhasil disimpan.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Data tidak lengkap. Pastikan jam keluar dan alasan telah diisi.";
    }
}

$conn->close();
?>
