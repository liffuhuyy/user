<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f2f5;
        }
        
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        .profile-photo {
            width: 100px;
            height: 100px;
            background-color: #e0e0e0;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            cursor: pointer;
        }

        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .change-photo {
            color: #007bff;
            background: none;
            border: none;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #7a6f6f;
            border-radius: 20px;
            font-size: 14px;
        }

        .submit-btn {
            width: 70%;
            padding: 12px;
            background-color: #0f172a;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
        }

        .change-password {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            font-size: 12px;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-photo" onclick="showModal()">
            <img id="profileImage" src="default-avatar.png" alt="Profile Photo">
        </div>
        
        <input type="file" id="fileInput" accept="image/*" style="display: none;">
        <button class="change-photo" onclick="document.getElementById('fileInput').click()">Ubah foto profil</button>
        
        <form id="editProfileForm">
           <br> <div class="form-group">
                <input type="text" id="nama" placeholder="Nama Lengkap" required>
            </div>
            
            <div class="form-group">
                <input type="email" id="email" placeholder="Email" required 
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                title="Masukkan email yang valid">
            </div>
            
            <div class="form-group">
                <input type="tel" id="hp" placeholder="No HP" required 
                pattern="[0-9]{10,13}" 
                title="Nomor HP harus 10-13 digit angka">
            </div><br><br>
           
            <button type="submit" class="submit-btn">Simpan Perubahan</button>
        </form>
        
        <a href="change-password.html" class="change-password">Ubah Kata Sandi</a><br>
        
    </div>

    <!-- Modal untuk Zoom Image -->
    <div class="modal" id="modal" onclick="hideModal()">
        <img id="modalImage" src="" alt="Profile Preview">
    </div>

    <script>
        // Ganti foto profil setelah memilih file
        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        
        document.getElementById('editProfileForm').addEventListener('submit', function(event) {
            event.preventDefault();

            if (this.checkValidity()) {
                window.location.href = "profil.html";
            } else {
                this.reportValidity();
            }
        });

        // Fungsi untuk menampilkan modal zoom gambar
        function showModal() {
            const profileImage = document.getElementById('profileImage').src;
            document.getElementById('modalImage').src = profileImage;
            document.getElementById('modal').style.display = 'flex';
        }

        // Fungsi untuk menyembunyikan modal
        function hideModal() {
            document.getElementById('modal').style.display = 'none';
        }
    </script>
</body>
</html>
