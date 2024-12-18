<?php
include('connection.php'); // Kết nối cơ sở dữ liệu

$message = ""; // Biến lưu thông báo

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Kiểm tra dữ liệu đầu vào
    if (empty($name) || empty($price)) {
        $message = "Tên sản phẩm và giá là bắt buộc!";
    } else {
        // Thêm sản phẩm vào bảng `product`
        $query = "INSERT INTO product (name, price, description, category) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);

        if ($stmt->execute([$name, $price, $description, $category])) {
            $message = "Thêm sản phẩm thành công!";
            header("Location: product.php");
        } else {
            $message = "Có lỗi xảy ra khi thêm sản phẩm!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
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
                <li><a href="product.php">Quay lại</a></li>
            </ul>
        </nav>
    </header>

    <main class="account-list-container">
        <h2>Thêm Sản Phẩm</h2>
        <?php if (!empty($message)): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form action="add_product.php" method="POST" class="form-container">
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" placeholder="Nhập tên sản phẩm" required>
            </div>
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" id="price" name="price" step="0.01" placeholder="Nhập giá sản phẩm" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea id="description" name="description" placeholder="Nhập mô tả sản phẩm"></textarea>
            </div>
            <div class="form-group">
                <label for="category">Loại:</label>
                <input type="text" id="category" name="category" placeholder="Nhập loại sản phẩm">
            </div>
            <button type="submit" class="submit-btn">Thêm Sản Phẩm</button>
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Coffee Shop. Tất cả quyền được bảo vệ.</p>
    </footer>
</body>
</html>
