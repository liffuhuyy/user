<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Izin/Sakit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            width: 320px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        select, textarea, button {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #000000;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #172a46;
        }
    </style>
</head>
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
    $status = $_POST['status'];
    $alasan = $_POST['alasan'];
    $tanggal = date('Y-m-d'); // Current date


    $sql = "INSERT INTO presensi (tanggal, jam_masuk, jam_keluar, status, alasan)
            VALUES ('$tanggal', NULL, NULL, '$status', '$alasan')";

    if ($conn->query($sql) === TRUE) {
        // Jika berhasil, redirect ke halaman presensi.html
        header("Location: presensi.html");
        exit(); // Pastikan script berhenti setelah redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<body>
    <div class="container">
        <h3>IZIN/SAKIT</h3>
        <form action="" method="POST">
            <select name="status" required>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
            </select>
            <textarea name="alasan" placeholder="Alasan..." required></textarea>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>
