<?php
session_start();

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $basePrice = (float)$_POST['basePrice'];
    $image = $_POST['image'];
    $size = $_POST['size'];
    $mealOption = $_POST['meal-option'];
    $addons = isset($_POST['addons']) ? $_POST['addons'] : [];
    $specialRequests = $_POST['special_requests'];
    $quantity = (int)$_POST['quantity'];

    // Calculate total price with customizations
    $totalPrice = $basePrice;
    
    // Size modifier
    if ($size === 'Large') {
        $totalPrice += 30;
    }
    
    // Meal option modifier
    if ($mealOption === 'With Fries') {
        $totalPrice += 40;
    } elseif ($mealOption === 'With Drink') {
        $totalPrice += 30;
    } elseif ($mealOption === 'Combo') {
        $totalPrice += 60;
    }
    
    // Addons
    $addonPrices = [
        'Extra Cheese' => 20,
        'Extra Bacon' => 30,
        'Avocado' => 25,
        'Jalapeños' => 15,
        'Extra Mushrooms' => 20,
        'Onion Rings' => 25
    ];
    
    foreach ($addons as $addon) {
        if (isset($addonPrices[$addon])) {
            $totalPrice += $addonPrices[$addon];
        }
    }

    // Add to cart
    $_SESSION['cart'][] = [
        'productId' => $productId,
        'productName' => $productName,
        'image' => $image,
        'basePrice' => $basePrice,
        'size' => $size,
        'mealOption' => $mealOption,
        'addons' => $addons,
        'specialRequests' => $specialRequests,
        'quantity' => $quantity,
        'totalPrice' => $totalPrice
    ];

    // Return success response
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'cartCount' => count($_SESSION['cart'])]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOS POLLOS HERMANOS - Menu</title>
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
        
        .menu-container {
            padding: 120px 20px 80px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }
        
        .burger-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .burger-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .burger-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 3px solid #FFD700;
        }
        
        .burger-content {
            padding: 20px;
            text-align: center;
        }
        
        .burger-name {
            font-size: 22px;
            color: #8B0000;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .burger-description {
            color: #555;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 15px;
        }
        
        .burger-price {
            color: #8B0000;
            font-size: 24px;
            font-weight: bold;
            background-color: #FFF8E1;
            padding: 8px;
            border-radius: 5px;
            display: inline-block;
            width: 100%;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.8);
            z-index: 2000;
            overflow-y: auto;
        }
        
        .modal-content {
            background-color: white;
            margin: 80px auto;
            padding: 30px;
            border-radius: 10px;
            max-width: 700px;
            width: 90%;
            box-shadow: 0 5px 30px rgba(0,0,0,0.3);
            position: relative;
        }
        
        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            color: #8B0000;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .close-modal:hover {
            transform: rotate(90deg);
            color: #FFD700;
        }
        
        .modal-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #FFD700;
            padding-bottom: 15px;
        }
        
        .modal-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
            border: 3px solid #FFD700;
        }
        
        .modal-title {
            flex: 1;
        }
        
        .modal-name {
            font-size: 28px;
            color: #8B0000;
            margin-bottom: 5px;
            font-weight: 700;
        }
        
        .modal-price {
            font-size: 24px;
            color: #8B0000;
            font-weight: 600;
        }
        
        .modal-description {
            color: #555;
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.6;
        }
        
        .customization-section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 20px;
            color: #8B0000;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
            font-weight: 600;
        }
        
        .options-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .option-item {
            flex: 1;
            min-width: 120px;
        }
        
        .option-label {
            display: block;
            padding: 10px 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            position: relative;
        }
        
        .option-input:checked + .option-label {
            background-color: #8B0000;
            color: white;
            border-color: #8B0000;
        }
        
        .option-input:checked + .option-label::after {
            content: "✓";
            position: absolute;
            right: 8px;
            top: 8px;
            color: #FFD700;
        }
        
        .option-input {
            display: none;
        }
        
        .addons-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
        }
        
        .addon-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .addon-price {
            color: #8B0000;
            font-weight: 600;
            margin-left: auto;
        }
        
        .special-requests {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
            min-height: 80px;
            margin-top: 10px;
        }
        
        .add-to-cart {
            background-color: #8B0000;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            font-weight: 600;
            margin-top: 20px;
        }
        
        .add-to-cart:hover {
            background-color: #6d0000;
            transform: translateY(-2px);
        }
        
        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
        }
        
        .quantity-btn {
            background-color: #8B0000;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .quantity-input {
            width: 50px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
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
            
            .modal-header {
                flex-direction: column;
                text-align: center;
            }
            
            .modal-image {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .options-container {
                flex-direction: column;
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

    <div class="menu-container">
      <?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "testo"); // Make sure 'testo' is your database name
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all active products from the database
$query = "SELECT * FROM products WHERE product_category = 'Pizza'";
$result = mysqli_query($conn, $query);

// Check if there are products
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="burger-card" onclick="openModal(
            '<?php echo addslashes($row['product_name']); ?>', 
            '<?php echo addslashes($row['product_description']); ?>', 
            '<?php echo $row['product_image']; ?>', 
            <?php echo $row['product_price']; ?>,
            <?php echo $row['product_id']; ?>
        )">
            <img class="burger-image" src="<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
            <div class="burger-content">
                <div class="burger-name"><?php echo $row['product_name']; ?></div>
                <div class="burger-description">
                    <?php echo $row['product_description']; ?>
                </div>
                <div class="burger-price">EGP <?php echo number_format($row['product_price'], 2); ?></div>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p>No products found in the menu.</p>";
}

