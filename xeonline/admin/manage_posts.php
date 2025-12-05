<?php
include '../includes/config.php';
include '../includes/auth.php';
require_admin();

if (isset($_GET['action']) && isset($_GET['id'])) {
    $status = ($_GET['action'] === 'approve') ? 'approved' : 'rejected';
    $pdo->prepare("UPDATE posts SET status = ? WHERE id = ?")->execute([$status, (int)$_GET['id']]);
    header("Location: manage_posts.php");
    exit;
}

$posts = $pdo->query("SELECT p.id, p.title, p.status, p.created_at, u.username 
                      FROM posts p 
                      JOIN users u ON p.user_id = u.id 
                      ORDER BY p.created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tin đăng</title>
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
        <h2 class="page-title"><i class="fas fa-newspaper"></i> Quản lý tin đăng</h2>
        <a href="dashboard.php" class="back-link"><i class="fas fa-arrow-left"></i> Quay lại</a>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Người đăng</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?= $post['id'] ?></td>
                        <td><?= htmlspecialchars($post['title']) ?></td>
                        <td><?= htmlspecialchars($post['username']) ?></td>
                        <td>
                            <?php if ($post['status'] === 'approved'): ?>
                                <span class="status-approved"><i class="fas fa-check-circle"></i> Đã duyệt</span>
                            <?php elseif ($post['status'] === 'rejected'): ?>
                                <span class="status-rejected"><i class="fas fa-times-circle"></i> Từ chối</span>
                            <?php else: ?>
                                <span class="status-pending"><i class="fas fa-clock"></i> Đang chờ</span>
                            <?php endif; ?>
                        </td>
                        <td><?= date('d/m/Y', strtotime($post['created_at'])) ?></td>
                        <td>
                            <?php if ($post['status'] === 'pending'): ?>
                                <a href="?action=approve&id=<?= $post['id'] ?>" class="action-link action-approve">
                                    <i class="fas fa-check"></i> Duyệt
                                </a>
                                <a href="?action=reject&id=<?= $post['id'] ?>" class="action-link action-reject">
                                    <i class="fas fa-times"></i> Từ chối
                                </a>
                            <?php else: ?>
                                <em>Đã xử lý</em>
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