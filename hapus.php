<?php
session_start();

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
include("db.php");
// Koneksi ke database
// $servername = "localhost";
// $username = "root";
// $password = "adamheril";
// $dbname = "db_registrasi";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Hapus data berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlDelete = "DELETE FROM tbl_tambahpantai WHERE id = $id";
    if ($conn->query($sqlDelete)) {
        header('Location: admin_manage_beaches.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data pantai dari database
$sql = "SELECT * FROM tbl_tambahpantai";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Pantai</title>
    <style>
        body {
            font-family: 'Cambria', serif;
            background-image: url("https://img.freepik.com/free-photo/aerial-view-beach-washed-by-blue-ocean-water-indonesia_181624-51814.jpg?semt=ais_tags_boosted");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            color: #fff;
        }

        .dashboard {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        h2 {
            color: #ffdd57;
            margin-bottom: 20px;
            font-size: 28px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #fff;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #ffdd57;
            padding: 10px;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        a {
            display: inline-block;
            padding: 5px 10px;
            background-color: #dc3545;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        a:hover {
            background-color: #c82333;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }

        /* Animasi untuk fade-in */
        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        /* Animasi untuk efek klik */
        @keyframes scaleClick {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h2>Kelola Data Pantai</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pantai</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['namapantai']); ?></td>
                        <td><?php echo htmlspecialchars($row['lokasi']); ?></td>
                        <td>
                            <a href="?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="delete-link">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="admin_dashboard.php" class="back-btn">Kembali ke Dashboard</a>
    </div>

    <script>
        // Animasi fade-in saat halaman dimuat
        window.onload = function() {
            var elements = document.querySelectorAll('.dashboard, .back-btn, a');
            elements.forEach(function(element) {
                element.style.animation = 'fadeIn 1s forwards';
            });
        };

        // Menambahkan efek klik pada tautan Hapus
        document.querySelectorAll('.delete-link').forEach(function(link) {
            link.addEventListener('click', function() {
                this.style.animation = 'scaleClick 0.2s';
            });
        });
    </script>
</body>
</html>


