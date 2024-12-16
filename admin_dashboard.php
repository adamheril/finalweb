<?php
session_start();

// Pastikan hanya admin yang dapat mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Simulasi data pantai yang bisa dikelola
$beaches = [
    ["id" => 1, "name" => "Pantai Losari", "description" => "Pantai yang terletak di pusat kota Makassar ini terkenal sebagai salah satu destinasi wisata paling ikonik di Sulawesi Selatan. Dikenal dengan pemandangan matahari terbenam yang spektakuler, Pantai Losari juga menjadi tempat berkumpul bagi warga lokal dan wisatawan.", "image" => "https://tse2.mm.bing.net/th?id=OIP.9ksx5b1eYr---wZx7qhZtAHaDt&pid=Api&P=0&h=220"],
    ["id" => 2, "name" => "Pantai Bira", "description" => "Pantai ini menawarkan pasir putih yang luas dengan perairan yang sangat jernih, cocok untuk berbagai kegiatan air seperti snorkeling dan diving. Terletak di daerah pesisir barat Sulawesi Selatan, Bira juga dikenal dengan keindahan terumbu karangnya.", "image" => "https://tse1.mm.bing.net/th?id=OIP.ez7T4FG37FTIe_IkqGodMQHaEc&pid=Api&P=0&h=220"],
    ["id" => 3, "name" => "Pantai Tanjung Bayang", "description" => "Pantai Tanjung Bayang terletak tidak jauh dari Makassar, menawarkan pasir putih yang lembut dan pemandangan yang memukau. Pantai ini cocok untuk bersantai atau menikmati berbagai aktivitas air seperti berperahu atau banana boat.", "image" => "https://tse1.mm.bing.net/th?id=OIP.sXLxi6loenyZI6Yl5GptIgHaE7&pid=Api&P=0&h=220"],
    ["id" => 4, "name" => "Pantai Kupa-Kupa", "description" => "Pantai Kupa-Kupa yang terletak di Kabupaten Takalar ini memiliki pasir putih yang bersih dan air laut yang tenang, cocok untuk berenang dan menikmati pemandangan alam yang menenangkan.", "image" => "https://tse1.mm.bing.net/th?id=OIP.P0Al0FgsZ9Yakd6h3nPdnQHaEc&pid=Api&P=0&h=220"],
    ["id" => 5, "name" => "Pantai Tanjung Karang", "description" => "Pantai Tanjung Karang terletak di Kabupaten Pangkep. Pantai ini menawarkan keindahan alam yang luar biasa dengan pemandangan laut yang luas, serta hamparan pasir putih yang bersih. Ideal untuk bersantai atau menikmati berbagai kegiatan air.", "image" => "https://tse2.mm.bing.net/th?id=OIP.xtBQB2D92lhEZ34Z135g8AHaFY&pid=Api&P=0&h=220"],
    ["id" => 6, "name" => "Pantai Tanjung Bunga", "description" => "Pantai Tanjung Bunga yang terletak di Kabupaten Gowa memiliki pantai dengan pasir putih yang lembut dan perairan yang jernih. Pantai ini cocok untuk berenang atau menikmati ketenangan alam.", "image" => "https://tse3.mm.bing.net/th?id=OIP._26-pM4_On61dQgIP_d5zwHaEt&pid=Api&P=0&h=220"],
    ["id" => 7, "name" => "Pantai Barombong", "description" => "Pantai Barombong adalah destinasi wisata yang menyajikan pemandangan laut yang biru dan hamparan pasir putih. Pantai ini sangat cocok untuk kegiatan seperti bermain air, berjemur, dan menikmati angin laut yang sejuk.", "image" => "https://tse3.mm.bing.net/th?id=OIP.k8Jim3eepBix97z8n62i9wHaE8&pid=Api&P=0&h=220"],
    ["id" => 8, "name" => "Pantai Kodingareng", "description" => "Pantai Kodingareng terletak di pulau kecil yang tidak jauh dari Makassar. Pulau ini menawarkan keindahan pantai yang masih alami dan perairan yang jernih, sangat cocok untuk snorkeling dan diving. Pulau Kodingareng adalah pilihan sempurna bagi mereka yang ingin menikmati ketenangan jauh dari keramaian kota.", "image" => "https://tse1.mm.bing.net/th?id=OIP.OWEgaaHVLeOZ59TWVXRvEQHaEK&pid=Api&P=0&h=220"],
    ["id" => 9, "name" => "Pantai Barrang Caddi", "description" => "Pantai Barrang Caddi terletak di Pulau Barrang Lompo, Makassar. Pantai ini menawarkan keindahan alam yang eksotis dengan pasir putih dan perairan yang jernih. Keindahan terumbu karang dan kehidupan bawah laut yang kaya menjadikan pantai ini populer di kalangan para penyelam.", "image" => "https://tse4.mm.bing.net/th?id=OIP.pVKC49yQKM5CeBYDocWLUAHaEK&pid=Api&P=0&h=220"],
    ["id" => 10, "name" => "Pantai Poto Batu", "description" => "Pantai Poto Batu di Kabupaten Sinjai dikenal dengan keindahan batu-batu besar yang tersebar di sepanjang pantai dan perairan yang jernih. Pantai ini masih alami dan menawarkan ketenangan bagi pengunjung yang ingin jauh dari keramaian.", "image" => "https://tse4.mm.bing.net/th?id=OIP.unxDHpozGyqI0hlIS7JLcQHaEr&pid=Api&P=0&h=220"]
];

