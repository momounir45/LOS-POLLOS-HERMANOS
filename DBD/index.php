<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOS POLLOS HERMANOS - Home</title>
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
        
        .hero {
            height: 80vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            margin-top: 80px;
        }
        
        .hero h1 {
            font-family: 'Luckiest Guy', cursive;
            font-size: 72px;
            margin-bottom: 20px;
            color: #FFD700;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.5);
        }
        
        .hero p {
            font-size: 24px;
            max-width: 700px;
            margin-bottom: 30px;
        }
        
        .cta-button {
            background-color: #FFD700;
            color: #8B0000;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            text-decoration: none;
        }
        
        .cta-button:hover {
            background-color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .categories {
            padding: 80px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            font-family: 'Luckiest Guy', cursive;
            color: #8B0000;
            font-size: 42px;
            margin-bottom: 50px;
        }
        
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .category-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .category-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .category-content {
            padding: 20px;
            text-align: center;
        }
        
        .category-name {
            font-size: 24px;
            color: #8B0000;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .category-description {
            color: #555;
            margin-bottom: 15px;
        }
        
        .view-menu {
            color: #8B0000;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        
        .view-menu:hover {
            text-decoration: underline;
        }
        
        .special-offer {
            background-color: #8B0000;
            color: white;
            padding: 60px 20px;
            text-align: center;
        }
        
        .offer-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .offer-title {
            font-family: 'Luckiest Guy', cursive;
            font-size: 36px;
            color: #FFD700;
            margin-bottom: 20px;
        }
        
        .offer-text {
            font-size: 18px;
            margin-bottom: 30px;
        }
        
        .testimonials {
            padding: 80px 20px;
            background-color: #FFF8E1;
        }
        
        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .testimonial-card {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .testimonial-text {
            font-style: italic;
            margin-bottom: 20px;
            color: #555;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .author-name {
            font-weight: 600;
            color: #8B0000;
        }
        
        .author-role {
            color: #777;
            font-size: 14px;
        }
        /* test pop*/
         /* Auth Modal Styles */
.auth-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.7);
    z-index: 2000;
    overflow-y: auto;
}

.auth-modal-content {
    background-color: white;
    margin: 80px auto;
    padding: 30px;
    border-radius: 10px;
    max-width: 450px;
    width: 90%;
    position: relative;
    animation: modalFadeIn 0.3s ease;
}

@keyframes modalFadeIn {
    from { opacity: 0; transform: translateY(-50px); }
    to { opacity: 1; transform: translateY(0); }
}

.close-auth-modal {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 24px;
    color: #8B0000;
    cursor: pointer;
    transition: all 0.3s ease;
}

.close-auth-modal:hover {
    transform: rotate(90deg);
    color: #FFD700;
}

/* Tabs */
.auth-tabs {
    display: flex;
    margin-bottom: 20px;
    border-bottom: 2px solid #eee;
}

.auth-tab {
    padding: 10px 20px;
    cursor: pointer;
    font-weight: 600;
    color: #777;
}

.auth-tab.active {
    color: #8B0000;
    border-bottom: 2px solid #8B0000;
    margin-bottom: -2px;
}

.auth-tab-content {
    display: none;
}

.auth-tab-content.active {
    display: block;
}

/* Form Styles */
.auth-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-weight: 600;
    color: #555;
}

