<?php
include('connection.php'); // Kết nối cơ sở dữ liệu

$message = ""; // Biến lưu thông báo

// Xử lý thêm nhân viên
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['adress'];
    $salary = $_POST['salary'];
    $position = $_POST['position'];

    if (empty($name) || empty($phone) || empty($salary)) {
        $message = "Tên, số điện thoại và lương là bắt buộc!";
    } else {
        $query = "INSERT INTO staff (name, phone, adress, salary, position) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute([$name, $phone, $address, $salary, $position])) {
            $message = "Thêm nhân viên thành công!";
        } else {
            $message = "Có lỗi xảy ra khi thêm nhân viên!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên</title>
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
                <li><a href="staff.php">Quay lại</a></li>
            </ul>
        </nav>
    </header>

    <main class="account-list-container">
        <h2>Thêm Nhân Viên</h2>
        <?php if (!empty($message)): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form action="add_staff.php" method="POST" class="form-container">
            <div class="form-group">
                <label for="name">Họ và tên:</label>
                <input type="text" id="name" name="name" placeholder="Nhập họ và tên" required>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" id="address" name="adress" placeholder="Nhập địa chỉ">
            </div>
            <div class="form-group">
                <label for="salary">Lương:</label>
                <input type="number" id="salary" name="salary" step="0.01" placeholder="Nhập lương" required>
            </div>
            <div class="form-group">
                <label for="position">Chức vụ:</label>
                <input type="text" id="position" name="position" placeholder="Nhập chức vụ">
            </div>
            <button type="submit" class="submit-btn">Thêm Nhân Viên</button>
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Coffee Shop. Tất cả quyền được bảo vệ.</p>
    </footer>
</body>
</html>
