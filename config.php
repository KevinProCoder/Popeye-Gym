<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "rusdibros_db";

// Pastikan variabelnya bernama $conn
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>