<?php
include 'includes/config.php';
$message = '';
if ($_POST) {
    $u = trim($_POST['username']);
    $e = trim($_POST['email']);
    $p = $_POST['password'];
    if (!$u || !$e || !$p) $message = "Vui lòng điền đủ thông tin!";
    elseif (strlen($p) < 6) $message = "Mật khẩu phải ≥6 ký tự!";
    else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$u, $e]);
        if ($stmt->fetch()) $message = "Tên hoặc email đã tồn tại!";
        else {
            $h = password_hash($p, PASSWORD_DEFAULT);
            $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)")->execute([$u, $e, $h]);
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1><i class="fas fa-car"></i> Xe Online</h1>
            <nav><a href="index.php"><i class="fas fa-home"></i> Trang chủ</a></nav>
        </div>
    </header>

    <main class="container">
        <div class="auth-form">
            <h2 class="page-title"><i class="fas fa-user-plus"></i> Đăng ký</h2>
            <?php if ($message): ?>
                <div class="alert alert-error"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu (≥6 ký tự)</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn"><i class="fas fa-user-plus"></i> Đăng ký</button>
            </form>
            <p style="text-align: center; margin-top: 16px;">
                Đã có tài khoản? <a href="login.php" style="color: #2563eb; font-weight: 600;">Đăng nhập</a>
            </p>
        </div>
    </main>
</body>
</html>