<?php
include('connection.php'); // Kết nối cơ sở dữ liệu

$message = ""; // Biến lưu thông báo

// Xử lý thêm bản ghi doanh thu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tong = $_POST['tong'];
    $soluong = $_POST['soluong'];
    $ngay = $_POST['ngay'];

    if (empty($tong) || empty($soluong) || empty($ngay)) {
        $message = "Tổng, số lượng và ngày là bắt buộc!";
    } else {
        $query = "INSERT INTO sales (tong, soluong, ngay) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute([$tong, $soluong, $ngay])) {
            $message = "Thêm bản ghi doanh thu thành công!";
        } else {
            $message = "Có lỗi xảy ra khi thêm bản ghi doanh thu!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Doanh Thu</title>
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
                <li><a href="sales.php">Quay lại</a></li>
            </ul>
        </nav>
    </header>

    <main class="account-list-container">
        <h2>Thêm Doanh Thu</h2>
        <?php if (!empty($message)): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form action="add_sales.php" method="POST" class="form-container">
            <div class="form-group">
                <label for="tong">Tổng:</label>
                <input type="number" id="tong" name="tong" step="0.01" placeholder="Nhập tổng doanh thu" required>
            </div>
            <div class="form-group">
                <label for="soluong">Số lượng:</label>
                <input type="number" id="soluong" name="soluong" placeholder="Nhập số lượng" required>
            </div>
            <div class="form-group">
                <label for="ngay">Ngày:</label>
                <input type="date" id="ngay" name="ngay" required>
            </div>
            <button type="submit" class="submit-btn">Thêm Doanh Thu</button>
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Coffee Shop. Tất cả quyền được bảo vệ.</p>
    </footer>
</body>
</html>
