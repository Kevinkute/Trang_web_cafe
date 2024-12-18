<?php
include('connection.php');

// Truy vấn lấy danh sách tài khoản
$query = "SELECT * FROM account_inf";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Xử lý xóa tài khoản
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM account_inf WHERE id = ?";
    $delete_stmt = $pdo->prepare($delete_query);
    $delete_stmt->execute([$delete_id]);
    header("Location: account.php"); // Reload trang sau khi xóa
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Tài Khoản</title>
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

    <!-- Danh sách tài khoản -->
    <main class="account-list-container">
        <h2>Danh sách tài khoản</h2>
        <a href="add_account.php" class="btn-add">+ Thêm tài khoản</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Tên đăng nhập</th>
                <th>Mật khẩu</th>
                <th>Quyền Admin</th>
                <th>Hành động</th>
            </tr>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                echo "<td>" . ($row['admin'] == 1 ? 'Có' : 'Không') . "</td>";
                echo "<td>";
                echo "<a href='edit_account.php?id=" . $row['id'] . "' class='btn-edit'>Sửa</a> ";
                echo "<a href='account.php?delete_id=" . $row['id'] . "' class='btn-delete' onclick=\"return confirm('Bạn có chắc muốn xóa tài khoản này không?');\">Xóa</a>";
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
