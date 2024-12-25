<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Thanh điều hướng -->
    <header class="navbar">
        <div class="logo">
            <a href="index.html">
                <img src="images/logo.png" alt="Logo">
            </a>
        </div>
        <nav>
            <ul>
                <li class="index-btn"><a href="index.html">Trang chủ</a></li>
                <li class="dropdown">
                    <a href="menu.html">Thực đơn</a>
                    <div class="dropdown-menu">
                        <div class="submenu">
                            <a href="#">Đồ uống</a>
                            <div class="submenu-items">
                                <a href="menu/menu-item-espresso.html">Espresso</a>
                                <a href="menu/menu-item-latte.html">Latte</a>
                                <a href="menu/menu-item-cappuccino.html">Cappuccino</a>
                            </div>
                        </div>
                        <div class="submenu">
                            <a href="#">Bánh</a>
                            <div class="submenu-items">
                                <a href="menu/menu-item-chocolate-cake.html">Bánh Chocolate</a>
                                <a href="menu/menu-item-cheesecake.html">Cheesecake</a>
                                <a href="menu/menu-item-red-velvet.html">Bánh Red Velvet</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="locations.html">Địa chỉ</a>
                    <div class="dropdown-menu">
                        <a href="location/location-hochi.html">Hồ Chí Minh</a>
                        <a href="location/location-hanoi.html">Hà Nội</a>
                        <a href="location/location-haiphong.html">Hải Phòng</a>
                    </div>
                </li>
                <li><a href="news.html">Tin tức</a></li>
                <li><a href="partners.html">Đối tác</a></li>
                <li><a href="login.php">Đăng nhập</a></li>
            </ul>
        </nav>
    </header>

    <main class="welcome">
        <h1>Chào mừng đến với Coffee Shop</h1>
        <p>Khám phá các loại đồ uống và bánh ngọt tuyệt vời của chúng tôi.</p>
        
        <!-- Hình ảnh minh họa -->
        <section class="highlights">
            <h2>Đồ uống bán chạy</h2>
            <div class="highlight-item">
                <img src="images/espresso.png" alt="Espresso">
                <h3>Espresso</h3>
                <p>Espresso là một loại cà phê đậm đà được chiết xuất từ hạt cà phê nguyên chất.</p>
            </div>
            <div class="highlight-item">
                <img src="images/latte.png" alt="Latte">
                <h3>Latte</h3>
                <p>Latte là sự kết hợp hoàn hảo giữa espresso và sữa tươi, tạo nên hương vị nhẹ nhàng, béo ngậy.</p>
            </div>
            <div class="highlight-item">
                <img src="images/cappucchino.png" alt="Cappuccino">
                <h3>Cappuccino</h3>
                <p>Cappuccino là một loại cà phê được pha chế từ espresso, sữa nóng và bọt sữa.</p>
            </div>
        </section>

        <section class="highlights">
            <h2>Bánh ngọt nổi bật</h2>
            <div class="highlight-item">
                <img src="images/chocolatecake.png" alt="Bánh Chocolate">
                <h3>Bánh Chocolate</h3>
                <p>Bánh Chocolate với lớp bánh mềm mịn và hương vị chocolate đậm đà.</p>
            </div>
            <div class="highlight-item">
                <img src="images/cheesecake.png" alt="Cheesecake">
                <h3>Cheesecake</h3>
                <p>Cheesecake kết hợp giữa lớp kem phô mai mềm mịn và đế bánh quy giòn tan.</p>
            </div>
            <div class="highlight-item">
                <img src="images/redvelvet.png" alt="Bánh Red Velvet">
                <h3>Bánh Red Velvet</h3>
                <p>Bánh Red Velvet với màu đỏ quyến rũ và vị ngọt ngào của kem phô mai.</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Coffee Shop. Tất cả quyền được bảo vệ.</p>
    </footer>
</body>
</html>
