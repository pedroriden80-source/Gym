<?php
// register_member.php
require 'db.php';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO member (FirstName, LastName, Phone, Email) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$firstName, $lastName, $phone, $email])) {
        $message = "Member registered successfully! <a href='index.php' class='underline'>Go to Login</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Member Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">
    <div class="bg-white p-8 rounded-xl shadow-lg max-w-md w-full">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Member Registration</h2>
        
        <?php if($message): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm">First Name</label>
                <input type="text" name="fname" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block text-sm">Last Name</label>
                <input type="text" name="lname" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block text-sm">Phone</label>
                <input type="text" name="phone" required class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block text-sm">Email</label>
                <input type="email" name="email" required class="w-full p-2 border rounded">
            </div>
            <div class="flex justify-between items-center pt-4">
                <a href="index.php" class="text-sm text-gray-500 hover:underline">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Register</button>
            </div>
        </form>
    </div>
</body>
</html>