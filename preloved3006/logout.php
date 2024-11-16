<?php
session_start();

// menghapus semua data sesi
session_unset();
session_destroy();

// ini akan mengarahkan kembali ke halaman login
header("Location: login.php");
exit();
?>
