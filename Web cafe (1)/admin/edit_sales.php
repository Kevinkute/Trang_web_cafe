<?php
include('connection.php'); // Kết nối cơ sở dữ liệu

$message = ""; // Biến lưu thông báo

// Lấy thông tin doanh thu để chỉnh sửa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM sales WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $sale = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$sale) {
        die("Bản ghi doanh thu không tồn tại!");
    }
} else {
    die("ID không hợp lệ!");
}

// Xử lý cập nhật thông tin doanh thu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tong = $_POST['tong'];
    $soluong = $_POST['soluong'];
    $ngay = $_POST['ngay'];

    if (empty($tong) || empty($soluong) || empty($ngay)) {
        $message = "Tổng, số lượng và ngày là bắt buộc!";
    } else {
        $query = "UPDATE sales SET tong = ?, soluong = ?, ngay = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute([$tong, $soluong, $ngay, $id])) {
            $message = "Cập nhật thông tin doanh thu thành công!";
            header("Location: sales.php"); // Quay lại danh sách doanh thu
            exit;
        } else {
            $message = "Có lỗi xảy ra khi cập nhật doanh thu!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Doanh Thu</title>
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
        <h2>Chỉnh Sửa Doanh Thu</h2>
        <?php if (!empty($message)): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form action="edit_sales.php?id=<?php echo $id; ?>" method="POST" class="form-container">
            <div class="form-group">
                <label for="tong">Tổng:</label>
                <input type="number" id="tong" name="tong" step="0.01" value="<?php echo htmlspecialchars($sale['tong']); ?>" required>
            </div>
            <div class="form-group">
                <label for="soluong">Số lượng:</label>
                <input type="number" id="soluong" name="soluong" value="<?php echo htmlspecialchars($sale['soluong']); ?>" required>
            </div>
            <div class="form-group">
                <label for="ngay">Ngày:</label>
                <input type="date" id="ngay" name="ngay" value="<?php echo htmlspecialchars($sale['ngay']); ?>" required>
            </div>
            <button type="submit" class="submit-btn">Cập Nhật</button>
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Coffee Shop. Tất cả quyền được bảo vệ.</p>
    </footer>
</body>
</html>
