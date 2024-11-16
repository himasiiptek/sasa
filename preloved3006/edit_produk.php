<?php
include 'config1.php';

// Memeriksa apakah ada ID produk yang diberikan
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ID produk tidak valid.');
}

$id = $_GET['id'];

// Menyiapkan query untuk mendapatkan data produk berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM produk WHERE id_produk = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Memeriksa apakah produk ditemukan
if (!$product) {
    die('Produk tidak ditemukan.');
}

// Memproses form jika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $nama_produk = $_POST['nama_produk'];
    $deskripi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $kondisi = $_POST['kondisi'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $status = $_POST['status'];
    $tanggal_ditambahkan = $_POST['tanggal_ditambahkan'];

    // Menghapus simbol dolar dan memastikan harga hanya berupa angka
    $harga = preg_replace('/[^\d.]/', '', $harga);

    // Validasi input
    if (!is_numeric($harga) || $harga <= 0) {
        echo "Harga harus berupa angka positif.";
        exit();
    }

    if (!is_numeric($stok) || $stok < 0) {
        echo "Stok harus berupa angka yang tidak negatif.";
        exit();
    }

    // Menyiapkan query untuk memperbarui data produk
    $stmt = $pdo->prepare("UPDATE produk SET nama_produk = ?, deskripsi = ?, harga = ?, kondisi = ?, kategori = ?, stok = ?, status = ?, tanggal_ditambahkan = ? WHERE id_produk = ?");
    $stmt->execute([$nama_produk, $deskripsi, $harga, $kondisi, $kategori, $stok, $status, $tanggal_ditambahkan, $id]);

    // Mengarahkan pengguna setelah berhasil update
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ff6f91, #ff9671, #ffc75f, #f9f871);
            background-size: 300% 300%;
            animation: gradientAnimation 8s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 700px;
            text-align: center;
        }

        h1 {
            color: #ff6f91;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
            color: #333;
            text-align: left;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #ff6f91;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        button[type="submit"]:hover {
            background-color: #ff4c61;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #ff6f91;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            color: #ff4c61;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Edit Produk</h1>
        <form method="post">
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" name="nama_produk" value="<?php echo htmlspecialchars($product['nama_produk']); ?>" required>

            <label for="deskripsi">Deskripsi:</label>
<textarea name="deskripsi" rows="4" required><?php echo isset($product['deskripsi']) ? htmlspecialchars($product['deskripsi']) : ''; ?></textarea>

            <label for="harga">Harga (dalam USD):</label>
            <input type="text" name="harga" value="<?php echo '$' . number_format($product['harga'], 2); ?>" required oninput="this.value = this.value.replace(/[^0-9.]/g, '')">

            <label for="kondisi">Kondisi:</label>
            <select name="kondisi" required>
                <option value="Baru" <?php echo $product['kondisi'] == 'Baru' ? 'selected' : ''; ?>>Baru</option>
                <option value="Bekas" <?php echo $product['kondisi'] == 'Bekas' ? 'selected' : ''; ?>>Bekas</option>
            </select>

            <label for="kategori">Kategori:</label>
            <input type="text" name="kategori" value="<?php echo htmlspecialchars($product['kategori']); ?>" required>

            <label for="stok">Stok:</label>
            <input type="number" name="stok" value="<?php echo htmlspecialchars($product['stok']); ?>" required>

            <label for="status">Status:</label>
            <div style="display: flex; gap: 10px; align-items: center;">
                <input type="radio" id="tersedia" name="status" value="tersedia" required>
                <label for="tersedia">Tersedia</label>

                <input type="radio" id="terjual" name="status" value="terjual">
                <label for="terjual">Terjual</label>
            </div>

            <label>Tanggal Ditambahkan</label>
            <input type="date" name="tanggal_ditambahkan" value="<?php echo htmlspecialchars($product['tanggal_ditambahkan']); ?>" required>

            <button type="submit">Simpan Perubahan</button>
        </form>
        <a href="dashboard.php" class="back-link">Kembali ke Dashboard</a>
    </div>
</body>
</html>
