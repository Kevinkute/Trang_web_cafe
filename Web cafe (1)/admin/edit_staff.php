<?php
include('connection.php'); // Kết nối cơ sở dữ liệu

$message = ""; // Biến lưu thông báo

// Lấy thông tin nhân viên để chỉnh sửa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM staff WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $staff = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$staff) {
        die("Nhân viên không tồn tại!");
    }
} else {
    die("ID nhân viên không hợp lệ!");
}

// Xử lý cập nhật nhân viên
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $position = $_POST['position'];

    if (empty($name) || empty($phone) || empty($salary)) {
        $message = "Tên, số điện thoại và lương là bắt buộc!";
    } else {
        $query = "UPDATE staff SET name = ?, phone = ?, adress = ?, salary = ?, position = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute([$name, $phone, $address, $salary, $position, $id])) {
            $message = "Cập nhật thông tin nhân viên thành công!";
            header("Location: staff.php"); // Quay lại danh sách nhân viên
            exit;
        } else {
            $message = "Có lỗi xảy ra khi cập nhật nhân viên!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Nhân Viên</title>
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
        <h2>Chỉnh Sửa Nhân Viên</h2>
        <?php if (!empty($message)): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form action="edit_staff.php?id=<?php echo $id; ?>" method="POST" class="form-container">
            <div class="form-group">
                <label for="name">Họ và tên:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($staff['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($staff['phone']); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($staff['adress']); ?>">
            </div>
            <div class="form-group">
                <label for="salary">Lương:</label>
                <input type="number" id="salary" name="salary" step="0.01" value="<?php echo htmlspecialchars($staff['salary']); ?>" required>
            </div>
            <div class="form-group">
                <label for="position">Chức vụ:</label>
                <input type="text" id="position" name="position" value="<?php echo htmlspecialchars($staff['position']); ?>">
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
