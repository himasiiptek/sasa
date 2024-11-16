<?php
include 'config2.php'; // Menghubungkan ke database

try {
    // Query untuk mengambil data produk
    $sql = "SELECT * FROM produk";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produk = $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengambil semua data produk
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}

$conversionRate = 15000; // Nilai konversi 1 dolar dalam rupiah
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preloved Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Tema warna gradasi */
        /* Theme Gradient Background */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #ff9a8b, #f6d365, #ff6f91, #7dce13);
    background-size: 200% 200%;
    animation: gradientAnimation 15s ease infinite;
    margin: 0;
    padding: 0;
    color: #333;
}

@keyframes gradientTextAnimation {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Header */
.header {
    display: flex;
    justify-content: space-between;
    padding: 15px 30px;
    background: #ffffffcc;
    align-items: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    backdrop-filter: blur(8px);
    border-radius: 0 0 15px 15px;
}

.logo {
    font-size: 1.8em;
    font-weight: 600;
    color: #ff6f91;
}

/* Sidebar */
.sidebar {
    display: flex; /* Change layout to horizontal */
    gap: 20px; /* Add spacing between each link */
    background: #ffffffcc;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
    justify-content: center; /* Center the links */
    align-items: center;
}

.sidebar a {
    color: #333;
    text-decoration: none;
    font-weight: 500;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background 0.3s;
}

.sidebar a:hover {
    background: #ff6f91;
    color: white;
}

/* Main Content */
.main-content {
    flex-grow: 1;
    padding: 20px;
}

.main-content h2 {
    color: #333;
    font-size: 1.8em;
    font-weight: 600;
    text-align: center;
    padding: 15px;
    margin-bottom: 20px;
    background: linear-gradient(90deg, #ff9a8b, #ff6f91, #f7aef8, #7dce13);
    background-size: 300% 300%;
    animation: gradientTextAnimation 6s ease infinite;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    color: white;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Product Grid */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.product-card {
    background: white;
    padding: 15px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    transition: all 0.3s;
    text-align: center;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.product-card img {
    max-width: 100%;
    border-radius: 10px;
    transition: transform 0.3s;
}

.product-card img:hover {
    transform: scale(1.05);
}

.product-info h3 {
    font-size: 1.2em;
    color: #333;
    margin: 10px 0;
}

.product-info .price {
    color: #009688;
    font-weight: bold;
    font-size: 1.2em;
}

/* Add to Cart Button */
.add-to-cart {
    padding: 10px 20px;
    background: linear-gradient(135deg, #ff6f91, #ff9a8b);
    color: white;
    border-radius: 25px;
    border: none;
    cursor: pointer;
    font-size: 1em;
    transition: background 0.3s;
}

.add-to-cart:hover {
    background: linear-gradient(135deg, #ff4e74, #ff6f91);
}

/* Product Detail Popup */
.product-detail-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1001;
}

.product-detail-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    width: 80%;
    max-width: 500px;
    text-align: center;
    position: relative;
}

.product-detail-content img {
    max-width: 100%;
    border-radius: 10px;
}

.close-popup {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    font-size: 1.5em;
    color: #333;
}

/* Cart Summary */
.cart-summary {
    position: fixed;
    bottom: 20px; /* Position it 20px from the bottom */
    right: 20px; /* Position it 20px from the right */
    background: #ffffffcc;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: center;
    gap: 10px;
    color: #ff6f91;
    z-index: 1000;
}

    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="logo">Preloved Shop</div>
        <div class="search-bar">
            <input type="text" placeholder="Search for items, brands, or inspiration">
        </div>
    </div>

    <!-- Cart Summary -->
    <div class="cart-summary">
        <span>🛒</span>
        <span id="cart-total">0 items</span> - <span id="cart-amount">Rp0</span>
    </div>

    <!-- Layout Wrapper -->
    <div class="layout">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="login.php">Profile</a>
            <a href="logout.php">Logout</a>
            <a href="dashboard.php" class="back-link">Add Product</a>
            <a href="halaman_preloved.php">New In</a>
        </div>

        <!-- Main Content -->
        <div class="main-content">
    <h2>Preloved, Affordable, and Classy!</h2>
    <div class="product-grid">
        <?php
        // Menampilkan produk
        if (count($produk) > 0) {
            foreach ($produk as $row) {
                echo "<div class='product-card' onclick='showDetail(\"" . htmlspecialchars($row["nama_produk"]) . "\", \"" . htmlspecialchars($row["foto_produk"]) . "\", \"" . number_format($row["harga"], 0, ',', '.') . "\", \"" . htmlspecialchars($row["kondisi"]) . "\", \"" . htmlspecialchars($row["deskripsi"]) . "\")'>";
                echo "<img src='" . htmlspecialchars($row["foto_produk"]) . "' alt='" . htmlspecialchars($row["nama_produk"]) . "'>";
                echo "<div class='product-info'>";
                echo "<h3>" . htmlspecialchars($row["nama_produk"]) . "</h3>";
                echo "<p class='condition'>" . htmlspecialchars($row["kondisi"]) . "</p>"; // Menampilkan kondisi produk
                echo "<p class='description'>" . htmlspecialchars($row["deskripsi"]) . "</p>"; // Menampilkan deskripsi produk
                echo "<p class='price'>$" . number_format($row["harga"], 2, '.', ',') . "</p>"; // Harga dalam dolar
                echo "<button class='add-to-cart' onclick='addToCart(\"" . htmlspecialchars($row["nama_produk"]) . "\", " . $row["harga"] . "); event.stopPropagation();'>Add to Cart</button>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Tidak ada produk yang tersedia.</p>";
        }
        ?>
    </div>
</div>

        ?>
    </div>
</div>
    </div>

    <!-- Product Detail Popup -->
    <div class="product-detail-popup" id="productDetailPopup">
        <div class="product-detail-content">
            <span class="close-popup" onclick="closeDetail()">×</span>
            <img id="detailImage" src="" alt="Product Image">
            <h3 id="detailName"></h3>
            <p class="price" id="detailPrice"></p>
        </div>
    </div>

    <script>
        let cartItems = 0;
        let cartTotal = 0;

        function addToCart(name, price) {
            cartItems++;
            cartTotal += price;
            document.getElementById('cart-total').innerText = cartItems + ' items';
            document.getElementById('cart-amount').innerText = '$' + cartTotal.toLocaleString('id-ID');
            alert(name + " has been added to cart!");
        }

        function showDetail(name, image, price) {
            document.getElementById('productDetailPopup').style.display = 'flex';
            document.getElementById('detailImage').src = image;
            document.getElementById('detailName').innerText = name;
            document.getElementById('detailPrice').innerText = 'Rp' + price;
        }

        function closeDetail() {
            document.getElementById('productDetailPopup').style.display = 'none';
        }
    </script>
</body>
</html>
