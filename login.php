<?php
session_start();

// Fungsi untuk autentikasi
function login($username, $password) {
    $users = [
        'admin' => ['password' => 'sessajaki', 'role' => 'admin'],
        'user' => ['password' => 'pusingdahlu', 'role' => 'user']
    ];

    // Mengecek apakah username ada dan passwordnya benar
    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role'];
        return true;
    }
    return false;
}

// Proses login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (login($username, $password)) {
        // Arahkan berdasarkan role user
        if ($_SESSION['role'] === 'admin') {
            header('Location: admin_dashboard.php'); // Arahkan ke dashboard admin
        } elseif ($_SESSION['role'] === 'user') {
            header('Location: index.php'); // Arahkan ke halaman index untuk user
        }
        exit();
    } else {
        $error_message = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("https://img.freepik.com/free-photo/tropical-beach-with-white-sand_1203-1710.jpg?t=st=1734356008~exp=1734359608~hmac=ee798742d8946a27a9ccc062c0e648e89c7edd8ee0acf842fe440ffa8d69764e&w=996");
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
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .login-form h2 {
            margin-bottom: 20px;
            color: #ffdd57;
        }

        .login-form form {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form input, .login-form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        .login-form button {
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
        </form>
        <?php
            if (isset($error_message)) {
                echo '<p class="error-message">' . $error_message . '</p>';
            }
        ?>
    </div>
</body>
</html>



