<?php
session_start();
include_once "config.php";

// Check if token is set in the URL
if (!isset($_GET['token'])) {
    header("location: index.php");
    exit();
}

// Retrieve token from URL
$token = $_GET['token'];

// Retrieve order details from the database based on the token
$sql = "SELECT * FROM orders WHERE token_no = '$token'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    exit();
}

$order = mysqli_fetch_assoc($result);

// Check if order exists
if (!$order) {
    header("location: index.php");
    exit();
}
?>

<?php include_once "header.php"; ?>
<?php include_once "components/_navbar.php"; ?>
<?php include_once "php/alerts.php"; ?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-semibold mb-4">Order Placed Successfully!</h2>
            <p class="mb-4">Your order details:</p>
            <p><strong>Order Date:</strong> <?php echo $order['placed_on']; ?></p>
            <p><strong>Booking Date:</strong> <?php echo $order['booking_date']; ?></p>
            <p><strong>Booking Time:</strong> <?php echo $order['booking_time']; ?></p>
            <p><strong>Total Amount:</strong> ₹<?php echo number_format($order['total_amount'], 2); ?></p>
            <p><strong>Payment Method:</strong> <?php echo ucfirst($order['payment_method']); ?> Payment</p>
            <p><strong>Name:</strong> <?php echo $order['customer_name']; ?></p>
            <p><strong>Phone Number:</strong> <?php echo $order['phone_number']; ?></p>
            <p><strong>Address:</strong> <?php echo $order['address']; ?></p>
            <p><strong>Token Number:</strong> <?php echo $order['token_no']; ?></p>
            <p><strong>Payment Status: <?php echo ($order['payment_status'] === 'complete') ? '<span class="text-green-600 font-bold uppercase">' . $order['payment_status'] . '</span>' : '<span class="text-red-600 font-bold uppercase">' . $order['payment_status'] . '</span>'; ?></strong></p>

            <?php if ($order['payment_method'] === 'Online' && $order['payment_status'] !== 'complete') : ?>

                <div class="flex flex-col justify-center items-center">
                    <script async src="https://js.stripe.com/v3/buy-button.js"></script>

                    <stripe-buy-button buy-button-id="buy_btn_1OqxZPSEvBFttWyR3ZYQYv3i" publishable-key="pk_test_51JVqDISEvBFttWyRlFRMosNUlIiQwZR8yN3X2am46lzD3wz8QlzGLMleUjDrBeToRHTU2tBveIJCsjf1koHUAT5M00pB3H0Ah4"></stripe-buy-button>
                    <div>
                        <h2 class="text-lg font-medium mb-6"> Or</h2>
                    </div>

                    <div class="w-full max-w-lg mx-auto p-8">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h2 class="text-lg font-medium mb-6">Payment Information</h2>
                            <form method="POST" action="php/store_payment_info.php">
                                <input type="hidden" name="token" value="<?php echo $token; ?>">
                                <div class="grid grid-cols-2 gap-6">
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="card-number" class="block text-sm font-medium text-gray-700 mb-2">Card Number</label>
                                        <input type="text" name="card-number" id="card-number" placeholder="0000 0000 0000 0000" class="w-full py-3 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500" required>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="expiration-date" class="block text-sm font-medium text-gray-700 mb-2">Expiration Date</label>
                                        <input type="text" name="expiration-date" id="expiration-date" placeholder="MM / YY" class="w-full py-3 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500" required>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="cvv" class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                                        <input type="text" name="cvv" id="cvv" placeholder="000" class="w-full py-3 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500" required>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="card-holder" class="block text-sm font-medium text-gray-700 mb-2">Card Holder</label>
                                        <input type="text" name="card-holder" id="card-holder" placeholder="Full Name" class="w-full py-3 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-500" required>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <button type="submit" class="w-full bg-green-500 hover:bg-blue-600 text-white font-medium py-3 rounded-lg focus:outline-none">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <a href="index.php" class="mt-6 inline-block bg-gray-900 text-white px-4 py-2 rounded-md hover:bg-gray-800">Back to Home</a>
        </div>
    </div>
</div>

<?php include_once "components/_footer.php"; ?>
</body>

</html>