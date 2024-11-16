<?php
include "config.php";

// Mendapatkan ID user dari parameter URL
$id_user = $_GET['id_user'];

// Query untuk menghapus data user dari database
$delete_query = "DELETE FROM users WHERE id_user = '$id_user'";
$result = mysqli_query($config, $delete_query);

if ($result) {
    echo "<script>alert('Data user berhasil dihapus'); window.location.href='halaman_user.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data'); window.location.href='halaman_user.php';</script>";
}
?>
