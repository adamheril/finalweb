<?php 
session_start();

// Konfigurasi koneksi ke database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'adamheril');
define('DB_NAME', 'db_registrasi');

// Membuat koneksi
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Mendapatkan data pengguna berdasarkan sesi
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];

    // Query untuk mendapatkan data pengguna berdasarkan username
    $sql = "SELECT * FROM tbl_regis WHERE username = '$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data pengguna tidak ditemukan!";
        exit;
    }
} else {
    header("Location: login.php");
    exit();
}

// Logika untuk update nama akun
if (isset($_POST['update'])) {
    $new_username = $conn->real_escape_string($_POST['new_username']);
    $update_sql = "UPDATE tbl_regis SET username = '$new_username' WHERE username = '$user'";
    
    if ($conn->query($update_sql) === TRUE) {
        $_SESSION['username'] = $new_username; // Update sesi dengan nama baru
        header("Location: profil.php");
        exit();
    } else {
        echo "Gagal memperbarui nama akun: " . $conn->error;
    }
}

// Logika untuk delete akun
if (isset($_POST['delete'])) {
    $delete_sql = "DELETE FROM tbl_regis WHERE username = '$user'";
    
    if ($conn->query($delete_sql) === TRUE) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        echo "Gagal menghapus akun: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <style>
        body {
            font-family: Cambria, serif;
            background-image: url("https://img.freepik.com/free-photo/aerial-view-beach-washed-by-blue-ocean-water-indonesia_181624-51814.jpg?semt=ais_tags_boosted");
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100%;
            color: #fff;
        }

        .profil-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }

        .profil-card {
            background-color: rgba(0, 0, 0, 0.7); 
            width: 80%; 
            max-width: 500px; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); 
            text-align: center;
        }

        .profil-card h2 {
            margin-bottom: 20px;
            color: #ffdd57; /* Warna judul sesuai tema */
        }

        .profil-card p {
            font-size: 18px;
            margin: 10px 0;
        }

        .profil-card form {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .profil-card input {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .profil-card button {
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            font-size: 14px;
            cursor: pointer;
        }

        .profil-card .btn-update {
            background-color: #007BFF;
            color: #fff;
        }

        .profil-card .btn-update:hover {
            background-color: #0056b3;
        }

        .profil-card .btn-delete {
            background-color: #FF0000;
            color: #fff;
        }

        .profil-card .btn-delete:hover {
            background-color: #b30000;
        }

        .back-button {
            margin-top: 20px;
        }

        .back-button a {
            padding: 10px 20px;
            background-color: #fff;
            color: #000;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .back-button a:hover {
            background-color: #f0f0f0;
        }

        /* Style untuk tombol log out */
        .logout-button {
            padding: 10px 20px;
            background-color: #FF0000;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-left: 20px;
        }

        .logout-button:hover {
            background-color: #b30000;
        }
    </style>
</head>
<body>
    <div class="profil-container">
        <div class="profil-card">
            <h2>Profil Akun</h2>
            <img src="<?php echo isset($row['foto']) && !empty($row['foto']) ? 'uploads/' . $row['foto'] : 'https://img.freepik.com/premium-vector/vector-flat-illustration-grayscale-avatar-user-profile-person-icon-profile-picture-business-profile-woman-suitable-social-media-profiles-icons-screensavers-as-templatex9_719432-1339.jpg'; ?>" alt="Foto Profil" style="border-radius: 50%; width: 120px; height: 120px; object-fit: cover;">

            <p><strong>Username:</strong> <?php echo $row['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>

            <!-- Form untuk update nama akun dan delete akun -->
            <form method="post">
                <input type="text" name="new_username" placeholder="Nama baru" required>
                <button type="submit" name="update" class="btn-update">Update</button>
                <button type="submit" name="delete" class="btn-delete">Hapus</button>
            </form>

            <div class="back-button">
                <a href="index.php">Kembali ke Halaman Utama</a>
                <!-- Tombol Log Out -->
                <a href="utama.php" class="logout-button">Log Out</a>
            </div>
        </div>
    </div>

    <script>
        // Efek animasi pada tombol saat di-hover
        const updateButton = document.querySelector('.btn-update');
        const deleteButton = document.querySelector('.btn-delete');
        const profileImage = document.querySelector('img');

        // Efek animasi pada tombol Update
        updateButton.addEventListener('mouseover', () => {
            updateButton.style.transform = 'scale(1.1)';
            updateButton.style.transition = 'transform 0.3s ease';
        });

        updateButton.addEventListener('mouseout', () => {
            updateButton.style.transform = 'scale(1)';
        });

        // Efek animasi pada tombol Delete
        deleteButton.addEventListener('mouseover', () => {
            deleteButton.style.transform = 'scale(1.1)';
            deleteButton.style.transition = 'transform 0.3s ease';
        });

        deleteButton.addEventListener('mouseout', () => {
            deleteButton.style.transform = 'scale(1)';
        });

        // Efek animasi pada gambar profil
        profileImage.addEventListener('mouseover', () => {
            profileImage.style.transform = 'rotate(15deg)';
            profileImage.style.transition = 'transform 0.5s ease';
        });

        profileImage.addEventListener('mouseout', () => {
            profileImage.style.transform = 'rotate(0deg)';
        });
    </script>
</body>
</html>
