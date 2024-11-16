<?php
include 'config1.php';

$stmt = $pdo->prepare("SELECT * FROM produk ORDER BY tanggal_ditambahkan DESC");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Preloved</title>
    <style>
        /* Colorful gradient background */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ff6f91, #ff9671, #ffc75f, #f9f871);
            background-size: 300% 300%;
            animation: gradientAnimation 8s ease infinite;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Animation for the gradient background */
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Dashboard container styling */
        .dashboard-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 100px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 6000px;
            text-align: center;
        }

        h1 {
            color: #ff6f91;
            margin-bottom: 20px;
        }

        .add-product-btn {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            margin-bottom: 15px;
            border-radius: 50px;
            transition: background-color 0.3s;
            background: linear-gradient(135deg, #ff9671, #ffc75f);
        }

        .add-product-btn:hover {
            background: linear-gradient(135deg, #ffc75f, #f9f871);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 50px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            color: #333;
        }

        th {
            background-color: #ff9671;
            color: #fff;
        }

        .action-buttons a {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            margin: 2px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .action-buttons a.edit {
            background-color: #4CAF50;
        }

        .action-buttons a.delete {
            background-color: #ff6f91;
        }

        .action-buttons a.edit:hover {
            background-color: #45a049;
        }

        .action-buttons a.delete:hover {
            background-color: #ff4c61;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Dashboard Preloved</h1>
        <a href="tambah_produk.php" class="add-product-btn">Tambah Produk</a>
        <table>
        <thead>
    <tr>
        <th>ID</th>
        <th>Nama Produk</th>
        <th>Deskripsi</th>
        <th>Harga</th>
        <th>Kondisi</th>
        <th>Kategori</th>
        <th>Stok</th>
        <th>Status</th>
        <th>Tanggal Ditambahkan</th> <!-- New column for Tanggal Ditambahkan -->
        <th>Aksi</th>
        <a href="halaman_preloved.php" class="add-product-btn">Website Preloved</a>
    </tr>
</thead>
<tbody>
    <?php if (empty($products)): ?>
        <tr>
            <td colspan="9">Tidak ada produk yang tersedia.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['id_produk']); ?></td>
                <td><?php echo htmlspecialchars($product['nama_produk']); ?></td>
                <td><?php echo htmlspecialchars($product['deskripsi']); ?></td>
                <td><?php echo "$" . number_format($product['harga'], 2); ?></td>
                <td><?php echo htmlspecialchars($product['kondisi']); ?></td>
                <td><?php echo htmlspecialchars($product['kategori']); ?></td>
                <td><?php echo htmlspecialchars($product['stok']); ?></td>
                <td><?php echo htmlspecialchars($product['status']); ?></td>
                <td><?php echo htmlspecialchars($product['tanggal_ditambahkan']); ?></td> <!-- Display Tanggal Ditambahkan -->
                <td class="action-buttons">
                    <a href="edit_produk.php?id=<?php echo $product['id_produk']; ?>" class="edit">Edit</a>
                    <a href="hapus_produk.php?id=<?php echo $product['id_produk']; ?>" class="delete" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody>
        </table>
    </div>
</body>
</html>
