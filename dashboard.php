<?php 
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - POPEYE GYM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <h2>POPEYE GYM</h2>
        <div class="user-info">
            Halo, <strong><?php echo strtoupper($_SESSION['username']); ?></strong> | 
            <a href="logout.php">LOGOUT</a>
        </div>
    </nav>

    <div class="container">
        <?php if(isset($_GET['status'])): ?>
            <div style="margin-bottom: 20px; font-weight: bold;">
                <?php if($_GET['status'] == 'success'): ?>
                    <span style="color: #2ecc71;">✓ PEMESANAN BERHASIL!</span>
                <?php elseif($_GET['status'] == 'canceled'): ?>
                    <span style="color: #ffcc00;">! PAKET TELAH DIBATALKAN</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <h2 style="border-bottom: 3px solid #ffcc00; display: inline-block; padding-bottom: 5px; color: #ffcc00;">
            MEMBERSHIP STATUS
        </h2>

        <?php
        $uid = $_SESSION['user_id'];
        $res = mysqli_query($conn, "SELECT * FROM memberships WHERE user_id = '$uid' ORDER BY id DESC LIMIT 1");
        $data = mysqli_fetch_assoc($res);

        if ($data) {
            echo "<h3 style='color: #ffcc00; margin-top: 10px;'>● ACTIVE MEMBER</h3>";
        } else {
            echo "<h3 style='color: #555; margin-top: 10px;'>● NO ACTIVE PLAN</h3>";
        }
        ?>

        <div class="status-box">
            <?php
            if ($data) {
                echo "<p style='font-size: 1.2em;'>PAKET: <b style='color: #ffcc00;'>" . strtoupper($data['package_name']) . "</b></p>";
                echo "<p>MASA BERLAKU: <br> <b>" . $data['start_date'] . "</b> s/d <b style='color: #ffcc00;'>" . $data['end_date'] . "</b></p>";
                echo "<a href='process.php?cancel_id={$data['id']}' class='btn-cancel' onclick='return confirm(\"BATALKAN?\")'>CANCEL MEMBERSHIP</a>";
            } else {
                echo "<p>Pilih paket di bawah untuk mulai latihan.</p>";
            }
            ?>
        </div>

        <div style="margin: 40px 0;">
            <h3 style="letter-spacing: 4px; color: #ffcc00;">CHOOSE YOUR PACKAGE</h3>
            <div style="width: 50px; height: 4px; background: #ffcc00; margin: 10px auto;"></div>
        </div>

        <div class="pricing">
            <?php 
            $packages = [
                ['name' => 'Monthly', 'price' => '150.000'],
                ['name' => '3 Months', 'price' => '400.000'],
                ['name' => '6 Months', 'price' => '750.000'],
                ['name' => 'Yearly', 'price' => '1.200.000']
            ];
            foreach($packages as $p): ?>
            <div class="card">
                <h4><?php echo strtoupper($p['name']); ?></h4>
                <p style="font-weight: bold;">RP <?php echo $p['price']; ?></p>
                <form action="process.php" method="POST">
                    <input type="hidden" name="package" value="<?php echo $p['name']; ?>">
                    <button type="submit" name="buy_membership" class="btn">SELECT</button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer style="margin-top: 50px; padding: 20px; color: #444; font-size: 0.8em; text-align: center;">
        POPEYE GYM &copy; 2026 - POWERED BY RUSDI BROS
    </footer>
</body>
</html>