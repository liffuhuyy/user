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

$selected_month = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');

$sql = "SELECT * FROM presensi WHERE MONTH(tanggal) = '$selected_month' ORDER BY tanggal DESC";
$result = $conn->query($sql);

function get_months() {
    return [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        select {
            padding: 5px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #003366;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Riwayat Absensi</h1>
        <form method="GET">
            <label for="bulan">Pilih Bulan:</label>
            <select name="bulan" id="bulan" onchange="this.form.submit()">
                <?php
                foreach (get_months() as $key => $month) {
                    $selected = $key == $selected_month ? 'selected' : '';
                    echo "<option value='$key' $selected>$month</option>";
                }
                ?>
            </select>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Status</th>
                    <th>Alasan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $batas_masuk = "08:00:00";
                $batas_keluar = "17:00:00";
            
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if (!empty($row['jam_masuk']) && !empty($row['jam_keluar'])) {
                            $warnaMasuk = (strtotime($row['jam_masuk']) <= strtotime($batas_masuk)) ? "green" : "red";
                            $warnaKeluar = (strtotime($row['jam_keluar']) >= strtotime($batas_keluar)) ? "green" : "red";
                        } else {
                            $warnaMasuk = "black";
                            $warnaKeluar = "black";
                        }
            
                        echo "<tr>
                                <td>" . htmlspecialchars($row['tanggal']) . "</td>
                                <td style='color: $warnaMasuk;'>" . htmlspecialchars($row['jam_masuk']) . "</td>
                                <td style='color: $warnaKeluar;'>" . htmlspecialchars($row['jam_keluar']) . "</td>
                                <td>" . htmlspecialchars($row['status']) . "</td>
                                <td>" . htmlspecialchars($row['alasan']) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data absen untuk bulan ini.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
