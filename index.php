<!DOCTYPE html>
<html>
<head>
    <title>Login - POPEYE GYM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="margin-top: 100px;">
        <h1 style="color: #ffcc00; font-size: 3.5em; margin-bottom: 0; font-family: 'Black Ops One';">POPEYE GYM</h1>
        <p style="letter-spacing: 8px; margin-bottom: 30px; color: #ffffff;">EAT YOUR SPINACH</p>
        
        <form action="process.php" method="POST">
            <input type="text" name="username" placeholder="USERNAME" required><br>
            <input type="password" name="password" placeholder="PASSWORD" required><br>
            <button type="submit" name="login" class="btn" style="width: 310px;">ENTER THE GYM</button>
        </form>
        <p>BELUM PUNYA AKUN? <a href="register.php" style="color: #ffcc00;">DAFTAR DISINI</a></p>
    </div>
</body>
</html>