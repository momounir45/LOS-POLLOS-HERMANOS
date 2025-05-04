<?php
session_start();

if (isset($_POST['index']) && isset($_SESSION['cart'][$_POST['index']])) {
    array_splice($_SESSION['cart'], $_POST['index'], 1);
    
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>