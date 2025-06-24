<?php
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'admin123');
define('CONTENT_FILE', __DIR__ . '/../data.json');
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/admin/');

session_start();

function loadContent() {
    if (!file_exists(CONTENT_FILE)) {
        file_put_contents(CONTENT_FILE, json_encode([]));
    }
    return json_decode(file_get_contents(CONTENT_FILE), true);
}

function saveContent($data) {
    return file_put_contents(CONTENT_FILE, json_encode($data, JSON_PRETTY_PRINT));
}

function handleUpload($file, $prefix = '') {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['error' => 'Upload error: ' . $file['error']];
    }


    if (!in_array($file['type'], ALLOWED_TYPES)) {
        return ['error' => 'Invalid file type. Only JPG, PNG, and GIF are allowed.'];
    }


    if ($file['size'] > MAX_FILE_SIZE) {
        return ['error' => 'File too large. Maximum size is 2MB.'];
    }


    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = $prefix . uniqid() . '.' . $ext;
    $destination = UPLOAD_DIR . $filename;


    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return ['filename' => 'images/' . $filename];
    } else {
        return ['error' => 'Failed to move uploaded file.'];
    }
}
?>