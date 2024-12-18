<?php
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

// Proses pendaftaran pengguna
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi data
    if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo "<script>alert('Username, Email, dan password wajib diisi!');</script>";
    } else {
        // Menangkap data input
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password

        // Cek apakah email sudah terdaftar
        $sql = "SELECT email FROM tbl_regis WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Email sudah terdaftar.');</script>";
        } else {
            // Simpan data pengguna baru ke database
            $insert_sql = "INSERT INTO tbl_regis (username, email, password) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("sss", $username, $email, $hashed_password);
            if ($insert_stmt->execute()) {
                // Redirect ke halaman login setelah registrasi berhasil
                echo "<script>alert('Registrasi berhasil!'); window.location.href = 'login.php';</script>";
            } else {
                echo "<script>alert('Gagal mendaftar. Coba lagi.');</script>";
            }
            $insert_stmt->close();
        }
        $stmt->close();
    }
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    <style>
        body {
            font-family: Cambria, serif;
            background-image: url("https://img.freepik.com/free-photo/aerial-view-beach-washed-by-blue-ocean-water-indonesia_181624-51814.jpg?semt=ais_tags_boosted");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            color: #fff;
            overflow: hidden;
        }

        .registrasi-form {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7); /* transparansi latar belakang */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            position: relative;
            opacity: 0; /* Awalnya tersembunyi */
            transform: translateY(30px); /* Mulai dari bawah */
            transition: all 0.8s ease-out; /* Animasi smooth */
        }

        .registrasi-form h2 {
            margin-bottom: 20px;
            color: #ffdd57; /* Warna judul sesuai tema */
        }

        .registrasi-form form {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .registrasi-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        .registrasi-form button {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            font-size: 16px; /* Ukuran font tetap sama */
            padding: 10px 0; /* Padding vertikal tetap */
            width: 55%; /* Lebar tombol diperkecil */
            margin: 10px auto;
            border: none;
            border-radius: 5px;
        }

        .registrasi-form button:hover {
            background-color: #0056b3;
        }

        .registrasi-form .additional-links {
            margin-top: 10px;
            text-align: center;
        }

        .registrasi-form .additional-links a {
            color: rgb(211, 210, 207);
            text-decoration: none;
        }

        .registrasi-form .additional-links a:hover {
            text-decoration: underline;
        }

        .registrasi-form .terms {
            margin-top: 15px;
            font-size: 12px; /* Ukuran teks kecil */
            font-style: italic; /* Huruf miring */
            color: rgb(200, 200, 200); /* Warna teks lebih lembut */
            text-align: center;
        }

        .registrasi-form .terms a {
            color: rgb(200, 200, 200);
            text-decoration: none;
        }

        .registrasi-form .terms a:hover {
            text-decoration: underline;
        }

        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 5px 10px;
            background-color: #fff;
            color: #000;
            border: none;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-btn:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

    <!-- Tombol Kembali -->
    <button class="back-btn" onclick="window.location.href='utama.php'">Kembali</button>

    <div class="registrasi-form" id="formContainer">
        <h2>Form Registrasi</h2>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Daftar</button>
        </form>
        <div class="additional-links">
            <a href="login.php">Sudah punya akun? Login di sini</a>
        </div>
        <div class="terms">
            Dengan mendaftar, Anda menyetujui <br> 
            <a href="syarat.php"><em>Syarat dan Ketentuan</em></a> kami.
        </div>
    </div>

    <script>
        // Menambahkan animasi fade-in pada registrasi-form
        window.onload = function() {
            const formContainer = document.getElementById('formContainer');
            formContainer.style.opacity = '1';
            formContainer.style.transform = 'translateY(0)';
        };
    </script>
</body>
</html>



