<?php
include('connection.php'); // Kết nối cơ sở dữ liệu

$message = ""; // Biến lưu thông báo

// Lấy thông tin sản phẩm để chỉnh sửa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM product WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Sản phẩm không tồn tại!");
    }
} else {
    die("ID sản phẩm không hợp lệ!");
}

// Xử lý cập nhật sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    if (empty($name) || empty($price)) {
        $message = "Tên sản phẩm và giá là bắt buộc!";
    } else {
        $query = "UPDATE product SET name = ?, price = ?, description = ?, category = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute([$name, $price, $description, $category, $id])) {
            $message = "Cập nhật sản phẩm thành công!";
            header("Location: product.php"); // Quay lại danh sách sản phẩm
            exit;
        } else {
            $message = "Có lỗi xảy ra khi cập nhật sản phẩm!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Sản Phẩm</title>
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
        <h2>Chỉnh Sửa Sản Phẩm</h2>
        <?php if (!empty($message)): ?>
            <div class="message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form action="edit_product.php?id=<?php echo $id; ?>" method="POST" class="form-container">
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea id="description" name="description"><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="category">Loại:</label>
                <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($product['category']); ?>">
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
