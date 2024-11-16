<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Preloved</title>
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
            height: 100vh;
        }

        /* Animation for the gradient background */
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Container styling */
        .welcome-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        /* Title styling */
        h1 {
            color: #ff6f91;
            margin-bottom: 20px;
        }

        /* Paragraph text color */
        p {
            color: #555;
            margin-bottom: 20px;
        }

        /* Button styles */
        a {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
            background: linear-gradient(135deg, #ff9671, #ffc75f);
        }

        a:hover {
            background: linear-gradient(135deg, #ffc75f, #f9f871);
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Selamat Datang di Preloved</h1>
        <p>Halo, selamat datang di Website Preloved kami! Nikmati pengalaman belanja barang preloved berkualitas dengan harga terbaik.</p>
        <p><a href="halaman_preloved.php">Website Preloved</a></p>
        <p> Untuk Seller Preloved</p?
        <p><a href="dashboard.php">For Seller</a></p>
    </div>
</body>
</html>
