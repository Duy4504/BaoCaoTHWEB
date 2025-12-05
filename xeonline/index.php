<?php
include 'includes/config.php';
$is_logged_in = isset($_SESSION['user_id']);
$user_role = $_SESSION['role'] ?? '';
$stmt = $pdo->prepare("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id WHERE p.status = 'approved' ORDER BY p.created_at DESC");
$stmt->execute();
$posts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xe Online</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1><i class="fas fa-car"></i> Xe Online</h1>
            <nav>
                <a href="index.php"><i class="fas fa-home"></i> Trang chủ</a>
                <?php if ($is_logged_in): ?>
                    <a href="post1.php"><i class="fas fa-plus-circle"></i> Đăng tin</a>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                <?php else: ?>
                    <a href="login.php"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                    <a href="register.php"><i class="fas fa-user-plus"></i> Đăng ký</a>
                <?php endif; ?>
                <?php if ($user_role === 'admin'): ?>
                    <a href="admin/dashboard.php"><i class="fas fa-shield-alt"></i> Admin</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container">
        <?php if (isset($_GET['posted'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> Đăng tin thành công! Tin đang chờ duyệt.
            </div>
        <?php endif; ?>

        <h2 class="page-title">Tin xe đã được duyệt</h2>
         <h2 class="page-title">Tin xe đã được duyệt</h2>

        <?php if (empty($posts)): ?>
            <div style="text-align: center; padding: 40px; background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <i class="fas fa-inbox" style="font-size: 48px; color: #cbd5e1; margin-bottom: 16px;"></i>
                <p>Chưa có tin đăng nào.</p>
            </div>
        <?php else: ?>
            <div class="posts-grid">
                <?php foreach ($posts as $post): ?>
                    <div class="post-card">
                        <?php if ($post['image']): ?>
                            <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="post-image">
                        <?php else: ?>
                            <div class="post-image"><i class="fas fa-car"></i></div>
                        <?php endif; ?>
                        <div class="post-content">
                            <h3 class="post-title"><?= htmlspecialchars($post['title']) ?></h3>
                            <p class="post-desc"><?= htmlspecialchars(substr($post['description'], 0, 120)) ?>...</p>
                            <div class="post-price"><?= number_format($post['price'], 0, ',', '.') ?> ₫</div>
                            <div class="post-contact">
                                <i class="fas fa-phone-alt"></i> <?= htmlspecialchars($post['contact']) ?>
                            </div>
                            <div class="post-meta">
                                <span><i class="fas fa-user"></i> <?= htmlspecialchars($post['username']) ?></span>
                                <span><i class="far fa-clock"></i> <?= date('d/m/Y', strtotime($post['created_at'])) ?></span>
                            </div>
                            <a href="view_post.php?id=<?= (int)$post['id'] ?>" class="btn-link">
                                <i class="fas fa-eye"></i> Xem chi tiết
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>