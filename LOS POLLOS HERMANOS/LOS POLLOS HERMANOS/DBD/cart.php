<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOS POLLOS HERMANOS - Your Cart</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Poppins:wght@400;600;700&display=swap">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar {
            background-color: #8B0000;
            color: white;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 0 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar .esm {
            font-family: 'Luckiest Guy', cursive;
            font-size: 32px;
            color: #FFD700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .navbar ul {
            display: flex;
            gap: 15px;
            list-style: none;
        }
        
        .navbar li a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-size: 16px;
        }
        
        .navbar li a:hover {
            background-color: #FFD700;
            color: #8B0000;
        }
        
        .cart-container {
            padding: 120px 20px 80px;
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
        }
        
        .cart-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .cart-title {
            font-family: 'Luckiest Guy', cursive;
            color: #8B0000;
            font-size: 36px;
            margin-bottom: 10px;
        }
        
        .cart-subtitle {
            color: #555;
            font-size: 16px;
        }
        
        .cart-items {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .cart-item {
            display: flex;
            gap: 20px;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
        
        .item-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #FFD700;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-name {
            font-size: 18px;
            color: #8B0000;
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .item-options {
            color: #555;
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .item-option {
            display: block;
            margin-bottom: 3px;
        }
        
        .item-special {
            font-style: italic;
            color: #777;
            font-size: 13px;
            margin-top: 5px;
        }
        
        .item-price {
            font-weight: 600;
            color: #8B0000;
            font-size: 18px;
            min-width: 100px;
            text-align: right;
        }
        
        .item-quantity {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }
        
        .quantity-btn {
            background-color: #8B0000;
            color: white;
            border: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .quantity-input {
            width: 40px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 3px;
        }
        
        .remove-item {
            color: #8B0000;
            font-size: 12px;
            text-decoration: underline;
            cursor: pointer;
            margin-top: 5px;
            display: inline-block;
        }
        
        .cart-summary {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 25px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        
        .summary-label {
            color: #555;
            font-size: 16px;
        }
        
        .summary-value {
            color: #333;
            font-weight: 600;
            font-size: 16px;
        }
        
        .summary-total {
            font-size: 20px;
            color: #8B0000;
            font-weight: 700;
            border-top: 2px solid #FFD700;
            padding-top: 15px;
            margin-top: 10px;
        }
        
        .checkout-btn {
            background-color: #8B0000;
            color: white;
            border: none;
            padding: 15px 25px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            font-weight: 600;
            margin-top: 20px;
        }
        
        .checkout-btn:hover {
            background-color: #6d0000;
            transform: translateY(-2px);
        }
        
        .empty-cart {
            text-align: center;
            padding: 50px 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .empty-cart-icon {
            font-size: 50px;
            color: #8B0000;
            margin-bottom: 20px;
        }
        
        .empty-cart-message {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }
        
        .continue-shopping {
            color: #8B0000;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-top: 15px;
        }
        
        /* Footer Styles */
        .parent6 {
            background-color: #222;
            color: white;
            padding: 40px 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: auto;
        }
        
        .nine, .ten, .eleven, .twelve {
            width: 22%;
            min-width: 250px;
            margin-bottom: 20px;
        }
        
        .parent6 h4 {
            color: #FFD700;
            font-size: 18px;
            margin-bottom: 15px;
            font-family: 'Luckiest Guy', cursive;
        }
        
        .parent6 p, .parent6 li {
            color: #ddd;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        
        .parent6 ul {
            list-style: none;
        }
        
        .parent6 li::before {
            content: "•";
            color: #FFD700;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
        
        .line {
            height: 1px;
            background-color: #444;
            margin: 10px 0;
        }
        
        .parent7 {
            background-color: #111;
            color: #FFD700;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            width: 100%;
        }
        
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                height: auto;
                padding: 15px;
            }
            
            .navbar .esm {
                margin-bottom: 15px;
            }
            
            .navbar ul {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .nine, .ten, .eleven, .twelve {
                width: 100%;
                padding: 0 20px;
            }
            
            .cart-item {
                flex-direction: column;
                gap: 15px;
            }
            
            .item-image {
                width: 100%;
                height: 150px;
            }
            
            .item-price {
                text-align: left;
            }
        }
    </style>
</head>
<body>
   <nav class="navbar">
        <div class="esm">LOS POLLOS HERMANOS</div>
        <ul>
               <li><a href="index.php">Home</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="#" onclick="openAuthModal('login')">Sign In</a></li>
        </ul>
    </nav>

    <div class="cart-container">
        <div class="cart-header">
            <h1 class="cart-title">YOUR CART</h1>
            <p class="cart-subtitle">Review your delicious selections before checkout</p>
        </div>
        
        <?php if (!empty($_SESSION['cart'])): ?>
            <div class="cart-items">
                <?php 
                $subtotal = 0;
                foreach ($_SESSION['cart'] as $index => $item): 
                    // Calculate item total based on size and addons
                    $itemTotal = $item['basePrice'];
                    
                    // Apply size modifier
                    if ($item['size'] === 'Large') {
                        $itemTotal += 30; // Large size costs 10 EGP more
                    }
                    
                    // Add addons cost
                    if (!empty($item['addons'])) {
                        foreach ($item['addons'] as $addon) {
                            $itemTotal += 20; // Each addon costs 20 EGP
                        }
                    }
                    
                    // Apply meal option modifier
                    if ($item['mealOption'] === 'With Fries') {
                        $itemTotal += 40;
                    } elseif ($item['mealOption'] === 'With Fries and Drink') {
                        $itemTotal += 60;
                    }
                    
                    $subtotal += $itemTotal * $item['quantity'];
                ?>
                    <div class="cart-item">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['productName']); ?>" class="item-image">
                        <div class="item-details">
                            <h3 class="item-name"><?php echo htmlspecialchars($item['productName']); ?></h3>
                            <div class="item-options">
                                <span class="item-option">• Size: <?php echo htmlspecialchars($item['size']); ?> (+<?php echo ($item['size'] === 'Large') ? '10' : '0'; ?> EGP)</span>
                                <span class="item-option">• Meal: <?php echo htmlspecialchars($item['mealOption']); ?> 
                                    <?php if ($item['mealOption'] === 'With Fries'): ?>
                                        (+40 EGP)
                                    <?php elseif ($item['mealOption'] === 'With Fries and Drink'): ?>
                                        (+60 EGP)
                                    <?php endif; ?>
                                </span>
                                <?php if (!empty($item['addons'])): ?>
                                    <span class="item-option">• Add-ons: 
                                        <?php 
                                        echo htmlspecialchars(implode(', ', $item['addons']));
                                        echo ' (+'.(count($item['addons']) * 5).' EGP)';
                                        ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty($item['specialRequests'])): ?>
                                <p class="item-special">Special request: <?php echo htmlspecialchars($item['specialRequests']); ?></p>
                            <?php endif; ?>
                            <div class="item-quantity">
                                <button class="quantity-btn" onclick="updateQuantity(<?php echo $index; ?>, -1)">-</button>
                                <input type="number" class="quantity-input" value="<?php echo $item['quantity']; ?>" min="1" id="quantity-<?php echo $index; ?>">
                                <button class="quantity-btn" onclick="updateQuantity(<?php echo $index; ?>, 1)">+</button>
                            </div>
                            <span class="remove-item" onclick="removeItem(<?php echo $index; ?>)">Remove item</span>
                        </div>
                        <div class="item-price">
                            EGP <?php echo number_format($itemTotal * $item['quantity'], 2); ?>
                            <div style="font-size: 12px; color: #777;">
                                (<?php echo number_format($itemTotal, 2); ?> each)
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Cart Summary -->
            <div class="cart-summary">
                <div class="summary-row">
                    <span class="summary-label">Subtotal (<?php echo count($_SESSION['cart']); ?> items)</span>
                    <span class="summary-value">EGP <?php echo number_format($subtotal, 2); ?></span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Delivery Fee</span>
                    <span class="summary-value">EGP 30.00</span>
                </div>
                <div class="summary-row">
                    <span class="summary-label">Tax (5%)</span>
                    <span class="summary-value">EGP <?php echo number_format($subtotal * 0.05, 2); ?></span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span>EGP <?php echo number_format($subtotal + 30 + ($subtotal * 0.05), 2); ?></span>
                </div>
                <form action="checkout.php" method="post">
                    <button type="submit" class="checkout-btn">PROCEED TO CHECKOUT</button>
                </form>
            </div>
        <?php else: ?>
            <!-- Empty Cart State -->
            <div class="empty-cart">
                <div class="empty-cart-icon">🛒</div>
                <h2 class="empty-cart-message">Your cart is empty</h2>
                <p>Looks like you haven't added anything to your cart yet</p>
                <a href="index.php" class="continue-shopping">Continue Shopping →</a>
            </div>
        <?php endif; ?>
    </div>
    
    
   <div class="parent6" id="whorwe">
        <div class="nine">
            <h4>About us</h4>
            <p>Welcome to LOS POLLOS HERMANOS, where passion meets flavor! Our mission is to bring you a delightful dining experience with dishes crafted from the freshest ingredients and inspired by both tradition and innovation.</p>
        </div>
        <div class="ten">
            <h4>Why we are special?</h4>
            <ul>
                <li>Our magical recipe.</li>
                <div class="line"></div>
                <li>We care about environment.</li>
                <div class="line"></div>
                <li>We are trusted by hundreds of clients.</li>
                <div class="line"></div>
                <li>Social media loves us!</li>
                <div class="line"></div>
                <li>This list is super easy to create.</li>
            </ul>
        </div>
        <div class="eleven">
            <h4>Opening Hours</h4>
            <ul>
                <li>Monday 10AM - 9PM</li>
                <div class="line"></div>
                <li>Tuesday 10AM - 9PM</li>
                <div class="line"></div>
                <li>Wednesday 10AM - 9PM</li>
                <div class="line"></div>
                <li>Thursday 10AM - 10PM</li>
                <div class="line"></div>
                <li>Friday 10AM - 10PM</li>
                <div class="line"></div>
                <li>Weekends 10AM - 11PM</li>
            </ul>
        </div>
        <div class="twelve">
            <h4>Contact Details</h4>
            <p>📍Madrid Road 123-78B Country</p>
            <div class="line"></div>
            <p>📞01111182821345</p>
            <div class="line"></div>
            <p>📧manager@Lospolloshermanos.com</p>
            <div class="line"></div>
            <p>📱http://www.lospollos.com</p>
        </div>
    </div>

    <div class="parent7">
        <p>Copyright 2024. All rights reserved.</p>
    </div>

    <script>
       function updateQuantity(index, change) {
            const quantityInput = document.getElementById('quantity-' + index);
            let newQuantity = parseInt(quantityInput.value) + change;
            
            if (newQuantity < 1) newQuantity = 1;
            quantityInput.value = newQuantity;
            
            // Update session via AJAX
            fetch('update_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `index=${index}&quantity=${newQuantity}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Refresh to show updated totals
                }
            });
        }
        
        function removeItem(index) {
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                fetch('remove_from_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `index=${index}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Refresh to show updated cart
                    }
                });
            }
        }
    </script>
</body>
</html>