<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$type = $_POST['type'] ?? null;
$form_data = $_POST['form_data'] ?? [];

if (!$type || empty($form_data)) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

// Determine which file to use
switch ($type) {
    case 'news':
        $file = 'data/news.json';
        break;
    case 'teacher':
        $file = 'data/teachers.json';
        break;
    case 'student':
        $file = 'data/students.json';
        break;
    case 'achievement':
        $file = 'data/achievements.json';
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid data type']);
        exit;
}

// Get existing data
$data = [];
if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
}

// Generate new ID
$new_id = 1;
if (!empty($data)) {
    $ids = array_column($data, 'id');
    $new_id = max($ids) + 1;
}

// Prepare new item
$new_item = ['id' => $new_id] + $form_data;

// Add to data array
$data[] = $new_item;

// Save back to file
if (file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true, 'message' => 'Data added successfully', 'id' => $new_id]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to add data']);
}
?>