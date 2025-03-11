<?php
include 'koneksi.php';
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
        .container {
            max-width: 500px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            
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
        
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        
        .date-time {
            background-color: #002b56;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 16px;
        }
        
        .content {
            padding: 20px;
        }
        
        .time-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }
        
        .time-block {
            text-align: center;
            flex: 1;
        }
        
        .time-block h3 {
            margin: 0 0 5px 0;
            color: #001f3f;
            font-size: 16px;
        }
        
        .time-block p {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        
        .action-btn {
            display: block;
            width: 97%;
            padding: 13px;
            background-color: #001f3f;
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 15px;
            transition: background-color 0.3s;
        }
        
        .action-btn:hover {
            background-color: #003366;
        }
        
        .action-btn:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        
        .secondary-btn {
            background-color: #f8f9fa;
            color: #001f3f;
            border: 2px solid #001f3f;
        }
        
        .secondary-btn:hover {
            background-color: #e9ecef;
        }
        
        .status {
            text-align: center;
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        
        .status.success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status.late {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .status.waiting {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .hide {
            display: none;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 400px;
        }
        
        .modal-content h3 {
            color: #001f3f;
            margin-top: 0;
        }
        
        .modal-content textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-height: 100px;
        }
        
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        
        .modal-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .confirm-btn {
            background-color: #001f3f;
            color: white;
        }
        
        .cancel-btn {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
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
        .menu-title {
            padding: 10px 20px;
            font-weight: bold;
            color: #bdc3c7;
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

.header h1 {
    flex: 1;
    text-align: center;
    margin: 0;
}
body, h1, h2, table {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
}

h1 {
    text-align: center;
    margin: 20px 0;
    color: #0056b3;
}

h2 {
    margin-top: 20px;
    color: #007bff;
}

a {
    text-decoration: none;
    color: #0056b3;
    margin: 0 10px;
}

a:hover {
    text-decoration: underline;
    color:rgb(255, 255, 255);
}

table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #003366;
    color: white;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

.tombol {
            display: inline-block;
            padding: 15px 25px;
            font-size: 18px;
            color: white;
            background-color:rgb(0, 0, 0);
            border: none;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            text-align: center;
            font-weight: bold;
        }

        .tombol:hover {
            background-color:rgb(0, 19, 39);
        }

@media (max-width: 768px) {
    table {
        width: 100%;
        font-size: 14px;}
    }

    h1 {
        font-size: 24px;
    }
    h2{
        font-size: 24px;
        color:rgb(0, 0, 0);  
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
            <a href="beranda.html" class="menu-item">Beranda</a>
            <a href="profil.html" class="menu-item">Profil Saya</a>
        </div>
        
        <div class="menu-group">
            <div class="menu-title">Menu Utama</div>
            <a href="presensi.html" class="menu-item">Presensi</a>
            <a href="manajemen-tugas.html" class="menu-item">Management Tugas</a>
            <a href="pengajuan.php" class="menu-item">Pengajuan Magang</a>
        </div>
        
        <div class="menu-group">
            <div class="menu-title">Lainnya</div>
            <a href="kontak.html" class="menu-item">Kontak</a>
            <a href="index.html" class="menu-item">Logout</a>
        </div>
    </div>

    <div class="container">
<php>     
<h2>Data Siswa Magang</h2>
    <table>
        <tr>
            <th>Nama Siswa</th>
            <th>Jurusan</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
        </tr>
        <?php
        $query = "SELECT * FROM siswa_magang ORDER BY tanggal_mulai DESC";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['jurusan']) . "</td>";
                echo "<td>" . htmlspecialchars($row['tanggal_mulai']) . "</td>";
                echo "<td>" . htmlspecialchars($row['tanggal_selesai']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' style='text-align: center;'>Belum ada data</td></tr>";
        }
        ?>
    </table>
    <a href="magang.html" class="tombol">Buat Pengajuan</a>
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
