<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Pantai Sulawesi Selatan</title>
    <style>
        body {
            font-family: Cambria, serif;
            background-image: url('https://img.freepik.com/free-photo/aerial-view-beach-washed-by-blue-ocean-water-indonesia_181624-51814.jpg?semt=ais_tags_boosted');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
            text-align: center;
        }

        .logout-box {
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 60%;
            max-width: 600px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }

        .logout-box h1 {
            font-size: 36px;
            margin-bottom: 15px;
            color: #ffdd57; /* Warna judul sesuai tema */
        }

        .logout-box p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .logout-box button {
            padding: 12px 25px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            margin: 5px;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .logout-box button:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }

        .logout-box form {
            display: inline;
        }
    </style>
</head>
<body>

    <div class="logout-box">
        <h1>Apakah Anda Yakin Ingin Logout?</h1>
        <p>Anda dapat kembali ke halaman registrasi atau kembali ke dashboard admin.</p>
        
        <!-- Tombol OK untuk kembali ke registrasi.php -->
        <form action="registrasi.php" method="GET">
            <button type="submit">OK</button>
        </form>
        
        <!-- Tombol Kembali untuk kembali ke admin_dashboard.php -->
        <form action="admin_dashboard.php" method="GET">
            <button type="submit">Kembali</button>
        </form>
    </div>

    <script>
        // Efek animasi pada tombol saat di-hover
        const buttons = document.querySelectorAll('.logout-box button');

        buttons.forEach(button => {
            // Efek animasi saat mouse masuk ke tombol
            button.addEventListener('mouseover', () => {
                button.style.transform = 'scale(1.1)';
            });

            // Efek animasi saat mouse keluar dari tombol
            button.addEventListener('mouseout', () => {
                button.style.transform = 'scale(1)';
            });
        });

        // Efek animasi pada kotak logout
        const logoutBox = document.querySelector('.logout-box');

        window.addEventListener('load', () => {
            logoutBox.style.animation = 'fadeIn 1s ease-out';
        });

        // Keyframes untuk animasi fadeIn
        const styleSheet = document.styleSheets[0];
        styleSheet.insertRule(`
            @keyframes fadeIn {
                0% { opacity: 0; transform: translateY(-30px); }
                100% { opacity: 1; transform: translateY(0); }
            }
        `, styleSheet.cssRules.length);
    </script>

</body>
</html>



