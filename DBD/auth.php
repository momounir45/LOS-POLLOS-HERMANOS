<?php
require_once 'config.php';

header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]));
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die(json_encode(['success' => false, 'message' => 'Invalid JSON input']));
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($input['action'])) {
    if ($input['action'] === 'login') {
        $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
        $password = $input['password'];
        
        try {
            $stmt = $conn->prepare("SELECT id, first_name, last_name, password FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            if ($stmt->rowCount() === 1) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                    echo json_encode(['success' => true, 'message' => 'Login successful']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Wrong password']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Email not found']);
            }
        } catch(PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Login error: ' . $e->getMessage()]);
        }
    }
    elseif ($input['action'] === 'register') {
        $firstName = filter_var($input['first_name'], FILTER_SANITIZE_STRING);
        $lastName = filter_var($input['last_name'], FILTER_SANITIZE_STRING);
        $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
        $password = password_hash($input['password'], PASSWORD_DEFAULT);
        
        try {
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            
            echo json_encode(['success' => true, 'message' => 'Registration successful']);
        } catch(PDOException $e) {
            $errorMsg = 'Registration failed';
            if ($e->getCode() == '23000') {
                $errorMsg = 'Email already exists';
            }
            echo json_encode(['success' => false, 'message' => $errorMsg . ': ' . $e->getMessage()]);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}