<!DOCTYPE html>
<html>
<head>
    <title>Halaman Tambah Data</title>
    <style>
        /* General body styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f6f9;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        /* Container for the form */
        .form-container {
            width: 100%;
            max-width: 500px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Form header */
        h3 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px 5px;
        }

        td:first-child {
            text-align: right;
            color: #555;
            width: 35%;
        }

        td:nth-child(2) {
            width: 5%;
            text-align: center;
        }

        /* Input field styling */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="datetime-local"],
        select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1em;
            color: #333;
        }

        /* Button styling */
        input[type="submit"],
        input[type="reset"] {
            padding: 10px 20px;
            margin-top: 15px;
            font-size: 1em;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"] {
            background-color: #4caf50;
            margin-right: 10px;
        }

        input[type="reset"] {
            background-color: #d9534f;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        input[type="reset"]:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h3>Menambah Data User</h3>
        <form method="POST" action="user_tambah_action.php">
            <table>
                <tr>
                    <td>ID User</td>
                    <td>:</td>
                    <td><input type="text" name="id_user" required></td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td><textarea name="nama_lengkap" rows="4" cols="50" required></textarea></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input type="email" name="email" required></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><input type="text" name="username" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="password" required></td>
                </tr>
                <tr>
                    <td>No Handphone</td>
                    <td>:</td>
                    <td><input type="number" name="phone_number" required></td>
                </tr>
                <tr>
                <td>Jenis Pengguna</td>
                <td>:</td>
                <td>
                    <input type="radio" id="seller" name="user_type" value="seller" required>
                    <label for="seller">Seller</label>
                    <input type="radio" id="buyer" name="user_type" value="buyer">
                    <label for="buyer">Buyer</label>
                </td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>:</td>
                    <td>
                        <input type="datetime-local" name="created_at" value="<?php echo date('Y-m-d\TH:i'); ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;">
                        <input type="submit" name="simpan" value="Simpan">
                        <input type="reset" value="Batal">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
