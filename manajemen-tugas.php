<?php
// Panggil koneksi ke database
include 'koneksi.php';

// Ambil hasilnya
$query = "SELECT COUNT(*) AS total FROM tugas";
$result = mysqli_query($conn, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_tugas = $row['total'];
} else {
    $total_tugas = 0; // Nilai default jika query gagal
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        } 

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: linear-gradient(to right, #0a192f, #000000);
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .menu-toggle {
            cursor: pointer;
        }

        .menu-toggle span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 5px 0;
            border-radius: 3px;
        }
        .menu-title {
            padding: 10px 20px;
            font-weight: bold;
            color: #bdc3c7;
        }
        .profile-icon img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background: #0a192f;
            transition: left 0.3s ease;
            z-index: 1000;
            padding-top: 60px;
            color: white;
        }

        .sidebar.active {
            left: 0;
        }

        .close-sidebar {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
        }

        .menu-group {
            margin-bottom: 20px;
        }

        .menu-item {
            padding: 12px 30px;
            display: block;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .menu-item:hover {
            background-color: #172a46;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .welcome-card, .stats-card {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        .stats-card {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .stat-item {
            flex: 1;
            min-width: 200px;
            text-align: center;
        }

        .stat-icon {
            font-size: 2.5rem;
            color: #0a192f;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #0a192f;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 999;
        }

        .overlay.active {
            display: block;
        }
        .container {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 30px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            color: #1a252f;
        }

        .input-section {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        select, input, button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-size: 16px;
        }

        select, input {
            flex-grow: 1;
            background-color: white;
            color: #333;
        }

        button {
            background-color: #1a252f;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none;
        }

        button:hover {
            background-color:  #1a252f;
        }

        .task-list {
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
        }

        .task-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 10px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .task-details {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .task-checkbox {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid  #1a252f;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
        }

        .task-checkbox:checked {
            background-color:  #1a252f;
            border-color:  #1a252f;
        }

        .task-checkbox:checked::after {
            content: '✔';
            color: white;
            display: block;
            text-align: center;
            line-height: 20px;
        }

        small {
            color: #666;
            margin-left: 10px;
        }

         h1 {
            color: rgb(255, 255, 255);
            text-align: center;
            margin: 0 auto;
            }
            h2{
                text-align: center;
            }
        h3 {
             color: rgb(255, 255, 255);
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="menu-toggle" id="menuToggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <h3>SMKN 1 SUBANG</h3>

            <div class="profile-icon">
                <a href="profil.html">
                    <img src="profil.html" alt="Profile Picture">
                </a>
            </div>            
    </div>

    <div class="overlay" id="overlay"></div>

    <div class="sidebar" id="sidebar">
        <div class="close-sidebar" id="closeSidebar">×</div>
        
        <div class="menu-group">
            <a href="beranda.php" class="menu-item">Beranda</a>
            <a href="profil.html" class="menu-item">Profil Saya</a>
        </div>
        
        <div class="menu-group">
            <div class="menu-title">Menu Utama</div>
            <a href="presensi.html" class="menu-item">Presensi</a>
            <a href="manajemen-tugas.php" class="menu-item">Management Tugas</a>
            <a href="pengajuan.php" class="menu-item">Pengajuan Magang</a>
        </div>
        
        <div class="menu-group">
            <div class="menu-title">Lainnya</div>
            <a href="kontak.html" class="menu-item">Kontak</a>
            <a href="index.html" class="menu-item">Logout</a>
        </div>
    </div>
<div class="container">
        <div class="header">
            <h1>Manajemen Tugas</h1>
        </div>

        <form method="POST" action="proses_tambah.php">
            <div class="input-section">
                <select name="bulan" id="bulan" required>
                    <option value="">Pilih Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
        
                <select name="tahun" id="tahun" required>
                    <option value="">Pilih Tahun</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                </select>
            </div>
        
            <div class="input-section">
                <input type="text" name="tugas" id="tugas" placeholder="Masukkan tugas baru" required>
                <button type="submit">Tambah Tugas</button>
            </div>
        </form>
        <br>
        <h2>Daftar Tugas</h2>
        <br> 
        <?php
        // Panggil koneksi ke database
        include "koneksi.php";
        
        // Query untuk mengambil data tugas
        $sql = "SELECT nama_tugas, bulan, tahun, dibuat_pada FROM tugas ORDER BY dibuat_pada DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='task-item'>";
                echo "<div class='task-details'>";
                echo "<span>" . htmlspecialchars($row["nama_tugas"]) . "</span>";
                echo "<small>Bulan: " . htmlspecialchars($row["bulan"]) . ", Tahun: " . htmlspecialchars($row["tahun"]) . "</small>";
                echo "<br><small>Dibuat pada: " . htmlspecialchars($row["dibuat_pada"]) . "</small>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "Belum ada tugas yang ditambahkan.";
        }
        
        $conn->close();
        ?>
        
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>
</body>
</html>
