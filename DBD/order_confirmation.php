<?php
session_start();
$order_id = $_GET['order_id'];

// Database connection
$conn = mysqli_connect("localhost", "root", "", "testo");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get order details
$order_query = "SELECT * FROM orders WHERE order_id = $order_id";
$order_result = mysqli_query($conn, $order_query);
$order = mysqli_fetch_assoc($order_result);

// Get order items
$items_query = "SELECT * FROM order_items WHERE order_id = $order_id";
$items_result = mysqli_query($conn, $items_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - LOS POLLOS HERMANOS</title>
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
        
        .confirmation-container {
            padding: 140px 20px 80px;
            max-width: 800px;
            margin: 0 auto;
            width: 100%;
            text-align: center;
        }
        
        .confirmation-container h1 {
            font-family: 'Luckiest Guy', cursive;
            color: #8B0000;
            font-size: 42px;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }
        
        .confirmation-container > p {
            font-size: 20px;
            margin-bottom: 40px;
            color: #555;
        }
        
        .order-details {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
            text-align: left;
        }
        
        .order-details h2 {
            font-size: 24px;
            color: #8B0000;
            margin-bottom: 15px;
            border-bottom: 2px solid #FFD700;
            padding-bottom: 10px;
        }
        
        .order-details > p {
            font-size: 16px;
            color: #555;
            margin-bottom: 25px;
            font-weight: 600;
        }
        
        .order-items {
            margin-bottom: 30px;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px dashed #eee;
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .order-totals {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #FFD700;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }
        
        .summary-row.total {
            font-size: 20px;
            font-weight: 700;
            color: #8B0000;
            margin-top: 15px;
        }
        
        .delivery-info {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
            text-align: left;
        }
        
        .delivery-info h3 {
            font-size: 20px;
            color: #8B0000;
            margin-bottom: 15px;
            border-bottom: 2px solid #FFD700;
            padding-bottom: 10px;
        }
        
        .delivery-info p {
            margin-bottom: 10px;
            color: #555;
        }
        
        .continue-btn {
            background-color: #8B0000;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
        }
        
        .continue-btn:hover {
            background-color: #6d0000;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 0, 0, 0.3);
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
            
            .confirmation-container {
                padding: 120px 15px 60px;
            }
            
            .confirmation-container h1 {
                font-size: 36px;
            }
        }
        
        /* Animation */
        @keyframes confetti {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(100vh) rotate(360deg); }
        }
        
        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background-color: #FFD700;
            opacity: 0.7;
            animation: confetti 3s linear forwards;
            z-index: 100;
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

    <div class="confirmation-container">
        <h1>🎉 ORDER CONFIRMED!</h1>
        <p>Thank you, <?php echo htmlspecialchars($order['customer_name']); ?>!</p>
        
        <div class="order-details">
            <h2>Order #<?php echo $order_id; ?></h2>
            <p>Estimated <?php echo ($order['delivery_method'] == 'Pickup') ? 'pickup' : 'delivery'; ?> time: 
               <?php echo date('h:i A', strtotime('+45 minutes')); ?></p>
            
            <div class="order-items">
                <?php while ($item = mysqli_fetch_assoc($items_result)): ?>
                    <div class="order-item">
                        <span><?php echo htmlspecialchars($item['product_name']); ?> × <?php echo $item['quantity']; ?></span>
                        <span>EGP <?php echo number_format($item['unit_price'] * $item['quantity'], 2); ?></span>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <div class="order-totals">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>EGP <?php echo number_format($order['subtotal'], 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Delivery Fee:</span>
                    <span>EGP <?php echo number_format($order['delivery_fee'], 2); ?></span>
                </div>
                <div class="summary-row">
                    <span>Tax (5%):</span>
                    <span>EGP <?php echo number_format($order['tax'], 2); ?></span>
                </div>
                <div class="summary-row total">
                    <span>Total:</span>
                    <span>EGP <?php echo number_format($order['total'], 2); ?></span>
                </div>
            </div>
        </div>
        
        <div class="delivery-info">
            <h3><?php echo ($order['delivery_method'] == 'Pickup') ? 'Pickup Information' : 'Delivery Information'; ?></h3>
            <?php if ($order['delivery_method'] == 'Pickup'): ?>
                <p>Restaurant Address: Madrid Road 123-78B Country</p>
                <p>Pickup Time: <?php echo date('h:i A', strtotime('+30 minutes')); ?></p>
            <?php else: ?>
                <p>Address: <?php echo htmlspecialchars($order['address']); ?>, <?php echo htmlspecialchars($order['city']); ?> <?php echo htmlspecialchars($order['zip_code']); ?></p>
            <?php endif; ?>
            <p>Phone: <?php echo htmlspecialchars($order['phone']); ?></p>
            <p>Payment Method: <?php echo htmlspecialchars($order['payment_method']); ?></p>
        </div>
        
        <a href="index.php" class="continue-btn">Back to Menu</a>
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
        // Create confetti effect
        function createConfetti() {
            const colors = ['#FFD700', '#8B0000', '#FFFFFF', '#FFA500'];
            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.width = Math.random() * 10 + 5 + 'px';
                confetti.style.height = Math.random() * 10 + 5 + 'px';
                confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
                document.body.appendChild(confetti);
                
                // Remove confetti after animation
                setTimeout(() => {
                    confetti.remove();
                }, 5000);
            }
        }
        
        // Run confetti when page loads
        window.onload = createConfetti;
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>