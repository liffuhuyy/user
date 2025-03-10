<?php
include 'koneksi.php';

// Inisialisasi variabel kosong
$nama = $nisn = $nohp = $email = $jenis_kelamin = $tempat_lahir = $tanggal_lahir = $jurusan = $kelas = $agama = $alamat = "";

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nisn = $_POST['nisn'];
    $nohp = $_POST['nohp'];
    $email = $_POST['email'];
    $jenis_kelamin = $_POST['jenisKelamin'];
    $tempat_lahir = $_POST['tempatLahir'];
    $tanggal_lahir = $_POST['tanggalLahir'];
    $jurusan = $_POST['jurusan'];
    $kelas = $_POST['kelas'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];

    // Simpan ke database
    $sql = "INSERT INTO biodata_siswa (nama, nisn, nohp, email, jenis_kelamin, tempat_lahir, tanggal_lahir, jurusan, kelas, agama, alamat) 
            VALUES ('$nama', '$nisn', '$nohp', '$email', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$jurusan', '$kelas', '$agama', '$alamat')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil disimpan!');</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data! Error: " . $conn->error . "');</script>";
    }
}
?>