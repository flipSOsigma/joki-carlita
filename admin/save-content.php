<?php
require_once '../includes/auth.php';
requireAuth();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: dashboard.php');
    exit;
}

$newContent = [

];

if (!empty($_FILES['principal_image']['name'])) {
    $result = handleUpload($_FILES['principal_image'], 'principal_');
    if (isset($result['filename'])) {
        $newContent['principal']['image'] = $result['filename'];
    } elseif (isset($result['error'])) {
        $_SESSION['upload_error'] = $result['error'];
    }
} elseif (isset($_POST['principal']['image'])) {
    $newContent['principal']['image'] = $_POST['principal']['image'];
}

if (isset($_POST['news'])) {
    foreach ($_POST['news'] as $index => $news) {
        if (!empty($_FILES['news']['name'][$index]['image_upload'])) {
            $file = [
                'name' => $_FILES['news']['name'][$index]['image_upload'],
                'type' => $_FILES['news']['type'][$index]['image_upload'],
                'tmp_name' => $_FILES['news']['tmp_name'][$index]['image_upload'],
                'error' => $_FILES['news']['error'][$index]['image_upload'],
                'size' => $_FILES['news']['size'][$index]['image_upload']
            ];
            
            $result = handleUpload($file, 'news_' . $index . '_');
            if (isset($result['filename'])) {
                $newContent['news'][$index]['image'] = $result['filename'];
            } elseif (isset($result['error'])) {
                $_SESSION['upload_error'] = $result['error'];
            }
        } elseif (!empty($news['image'])) {
            $newContent['news'][$index]['image'] = $news['image'];
        }
    }
}


if (saveContent($newContent)) {
    header('Location: dashboard.php?success=1');
} else {
    header('Location: dashboard.php?error=1');
}
exit;
?>