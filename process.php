<?php
// 1. Letakkan kode ini di paling atas untuk menangkap error jika terjadi masalah
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';
session_start();

// --- LOGIKA LOGIN ---
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Ambil data user berdasarkan username
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password (menggunakan password_verify karena di register kita pakai password_hash)
        if ($user && password_verify($password, $user['password'])) {
            // Login Berhasil
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            header("Location: dashboard.php");
            exit(); 
        } else {
            // Login Gagal (Password salah atau user tidak ditemukan)
            header("Location: index.php?error=login_failed");
            exit();
        }
    } else {
        die("Kesalahan Database: " . mysqli_error($conn));
    }
}

// --- LOGIKA REGISTER ---
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        die("Gagal Register: " . mysqli_error($conn));
    }
}

// --- LOGIKA BUY / RENEW MEMBERSHIP ---
if (isset($_POST['buy_membership'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $package = mysqli_real_escape_string($conn, $_POST['package']);
    
    $duration = 1;
    if ($package == '3 Months') $duration = 3;
    elseif ($package == '6 Months') $duration = 6;
    elseif ($package == 'Yearly') $duration = 12;
    
    $start_date = date('Y-m-d');
    $end_date = date('Y-m-d', strtotime("+$duration month"));

    $sql = "INSERT INTO memberships (user_id, package_name, start_date, end_date, payment_status) 
            VALUES ('$user_id', '$package', '$start_date', '$end_date', 'paid')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php?status=success");
        exit();
    } else {
        die("Gagal memproses paket: " . mysqli_error($conn));
    }
}

// --- LOGIKA CANCEL MEMBERSHIP ---
if (isset($_GET['cancel_id'])) {
    $membership_id = mysqli_real_escape_string($conn, $_GET['cancel_id']);
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM memberships WHERE id = '$membership_id' AND user_id = '$user_id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php?status=canceled");
        exit();
    }
}
?>