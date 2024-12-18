<?php
include('connection.php');

$query = "SELECT * FROM product";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Xử lý xóa sản phẩm
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM product WHERE id = ?";
    $delete_stmt = $pdo->prepare($delete_query);
    $delete_stmt->execute([$delete_id]);
    header("Location: product.php"); // Reload trang sau khi xóa
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách sản phẩm</title>
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
                <li><a href="admin.php">Trang quản trị</a></li>
                <li><a href="../index.html">Đăng xuất</a></li>
            </ul>
        </nav>
    </header>

    <main class="account-list-container">
        <h2>Danh sách sản phẩm</h2>
        <a href="add_product.php" class="btn-add">+ Thêm sản phẩm</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Thông tin sản phẩm</th>
                <th>Giá</th>
                <th>Loại</th>
                <th>Hành động</th>
            </tr>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                echo "<td>";
                echo "<a href='edit_product.php?id=" . $row['id'] . "' class='btn-edit'>Sửa</a> ";
                echo "<a href='product.php?delete_id=" . $row['id'] . "' class='btn-delete' onclick=\"return confirm('Bạn có chắc muốn xóa tài khoản này không?');\">Xóa</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Coffee Shop. Tất cả quyền được bảo vệ.</p>
    </footer>
</body>
</html>
