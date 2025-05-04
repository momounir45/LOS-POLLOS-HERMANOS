<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "root", "", "testo");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 1. Get form data
$customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$city = mysqli_real_escape_string($conn, $_POST['city']);
$zip_code = mysqli_real_escape_string($conn, $_POST['zip_code']);
$delivery_method = mysqli_real_escape_string($conn, $_POST['delivery_method']);
$payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
$special_instructions = mysqli_real_escape_string($conn, $_POST['special_instructions']);

// 2. Calculate order totals from cart
$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['totalPrice'];
}

$delivery_fee = ($delivery_method == 'Pickup') ? 0 : 30.00;
$tax = $subtotal * 0.05; // 5% tax
$total = $subtotal + $delivery_fee + $tax;

// 3. Insert order into database
$order_query = "INSERT INTO orders (
    customer_name, phone, email, address, city, zip_code,
    delivery_method, payment_method, special_instructions,
    subtotal, delivery_fee, tax, total
) VALUES (
    '$customer_name', '$phone', '$email', '$address', '$city', '$zip_code',
    '$delivery_method', '$payment_method', '$special_instructions',
    $subtotal, $delivery_fee, $tax, $total
)";

if (mysqli_query($conn, $order_query)) {
    $order_id = mysqli_insert_id($conn);
    
    // 4. Insert each cart item into order_items
    foreach ($_SESSION['cart'] as $item) {
        $product_id = $item['productId'];
        $product_name = mysqli_real_escape_string($conn, $item['productName']);
        $quantity = $item['quantity'];
        $unit_price = $item['basePrice'];
        $size = mysqli_real_escape_string($conn, $item['size']);
        $meal_option = mysqli_real_escape_string($conn, $item['mealOption']);
        $addons = isset($item['addons']) ? mysqli_real_escape_string($conn, implode(', ', $item['addons'])) : '';
        
        $item_query = "INSERT INTO order_items (
            order_id, product_id, product_name, quantity, unit_price,
            size, meal_option, addons
        ) VALUES (
            $order_id, $product_id, '$product_name', $quantity, $unit_price,
            '$size', '$meal_option', '$addons'
        )";
        
        mysqli_query($conn, $item_query);
    }
    
    // 5. Clear the cart
    unset($_SESSION['cart']);
    
    // 6. Redirect to confirmation page
    header("Location: order_confirmation.php?order_id=$order_id");
    exit();
} else {
    // Error handling
    header("Location: checkout.php?error=1");
    exit();
}

mysqli_close($conn);
?>