<?php
session_start();

// Get the submitted data
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // Base price
    $basePrice = floatval($data['basePrice']);
    $total = $basePrice;
    $addonsTotal = 0;
    
    // Calculate size price
    $sizePrice = ($data['size'] === 'Large') ? 50 : 0;
    $total += $sizePrice;
    
    // Calculate meal option price
    $mealOptionPrice = 0;
    switch ($data['mealOption']) {
        case 'With Fries': $mealOptionPrice = 40; break;
        case 'With Drink': $mealOptionPrice = 30; break;
        case 'Combo': $mealOptionPrice = 60; break;
    }
    $total += $mealOptionPrice;
    
    // Calculate addons price
    $addonsPrices = [
        'Extra Cheese' => 20,
        'Extra Bacon' => 30,
        'Avocado' => 25,
        'Jalapeños' => 15,
        'Extra Mushrooms' => 20,
        'Onion Rings' => 25
    ];
    
    $selectedAddons = $data['addons'] ?? [];
    $addonsTotal = 0;
    
    foreach ($selectedAddons as $addon) {
        if (isset($addonsPrices[$addon])) {
            $addonsTotal += $addonsPrices[$addon];
        }
    }
    $total += $addonsTotal;
    
    // Return the calculated prices
    echo json_encode([
        'success' => true,
        'basePrice' => number_format($basePrice, 2),
        'sizePrice' => number_format($sizePrice, 2),
        'mealOptionPrice' => number_format($mealOptionPrice, 2),
        'addonsPrice' => number_format($addonsTotal, 2),
        'totalPrice' => number_format($total, 2)
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
}
?>