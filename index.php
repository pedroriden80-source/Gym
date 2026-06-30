<?php
// index.php
require 'db.php';
$error = '';

// Handle Login Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    
    $stmt = $pdo->prepare("SELECT * FROM member WHERE Email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['MemberID'] = $user['MemberID'];
        $_SESSION['FirstName'] = $user['FirstName'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Email not found. Please register first.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gym System - Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">
    <div class="bg-white p-8 rounded-xl shadow-lg max-w-md w-full text-center">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Welcome to Pulse Gym</h1>
        
        <div class="space-y-4 mb-8">
            <h3 class="text-sm font-semibold text-gray-500 uppercase">New Here?</h3>
            <a href="register_member.php" class="block w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Register as Member</a>
            <a href="register_trainer.php" class="block w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">Register as Trainer</a>
        </div>

        <hr class="mb-6">

        <form method="POST" class="space-y-4 text-left">
            <h3 class="text-sm font-semibold text-gray-500 uppercase text-center">Already Registered?</h3>
            <?php if($error): ?>
                <p class="text-red-500 text-sm text-center"><?= $error ?></p>
            <?php endif; ?>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" required class="w-full mt-1 p-2 border rounded focus:ring focus:ring-blue-200">
            </div>
            <button type="submit" name="login" class="w-full bg-gray-800 text-white py-2 rounded hover:bg-gray-900 transition">Log In</button>
        </form>
    </div>
</body>
</html>