<?php
session_start();
// Cek apakah pengguna sudah login dan memiliki peran sebagai user
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: index.php'); // Arahkan ke halaman index.php jika bukan user
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: "Cambria", serif;
            background-image: url("https://img.freepik.com/free-photo/aerial-view-beach-washed-by-blue-ocean-water-indonesia_181624-51814.jpg?semt=ais_tags_boosted");
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }

        .dashboard {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 100%;
            max-width: 500px;
            opacity: 0;
            transform: translateY(-50px);
            transition: all 1s ease-out;
        }

        h1 {
            font-size: 32px;
            color: #D1D1D1; /* Kuning abu-abu */
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            margin: 20px 10px;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .btn.daftar, .btn.masuk {
            background-color: #ADD8E6; /* Biru muda */
            color: white;
        }

        .btn.daftar:hover, .btn.masuk:hover {
            background-color: #87CEEB; /* Biru muda lebih tua saat hover */
        }

        .btn.logout, .btn.keluar {
            background-color: red;
            color: white;
        }

        .btn.logout:hover, .btn.keluar:hover {
            background-color: #800000; /* Merah maroon saat hover */
        }

        .logout {
            display: block;
            margin-top: 20px;
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

            h1 {
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
        <h1>Dashboard User</h1>
        <p>Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <p>Anda masuk sebagai <strong>User</strong>.</p>
        <!-- Tombol logout yang mengarah ke logout.php -->
        <a href="logout.php" class="btn logout" onmouseover="hoverButton(this)" onmouseout="unhoverButton(this)">Logout</a>
    </div>

    <script>
        // Fungsi untuk animasi muncul
        window.onload = function() {
            const dashboard = document.getElementById('dashboard');
            dashboard.style.opacity = '1';
            dashboard.style.transform = 'translateY(0)';
        };

        // Fungsi hover tombol
        function hoverButton(button) {
            button.style.transform = 'scale(1.05)'; // Efek zoom
            button.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.3)'; // Bayangan
        }

        // Fungsi unhover tombol
        function unhoverButton(button) {
            button.style.transform = 'scale(1)'; // Ukuran normal
            button.style.boxShadow = 'none'; // Hilangkan bayangan
        }
    </script>
</body>
</html>


