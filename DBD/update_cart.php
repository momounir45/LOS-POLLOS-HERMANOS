<?php
session_start();

if (isset($_POST['index']) && isset($_POST['quantity']) && isset($_SESSION['cart'][$_POST['index']])) {
    $index = $_POST['index'];
    $quantity = max(1, intval($_POST['quantity'])); // Ensure quantity is at least 1
    
    $_SESSION['cart'][$index]['quantity'] = $quantity;
    
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>