// Logika untuk menambah, mengedit, atau menghapus pantai
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        $newBeach = ['id' => count($beaches) + 1, 'name' => $_POST['name'], 'description' => $_POST['description'], 'image' => $_POST['image']];
        $beaches[] = $newBeach;
        $message = "Pantai baru berhasil ditambahkan!";
    }
    if ($_POST['action'] === 'delete' && isset($_POST['id'])) {
        foreach ($beaches as $key => $beach) {
            if ($beach['id'] === (int)$_POST['id']) {
                unset($beaches[$key]);
                $message = "Pantai berhasil dihapus!";
                break;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Beach Content</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #282c34;
            background-image: url('https://img.freepik.com/free-photo/tropical-beach-with-white-sand_1203-1710.jpg?t=st=1734356008~exp=1734359608~hmac=ee798742d8946a27a9ccc062c0e648e89c7edd8ee0acf842fe440ffa8d69764e&w=996'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed; 
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .dashboard {
            padding: 20px;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            width: 80%;
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            font-size: 36px;
            color: #ffdd57;
        }

        .content-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .content-table th, .content-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .content-table th {
            background-color: #333;
            color: #fff;
        }

        .content-table tr:nth-child(even) {
            background-color: #444;
        }

        .content-table tr:hover {
            background-color: #555;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group input,
        .form-group textarea {
            width: 80%;
            max-width: 500px;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .form-group button {
            width: 80%;
            max-width: 500px;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .message {
            margin: 20px 0;
            padding: 15px;
            background-color: #28a745;
            color: #fff;
            border-radius: 5px;
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            max-width: 200px;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Manage Beach Content</h1>
        <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>! Anda dapat mengelola daftar pantai di sini.</p>

        <?php if (isset($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="form-group">
            <h2>Tambah Pantai</h2>
            <form method="POST">
                <input type="hidden" name="action" value="add">
                <input type="text" name="name" placeholder="Nama Pantai" required>
                <textarea name="description" rows="4" placeholder="Deskripsi Pantai" required></textarea>
                <input type="text" name="image" placeholder="URL Gambar Pantai" required>
                <button type="submit">Tambah Pantai</button>
            </form>
        </div>

        <h2>Daftar Pantai</h2>
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
                        <td><?php echo $beach['name']; ?></td>
                        <td><?php echo $beach['description']; ?></td>
                        <td><img src="<?php echo $beach['image']; ?>" alt="Image" style="width: 50px;"></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $beach['id']; ?>">
                                <button type="submit" style="background-color: #dc3545; color: white;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Button Logout -->
        <form action="logout.php" method="POST">
            <button type="submit" class="logout-btn">Log Out</button>
        </form>
    </div>
</body>
</html>


