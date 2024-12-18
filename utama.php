<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Pantai Sulawesi Selatan</title>
    <style>
        body {
            font-family: "Cambria", serif;
            background-image: url('https://img.freepik.com/free-photo/aerial-view-beach-washed-by-blue-ocean-water-indonesia_181624-51814.jpg?semt=ais_tags_boosted');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            color: #fff;
            text-align: center;
        }

        .header-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .header-button .button {
            padding: 8px 20px;
            font-size: 14px;
            color: white;
            background-color: #ADD8E6; /* Biru muda */
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .welcome-box {
            margin-top: 150px;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 60%;
            max-width: 600px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            margin-left: auto;
            margin-right: auto;
            opacity: 0;
            transform: translateY(-50px);
        }

        .welcome-box h1 {
            font-size: 36px;
            margin-bottom: 15px;
            color: #D1D1D1; /* Kuning abu-abu */
        }

        .welcome-box p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-container .button {
            padding: 12px 25px;
            font-size: 16px;
            color: white;
            background-color: #ADD8E6; /* Biru muda */
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .about-button {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 14px;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

    </style>
</head>
<body>

    <!-- Tombol "Tentang Kami" di kiri atas -->
    <a href="about.php" class="about-button">Tentang Kami</a>

    <!-- Tombol Daftar di kanan atas -->
    <div class="header-button">
        <form action="registrasi.php" method="GET">
            <button type="submit" class="button" onmouseover="hoverButton(this)" onmouseout="unhoverButton(this)">Daftar</button>
        </form>
    </div>

    <!-- Kontainer utama dengan tombol Masuk -->
    <div class="welcome-box" id="welcomeBox">
        <h1>Temukan pesona pantai Sulawesi : Surga tersembunyi di bawah air</h1>
        <p>Saran destinasi untuk Menjelajahi keindahan pasir putih dan terumbung karang pada surga tersembunyi di bawah laut.</p>
        <div class="button-container">
            <form action="login.php" method="GET">
                <button type="submit" class="button" onmouseover="hoverButton(this)" onmouseout="unhoverButton(this)">Masuk</button>
            </form>
        </div>
    </div>

    <script>
        // Fungsi untuk mengubah warna tombol saat mouse hover
        function hoverButton(button) {
            button.style.backgroundColor = '#87CEEB'; // Warna lebih tua saat hover
            button.style.transform = 'scale(1.1)'; // Efek zoom
            button.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.2)'; // Bayangan lebih besar
        }

        // Fungsi untuk mengembalikan ke kondisi semula
        function unhoverButton(button) {
            button.style.backgroundColor = '#ADD8E6'; // Warna biru muda normal
            button.style.transform = 'scale(1)'; // Kembali ke ukuran normal
            button.style.boxShadow = 'none'; // Hilangkan bayangan
        }

        // Animasi muncul saat halaman dimuat
        window.onload = function() {
            const welcomeBox = document.getElementById('welcomeBox');
            welcomeBox.style.transition = 'all 1s ease-out';
            welcomeBox.style.opacity = '1';
            welcomeBox.style.transform = 'translateY(0)';
        };
    </script>

</body>
</html>

