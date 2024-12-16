<?php
session_start();
// Cek apakah pengguna sudah login dan memiliki peran sebagai user
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: index.php'); // Arahkan ke halaman index.php jika bukan user
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("https://img.freepik.com/free-photo/tropical-beach-with-white-sand_1203-1710.jpg?t=st=1734356008~exp=1734359608~hmac=ee798742d8946a27a9ccc062c0e648e89c7edd8ee0acf842fe440ffa8d69764e&w=996");
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }

        .dashboard {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        h1 {
            font-size: 32px;
            color: #ffdd57;
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            margin: 20px 10px;
            padding: 12px 25px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .logout {
            display: block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Dashboard User</h1>
        <p>Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <p>Anda masuk sebagai <strong>User</strong>.</p>
        <!-- Tombol logout yang mengarah ke logout.php -->
        <a href="logout.php" class="btn logout">Logout</a>
    </div>
</body>
</html>

