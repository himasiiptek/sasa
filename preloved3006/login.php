<?php
session_start();
include 'config2.php';

// Logika login: cek username dan password
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Contoh query login
    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password); // Pastikan password sudah di-hash sesuai
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Login sukses
        $_SESSION['username'] = $username;
        header("Location: dashboard.php"); // Arahkan ke halaman dashboard
        exit();
    } else {
        echo "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Colorful Login Page</title>
    <style>
        /* Full-page background with a colorful gradient */
        body {
            background: linear-gradient(135deg, #ff6f91, #ff9671, #ffc75f, #f9f871);
            background-size: 300% 300%;
            animation: gradientAnimation 8s ease infinite;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Animation for the gradient background */
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Form container with a semi-transparent white background */
        .login-container {
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
            width: 450px; /* Increase width */
            padding: 60px; /* Reduce padding to balance the larger width */
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: #333;
            position: relative;
        }

        /* Close icon (top-right corner) */
        .close-icon {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 18px;
            cursor: pointer;
            color: #888;
        }

        /* Placeholder title text */
        .login-container h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 10px;
            color: #ff6f91;
        }

        /* Subtitle text */
        .login-container p {
            font-size: 14px;
            margin: 0 0 20px;
            color: #666;
        }

        /* Input fields */
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: calc(100% - 50px);
            padding: 12px;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid #ff9671;
            color: #333;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
            outline: none;
        }

        /* Icon inside input */
        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ff9671;
        }

        /* Button with colorful gradient */
        .login-container button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #f9f871, #ff6f91);
            border: none;
            color: #fff;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .login-container button:hover {
            background: linear-gradient(135deg, #ff9671, #ffc75f);
        }

        /* Remember me */
        .remember-me {
            display: flex;
            align-items: center;
            justify-content: start;
            font-size: 12px;
            color: #333;
            margin-top: 10px;
        }

        .remember-me input[type="checkbox"] {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="close-icon">&times;</div>
        <h1>Login</h1>
        <p>Rediscover the Beauty of Second Chances</p>
        
        <form action="login_action.php" method="post">
            <div class="input-group">
                <i class="fa fa-user"></i> <!-- Replace with actual icon if using Font Awesome -->
                <input type="text" placeholder="Username" name="txtUsername" required>
            </div>
            <div class="input-group">
                <i class="fa fa-lock"></i> <!-- Replace with actual icon if using Font Awesome -->
                <input type="password" placeholder="Password" name="txtPassword" required>
            </div>
            <div class="remember-me">
                <input type="checkbox" name="remember">
                <label for="remember">Remember me</label>
            </div>
            <button type="submit">Sign In</button>
        </form>
    </div>
</body>
</html>
