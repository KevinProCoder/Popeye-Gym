<?php
session_start();
session_destroy(); // Menghapus semua session login
header("Location: index.php"); // Kembali ke halaman register
exit();
?>