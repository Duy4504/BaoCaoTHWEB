<?php
include 'includes/config.php';
$id = (int)($_GET['id'] ?? 0);
if (!$id) die("Không tìm thấy tin!");
$stmt = $pdo->prepare("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id WHERE p.id = ? AND p.status = 'approved'");
$stmt->execute([$id]);
$post = $stmt->fetch();
if (!$post) die("Tin không tồn tại hoặc chưa được duyệt.");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title']) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1><i class="fas fa-car"></i> Xe Online</h1>
            <nav>
                <a href="index.php"><i class="fas fa-home"></i> Trang chủ</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container">
        <a href="index.php" class="back-link"><i class="fas fa-arrow-left"></i> Quay lại</a>
        <div class="post-detail">
            <h1><?= htmlspecialchars($post['title']) ?></h1>
            <?php if ($post['image']): ?>
                <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
            <?php endif; ?>
            <p><?= nl2br(htmlspecialchars($post['description'])) ?></p>
            <p class="post-price"><?= number_format($post['price'], 0, ',', '.') ?> ₫</p>
            <p class="post-contact"><i class="fas fa-phone-alt"></i> <?= htmlspecialchars($post['contact']) ?></p>
            <p><small>Đăng bởi: <strong><?= htmlspecialchars($post['username']) ?></strong> | <?= date('d/m/Y H:i', strtotime($post['created_at'])) ?></small></p>
        </div>
    </main>
</body>
</html>