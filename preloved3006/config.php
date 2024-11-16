<?php
$host = 'localhost';
$username = 'root'; // Nama pengguna MySQL
$password = ''; // Masukkan password jika ada
$database = 'preloved3006'; // Ganti dengan nama database Anda

// Membuat koneksi menggunakan mysqli
$config = new mysqli($host, $username, $password, $database);

// Mengecek koneksi
if ($config->connect_error) {
    die("Koneksi gagal: " . $config->connect_error);
} else {
    echo "Koneksi berhasil!";
}
?>
