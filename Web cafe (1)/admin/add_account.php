<?php
include('connection.php');

// Xử lý thêm tài khoản
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_account'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $admin = isset($_POST['admin']) ? 1 : 0;

    // Kiểm tra tài khoản có trùng không
    $check_query = "SELECT * FROM account_inf WHERE username = ?";
    $check_stmt = $pdo->prepare($check_query);
    $check_stmt->execute([$username]);

    if ($check_stmt->rowCount() > 0) {
        $error_message = "Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO account_inf (username, password, admin) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $password, $admin]);

        header("Location: account.php"); // Quay lại danh sách tài khoản
        exit;
    }
}

// Xử lý sửa tài khoản
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_account'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $admin = isset($_POST['admin']) ? 1 : 0;

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $query = "UPDATE account_inf SET username = ?, password = ?, admin = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $password, $admin, $id]);
    } else {
        $query = "UPDATE account_inf SET username = ?, admin = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $admin, $id]);
    }

    header("Location: account.php"); // Quay lại danh sách tài khoản
    exit;
}

// Lấy thông tin tài khoản cần sửa
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM account_inf WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($account) ? 'Sửa Tài Khoản' : 'Thêm Tài Khoản'; ?></title>
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
                <li><a href="account.php">Quay lại</a></li>
            </ul>
        </nav>
    </header>

    <!-- Form Thêm/Sửa Tài Khoản -->
    <main class="account-list-container">
        <h2><?php echo isset($account) ? 'Sửa Tài Khoản' : 'Thêm Tài Khoản'; ?></h2>
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-container">
            <?php if (isset($account)): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($account['id']); ?>">
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" value="<?php echo isset($account) ? htmlspecialchars($account['username']) : ''; ?>" placeholder="Nhập tên đăng nhập" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu (bỏ trống nếu không thay đổi)">
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="admin" <?php echo isset($account) && $account['admin'] == 1 ? 'checked' : ''; ?>>
                    Quyền Admin
                </label>
            </div>
            <button type="submit" name="<?php echo isset($account) ? 'edit_account' : 'add_account'; ?>" class="submit-btn">
                <?php echo isset($account) ? 'Cập Nhật' : 'Thêm Mới'; ?>
            </button>
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Coffee Shop. Tất cả quyền được bảo vệ.</p>
    </footer>
</body>
</html>
