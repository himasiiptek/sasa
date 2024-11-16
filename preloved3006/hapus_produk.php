<?php
include 'config1.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM produk WHERE id_produk = ?");
$stmt->execute([$id]);

header("Location: dashboard.php");
exit();
?>
