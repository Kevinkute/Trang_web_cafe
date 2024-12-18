

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
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
                <li><a href="admin.php">Quản trị</a></li>
                <li><a href="../index.html">Đăng xuất</a></li>
            </ul>
        </nav>
    </header>

    <!-- Nội dung quản trị -->
    <main class="admin-container">
        <h2>Chào mừng đến với trang quản trị</h2>

        <div class="admin-buttons">
            <a href="account.php" class="admin-btn">Danh sách tài khoản</a>
            <a href="product.php" class="admin-btn">Danh sách sản phẩm</a>
            <a href="staff.php" class="admin-btn">Danh sách nhân viên</a>
            <a href="sales.php" class="admin-btn">Danh sách sale</a>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Coffee Shop. Tất cả quyền được bảo vệ.</p>
    </footer>
</body>
</html>
