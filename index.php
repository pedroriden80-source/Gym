<?php
session_start();
if (isset($_SESSION['memberID'])) {
    header("Location: dashboard.php"); // Redirect if already logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Membership System | Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="center-content">
    <div class="login-container fade-in">
        <h2>Member Portal</h2>
        <p class="subtitle">Enter your credentials to access your account</p>
        
        <form action="login_action.php" method="POST" id="loginForm">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="johndoe" required autocomplete="username">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
            </div>
            <button type="submit" class="btn-primary">Login to Account</button>
            
            <?php 
                if(isset($_GET['error'])) {
                    echo "<p class='error-msg pop-in' style='margin-top: 1rem;'>Invalid username or password.</p>"; 
                }
            ?>
        </form>
        
        <!-- Connection to the registration page -->
        <div class="form-links slide-down" style="animation-delay: 0.3s;">
            <p>New to the gym? <a href="register_member.php">Create an account</a></p>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>