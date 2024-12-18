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

// Hapus data berdasarkan ID
if (isset($_GET['hapus_id'])) {
    $id = (int)$_GET['hapus_id'];
    $sqlDelete = "DELETE FROM tbl_tambahpantai WHERE id = $id";
    $conn->query($sqlDelete);
    header("Location: admin_dashboard.php");  // Arahkan ke admin_dashboard.php setelah penghapusan
    exit();
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
    <title>Admin - Kelola Konten Pantai</title>
    <style>
        body {
            font-family: 'Cambria', serif;
            background-image: url("https://img.freepik.com/free-photo/aerial-view-beach-washed-by-blue-ocean-water-indonesia_181624-51814.jpg?semt=ais_tags_boosted");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh; /* Agar background seluruh layar */
            color: #fff;
        }

        .dashboard {
            position: relative;
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 90%;  /* Menyesuaikan lebar dengan konten */
            min-height: 100vh;  /* Mengatur tinggi minimum untuk mengisi layar */
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        h1 {
            color: #ffdd57;
            font-size: 32px;
        }

        h2 {
            color: #ffdd57;
            margin-bottom: 20px;
            font-size: 28px;
        }

        .content-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            color: #fff;
            opacity: 0;
            animation: fadeIn 1s forwards;
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

        .logout-btn, .edit-btn, .delete-btn, .add-btn {
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
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .logout-btn {
            background-color: #e74c3c;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        .edit-btn {
            background-color: #3498db;
        }

        .edit-btn:hover {
            background-color: #2980b9;
        }

        .delete-btn {
            background-color: #e74c3c;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .add-btn {
            background-color: #28a745;
        }

        .add-btn:hover {
            background-color: #218838;
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }

        .kembali-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        .kembali-btn:hover {
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
        <h1>Kelola Konten Pantai</h1>
        <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>! Anda dapat mengelola daftar pantai di sini.</p>

        <h2>Daftar Pantai</h2>

        <!-- Button to open the Add New Beach Form -->
        <a href="tambah_pantai.php" class="add-btn">Tambah Pantai Baru</a>

        <table class="content-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pantai</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($beaches as $beach): ?>
                    <tr>
                        <td><?php echo $beach['id']; ?></td>
                        <td><?php echo htmlspecialchars($beach['namapantai']); ?></td>
                        <td><?php echo htmlspecialchars($beach['deskripsi']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($beach['gambar']); ?>" alt="Image"></td>
                        <td class="buttons-container">
                            <a href="edit.php?id=<?php echo $beach['id']; ?>" class="edit-btn">Edit</a>
                            <a href="?hapus_id=<?php echo $beach['id']; ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Button kembali -->
        <form action="utama.php" method="POST" style="margin-top: 20px;">
            <button type="submit" class="kembali-btn">Kembali</button>
        </form>
    </div>

    <script>
        // Menambahkan efek klik pada tombol dengan animasi scale
        const buttons = document.querySelectorAll('.logout-btn, .edit-btn, .delete-btn, .add-btn, .kembali-btn');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                this.style.animation = 'scaleClick 0.2s';
            });
        });
    </script>
</body>
</html>
