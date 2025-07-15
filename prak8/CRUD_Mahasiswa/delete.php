<?php
$id = $_GET['id'] ?? null;
$data = json_decode(file_get_contents('data/data.json'), true);

if ($id !== null && isset($data[$id])) {
    $imagePath = $data[$id]['image'] ?? null;
    unset($data[$id]); // Remove only the selected item
    file_put_contents('data/data.json', json_encode($data));

    if ($imagePath && file_exists($imagePath)) {
        unlink($imagePath);
    }
}

// Redirect to index.php in all cases
header('Location: index.php');
exit();
?>
