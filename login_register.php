<?php
session_start();
require_once 'config.php';

// ========== REGISTER ==========
if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check if email already exists
    $check = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $checkResult = $check->get_result();

    if ($checkResult->num_rows > 0) {
        $_SESSION['register_error'] = "⚠️ Email is already registered!";
        $_SESSION['active_form'] = 'register';
    } else {
        // Insert new user securely
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $role);

        if ($stmt->execute()) {
            $_SESSION['login_error'] = "✅ Registration successful! Please log in.";
            $_SESSION['active_form'] = 'login';
        } else {
            $_SESSION['register_error'] = "❌ Error registering user.";
            $_SESSION['active_form'] = 'register';
        }
    }

    header("Location: about.php");
    exit();
}

// ========== LOGIN ==========
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Store session details
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            // Redirect based on role
            if ($user['role'] === 'partner' || $user['role'] === 'admin') {
                header("Location: partner_page.php");
            } else {
                header("Location: member_page.php");
            }
            exit();
        }
    }

    // If login fails
    $_SESSION['login_error'] = "❌ Incorrect email or password!";
    $_SESSION['active_form'] = 'login';
    header("Location: about.php");
    exit();
}
?>
