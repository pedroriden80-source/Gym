<?php
session_start();
if (!isset($_SESSION['memberID'])) {
    header("Location: index.php");
    exit();
}
require 'db_connect.php';

$memberID = $_SESSION['memberID'];
$memberName = "Member"; 

// Join login and member tables to get the user's actual name
$sql = "SELECT m.FirstName, m.LastName 
        FROM member m 
        WHERE m.MemberID = '$memberID'";
        
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $memberName = $row['FirstName'] . " " . $row['LastName'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Gym Membership System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar slide-down">
        <div class="brand">GymSystem Pro</div>
        <div class="nav-links">
            <a href="register_trainer.php">Add New Trainer</a>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>
    </nav>
    
    <main class="dashboard-content fade-in">
        <header class="dashboard-header">
            <h1>Welcome back, <?php echo htmlspecialchars($memberName); ?>!</h1>
            <p style="color: var(--text-muted); font-size: 1.1rem; margin-top: 0.5rem;">Manage your fitness journey, view active programs, and check your payments.</p>
        </header>
        
        <div class="card-grid">
            <div class="card pop-in" style="animation-delay: 0.1s;">
                <div class="card-icon">🏋️</div>
                <h3>My Programs</h3>
                <p>View duration and description of your enrolled training programs.</p>
            </div>
            <div class="card pop-in" style="animation-delay: 0.2s;">
                <div class="card-icon">💳</div>
                <h3>Payment History</h3>
                <p>Check past transactions, amounts, and payment methods securely.</p>
            </div>
            <div class="card pop-in" style="animation-delay: 0.3s;">
                <div class="card-icon">💪</div>
                <h3>Trainers</h3>
                <p>View your assigned trainers, contact info, and their specializations.</p>
            </div>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>