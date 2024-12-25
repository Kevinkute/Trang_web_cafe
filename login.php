<?php
// Kết nối đến cơ sở dữ liệu
include('admin/connection.php');

// Khởi tạo biến lỗi để hiển thị thông báo
$error_message = '';

// Kiểm tra nếu người dùng đã gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM account_inf WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Kiểm tra nếu có kết quả
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Kiểm tra nếu người dùng là admin
        if ($user['admin'] == 1) {
            // Nếu là admin, chuyển hướng tới trang admin.php
            header('Location: admin/admin.php');
            exit();
        } else {
            // Nếu không phải admin, chuyển hướng về trang chủ
            header('Location: index.html');
            exit();
        }
    } else {
        $error_message = "Tên đăng nhập hoặc mật khẩu không đúng!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Thanh điều hướng -->
    <header class="navbar">
        <div class="logo">
            <a href="index.html">
                <img src="images/logo.png" alt="Logo">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Trang chủ</a></li>
                <li><a href="menu.html">Thực đơn</a></li>
                <li><a href="locations.html">Địa chỉ</a></li>
                <li><a href="news.html">Tin tức</a></li>
                <li><a href="partners.html">Đối tác</a></li>
                <li class="login-btn">
                    <a href="login.php">Đăng nhập</a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Form Đăng Nhập -->
    <main class="login-form-container">
        <form class="login-form" action="login.php" method="POST">
            <h2>Đăng Nhập</h2>
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            <button type="submit" class="submit-btn">Đăng Nhập</button>
            <?php
            // Hiển thị thông báo lỗi nếu có
            if ($error_message != '') {
                echo "<p style='color: red;'>$error_message</p>";
            }
            ?>
            <p class="signup-link">Chưa có tài khoản? <a href="admin/signup.php">Đăng ký ngay</a></p>
            <p class="signup-link">Quên mật khẩu? <a href="admin/forgot-password.php">Đổi mật khẩu tại đây</a></p>
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Coffee Shop. Tất cả quyền được bảo vệ.</p>
    </footer>
</body>
</html>
