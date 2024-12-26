<?php
session_start();
include_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check admin credentials
    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Admin login successful
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header("location: index.php");
        exit();
    } else {
        // Admin login failed
        echo "Invalid email or password. Please try again.";
    }
}
?>

<?php include_once "header.php"; ?>
<form class="max-w-xl mt-8 p-11 rounded-lg shadow-xl mx-auto bg-gray-200" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2 class="text-xl mb-4 font-semibold text-gray-700 capitalize">Admin Login</h2>
    <div class="mb-5">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@gmail.com" required />
    </div>
    <div class="mb-5">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Your password</label>
        <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
    </div>
    <div class="flex items-start mb-5">
        <div class="flex items-center h-5">
            <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" required />
        </div>
        <label for="remember" class="ms-2 text-sm font-medium text-gray-900">Remember me</label>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
</form>
</body>
</html>
