<?php
include '../includes/config.php';
include '../includes/auth.php';
require_admin();

if (isset($_GET['delete']) && $_GET['delete'] != $_SESSION['user_id']) {
    $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([(int)$_GET['delete']]);
    header("Location: manage_users.php");
    exit;
}

$users = $pdo->query("SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
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
                <a href="manage_users.php"><i class="fas fa-users"></i> Người dùng</a>
                <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <h2 class="page-title"><i class="fas fa-users"></i> Quản lý người dùng</h2>
        <a href="dashboard.php" class="back-link"><i class="fas fa-arrow-left"></i> Quay lại</a>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên đăng nhập</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td>
                            <?php if ($user['role'] === 'admin'): ?>
                                <span style="color: #2563eb; font-weight: 600;">Admin</span>
                            <?php else: ?>
                                Người dùng
                            <?php endif; ?>
                        </td>
                        <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                        <td>
                            <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                <a href="?delete=<?= $user['id'] ?>" class="action-link" style="color: #ef4444;" onclick="return confirm('Xóa người dùng này?')">
                                    <i class="fas fa-trash"></i> Xóa
                                </a>
                            <?php else: ?>
                                <em>(Bạn)</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>