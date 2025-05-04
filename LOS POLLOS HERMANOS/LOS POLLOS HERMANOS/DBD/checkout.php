<?php
session_start();

// Calculate totals from cart
$subtotal = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $subtotal += $item['totalPrice'];
    }
}
$tax = $subtotal * 0.05;
$delivery_fee = 30.00; // Or calculate based on delivery method
$total = $subtotal + $tax + $delivery_fee;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOS POLLOS HERMANOS - Checkout</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Poppins:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        
        .checkout-container {
            padding: 120px 20px 80px;
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        @media (min-width: 992px) {
            .checkout-container {
                grid-template-columns: 1fr 350px;
            }
        }
        
        .checkout-header {
            grid-column: 1 / -1;
            text-align: center;
        }
        
        .checkout-title {
            font-family: 'Luckiest Guy', cursive;
            color: #8B0000;
            font-size: 36px;
            margin-bottom: 10px;
        }
        
        .checkout-subtitle {
            color: #555;
            font-size: 16px;
        }
        
        .checkout-form {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
        }
        
        .form-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 20px;
            color: #8B0000;
            margin-bottom: 20px;
            padding-bottom: 5px;
            border-bottom: 2px solid #FFD700;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            border-color: #8B0000;
            outline: none;
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .delivery-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .delivery-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .delivery-option:hover {
            border-color: #8B0000;
        }
        
        .delivery-option input[type="radio"] {
            accent-color: #8B0000;
        }
        
        .delivery-option.active {
            border-color: #8B0000;
            background-color: #FFF8E1;
        }
        
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
        }
        
        .payment-method {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            padding: 15px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .payment-method:hover {
            border-color: #8B0000;
        }
        
        .payment-method.active {
            border-color: #8B0000;
            background-color: #FFF8E1;
        }
        
        .payment-icon {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .order-summary {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 25px;
            height: fit-content;
            position: sticky;
            top: 100px;
        }
        
        .order-items {
            max-height: 200px;
            overflow-y: auto;
            margin-bottom: 20px;
            padding-right: 10px;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .order-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .item-name {
            font-weight: 600;
        }
        
        .item-quantity {
            color: #777;
            font-size: 14px;
        }
        
        .item-price {
            font-weight: 600;
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
        
        /* Improved Footer Styles */
        .footer {
            background-color: #222;
            color: white;
            padding: 50px 20px 0;
            margin-top: auto;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
        }
        
        .footer-column {
            padding: 0 15px;
        }
        
        .footer-column h4 {
            color: #FFD700;
            font-size: 18px;
            margin-bottom: 20px;
            font-family: 'Luckiest Guy', cursive;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-column h4::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background-color: #FFD700;
        }
        
        .footer-column p {
            color: #ddd;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: #ddd;
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
        }
        
        .footer-links a:hover {
            color: #FFD700;
            padding-left: 5px;
        }
        
        .contact-info {
            list-style: none;
        }
        
        .contact-info li {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }
        
        .contact-info i {
            color: #FFD700;
            margin-right: 10px;
            margin-top: 3px;
        }
        
        .footer-bottom {
            background-color: #111;
            color: #FFD700;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            margin-top: 30px;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-links a {
            color: #FFD700;
            background-color: rgba(255, 255, 255, 0.1);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background-color: #FFD700;
            color: #8B0000;
            transform: translateY(-3px);
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
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .payment-methods {
                grid-template-columns: 1fr 1fr;
            }
            
            .footer-container {
                grid-template-columns: 1fr;
            }
            
            .footer-column {
                margin-bottom: 30px;
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

    <div class="checkout-container">
        <div class="checkout-header">
            <h1 class="checkout-title">CHECKOUT</h1>
            <p class="checkout-subtitle">Complete your order with delivery information</p>
        </div>
        
        <div class="checkout-form">
            <div class="form-section">
                <h2 class="section-title">Delivery Information</h2>
                <form id="checkoutForm" method="post" action="process_checkout.php" class="checkout-form">
                    <!-- Delivery Information -->
                    <div class="form-group">
                        <label for="full-name" class="form-label">Full Name</label>
                        <input type="text" id="full-name" name="customer_name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">Delivery Address</label>
                        <input type="text" id="address" name="address" class="form-input" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="city" class="form-label">City</label>
                            <input type="text" id="city" name="city" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label for="zip" class="form-label">ZIP Code</label>
                            <input type="text" id="zip" name="zip_code" class="form-input" required>
                        </div>
                    </div>

                    <!-- Delivery Method -->
                    <div class="delivery-options">
                        <label class="delivery-option active">
                            <input type="radio" name="delivery_method" value="Home Delivery" checked>
                            <div>Home Delivery</div>
                        </label>
                        <label class="delivery-option">
                            <input type="radio" name="delivery_method" value="Pickup">
                            <div>Pickup</div>
                        </label>
                    </div>

                    <!-- Payment Method -->
                    <div class="payment-methods">
                        <label class="payment-method active">
                            <input type="radio" name="payment_method" value="Credit Card" checked>
                            <div>Credit Card</div>
                        </label>
                        <label class="payment-method">
                            <input type="radio" name="payment_method" value="Mobile Pay">
                            <div>Mobile Pay</div>
                        </label>
                        <label class="payment-method">
                            <input type="radio" name="payment_method" value="Cash">
                            <div>Cash</div>
                        </label>
                    </div>

                    <!-- Special Instructions -->
                    <div class="form-group">
                        <label for="instructions" class="form-label">Special Instructions</label>
                        <textarea id="instructions" name="special_instructions" class="form-input" rows="4" placeholder="Any special requests or instructions..."></textarea>
                    </div>

                    <button type="submit" class="checkout-btn">PLACE ORDER</button>
                </form>
            </div>
        </div>
        
        <div class="order-summary">
            <h2 class="section-title">Order Summary</h2>
            <div class="order-items">
                <?php if (isset($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <div class="order-item">
                            <div>
                                <div class="item-name"><?php echo htmlspecialchars($item['productName']); ?></div>
                                <div class="item-quantity"><?php echo $item['quantity']; ?> × EGP <?php echo number_format($item['basePrice'], 2); ?></div>
                            </div>
                            <div class="item-price">EGP <?php echo number_format($item['totalPrice'], 2); ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="summary-row">
                <span class="summary-label">Subtotal</span>
                <span class="summary-value">EGP <?php echo number_format($subtotal, 2); ?></span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Delivery Fee</span>
                <span class="summary-value">EGP <?php echo number_format($delivery_fee, 2); ?></span>
            </div>
            <div class="summary-row">
                <span class="summary-label">Tax (5%)</span>
                <span class="summary-value">EGP <?php echo number_format($tax, 2); ?></span>
            </div>
            <div class="summary-row summary-total">
                <span>Total</span>
                <span>EGP <?php echo number_format($total, 2); ?></span>
            </div>
            <button type="submit" class="checkout-btn" form="checkoutForm">PLACE ORDER</button>
        </div>
    </div>
    
    <!-- Improved Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <h4>About Us</h4>
                <p>Welcome to LOS POLLOS HERMANOS, where passion meets flavor! Our mission is to bring you a delightful dining experience with dishes crafted from the freshest ingredients.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="footer-column">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#us">Menu</a></li>
                    <li><a href="#reservation">Reservations</a></li>
                    <li><a href="#contactus">Contact Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>Opening Hours</h4>
                <ul class="footer-links">
                    <li>Monday - Friday: 10AM - 9PM</li>
                    <li>Saturday: 10AM - 11PM</li>
                    <li>Sunday: 10AM - 11PM</li>
                    <li>Holidays: 12PM - 10PM</li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>Contact Us</h4>
                <ul class="contact-info">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Madrid Road 123-78B Country</span>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <span>01111182821345</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>manager@Lospolloshermanos.com</span>
                    </li>
                    <li>
                        <i class="fas fa-globe"></i>
                        <span>www.lospollos.com</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2024 LOS POLLOS HERMANOS. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
       document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = 'red';
                    isValid = false;
                } else {
                    field.style.borderColor = '#ddd';
                }
            });
            
            if (isValid) {
                this.submit();
            } else {
                alert('Please fill in all required fields.');
            }
        });
    </script>
</body>
</html>