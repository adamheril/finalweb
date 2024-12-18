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

// Inisialisasi variabel untuk form login
$username = "";
$password = "";

// Proses login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengecek apakah username adalah admin dan password adalah sessajaki
    if ($username == 'admin' && $password == 'sessajaki') {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin'; // Set role admin

        // Menghapus cookie sebelumnya jika ada
        setcookie('username', '', time() - 3600, "/");

        // Menyimpan cookie untuk admin jika "Remember Me" diklik
        setcookie('username', $username, time() + 60, "/"); // Cookie selama 1 menit

        // Arahkan admin langsung ke halaman dashboard
        header('Location: admin_dashboard.php');
        exit();
    } else {
        // Query untuk memeriksa apakah username ada dalam database
        $sql = "SELECT * FROM tbl_regis WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Mengambil data pengguna dari database
            $user = $result->fetch_assoc();

            // Memeriksa apakah password yang dimasukkan sesuai
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];

                // Menghapus cookie sebelumnya jika ada
                setcookie('username', '', time() - 3600, "/");

                // Menyimpan cookie selama 1 menit
                setcookie('username', $user['username'], time() + 60, "/");

                // Redirect ke halaman index
                header('Location: index.php');
                exit();
            } else {
                $error_message = "Password salah.";
            }
        } else {
            $error_message = "Username tidak ditemukan.";
        }

        $stmt->close();
    }
}

// Memeriksa cookie 'username' untuk sesi otomatis jika belum login
if (isset($_COOKIE['username']) && !isset($_SESSION['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $username = $_COOKIE['username']; // Isi form dengan username dari cookie
} else if (!isset($_SESSION['username'])) {
    // Jika cookie sudah kedaluwarsa, pastikan kolom username kosong
    setcookie('username', '', time() - 3600, "/");
    $username = ""; // Kosongkan kolom username
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            width: 100%;
            color: #fff;
            overflow: hidden;
        }

        .login-form {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            position: relative;
        }

        .login-form h2 {
            margin-bottom: 20px;
            color: #ffdd57; /* Warna judul sesuai tema */
        }

        .login-form form {
            display: flex;
            flex-direction: column;
        }

        .login-form input, .login-form button {
            width: 100%;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        .login-form input {
            font-size: 16px;
        }

        .login-form button {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
            font-size: 18px;
        }

        .login-form button:hover {
            background-color: rgb(71, 138, 226);
        }

        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
        }

        .back-btn {
            position: absolute;
            top: 20px;
            right: 20px;
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

        .login-form .remember-me {
            text-align: center;
            margin-bottom: 20px;
        }

        .remember-me label {
            color: #007BFF;
            font-size: 16px;
            font-style: italic; /* Menambahkan gaya miring pada tulisan */
            cursor: pointer;
        }

        .remember-me label:hover {
            color: #0056b3;
        }

        /* Menghilangkan kotak centang */
        .remember-me input[type="checkbox"] {
            display: none;
        }

    </style>
</head>
<body>
    <button class="back-btn" onclick="window.location.href='utama.php'">Kembali</button>

    <div class="login-form">
        <h2>Login</h2>
        <form method="POST" action="" autocomplete="off">
            <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" required><br>
            <input type="password" name="password" placeholder="Password" value="" required><br>
            <div class="remember-me">
                <!-- Menampilkan label "Remember Me" tanpa kotak centang -->
                <label>Remember Me</label>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        
        <?php
            if (isset($error_message)) {
                echo '<p class="error-message">' . $error_message . '</p>';
            }
        ?>
    </div>

    <script>
        // Animasi pada form login saat dimuat
        window.onload = function() {
            const form = document.querySelector('.login-form');
            form.style.animation = 'fadeIn 1s ease-out';
        }

        // Keyframes untuk animasi fadeIn
        const styleSheet = document.styleSheets[0];
        styleSheet.insertRule(`
            @keyframes fadeIn {
                0% { opacity: 0; transform: translateY(-50px); }
                100% { opacity: 1; transform: translateY(0); }
            }
        `, styleSheet.cssRules.length);

        // Animasi hover pada input
        const inputs = document.querySelectorAll('.login-form input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                input.style.transform = 'scale(1.05)';
            });
            input.addEventListener('blur', function() {
                input.style.transform = 'scale(1)';
            });
        });

        // Animasi pada tombol login
        const button = document.querySelector('.login-form button');
        button.addEventListener('mouseover', function() {
            button.style.transform = 'scale(1.05)';
        });
        button.addEventListener('mouseout', function() {
            button.style.transform = 'scale(1)';
        });
    </script>
</body>
</html>






