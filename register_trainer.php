<?php
require 'db_connect.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $conn->real_escape_string($_POST['first_name']);
    $lastName = $conn->real_escape_string($_POST['last_name']);
    $specialization = $conn->real_escape_string($_POST['specialization']);
    $phone = $conn->real_escape_string($_POST['phone']);

    $sql = "INSERT INTO trainer (FirstName, LastName, Specialization, Phone) 
            VALUES ('$firstName', '$lastName', '$specialization', '$phone')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='success-msg pop-in' style='color: var(--secondary-color); background: #ecfdf5; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; text-align: center; border: 1px solid #a7f3d0;'>Trainer added successfully!</div>";
    } else {
        $message = "<div class='error-msg pop-in' style='color: var(--error-color); background: #fef2f2; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; text-align: center;'>Error: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Trainer | Gym Membership System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="center-content">
    <div class="login-container fade-in" style="max-width: 550px;">
        <h2>Trainer Registration</h2>
        <p class="subtitle">Onboard a new fitness professional</p>
        
        <?php echo $message; ?>

        <form action="register_trainer.php" method="POST">
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

            <div class="input-group">
                <label for="specialization">Specialization</label>
                <select id="specialization" name="specialization" required>
                    <option value="" disabled selected>Select a specialization...</option>
                    <option value="Weightlifting">Weightlifting</option>
                    <option value="Cardio & Endurance">Cardio & Endurance</option>
                    <option value="Yoga & Flexibility">Yoga & Flexibility</option>
                    <option value="Rehabilitation">Rehabilitation</option>
                    <option value="CrossFit">CrossFit</option>
                </select>
            </div>

            <div class="input-group">
                <label for="phone">Phone Number (Numeric only)</label>
                <input type="number" id="phone" name="phone" required>
            </div>

            <button type="submit" class="btn-primary btn-secondary">Add Trainer</button>
            
            <div class="form-links">
                <a href="dashboard.php">← Return to Dashboard</a>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>