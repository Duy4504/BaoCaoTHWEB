<?php
include 'includes/config.php';
$error = '';
if ($_POST) {
    $u = trim($_POST['username']);
    $p = $_POST['password'];
    if ($u && $p) {
        $stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
        $stmt->execute([$u]);
        $user = $stmt->fetch();
        if ($user && password_verify($p, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit;
        }
    }
    $error = "Sai tài khoản hoặc mật khẩu!";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
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
            <h2 class="page-title"><i class="fas fa-sign-in-alt"></i> Đăng nhập</h2>
            <?php if ($error): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i> Đăng nhập</button>
            </form>
            <p style="text-align: center; margin-top: 16px;">
                Chưa có tài khoản? <a href="register.php" style="color: #2563eb; font-weight: 600;">Đăng ký ngay</a>
            </p>
        </div>
    </main>
</body>
</html>