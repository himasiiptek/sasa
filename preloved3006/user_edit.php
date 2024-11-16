<?php
include "config.php";

// Mendapatkan ID user dari parameter URL
$id_user = $_GET['id_user'];

// Mengambil data user dari database berdasarkan ID
$query = "SELECT * FROM users WHERE id_user = '$id_user'";
$result = mysqli_query($config, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($config));
}

$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];

    // Jika password diisi, maka update password juga
    if (!empty($password)) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT); // Enkripsi password
        $update_query = "UPDATE users SET 
                            Nama_lengkap = '$nama_lengkap', 
                            email = '$email', 
                            username = '$username', 
                            phone_number = '$phone_number', 
                            user_type = '$user_type', 
                            password = '$password_hashed' 
                            created_at = '$created_at'
                        WHERE id_user = '$id_user'";
    } else {
        // Jika password kosong, jangan update kolom password
        $update_query = "UPDATE users SET 
                            Nama_lengkap = '$nama_lengkap', 
                            email = '$email', 
                            username = '$username', 
                            phone_number = '$phone_number', 
                            user_type = '$user_type' 
                            created_at = '$created_at'
                        WHERE id_user = '$id_user'";
    }

    $created_at = $_POST['created_at'];  // Get the 'created_at' value from the form

    $update_result = mysqli_query($config, $update_query);

    if ($update_result) {
        echo "<script>alert('Data user berhasil diperbarui'); window.location.href='halaman_user.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #e0e0e0; /* Background warna silver */
            color: #333;
        }
        h3 {
            color: #555;
            margin: 20px;
        }
        form {
            background-color: #f2f2f2; /* Warna form silver */
            padding: 60px;
            border-radius: 30px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 500px;
        }
        label {
            display: block;
            margin-top: 10px;
            color: #555;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #bbb;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background-color: #6e6e6e; /* Tombol warna silver gelap */
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h3>Edit User</h3>
    <form method="POST" action="">
    <label>Nama Lengkap:</label>
<textarea name="nama_lengkap" rows="4" cols="50" required><?php echo $data['Nama_lengkap']; ?></textarea>

<label>Email:</label>
<input type="email" name="email" value="<?php echo $data['email']; ?>" required>

<label>Username:</label>
<input type="text" name="username" value="<?php echo $data['username']; ?>" required>

<label>No Handphone:</label>
<input type="text" name="phone_number" value="<?php echo $data['phone_number']; ?>" required>

<label>Jenis Pengguna:</label>
<input type="radio" name="user_type" value="buyer" <?php echo ($data['user_type'] == 'buyer') ? 'checked' : ''; ?> required> Buyer
<input type="radio" name="user_type" value="seller" <?php echo ($data['user_type'] == 'seller') ? 'checked' : ''; ?> required> Seller

<label>Created At:</label>
<input type="text" name="created_at" value="<?php echo $data['created_at']; ?>" readonly>

<label>Password (Kosongkan jika tidak ingin mengubah):</label>
<input type="password" name="password" placeholder="Password baru">

<button type="submit" name="update">Update</button>
    </form>
</body>
</html>
