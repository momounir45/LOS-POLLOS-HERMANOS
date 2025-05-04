<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "dbd");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get form data
$productId = $_POST['productId'];
$productName = $_POST['productName'];
$basePrice = $_POST['basePrice'];
$size = $_POST['size'];
$mealOption = $_POST['meal-option'];
$addons = isset($_POST['addons']) ? $_POST['addons'] : [];
$specialRequests = $_POST['special_requests'];
$quantity = $_POST['quantity'];

// Calculate total price (simplified - you'll need proper calculation)
$totalPrice = $basePrice * $quantity;

// Create cart item array
$cartItem = [
    'productId' => $productId,
    'productName' => $productName,
    'image' => $_POST['image'],
    'basePrice' => $basePrice,
    'size' => $size,
    'mealOption' => $mealOption,
    'addons' => $addons,
    'specialRequests' => $specialRequests,
    'quantity' => $quantity,
    'totalPrice' => $totalPrice
];

// Add item to cart
$_SESSION['cart'][] = $cartItem;

// Redirect to cart page
header("Location: cart.php");
exit();
?>