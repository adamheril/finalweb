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

// Ambil data berdasarkan ID untuk diedit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_tambahpantai WHERE id = $id";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
}

// Update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namapantai = $_POST['namapantai'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_POST['gambar'];
    $id = $_POST['id'];

    $sqlUpdate = "UPDATE tbl_tambahpantai SET namapantai='$namapantai', deskripsi='$deskripsi', gambar='$gambar' WHERE id=$id";
    if ($conn->query($sqlUpdate)) {
        header('Location: admin_dashboard.php'); // Arahkan ke halaman admin_dashboard setelah update
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pantai</title>
    <style>
        body {
            font-family: 'Cambria', serif;
            background-image: url("https://img.freepik.com/free-photo/aerial-view-beach-washed-by-blue-ocean-water-indonesia_181624-51814.jpg?semt=ais_tags_boosted");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .edit-form-container {
            background-color: rgba(0, 0, 0, 0.8);
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color: #fff;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        h2 {
            text-align: center;
            color: #ffdd57;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            background-color: #f9f9f9;
            color: #333;
        }

        button {
            background-color: #28a745;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        a:hover {
            text-decoration: underline;
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
    <div class="edit-form-container">
        <h2>Edit Data Pantai</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

            <label>Nama Pantai:</label>
            <input type="text" name="namapantai" value="<?php echo htmlspecialchars($data['namapantai']); ?>" required>

            <label>Deskripsi:</label>
            <textarea name="deskripsi" rows="5" required><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>

            <label>URL Gambar:</label>
            <input type="text" name="gambar" value="<?php echo htmlspecialchars($data['gambar']); ?>" required>

            <button type="submit" id="saveButton">Simpan</button>
            <a href="admin_dashboard.php">Kembali</a>
        </form>
    </div>

    <script>
        // Menambahkan efek klik pada tombol "Simpan"
        document.getElementById("saveButton").addEventListener('click', function() {
            this.style.animation = 'scaleClick 0.2s';
        });

        // Menambahkan animasi fade-in pada form dan tombol setelah halaman dimuat
        window.onload = function() {
            var formElements = document.querySelectorAll('.edit-form-container, button, a');
            formElements.forEach(function(element) {
                element.style.animation = 'fadeIn 1s forwards';
            });
        };
    </script>
</body>
</html>