.form-group input {
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

.form-group input:focus {
    border-color: #8B0000;
    outline: none;
    box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
}

.remember-forgot {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.remember-me {
    display: flex;
    align-items: center;
    gap: 8px;
}

.remember-me input {
    accent-color: #8B0000;
}

.forgot-password {
    color: #8B0000;
    text-decoration: none;
    font-size: 14px;
}

.auth-btn {
    background-color: #8B0000;
    color: white;
    border: none;
    padding: 14px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
    margin-top: 10px;
}

.auth-btn:hover {
    background-color: #6d0000;
}

.auth-divider {
    display: flex;
    align-items: center;
    margin: 20px 0;
    color: #777;
}

.auth-divider::before,
.auth-divider::after {
    content: "";
    flex: 1;
    border-bottom: 1px solid #ddd;
}

.auth-divider::before {
    margin-right: 10px;
}

.auth-divider::after {
    margin-left: 10px;
}

.social-login {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.social-btn {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f5f5f5;
    color: #555;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.social-btn:hover {
    background-color: #e0e0e0;
}

.terms {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    margin-top: -10px;
}

.terms input {
    accent-color: #8B0000;
    margin-top: 3px;
}

.terms label {
    font-size: 14px;
    color: #555;
}

.terms a {
    color: #8B0000;
    text-decoration: none;
}
        
        /* Footer Styles */
        .parent6 {
            background-color: #222;
            color: white;
            padding: 40px 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
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
            
            .hero h1 {
                font-size: 48px;
            }
            
            .hero p {
                font-size: 18px;
                padding: 0 20px;
            }
            
            .nine, .ten, .eleven, .twelve {
                width: 100%;
                padding: 0 20px;
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

    <section class="hero">
        <h1>LOS POLLOS HERMANOS</h1>
        <p>Authentic flavors crafted with passion and served with pride since 1989</p>
        <a href="Product.php" class="cta-button">VIEW OUR MENU</a>
    </section>

    <section class="categories" id="menu">
        <h2 class="section-title">OUR MENU CATEGORIES</h2>
        <div class="category-grid">
            <!-- Pizza Category -->
            <div class="category-card">
                <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1981&q=80" alt="Pizza" class="category-image">
                <div class="category-content">
                    <h3 class="category-name">PIZZA</h3>
                    <p class="category-description">Hand-tossed dough with premium toppings and melted cheese</p>
                    <a href="pizza.php" class="view-menu">View Pizza Menu →</a>
                </div>
            </div>
            
            <!-- Sandwiches Category -->
            <div class="category-card">
                <img src="https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Sandwiches" class="category-image">
                <div class="category-content">
                    <h3 class="category-name">Burgers</h3>
                    <p class="category-description">Freshly baked bread with premium meats and crisp vegetables</p>
                    <a href="Burgers.php" class="view-menu">View Burgers Menu →</a>
                </div>
            </div>
            
            <!-- Drinks Category -->
            <div class="category-card">
                <img src="https://images.unsplash.com/photo-1551024709-8f23befc6f87?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2157&q=80" alt="Drinks" class="category-image">
                <div class="category-content">
                    <h3 class="category-name">Sides</h3>
                    <p class="category-description">Refreshing beverages to complement your meal</p>
                    <a href="Sides.php" class="view-menu">View Sides Menu →</a>
                </div>
            </div>
            
            <!-- Desserts Category -->
            <div class="category-card">
                <img src="https://images.unsplash.com/photo-1551024506-0bccd828d307?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2157&q=80" alt="Desserts" class="category-image">
                <div class="category-content">
                    <h3 class="category-name">DESSERTS</h3>
                    <p class="category-description">Sweet treats to complete your dining experience</p>
                    <a href="Desserts.php" class="view-menu">View Desserts Menu →</a>
                </div>
            </div>
        </div>
    </section>

    <section class="special-offer">
        <div class="offer-content">
            <h3 class="offer-title">SPECIAL FAMILY MEAL DEAL</h3>
            <p class="offer-text">Get 2 large pizzas, 4 drinks, and a dessert platter for only EGP 499. Available every weekend from 4-9pm.</p>
            <a href="#reservation" class="cta-button">RESERVE NOW</a>
        </div>
    </section>

    <section class="testimonials">
        <h2 class="section-title">WHAT OUR CUSTOMERS SAY</h2>
        <div class="testimonial-grid">
            <div class="testimonial-card">
                <p class="testimonial-text">"The best pizza I've ever had! The crust is perfectly crispy and the toppings are always fresh. LOS POLLOS HERMANOS never disappoints!"</p>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah M." class="author-avatar">
                    <div>
                        <div class="author-name">Sarah M.</div>
                        <div class="author-role">Regular Customer</div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <p class="testimonial-text">"Their chicken sandwiches are incredible! I come here at least twice a week. The service is always friendly and fast."</p>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Ahmed K." class="author-avatar">
                    <div>
                        <div class="author-name">Ahmed K.</div>
                        <div class="author-role">Food Blogger</div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <p class="testimonial-text">"The chocolate lava cake is to die for! Perfect ending to a delicious meal. Highly recommend the dessert menu."</p>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Layla S." class="author-avatar">
                    <div>
                        <div class="author-name">Layla S.</div>
                        <div class="author-role">First-time Visitor</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- Auth Modals -->
<div id="authModal" class="auth-modal">
    <div class="auth-modal-content">
        <span class="close-auth-modal">&times;</span>
        
        <div class="auth-tabs">
            <div class="auth-tab active" data-tab="login">Sign In</div>
            <div class="auth-tab" data-tab="register">Sign Up</div>
        </div>
        
        <!-- Login Form -->
        <div id="loginTab" class="auth-tab-content active">
            <h2>Welcome Back</h2>
            <form id="loginForm" class="auth-form">
                <div class="form-group">
                    <label for="loginEmail">Email Address</label>
                    <input type="email" id="loginEmail" name="email" required>
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" name="password" required>
                </div>
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                <button type="submit" class="auth-btn">SIGN IN</button>
            </form>
            
            <div class="auth-divider">or sign in with</div>
            
            <div class="social-login">
                <div class="social-btn">f</div>
                <div class="social-btn">G</div>
                <div class="social-btn">in</div>
            </div>
        </div>
        
        <!-- Registration Form -->
        <div id="registerTab" class="auth-tab-content">
            <h2>Create Account</h2>
            <form id="registerForm" class="auth-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="last_name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="registerEmail">Email Address</label>
                    <input type="email" id="registerEmail" name="email" required>
                </div>
                <div class="form-group">
                    <label for="registerPassword">Password</label>
                    <input type="password" id="registerPassword" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirm_password" required>
                </div>
                <div class="terms">
                    <input type="checkbox" id="agreeTerms" required>
                    <label for="agreeTerms">I agree to the <a href="#">Terms</a> and <a href="#">Privacy Policy</a></label>
                </div>
                <button type="submit" class="auth-btn">CREATE ACCOUNT</button>
            </form>
            
            <div class="auth-divider">or sign up with</div>
            
            <div class="social-login">
                <div class="social-btn">f</div>
                <div class="social-btn">G</div>
                <div class="social-btn">in</div>
            </div>
        </div>
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
 // Wait for DOM to load
document.addEventListener('DOMContentLoaded', function() {
    // Auth Modal Elements
    const authModal = document.getElementById('authModal');
    const authTabs = document.querySelectorAll('.auth-tab');
    const authTabContents = document.querySelectorAll('.auth-tab-content');
    const closeAuthModalBtn = document.querySelector('.close-auth-modal');
    
    // Open auth modal function
    window.openAuthModal = function(initialTab = 'login') {
        authModal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        switchTab(initialTab);
    };
    
    // Close auth modal function
    function closeAuthModal() {
        authModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    // Switch between tabs
    function switchTab(tabId) {
        authTabs.forEach(tab => {
            tab.classList.toggle('active', tab.dataset.tab === tabId);
        });
        
        authTabContents.forEach(content => {
            content.classList.toggle('active', content.id === `${tabId}Tab`);
        });
    }
    
    // Event listeners
    authTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            switchTab(tab.dataset.tab);
        });
    });
    
    closeAuthModalBtn.addEventListener('click', closeAuthModal);
    
    window.addEventListener('click', (e) => {
        if (e.target === authModal) {
            closeAuthModal();
        }
    });
    
    // Form submissions
    document.getElementById('loginForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        // Add your login AJAX call here
        console.log('Login form submitted');
        // closeAuthModal(); // Uncomment to close after successful login
    });
    
    document.getElementById('registerForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        // Add your registration AJAX call here
        console.log('Register form submitted');
        // switchTab('login'); // Uncomment to switch to login after registration
    });
});
//sign)
// Update form submissions
document.getElementById('loginForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = {
        action: 'login',
        email: this.querySelector('#loginEmail').value,
        password: this.querySelector('#loginPassword').value
    };
    
    try {
        const response = await fetch('auth.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert(data.message);
            closeAuthModal();
            window.location.href = 'dashboard.html';
        } else {
            alert('Error: ' + data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Login failed. Please try again.');
    }
});

document.getElementById('registerForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Client-side validation
    if (document.getElementById('registerPassword').value !== 
        document.getElementById('confirmPassword').value) {
        alert('Passwords do not match');
        return;
    }
    
    const formData = {
        action: 'register',
        first_name: this.querySelector('#firstName').value,
        last_name: this.querySelector('#lastName').value,
        email: this.querySelector('#registerEmail').value,
        password: this.querySelector('#registerPassword').value
    };
    
    try {
        const response = await fetch('auth.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert(data.message);
            switchTab('login');
        } else {
            alert('Error: ' + data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Registration failed. Please try again.');
    }
});
    </script>
</body>
</html>