<?php
$servername = "localhost";
$username = "root";
$password = "adamheril";
$dbname = "db_registrasi";

$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);

}
?>