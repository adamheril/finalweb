<?php
session_start();

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
include("db.php");
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "adamheril";
$dbname = "db_registrasi";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses tambah pantai
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $namapantai = $_POST['namapantai'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_POST['gambar'];

    $sqlInsert = "INSERT INTO tbl_tambahpantai (namapantai, deskripsi, gambar) VALUES ('$namapantai', '$deskripsi', '$gambar')";
    if ($conn->query($sqlInsert) === TRUE) {
        // Data berhasil ditambahkan, arahkan kembali ke halaman tambah pantai untuk menampilkan data terbaru
        echo "<script>alert('Pantai berhasil ditambahkan!'); window.location='tambah_pantai.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data dari tabel tbl_tambahpantai
$sql = "SELECT * FROM tbl_tambahpantai";
$result = $conn->query($sql);
$beaches = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $beaches[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pantai</title>
    <style>
        body {
            font-family: "Cambria", serif;
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
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            opacity: 0;
            transform: translateY(-50px);
            transition: all 1s ease-out;
        }

        h1 {
            color: #D1D1D1; /* Kuning abu-abu */
            font-size: 32px;
        }

        h2 {
            color: #D1D1D1; /* Kuning abu-abu */
            margin-bottom: 20px;
            font-size: 28px;
        }

        .content-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            color: #fff;
        }

        .content-table th, .content-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .content-table th {
            background-color: #333;
            color: #ffdd57;
        }

        .content-table tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .content-table tr:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        img {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
        }

        .back-btn, .add-btn {
            display: inline-block;
            padding: 8px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .back-btn {
            background-color: #007bff;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }

        .add-btn {
            background-color: #ADD8E6; /* Biru muda */
        }

        .add-btn:hover {
            background-color: #87CEEB; /* Biru lebih tua saat hover */
        }

        .form-container {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            color: #fff;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        /* Responsif untuk tampilan mobile */
        @media screen and (max-width: 768px) {
            .dashboard {
                width: 80%;
            }

            .btn {
                font-size: 16px;
                padding: 10px 20px;
            }

            h1, h2 {
                font-size: 28px;
            }

            p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard" id="dashboard">
        <h1>Tambah Pantai Baru</h1>
        <p>Silakan tambahkan pantai baru di bawah ini:</p>

        <!-- Form untuk menambah pantai -->
        <div class="form-container">
            <form method="POST" action="tambah_pantai.php">
                <input type="text" name="namapantai" placeholder="Nama Pantai" required>
                <textarea name="deskripsi" placeholder="Deskripsi Pantai" rows="4" required></textarea>
                <input type="text" name="gambar" placeholder="URL Gambar Pantai" required>
                <button type="submit" name="tambah" class="add-btn">Tambah Pantai</button>
            </form>
        </div>

        <h2>Daftar Pantai</h2>

        <table class="content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pantai</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($beaches as $beach): ?>
                    <tr>
                        <td><?php echo $beach['id']; ?></td>
                        <td><?php echo htmlspecialchars($beach['namapantai']); ?></td>
                        <td><?php echo htmlspecialchars($beach['deskripsi']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($beach['gambar']); ?>" alt="Image"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Button Kembali -->
        <form action="admin_dashboard.php" method="GET" style="margin-top: 20px;">
            <button type="submit" class="back-btn">Kembali</button>
        </form>
    </div>

    <script>
        // Fungsi untuk animasi muncul
        window.onload = function() {
            const dashboard = document.getElementById('dashboard');
            dashboard.style.opacity = '1';
            dashboard.style.transform = 'translateY(0)';
        };
    </script>
</body>
</html>