// Close connection
mysqli_close($conn);
?>
    </div>

 <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <img id="modalImage" class="modal-image" src="" alt="">
                <div class="modal-title">
                    <h2 id="modalName" class="modal-name"></h2>
                    <div id="modalPrice" class="modal-price"></div>
                </div>
            </div>
            <p id="modalDescription" class="modal-description"></p>
            
            <form id="orderForm" method="post">
                <input type="hidden" id="productId" name="productId" value="">
                <input type="hidden" id="productName" name="productName" value="">
                <input type="hidden" id="basePrice" name="basePrice" value="">
                <input type="hidden" id="productImage" name="image" value="">
            
            <div class="customization-section">
                <h3 class="section-title">Meal Size</h3>
                <div class="options-container">
                    <?php
                    $sizes = [
                        ['id' => 'size-regular', 'value' => 'Regular', 'label' => 'Regular'],
                        ['id' => 'size-large', 'value' => 'Large', 'label' => 'Large (+EGP 30)']
                    ];
                    foreach ($sizes as $size) {
                        echo '<div class="option-item">
                            <input type="radio" id="'.$size['id'].'" name="size" class="option-input" value="'.$size['value'].'" '.($size['id']=='size-regular'?'checked':'').'>
                            <label for="'.$size['id'].'" class="option-label">'.$size['label'].'</label>
                        </div>';
                    }
                    ?>
                </div>
            </div>
            
            <div class="customization-section">
                <h3 class="section-title">Meal Options</h3>
                <div class="options-container">
                    <?php
                    $options = [
                        ['id' => 'option-burger-only', 'value' => 'Burger Only', 'label' => 'Pizza Only Only'],
                        ['id' => 'option-with-fries', 'value' => 'With Fries', 'label' => 'With Fries (+EGP 40)'],
                        ['id' => 'option-with-drink', 'value' => 'With Drink', 'label' => 'With Drink (+EGP 30)'],
                        ['id' => 'option-combo', 'value' => 'Combo', 'label' => 'Combo (+EGP 60)']
                    ];
                    foreach ($options as $option) {
                        echo '<div class="option-item">
                            <input type="radio" id="'.$option['id'].'" name="meal-option" class="option-input" value="'.$option['value'].'" '.($option['id']=='option-burger-only'?'checked':'').'>
                            <label for="'.$option['id'].'" class="option-label">'.$option['label'].'</label>
                        </div>';
                    }
                    ?>
                </div>
            </div>
            
            <div class="customization-section">
                <h3 class="section-title">Add-ons</h3>
                <div class="addons-container">
                    <?php
                    $addons = [
                        ['id' => 'addon-extra-cheese', 'value' => 'Extra Cheese', 'price' => 30],
                        ['id' => 'addon-bacon', 'value' => 'Extra Bacon', 'price' => 30],
                        ['id' => 'addon-avocado', 'value' => 'Extra Vegetables ', 'price' => 30],
                        ['id' => 'addon-jalapenos', 'value' => 'Jalapeños', 'price' => 30],
                        ['id' => 'addon-mushrooms', 'value' => 'Ranch', 'price' => 30],
                        ['id' => 'addon-onion-rings', 'value' => 'Extra Chicken', 'price' => 30]
                    ];
                    foreach ($addons as $addon) {
                        echo '<div class="addon-item">
                            <input type="checkbox" id="'.$addon['id'].'" name="addons[]" value="'.$addon['value'].'">
                            <label for="'.$addon['id'].'">'.$addon['value'].'</label>
                            <span class="addon-price">+EGP '.$addon['price'].'</span>
                        </div>';
                    }
                    ?>
                </div>
            </div>
            
            <div class="customization-section">
                <h3 class="section-title">Special Requests</h3>
                <textarea class="special-requests" name="special_requests" placeholder="Any special instructions or dietary requirements..."></textarea>
            </div>
            
           <div class="quantity-selector">
                    <button type="button" class="quantity-btn" onclick="decreaseQuantity()">-</button>
                    <input type="number" class="quantity-input" name="quantity" value="1" min="1">
                    <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
                </div>
                
                <button type="button" class="add-to-cart" onclick="addToCart()">ADD TO CART</button>
                <div id="successMessage" style="display: none; color: green; text-align: center; margin-top: 10px;">
                    Item added to cart successfully!
                </div>
        </form>
    </div>
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
        // Modal functionality
       function openModal(name, description, image, price, productId) {
    const modal = document.getElementById('productModal');
    document.getElementById('modalName').textContent = name;
    document.getElementById('modalDescription').textContent = description;
    document.getElementById('modalImage').src = image;
    document.getElementById('modalPrice').textContent = `EGP ${price}`;
    
    // Set hidden form values
    document.getElementById('productId').value = productId;
    document.getElementById('productName').value = name;
    document.getElementById('basePrice').value = price;
    document.getElementById('productImage').value = image;
    
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}
        
        function closeModal() {
            document.getElementById('productModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('productModal');
            if (event.target == modal) {
                closeModal();
            }
        }
        
        // Quantity controls
        function increaseQuantity() {
            const input = document.querySelector('.quantity-input');
            input.value = parseInt(input.value) + 1;
        }
        
        function decreaseQuantity() {
            const input = document.querySelector('.quantity-input');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
        
        // Add to cart functionality
         function addToCart() {
            const form = document.getElementById('orderForm');
            const formData = new FormData(form);
            
            fetch('', { // Empty string means submit to same page
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    const successMsg = document.getElementById('successMessage');
                    successMsg.style.display = 'block';
                    
                    // Hide message after 2 seconds
                    setTimeout(() => {
                        successMsg.style.display = 'none';
                    }, 2000);
                    
                    // Optionally update cart counter in navbar
                    // document.getElementById('cartCount').textContent = data.cartCount;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error adding to cart. Please try again.');
            });
        }
    </script>
</body>
</html>