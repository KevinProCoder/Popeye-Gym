<!DOCTYPE html>
<html>
<head>
    <title>Register - POPEYE GYM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2 style="color: #ffcc00; font-family: 'Black Ops One';">BECOME A MEMBER</h2>
        <form action="process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="register" class="btn" style="width: 310px; margin-top: 10px;">REGISTER NOW</button>
        </form>
        <p>SUDAH PUNYA AKUN? <a href="index.php" style="color: #ffcc00;">LOGIN DI SINI</a></p>
    </div>
</body>
</html>