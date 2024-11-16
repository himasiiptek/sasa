<?php
session_start(); // Memulai sesi

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    echo "Anda harus login terlebih dahulu.";
    exit();
}

include "config.php";  // Menghubungkan ke file konfigurasi database

// Cek jika formulir sudah disubmit menggunakan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $id_user = $_POST['id_user'];
    $nama_lengkap = $_POST['Nama_lengkap'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];
    $user_type = $_POST['user_type'];
    $created_at = $_POST['created_at'];

    // Enkripsi password sebelum disimpan
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan data ke dalam tabel
    $sql = "INSERT INTO users (id_user, username, password, Nama_lengkap, email, phone_number, user_type, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Menyiapkan statement untuk query
    if ($stmt = mysqli_prepare($config, $sql)) {
        // Binding parameter
        mysqli_stmt_bind_param($stmt, "isssssss", $id_user, $username, $password, $nama_lengkap, $email, $phone_number, $user_type, $created_at);

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            echo "Data berhasil ditambahkan. <a href='halaman_user.php'>Kembali ke halaman user</a>";
        } else {
            echo "Error: " . mysqli_error($config);
        }

        // Menutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Query gagal: " . mysqli_error($config);
    }

    // Menutup koneksi database
    mysqli_close($config);
}
?>
