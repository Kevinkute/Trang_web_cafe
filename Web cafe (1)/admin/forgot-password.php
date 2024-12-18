<?php
include('connection.php');

$message = ""; // Biến lưu thông báo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = $_POST['username_or_email'];

    // Kiểm tra xem tài khoản tồn tại không
    $query = "SELECT * FROM account_inf WHERE username = ? OR email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username_or_email, $username_or_email]);

    if ($stmt->rowCount() > 0) {
        // Tạo mã khôi phục ngẫu nhiên
        $reset_code = bin2hex(random_bytes(16));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Cập nhật mã khôi phục trong cơ sở dữ liệu
        $update_query = "UPDATE account_inf SET reset_code = ? WHERE id = ?";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->execute([$reset_code, $user['id']]);

        $reset_link = "http://localhost/reset-password.php?code=$reset_code";
        $to = $user['email'];
        $subject = "Khôi phục mật khẩu";
        $message = "Chào bạn, nhấn vào liên kết sau để đặt lại mật khẩu của bạn: $reset_link";
        $headers = "From: admin@coffee-shop.com";

        // Giả lập gửi email (thực tế bạn có thể dùng PHPMailer hoặc hàm `mail`)
        // mail($to, $subject, $message, $headers);

        $message = "Liên kết khôi phục đã được gửi đến email của bạn. Vui lòng kiểm tra!";
    } else {
        $message = "Tài khoản không tồn tại!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="admin-styles.css">
</head>
<body>
    <!-- Thanh điều hướng -->
    <header class="navbar">
        <div class="logo">
            <a href="../index.html">
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

    <!-- Form Quên Mật Khẩu -->
    <main class="account-list-container">
        <h2>Quên Mật Khẩu</h2>
        <?php if ($message): ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form action="forgot-password.php" method="POST" class="form-container">
            <div class="form-group">
                <label for="username_or_email">Tên đăng nhập hoặc Email:</label>
                <input type="text" id="username_or_email" name="username_or_email" placeholder="Nhập tên đăng nhập hoặc email" required>
            </div>
            <button type="submit" class="submit-btn">Gửi yêu cầu</button>
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Coffee Shop. Tất cả quyền được bảo vệ.</p>
    </footer>
</body>
</html>
