<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

$data_file = 'data.json';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get the existing data
$data = json_decode(file_get_contents($data_file), true);

// Get the POST data
$section = $_POST['section'] ?? null;
$form_data = $_POST['form_data'] ?? [];

if (!$section || empty($form_data)) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    exit;
}

// Update the specific section
if ($section === 'stats' || $section === 'news') {
    $index = $_POST['index'] ?? null;
    if ($index === null) {
        echo json_encode(['success' => false, 'message' => 'Index required for array sections']);
        exit;
    }
    
    // Update the specific item in the array
    foreach ($form_data as $key => $value) {
        $data[$section][$index][$key] = $value;
    }
} elseif ($section === 'about') {
    // Special handling for about section with nested structure
    $data[$section]['title'] = $form_data['title'] ?? $data[$section]['title'];
    $data[$section]['subtitle'] = $form_data['subtitle'] ?? $data[$section]['subtitle'];
    
    $data[$section]['vision']['title'] = $form_data['vision_title'] ?? $data[$section]['vision']['title'];
    $data[$section]['vision']['content'] = $form_data['vision_content'] ?? $data[$section]['vision']['content'];
    
    $data[$section]['mission']['title'] = $form_data['mission_title'] ?? $data[$section]['mission']['title'];
    $data[$section]['mission']['content'] = $form_data['mission_content'] ?? $data[$section]['mission']['content'];
} else {
    // For other sections (school, principal, hero)
    foreach ($form_data as $key => $value) {
        $data[$section][$key] = $value;
    }
}

// Save the updated data back to the file
if (file_put_contents($data_file, json_encode($data, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true, 'message' => 'Data saved successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save data']);
}
?>
