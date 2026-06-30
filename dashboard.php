<?php
// dashboard.php
require 'db.php';

// Check if user is logged in
if (!isset($_SESSION['MemberID'])) {
    header("Location: index.php");
    exit();
}

// Fetch full member details
$memberId = $_SESSION['MemberID'];
$stmt = $pdo->prepare("SELECT * FROM member WHERE MemberID = ?");
$stmt->execute([$memberId]);
$userData = $stmt->fetch();

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8 min-h-screen">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Profile Dashboard</h1>
            <a href="?logout=true" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">Log Out</a>
        </div>

        <div class="space-y-4">
            <h2 class="text-lg font-semibold text-gray-700">Welcome back, <?= htmlspecialchars($userData['FirstName']) ?>!</h2>
            
            <div class="bg-gray-50 p-4 rounded border">
                <h3 class="font-bold text-gray-600 uppercase text-xs mb-2">Your Information</h3>
                <p><strong>Member ID:</strong> <?= htmlspecialchars($userData['MemberID']) ?></p>
                <p><strong>Name:</strong> <?= htmlspecialchars($userData['FirstName'] . ' ' . $userData['LastName']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($userData['Email']) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($userData['Phone']) ?></p>
            </div>
        </div>
    </div>
</body>
</html>