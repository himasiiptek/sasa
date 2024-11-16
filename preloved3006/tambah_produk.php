<?php
include 'config1.php';
session_start();

// Cek jika user sudah login
if (!isset($_SESSION['id_user'])) {
    echo "Anda harus login terlebih dahulu.";
    exit();
}

// Ambil id_user dari sesi
$id_user = $_SESSION['id_user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $kondisi = $_POST['kondisi'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $status = $_POST['status'];
    $tanggal_ditambahkan = $_POST['tanggal_ditambahkan'];

    // Handle file upload
    $target_dir = "uploads/";
    $foto_produk = $_FILES['foto_produk']['name'];
    $target_file = $target_dir . basename($foto_produk);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verifikasi file adalah gambar
    $check = getimagesize($_FILES["foto_produk"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File yang diunggah bukan gambar.";
        $uploadOk = 0;
    }

    // Verifikasi ukuran file
    if ($_FILES["foto_produk"]["size"] > 2000000) {
        echo "Ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Verifikasi format file
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Hanya format JPG, JPEG, & PNG yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Jika verifikasi upload berhasil
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["foto_produk"]["tmp_name"], $target_file)) {
            // Masukkan data ke database
            $stmt = $pdo->prepare("INSERT INTO produk (nama_produk, deskripsi, harga, kondisi, kategori, stok, status, foto_produk, tanggal_ditambahkan id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nama_produk, $deskripsi, $harga, $kondisi, $kategori, $stok, $status, $tanggal_ditambahkan, $target_file, $id_user]);

            // Redirect ke halaman dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah gambar.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
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
        input[type="number"],
        input[type="file"],
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
        <h1>Tambah Produk</h1>
        <form method="post" enctype="multipart/form-data">
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" id="nama_produk" name="nama_produk" required>

            <label for="deskripsi">Deskripsi:</label>
<textarea name="deskripsi" rows="4" required><?php echo isset($product['deskripsi']) ? htmlspecialchars($product['deskripsi']) : ''; ?></textarea>


            <label for="harga">Harga:</label>
<div>
    <input type="text" id="harga" name="harga" oninput="formatRupiah(this)" placeholder="0" required>
</div>

<script>
function formatRupiah(input) {
    // Remove any non-numeric characters except for the decimal point
    let value = input.value.replace(/[^,\d]/g, "");
    // Split the input value into whole and decimal parts
    let parts = value.split(",");
    let wholePart = parts[0];
    let decimalPart = parts[1] !== undefined ? "," + parts[1] : "";

    // Format whole part with thousands separator
    let formattedValue = wholePart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Update the input value
    input.value = formattedValue + decimalPart;
}
</script>

            <label for="kondisi">Kondisi:</label>
            <select id="kondisi" name="kondisi" required>
                <option value="baru">Baru</option>
                <option value="preloved">Bekas</option>
            </select>

            <label for="kategori">Kategori:</label>
            <input type="text" id="kategori" name="kategori" required>

            <label for="stok">Stok:</label>
            <input type="number" id="stok" name="stok" required>

            <label for="status">Status:</label>
            <div style="display: flex; gap: 10px; align-items: center;">
                <input type="radio" id="tersedia" name="status" value="tersedia" required>
                <label for="tersedia">Tersedia</label>

                <input type="radio" id="terjual" name="status" value="terjual">
                <label for="terjual">Terjual</label>
            </div>

            <label for="foto_produk">Foto Produk:</label>
            <input type="file" id="foto_produk" name="foto_produk" accept="image/*" required>

            <label>Tanggal Ditambahkan</label>
            <input type="date" name="tanggal_ditambahkan" value="<?php echo htmlspecialchars($product['tanggal_ditambahkan']); ?>" required>

            <button type="submit">Tambah Produk</button>
        </form>
        <a href="dashboard.php" class="back-link">Kembali ke Dashboard</a>
    </div>
</body>
</html>
