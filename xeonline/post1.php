<?php
include 'includes/config.php';
include 'includes/auth.php';
require_login();

// Tự động tạo thư mục uploads
$upload_dir = 'uploads';
if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0755, true)) {
        die("❌ Không thể tạo thư mục uploads. Vui lòng tạo thủ công.");
    }
}

$message = '';
$image_preview = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = filter_var($_POST['price'] ?? 0, FILTER_VALIDATE_FLOAT);
    $contact = trim($_POST['contact'] ?? '');

    if (!$title || !$description || $price === false || !$contact) {
        $message = "Vui lòng điền đầy đủ thông tin!";
    } else {
        $image_path = null;

        if (!empty($_FILES['image']['tmp_name'])) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $file_size = $_FILES['image']['size'];

            if ($file_size > 5 * 1024 * 1024) {
                $message = "Ảnh quá lớn (tối đa 5MB)!";
            } else {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $tmp_name);
                finfo_close($finfo);

                if (!in_array($mime, ['image/jpeg', 'image/png', 'image/gif'])) {
                    $message = "Chỉ cho phép JPG, PNG, GIF!";
                } else {
                    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    $new_name = 'img_' . uniqid() . '.' . $ext;
                    $target_path = $upload_dir . '/' . $new_name;

                    if (move_uploaded_file($tmp_name, $target_path)) {
                        $image_path = $target_path;
                        $image_preview = '<img src="' . htmlspecialchars($image_path) . '" alt="Preview" style="max-width: 100%; max-height: 200px; object-fit: cover; border-radius: 8px; margin-top: 10px;">';
                    } else {
                        $message = "Lỗi lưu ảnh.";
                    }
                }
            }
        }

        if (!$message)
        {
        $status = ($_SESSION['role'] === 'admin') ? 'approved' : 'pending';
        
        $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, description, price, contact, image, status) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $title, $description, $price, $contact, $image_path, $status]);
        
        header("Location: index.php?posted=1");
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
    <title>Đăng tin xe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --gray-100: #f8fafc;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-700: #334155;
            --white: #ffffff;
            --red-500: #ef4444;
            --green-500: #10b981;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--gray-100);
            color: var(--gray-700);
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: var(--white);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--gray-700);
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--gray-300);
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: white;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .file-input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .file-input-label {
            display: inline-block;
            width: 100%;
            padding: 12px 16px;
            border: 2px dashed var(--gray-300);
            border-radius: 8px;
            background: white;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s;
            font-weight: 500;
            color: var(--gray-700);
        }

        .file-input-label:hover {
            border-color: var(--primary);
            background: rgba(37, 99, 235, 0.05);
        }

        .file-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-info {
            margin-top: 8px;
            font-size: 0.85rem;
            color: var(--gray-500);
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
        }

        .alert {
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
        }

        .alert-success { background: #dcfce7; color: #166534; }
        .alert-error { background: #fee2e2; color: #b91c1c; }

        .image-preview {
            margin-top: 20px;
            text-align: center;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--gray-300);
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            h2 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-edit"></i> Đăng tin xe</h2>

        <?php if ($message): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title" class="form-label">Tiêu đề xe <span style="color: red;">*</span></label>
                <input type="text" name="title" id="title" class="form-input" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Mô tả chi tiết <span style="color: red;">*</span></label>
                <textarea name="description" id="description" class="form-textarea" required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Giá (VND) <span style="color: red;">*</span></label>
                <input type="number" name="price" id="price" class="form-input" value="<?= $_POST['price'] ?? '' ?>" min="0" step="1000" required>
            </div>

            <div class="form-group">
                <label for="contact" class="form-label">Số điện thoại hoặc Zalo <span style="color: red;">*</span></label>
                <input type="text" name="contact" id="contact" class="form-input" value="<?= htmlspecialchars($_POST['contact'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Ảnh xe (tùy chọn)</label>
                <div class="file-input-wrapper">
                    <label for="image" class="file-input-label">
                        <i class="fas fa-image"></i> Chọn ảnh để tải lên
                    </label>
                    <input type="file" name="image" id="image" class="file-input" accept="image/jpeg,image/png,image/gif">
                </div>
                <div class="file-info">Chỉ hỗ trợ JPG, PNG, GIF (tối đa 5MB)</div>
            </div>

            <!-- Hiển thị ảnh đã chọn -->
            <?php if ($image_preview): ?>
                <div class="image-preview">
                    <p><strong>Ảnh đã chọn:</strong></p>
                    <?= $image_preview ?>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i> Đăng tin</button>
        </form>
    </div>
</body>
</html>