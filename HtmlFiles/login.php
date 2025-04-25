<?php
session_start();
include("db.php"); // Make sure db.php sets up $conn correctly

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];
            header("Location: /HtmlFiles/index.php"); // Successful login
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with this email.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Now the HTML part below remains the same, but error handling is added -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Clover Learning</title>
    <link href="/HtmlFiles/src/output.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-amber-100 to-amber-200 min-h-screen font-['Poppins']">

<header class="bg-gradient-to-r from-green-600 to-green-700 p-4 shadow-lg sticky top-0 z-50">
    <div class="container mx-auto">
        <div class="flex items-center justify-center space-x-4">
            <img src="/HtmlFiles/images/cloverlogo.png" alt="clovername" class="w-16 h-16 object-contain">
            <img src="/HtmlFiles/images/clovername.png" alt="cloverlogo" class="w-48 h-16 object-contain">
        </div>
        <nav class="mt-2">
            <ul class="flex justify-center space-x-6">
                <li><a href="/HtmlFiles/index.html" class="text-white hover:text-yellow-300 transition-all duration-300 font-medium">Home</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="flex-grow flex items-center justify-center py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-3xl">
                <div class="bg-gradient-to-r from-green-600 to-green-700 p-6 text-center">
                    <h2 class="text-3xl font-bold text-white">Welcome Back!</h2>
                    <p class="text-yellow-300 mt-2">Please login to continue learning</p>
                </div>
                <div class="p-8">
                    <?php if (!empty($error)) : ?>
                        <p class="text-red-600 font-medium text-center mb-4"><?= htmlspecialchars($error) ?></p>
                    <?php endif; ?>
                    <form action="login.php" method="POST" class="space-y-6">
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="relative">
                                <input type="email" name="email" id="email" required 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 pl-10"
                                    placeholder="Enter your email">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">📧</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" required 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 pl-10"
                                    placeholder="Enter your password">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">🔒</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                            </div>
                            <a href="#" class="text-sm text-green-600 hover:text-green-700 hover:underline">Forgot password?</a>
                        </div>
                        <button type="submit" 
                            class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white font-bold py-3 px-6 rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            Login
                        </button>
                        <p class="text-center text-gray-600">
                            Don't have an account? 
                            <a href="/HtmlFiles/registration.html" class="text-green-600 hover:text-green-700 font-medium hover:underline transition-colors duration-300">
                                Register here
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="bg-gradient-to-r from-green-600 to-green-700 text-white py-6">
    <div class="container mx-auto text-center">
        <p class="text-lg">&copy; 2025 Clover Education. All rights reserved.</p>
        <div class="mt-4 flex justify-center space-x-6">
            <a href="#" class="hover:text-yellow-300 transition-colors">Privacy Policy</a>
            <a href="#" class="hover:text-yellow-300 transition-colors">Terms of Service</a>
            <a href="#" class="hover:text-yellow-300 transition-colors">Contact Us</a>
        </div>
    </div>
</footer>
</body>
</html>
