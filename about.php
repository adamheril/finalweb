<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Pengenalan Website</title>
    <style>
        body {
            font-family: 'Cambria', serif;
            background-image: url("https://img.freepik.com/free-photo/aerial-view-beach-washed-by-blue-ocean-water-indonesia_181624-51814.jpg?semt=ais_tags_boosted");
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100%;
            color: #fff;
            overflow: hidden;
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
            width: 90%; 
            max-width: 700px;
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); 
            text-align: center;
            backdrop-filter: blur(10px);
            max-height: 75vh;
            overflow-y: auto;
            scrollbar-width: none;
            opacity: 0; /* Initial hidden state */
            transform: translateY(20px); /* Start position */
        }

        .profil-card h2 {
            margin-bottom: 20px;
            font-size: 32px;
            color: #ffdd57;
        }

        .profil-card p {
            font-size: 20px;
            color: #ddd;
            margin: 10px 0;
        }

        .pantai-data img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .back-button {
            margin-top: 20px;
            text-align: center;
        }

        .back-button a {
            padding: 12px 24px;
            background-color: #fff;
            color: #000;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
        }

        .back-button a:hover {
            background-color: #f0f0f0;
        }

        .back-button-top {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: rgba(255, 255, 255, 0.6);
            color: #000;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            opacity: 0; /* Initial hidden state */
        }

        .back-button-top:hover {
            background-color: rgba(255, 255, 255, 0.8);
        }

    </style>
</head>
<body>

    <!-- Tombol "Kembali" di kanan atas dengan transparansi -->
    <a href="utama.php" class="back-button-top">Kembali</a>

    <div class="profil-container">
        <div class="profil-card">
            <!-- Menampilkan informasi tentang pantai -->
            <h2>Mengenai Website</h2>
            <p>Website ini memberikan informasi mengenai berbagai pantai yang ada di sekitar kita. Salah satu contoh pantai yang kami tampilkan adalah:</p>

            <div class="pantai-data">
                <h3>Pantai Bira</h3>
                <!-- Menampilkan foto pantai -->
                <img src="https://tse1.mm.bing.net/th?id=OIP.ez7T4FG37FTIe_IkqGodMQHaEc&pid=Api&P=0&h=220" alt="Pantai Bira">
                <p><strong>Deskripsi:</strong> Pantai ini menawarkan pasir putih yang luas dengan perairan yang sangat jernih, cocok untuk berbagai kegiatan air seperti snorkeling dan diving. Terletak di daerah pesisir barat Sulawesi Selatan, Bira juga dikenal dengan keindahan terumbu karangnya.</p>
            </div>

            <div class="back-button">
                <a href="login.php">Login</a>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk memulai animasi fade in pada profil card
        window.addEventListener('load', function() {
            const profilCard = document.querySelector('.profil-card');
            const backButtonTop = document.querySelector('.back-button-top');
            
            // Animasi profil card
            profilCard.style.transition = 'opacity 1s ease, transform 1s ease';
            profilCard.style.opacity = '1';
            profilCard.style.transform = 'translateY(0)';
            
            // Animasi tombol kembali
            backButtonTop.style.transition = 'opacity 1s ease 0.5s'; // Delay untuk tombol
            backButtonTop.style.opacity = '1';
        });
    </script>

</body>
</html>
