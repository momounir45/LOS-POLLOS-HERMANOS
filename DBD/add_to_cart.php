<?php
session_start();

// Ensure we have a cart array
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get the JSON data from the request
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if ($data) {
    // Calculate the total price including all customizations
    $totalPrice = $data['basePrice'];
    
    // Add size price
    if ($data['size'] === 'Large') {
        $totalPrice += 50;
    }
    
    // Add meal option price
    switch ($data['mealOption']) {
        case 'With Fries': $totalPrice += 40; break;
        case 'With Drink': $totalPrice += 30; break;
        case 'Combo': $totalPrice += 60; break;
    }
    
    // Add addons prices
    $addonsPrices = [
        'Extra Cheese' => 20,
        'Extra Bacon' => 30,
        'Avocado' => 25,
        'Jalapeños' => 15,
        'Extra Mushrooms' => 20,
        'Onion Rings' => 25
    ];
    
    $addonsTotal = 0;
    foreach ($data['addons'] as $addon) {
        if (isset($addonsPrices[$addon])) {
            $addonsTotal += $addonsPrices[$addon];
        }
    }
    $totalPrice += $addonsTotal;
    
    // Create cart item with all customizations
    $cartItem = [
        'productId' => $data['productId'],
        'productName' => $data['productName'],
        'basePrice' => $data['basePrice'],
        'totalPrice' => $totalPrice,
        'image' => $data['image'],
        'size' => $data['size'],
        'mealOption' => $data['mealOption'],
        'addons' => $data['addons'],
        'specialRequests' => $data['specialRequests'],
        'quantity' => $data['quantity']
    ];
    
    // Add to cart
    $_SESSION['cart'][] = $cartItem;
    
    // Return success response
    echo json_encode([
        'success' => true, 
        'cartCount' => count($_SESSION['cart']),
        'message' => 'Item added to cart'
    ]);
} else {
    // Return error response
    echo json_encode([
        'success' => false, 
        'message' => 'Invalid data received'
    ]);
}
?>