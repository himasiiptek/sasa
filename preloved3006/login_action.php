<?php
session_start();
include("config.php");

// Ambil data username dan password dari form login
$username = $_POST['txtUsername'];
$password = $_POST['txtPassword'];

// Query untuk mengambil id_user dan username berdasarkan username dan password yang cocok
$sql = "SELECT id_user, username FROM users WHERE username='$username' AND password='$password'";
$hasil = mysqli_query($config, $sql) or exit("Error query: <b>".$sql."</b>.");

// Cek apakah username dan password cocok
if (mysqli_num_rows($hasil) > 0) {
    $data = mysqli_fetch_array($hasil);
    
    // Simpan username dan id_user dalam sesi
    $_SESSION['username'] = $data['username'];
    $_SESSION['id_user'] = $data['id_user'];
    
    // Redirect ke halaman welcome setelah login
    header("Location:welcome.php");
    exit();
} else {
    // Tampilkan pesan kesalahan jika login gagal
    ?>
    <h2>Maaf...</h2>
    <p>Username atau password salah. Klik <a href="login.php">disini</a> untuk kembali login.</p>
    <?php
}
?>
