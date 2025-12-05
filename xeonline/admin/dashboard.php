<?php
include '../includes/config.php';
include '../includes/auth.php';
require_admin();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1><i class="fas fa-car"></i> Xe Online - Admin</h1>
            <nav>
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="manage_posts.php"><i class="fas fa-newspaper"></i> Quản lý tin</a>
                <a href="manage_users.php"><i class="fas fa-users"></i> Quản lý người dùng</a>
                <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <h2 class="page-title">Chào mừng, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
        <div style="text-align: center; padding: 40px; background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <i class="fas fa-shield-alt" style="font-size: 48px; color: #2563eb; margin-bottom: 16px;"></i>
            <p>Bạn đang ở trang quản trị hệ thống.</p>
        </div>
    </main>
</body>
</html>