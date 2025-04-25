<?php
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Clover Learning</title>
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
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-300 hover:shadow-3xl">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 p-6 text-center">
                        <h2 class="text-3xl font-bold text-white">Join Clover Learning</h2>
                        <p class="text-yellow-300 mt-2">Create your account to start learning</p>
                    </div>
                    <div class="p-8">
                        <?php
                        // Database connection details
                      

                        // Process form submission
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $name = $_POST["name"];
                            $email = $_POST["email"];
                            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                            $age = $_POST["age"];
                            $phone = $_POST["phone"];
                            $country = $_POST["country"];
                            $address = $_POST["address"];

                            $sql = "INSERT INTO users (name, email, password, age, phone, country, address)
                                    VALUES (?, ?, ?, ?, ?, ?, ?)";

                            $stmt = $conn->prepare($sql);

                            if ($stmt) {
                                $stmt->bind_param("sssssss", $name, $email, $password, $age, $phone, $country, $address);

                                if ($stmt->execute()) {
                                    echo '<div class="bg-green-200 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                              <strong class="font-bold">Success!</strong>
                                              <span class="block sm:inline">Registration successful! You can now <a href="/HtmlFiles/login.html" class="underline font-medium">login</a>.</span>
                                            </div>';
                                } else {
                                    echo '<div class="bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                              <strong class="font-bold">Error!</strong>
                                              <span class="block sm:inline">Error during registration: ' . $stmt->error . '</span>
                                            </div>';
                                }
                                $stmt->close();
                            } else {
                                echo '<div class="bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                          <strong class="font-bold">Error!</strong>
                                          <span class="block sm:inline">Error preparing statement: ' . $conn->error . '</span>
                                        </div>';
                            }
                        }

                        $conn->close();
                        ?>
                        <form method="post" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <div class="relative">
                                        <input type="text" id="name" name="name" required
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 pl-10"
                                            placeholder="Enter your full name">
                                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">👤</span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <div class="relative">
                                        <input type="email" id="email" name="email" required
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 pl-10"
                                            placeholder="Enter your email">
                                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">📧</span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <div class="relative">
                                        <input type="password" id="password" name="password" required
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 pl-10"
                                            placeholder="Create a password">
                                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">🔒</span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                                    <div class="relative">
                                        <input type="number" id="age" name="age" required
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 pl-10"
                                            placeholder="Enter your age">
                                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">🎂</span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                    <div class="relative">
                                        <input type="text" id="phone" name="phone" required
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 pl-10"
                                            placeholder="Enter your phone number">
                                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">📱</span>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                    <div class="relative">
                                        <input type="text" id="country" name="country" required
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 pl-10"
                                            placeholder="Enter your country">
                                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">🌍</span>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <div class="relative">
                                    <input type="text" id="address" name="address" required
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 pl-10"
                                        placeholder="Enter your address">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">🏠</span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="terms" name="terms" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                <label for="terms" class="ml-2 block text-sm text-gray-700">
                                    I agree to the <a href="#" class="text-green-600 hover:text-green-700 hover:underline">Terms of Service</a> and <a href="#" class="text-green-600 hover:text-green-700 hover:underline">Privacy Policy</a>
                                </label>
                            </div>
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white font-bold py-3 px-6 rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                Create Account
                            </button>
                            <p class="text-center text-gray-600">
                                Already have an account?
                                <a href="login.php" class="text-green-600 hover:text-green-700 font-medium hover:underline transition-colors duration-300">
                                    Login here
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