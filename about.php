<?php
session_start();

// Capture session-based errors or messages
$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];

// Which form should be active (default = login)
$activeForm = $_SESSION['active_form'] ?? 'login';

// Clear session after use
session_unset();

function showError($error)
{
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm)
{
    return $formName === $activeForm ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="aboutstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- LOGIN FORM -->
        <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">
            <form action="login_register.php" method="post">
                <h2>Login</h2>
                <?= showError($errors['login']); ?>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account?
                    <a href="#" onclick="showForm('register-form')">Register</a>
                </p>
            </form>
        </div>

        <!-- REGISTER FORM -->
        <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form">
            <form action="login_register.php" method="post">
                <h2>Register</h2>
                <?= showError($errors['register']); ?>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="">--Select Role--</option>
                    <option value="partner">Partner</option>
                    <option value="member">Member</option>
                </select>
                <button type="submit" name="register">Register</button>
                <p>Already have an account?
                    <a href="#" onclick="showForm('login-form')">Login</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        // Toggle forms dynamically
        function showForm(formId) {
            document.getElementById('login-form').classList.remove('active');
            document.getElementById('register-form').classList.remove('active');
            document.getElementById(formId).classList.add('active');
            // Scroll into view
            document.getElementById(formId).scrollIntoView({ behavior: 'smooth' });
        }
    </script>

    <!-- ===== Footer ===== -->
    <footer>
        <div class="footer-container">
            <div class="footer-contact">
                <h4>Contact Us</h4>
                <p>Email: <a href="mailto:info@southen_revive.com">info@SouthenRevive.com</a></p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                </div>
            </div>

            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="individual.html">Individual</a></li>
                    <li><a href="business.html">Business</a></li>
                    <li><a href="projects.html">Projects</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </div>

            <div class="footer-actions">
                <h4>Get Involved</h4>
                <button onclick="showForm('login-form')">Log In</button>
                <button onclick="showForm('register-form')">Register</button>
                
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 SOUTHEN REVIVE. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
