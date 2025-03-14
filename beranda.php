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
?><!DOCTYPE html>
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
            display: flex;
            flex-direction: column;
            cursor: pointer;
        }

        .menu-toggle span {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 2px 0;
            border-radius: 3px;
        }

        .profile-icon a {
             display: block; 
             width: 100%;
             height: 100%;
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
            background: linear-gradient(to bottom, #0a192f, #111827);
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
            font-size: 20px;
            cursor: pointer;
        }

        .menu-group {
            margin-bottom: 20px;
        }

        .menu-title {
            padding: 10px 20px;
            font-weight: bold;
            color: #bdc3c7;
        }

        .menu-item {
            padding: 12px 30px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            color: white;
            display: block;
        }

        .menu-item:hover {
            background-color: #172a46;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .welcome-card {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .welcome-title {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            color: #0a192f;
        }

        .welcome-subtitle {
            color: #7f8c8d;
            margin-bottom: 1.5rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn:hover {
            background-color: #172a46;
        }

        .btn-primary {
            background: linear-gradient(to right, #0a192f, #172a46);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(to right, #172a46, #0a192f);
            color: white;
        }

        .stats-card {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .stat-item {
            flex: 1;
            min-width: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            color: #0a192f;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #0a192f;
        }

        .stat-label {
            color: #7f8c8d;
            margin-bottom: 1rem;
        }

        .view-more-container {
            text-align: center;
            margin-top: 1.5rem;
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

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }
            
            .stat-item {
                min-width: 100%;
            }
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
        <div class="welcome-card">
            <h3 class="welcome-title">Selamat Datang, Siswa!</h3>
            <p class="welcome-subtitle">Selamat datang di portal siswa SMK Teknologi. Silakan lengkapi biodata Anda dan ajukan program magang untuk memulai perjalanan pendidikan Anda.</p>
            <div class="action-buttons">
                <a href="biodata.html" class="btn btn-primary">Lengkapi Biodata</a>
                <a href="pengajuan.php" class="btn btn-secondary">Ajukan Magang</a>
            </div>
        </div>

        <div class="stats-card">
            <div class="stat-item">
                <div>
                    <a href="manajemen-tugas.php" class="stat-icon">📚</a>
                </div>
                <div class="stat-value"><?php echo "Tugas: " . $total_tugas;?></div>
            <div class="stat-item">
                <div class="stat-icon">
                    <a href="nilai.html" class="stat-icon">📋</a>
                </div>
                <div class="stat-value">8</div>
                <div class="stat-label">Rekap Nilai</div>
            </div>
            <div class="view-more-container">
                <a href="manajemen-tugas.php" class="btn btn-primary">Lihat Selengkapnya</a>
            </div>
        </div>
    </div>

    <script>
        // Menu toggle functionality
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const closeSidebar = document.getElementById('closeSidebar');  
        const overlay = document.getElementById('overlay');

        menuToggle.addEventListener('click', function() {
            sidebar.classList.add('active');
            overlay.classList.add('active');
        });

        closeSidebar.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>
</body>
</html>