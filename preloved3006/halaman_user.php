<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #e0e0e0; /* Silver background */
            color: #333; /* Dark text for contrast */
        }
        h3 {
            margin: 20px;
            color: #555;
        }
        .add-user a {
            text-decoration: none;
            color: #ffffff;
            background-color: #6e6e6e; /* Darker silver */
            padding: 10px 15px;
            border-radius: 5px;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #f2f2f2; /* Light silver */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Shadow effect */
        }
        table, th, td {
            border: 1px solid #bbb; /* Border color in silver tone */
            text-align: center;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: #b0b0b0; /* Silver header */
            color: #ffffff;
        }
        tr:nth-child(even) {
            background-color: #d9d9d9; /* Alternating row color */
        }
        tr:hover {
            background-color: #c0c0c0; /* Hover effect with silver tone */
        }
        .action-buttons a {
            text-decoration: none;
            color: #ffffff;
            padding: 5px 10px;
            border-radius: 5px;
            margin: 0 2px;
        }
        .edit-button {
            background-color: #5c5c5c; /* Dark silver for Edit button */
        }
        .delete-button {
            background-color: #8b0000; /* Dark red for Delete button */
        }
    </style>
    <script>
        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus user ini?")) {
                window.location.href = `user_hapus.php?id_user=${id}`;
            }
        }
    </script>
</head>
<body>
    <h3>Data User</h3>
    <p class="add-user"><a href="user_tambah.php">+ Tambah User</a></p>
    <table>
        <tr>
            <th>No</th>
            <th>ID User</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Username</th>
            <th>No Handphone</th>
            <th>Jenis Pengguna</th>
            <th>Created At</th>
            <th>Opsi</th>
        </tr>
        <?php
            include "config.php";

            // Pastikan semua kolom sesuai dengan tabel database
            $sql = "SELECT id_user, username, Nama_lengkap, email, phone_number, user_type, created_at FROM users ORDER BY Nama_lengkap";
            $hasil = mysqli_query($config, $sql);

            if (!$hasil) {
                die("Query Error: " . mysqli_error($config)); // Untuk debugging jika query gagal
            }

            $no = 1;

            while ($data = mysqli_fetch_array($hasil)) {
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data['id_user']; ?></td>
                <td><?php echo $data['Nama_lengkap']; ?></td>
                <td><?php echo $data['email']; ?></td>
                <td><?php echo $data['username']; ?></td>
                <td><?php echo $data['phone_number']; ?></td>
                <td><?php echo $data['user_type']; ?></td>
                <td><?php echo $data['created_at']; ?></td>
                <td class="action-buttons">
                    <a href="user_edit.php?id_user=<?php echo $data['id_user']; ?>" class="edit-button">Edit</a>
                    <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $data['id_user']; ?>);" class="delete-button">Hapus</a>
                </td>
            </tr>
        <?php
                $no++;
            }
        ?>
    </table>
</body>
</html>
