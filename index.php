<?php
// Memulai sesi untuk mengakses data $_SESSION
session_start();

// Simulasi login, pastikan sudah ada username dan role pada $_SESSION
// $_SESSION['username'] = 'User';  // untuk user
// $_SESSION['role'] = 'user';      // untuk user
// $_SESSION['username'] = 'Admin'; // untuk admin
// $_SESSION['role'] = 'admin';     // untuk admin

// Cek jika logout ditekan
if (isset($_GET['keluar']) && $_GET['keluar'] == 'true') {
    // Menghapus sesi dan data sesi
    session_unset();
    session_destroy();
    // Mengarahkan kembali ke halaman login
    header("Location: utama.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    <style>
        body {
            font-family: 'Cambria', serif;
            margin: 0;
            padding: 0;
            background-image: url("https://img.freepik.com/free-photo/aerial-view-beach-washed-by-blue-ocean-water-indonesia_181624-51814.jpg?semt=ais_tags_boosted");
            background-size: cover;
            color: #fff;
        }

        .dashboard {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            margin: 0 auto;
            overflow-y: auto;
            opacity: 0;
            animation: fadeIn 2s forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .dashboard h2 {
            color: #ffdd57;
            font-size: 30px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        .dashboard a {
            color: #ffdd57;
            text-decoration: none;
            font-size: 18px;
        }

        .dashboard button {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .dashboard button:hover {
            background-color: #0056b3;
        }

        .beach-card {
            background-color: rgba(0, 0, 0, 0.6);
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 70%;
            text-align: center;
            position: relative;
            opacity: 0;
            animation: slideIn 1s forwards;
        }

        @keyframes slideIn {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .beach-card img {
            width: 60%;
            height: auto;
            border-radius: 8px;
        }

        .beach-card h4 {
            color: #ffdd57;
            margin-top: 10px;
        }

        .beach-card p {
            color: #fff;
            font-size: 14px;
            margin-top: 10px;
        }

        .profile-img-container {
            position: absolute;
            top: 20px;
            right: 20px;
            text-align: center;
        }

        .profile-img-container img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid #fff;
            transition: transform 0.3s ease;
        }

        .profile-img-container img:hover {
            transform: scale(1.1);
        }

        /* Mengubah tulisan profil menjadi biasa */
        .profile-img-container p {
            margin-top: 10px;
            color: #fff;
            font-size: 16px;
            font-weight: normal; /* Mengubah gaya teks menjadi biasa */
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
            background-color: rgb(119, 119, 119);
        }
    </style>
</head>
<body>
    <button class="back-btn" onclick="window.location.href='utama.php'">Kembali</button>

    <div class="dashboard">
        <?php
        // Cek apakah $_SESSION['username'] tersedia
        if (isset($_SESSION['username'])) {
            // Menampilkan nama pengguna tanpa role
            echo '<h2>Selamat datang, ' . $_SESSION['username'] . '</h2>';
        } else {
            echo '<h2>Selamat datang, Pengguna Tidak Terdaftar</h2>';
        }
        ?>

        <h3>Pantai-pantai yang tersedia di Sulawesi Selatan:</h3>

        <?php
        // Array pantai dengan informasi
        $beaches = [
            ["name" => "Pantai Losari", "description" => "Pantai yang terletak di pusat kota Makassar ini terkenal sebagai salah satu destinasi wisata paling ikonik di Sulawesi Selatan. Dikenal dengan pemandangan matahari terbenam yang spektakuler, Pantai Losari juga menjadi tempat berkumpul bagi warga lokal dan wisatawan.", "image" => "https://tse2.mm.bing.net/th?id=OIP.9ksx5b1eYr---wZx7qhZtAHaDt&pid=Api&P=0&h=220"],
            ["name" => "Pantai Bira", "description" => "Pantai ini menawarkan pasir putih yang luas dengan perairan yang sangat jernih, cocok untuk berbagai kegiatan air seperti snorkeling dan diving. Terletak di daerah pesisir barat Sulawesi Selatan, Bira juga dikenal dengan keindahan terumbu karangnya.", "image" => "https://tse1.mm.bing.net/th?id=OIP.ez7T4FG37FTIe_IkqGodMQHaEc&pid=Api&P=0&h=220"],
            ["name" => "Pantai Tanjung Bayang", "description" => "Pantai Tanjung Bayang terletak tidak jauh dari Makassar, menawarkan pasir putih yang lembut dan pemandangan yang memukau. Pantai ini cocok untuk bersantai atau menikmati berbagai aktivitas air seperti berperahu atau banana boat.", "image" => "https://tse1.mm.bing.net/th?id=OIP.sXLxi6loenyZI6Yl5GptIgHaE7&pid=Api&P=0&h=220"],
            ["name" => "Pantai Kupa-Kupa", "description" => "Pantai Kupa-Kupa yang terletak di Kabupaten Takalar ini memiliki pasir putih yang bersih dan air laut yang tenang, cocok untuk berenang dan menikmati pemandangan alam yang menenangkan.", "image" => "https://tse1.mm.bing.net/th?id=OIP.P0Al0FgsZ9Yakd6h3nPdnQHaEc&pid=Api&P=0&h=220"],
            ["name" => "Pantai Tanjung Karang", "description" => "Pantai Tanjung Karang terletak di Kabupaten Pangkep. Pantai ini menawarkan keindahan alam yang luar biasa dengan pemandangan laut yang luas, serta hamparan pasir putih yang bersih. Ideal untuk bersantai atau menikmati berbagai kegiatan air.", "image" => "https://tse2.mm.bing.net/th?id=OIP.xtBQB2D92lhEZ34Z135g8AHaFY&pid=Api&P=0&h=220"],
            ["name" => "Pantai Tanjung Bunga", "description" => "Pantai Tanjung Bunga yang terletak di Kabupaten Gowa memiliki pantai dengan pasir putih yang lembut dan perairan yang jernih. Pantai ini cocok untuk berenang atau menikmati ketenangan alam.", "image" => "https://tse3.mm.bing.net/th?id=OIP._26-pM4_On61dQgIP_d5zwHaEt&pid=Api&P=0&h=220"],
            ["name" => "Pantai Barombong", "description" => "Pantai Barombong adalah destinasi wisata yang menyajikan pemandangan laut yang biru dan hamparan pasir putih. Pantai ini sangat cocok untuk kegiatan seperti bermain air, berjemur, dan menikmati angin laut yang sejuk.", "image" => "https://tse3.mm.bing.net/th?id=OIP.k8Jim3eepBix97z8n62i9wHaE8&pid=Api&P=0&h=220"],
            ["name" => "Pantai Kodingareng", "description" => "Pantai Kodingareng terletak di pulau kecil yang tidak jauh dari Makassar. Pulau ini menawarkan keindahan pantai yang masih alami dan perairan yang jernih, sangat cocok untuk snorkeling dan diving. Pulau Kodingareng adalah pilihan sempurna bagi mereka yang ingin menikmati ketenangan jauh dari keramaian kota.", "image" => "https://tse1.mm.bing.net/th?id=OIP.OWEgaaHVLeOZ59TWVXRvEQHaEK&pid=Api&P=0&h=220"],
            ["name" => "Pantai Barrang Caddi", "description" => "Pantai Barrang Caddi terletak di Pulau Barrang Lompo, Makassar. Pantai ini menawarkan keindahan alam yang eksotis dengan pasir putih dan perairan yang jernih. Keindahan terumbu karang dan kehidupan bawah laut yang kaya menjadikan pantai ini populer di kalangan para penyelam.", "image" => "https://tse4.mm.bing.net/th?id=OIP.pVKC49yQKM5CeBYDocWLUAHaEK&pid=Api&P=0&h=220"],
            ["name" => "Pantai Poto Batu", "description" => "Pantai Poto Batu di Kabupaten Sinjai dikenal dengan keindahan batu-batu besar yang tersebar di sepanjang pantai dan perairan yang jernih. Pantai ini masih alami dan menawarkan ketenangan bagi pengunjung yang ingin jauh dari keramaian.", "image" => "https://tse4.mm.bing.net/th?id=OIP.unxDHpozGyqI0hlIS7JLcQHaEr&pid=Api&P=0&h=220"]
        ];
        

        // Menampilkan data pantai
        foreach ($beaches as $beach) {
            echo '<div class="beach-card">
                    <img src="' . $beach["image"] . '" alt="' . $beach["name"] . '">
                    <h4>' . $beach["name"] . '</h4>
                    <p>' . $beach["description"] . '</p>
                </div>';
        }
        ?>

        <!-- Tombol Profil (gambar) -->
        <div class="profile-img-container">
            <img src="https://img.freepik.com/premium-vector/vector-flat-illustration-grayscale-avatar-user-profile-person-icon-profile-picture-business-profile-woman-suitable-social-media-profiles-icons-screensavers-as-templatex9_719432-1339.jpg" alt="Foto Profil" title="Klik untuk Lihat Profil" onclick="location.href='profil.php';">
            <p><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Pengguna Tidak Terdaftar'; ?></p>
        </div>

        <!-- Tombol Keluar -->
        <a href="?keluar=true"><button>Log Out</button></a>
    </div>
</body>
</html>

