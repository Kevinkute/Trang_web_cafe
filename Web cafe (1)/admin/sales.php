<?php
include('connection.php');

$query = "SELECT * FROM sales";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Xử lý xóa sales
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM sales WHERE id = ?";
    $delete_stmt = $pdo->prepare($delete_query);
    $delete_stmt->execute([$delete_id]);
    header("Location: sales.php"); // Reload trang sau khi xóa
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách tài chính</title>
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
        <h2>Danh sách tài chính</h2>
        <a href="add_sales.php" class="btn-add">+ Thêm thông tin tài chính</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Tổng tiền nhận được</th>
                <th>Số lượng đã bán</th>
                <th>Ngày cập nhật</th>
                <th>Hành động</th>
            </tr>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['tong']) . "</td>";
                echo "<td>" . htmlspecialchars($row['soluong']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ngay']) . "</td>";
                echo "<td>";
                echo "<a href='edit_sales.php?id=" . $row['id'] . "' class='btn-edit'>Sửa</a> ";
                echo "<a href='sales.php?delete_id=" . $row['id'] . "' class='btn-delete' onclick=\"return confirm('Bạn có chắc muốn xóa tài khoản này không?');\">Xóa</a>";
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
