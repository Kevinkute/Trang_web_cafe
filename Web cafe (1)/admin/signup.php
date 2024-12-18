<?php
include('connection.php');

$message = ""; // Biến lưu thông báo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "Mật khẩu không khớp!";
    } else {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Kiểm tra tên đăng nhập đã tồn tại
        $query = "SELECT * FROM account_inf WHERE username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            $message = "Tên đăng nhập đã tồn tại!";
        } else {
            // Thêm tài khoản vào cơ sở dữ liệu
            $query = "INSERT INTO account_inf (username, password, admin) VALUES (?, ?, 0)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, $password]);
            $message = "Đăng ký thành công! <a href='../login.php'>Đăng nhập ngay</a>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
    <link rel="stylesheet" href="admin-styles.css">
</head>
<body>
    <!-- Thanh điều hướng -->
    <header class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="../images/logo.png" alt="Logo">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="../index.html">Trang chủ</a></li>
                <li><a href="../login.php">Đăng nhập</a></li>
            </ul>
        </nav>
    </header>

    <!-- Form Đăng Ký -->
    <main class="account-list-container">
        <h2>Đăng Ký Tài Khoản</h2>
        <?php if ($message): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form action="signup.php" method="POST" class="form-container">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Xác nhận mật khẩu:</label>
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
            </div>
            <button type="submit" class="submit-btn">Đăng Ký</button>
            <p class="signup-link">Đã có tài khoản? <a href="../login.php">Đăng nhập ngay</a></p>
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Coffee Shop. Tất cả quyền được bảo vệ.</p>
    </footer>
</body>
</html>
