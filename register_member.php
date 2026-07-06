<?php
session_start();
require 'db_connect.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $conn->real_escape_string($_POST['first_name']);
    $lastName = $conn->real_escape_string($_POST['last_name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']); 

    $conn->begin_transaction();

    try {
        $sqlMember = "INSERT INTO member (FirstName, LastName, Phone, Email) 
                      VALUES ('$firstName', '$lastName', '$phone', '$email')";
        $conn->query($sqlMember);
        $newMemberID = $conn->insert_id;

        $sqlLogin = "INSERT INTO login (username, password, memberID) 
                     VALUES ('$username', '$password', '$newMemberID')";
        $conn->query($sqlLogin);

        $conn->commit();
        $message = "<div class='success-msg pop-in' style='color: var(--secondary-color); background: #ecfdf5; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; text-align: center; border: 1px solid #a7f3d0;'>Member registered successfully! <br><a href='index.php' style='color: var(--secondary-hover); font-weight: bold;'>Login here</a></div>";
        
    } catch (Exception $e) {
        $conn->rollback();
        $message = "<div class='error-msg pop-in' style='color: var(--error-color); background: #fef2f2; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; text-align: center;'>Error registering member: " . $e->getMessage() . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Member | Gym Membership System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="center-content">
    <div class="login-container fade-in" style="max-width: 550px;">
        <h2>Member Registration</h2>
        <p class="subtitle">Create a new gym member profile and account</p>
        
        <?php echo $message; ?>

        <form action="register_member.php" method="POST">
            <div class="form-row">
                <div class="input-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="input-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
            </div>

            <div class="form-row">
                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>

            <hr style="margin: 1rem 0 1.5rem; border-top: 1px solid var(--border-color);">

            <div class="form-row">
                <div class="input-group">
                    <label for="username">Choose Username</label>
                    <input type="text" id="username" name="username" required autocomplete="new-username">
                </div>
                <div class="input-group">
                    <label for="password">Create Password</label>
                    <input type="password" id="password" name="password" required autocomplete="new-password">
                </div>
            </div>

            <button type="submit" class="btn-primary">Register Member</button>
            
            <div class="form-links">
                <a href="index.php">← Back to Login</a>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>