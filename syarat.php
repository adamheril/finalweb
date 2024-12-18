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

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat dan Ketentuan - Pendaftaran Akun</title>
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

        .terms-container {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7); /* transparansi latar belakang */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: left;
            position: relative;
            max-height: 70vh; /* Membatasi tinggi container */
            overflow-y: auto; /* Membuat konten dapat digulir */
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .terms-container h2 {
            margin-bottom: 20px;
            color: #ffdd57; /* Warna judul sesuai tema */
            font-size: 28px;
        }

        .terms-container p {
            font-size: 18px;
            color: #ddd;
            line-height: 1.6;
        }

        .terms-container ul {
            color: #ddd;
            font-size: 16px;
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

        .accept-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .accept-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Tombol Kembali -->
    <button class="back-btn" onclick="window.location.href='registrasi.php'">Kembali</button>

    <div class="terms-container" id="termsContainer">
        <h2>Syarat dan Ketentuan Pendaftaran Akun</h2>
        
        <p>Dengan membuat akun di website ini, Anda setuju untuk mematuhi syarat dan ketentuan yang berlaku. Harap membaca dengan seksama sebelum melanjutkan pendaftaran.</p>
        
        <h3>Syarat Pengguna</h3>
        <ul>
            <li>Anda harus berusia minimal 18 tahun untuk mendaftar akun di website ini.</li>
            <li>Anda wajib memberikan informasi yang akurat dan terbaru saat mengisi formulir pendaftaran.</li>
            <li>Anda bertanggung jawab penuh atas keamanan akun dan informasi pribadi Anda.</li>
        </ul>

        <h3>Ketentuan Penggunaan</h3>
        <ul>
            <li>Website ini tidak bertanggung jawab atas segala kerugian yang disebabkan oleh penggunaan akun Anda yang tidak sah.</li>
            <li>Penggunaan website ini harus sesuai dengan hukum yang berlaku di Indonesia.</li>
            <li>Website ini berhak untuk menangguhkan atau menutup akun pengguna yang melanggar syarat dan ketentuan yang telah ditetapkan.</li>
        </ul>

        <h3>Hak Kekayaan Intelektual</h3>
        <ul>
            <li>Konten yang tersedia di website ini dilindungi oleh hak cipta dan tidak dapat digunakan tanpa izin yang sah.</li>
        </ul>

        <h3>Penyelesaian Sengketa</h3>
        <ul>
            <li>Segala sengketa yang timbul dari penggunaan website ini akan diselesaikan sesuai dengan hukum yang berlaku di Indonesia.</li>
        </ul>

        <div>
            <button class="accept-button" onclick="window.location.href='registrasi.php'">Setuju dan Lanjutkan</button>
        </div>
    </div>

    <script>
        // Animasi untuk elemen terms-container
        window.onload = function() {
            const termsContainer = document.getElementById('termsContainer');
            termsContainer.style.opacity = '1';
            termsContainer.style.transform = 'translateY(0)';
        };
    </script>

</body>
</html>
