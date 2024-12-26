<?php
session_start();
include_once "config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: auth/auth.php?auth=login");
}

// Function to generate a random token
function generateToken($length = 8)
{
    return bin2hex(random_bytes($length));
}

// Retrieve cart details from session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$total = 0;

// Calculate total cart amount
foreach ($cart as $item) {
    $total += $item['price'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_date = $_POST['order-date']; // Retrieve order date from form
    $order_time = $_POST['order-time']; // Retrieve order time from form

    if ($_POST['payment-option'] == 'offline') {
        // Get offline payment details
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        // Generate a token
        $token = generateToken();

        // Prepare cart item names
        $item_names = array_column($cart, 'name');
        $item_names_str = implode(', ', $item_names);

        // Retrieve unique_id from session
        $unique_id = $_SESSION['unique_id'];

        // Store order details in the database
        $sql = "INSERT INTO orders (booking_date, booking_time, total_amount, payment_method, customer_name, phone_number, token_no, item_names, unique_id, address) 
        VALUES ('$order_date', '$order_time', $total, 'Offline', '$name', '$phone', '$token', '$item_names_str', '$unique_id', '$address')";
        

        if (mysqli_query($conn, $sql)) {
            unset($_SESSION['cart']);
            // Redirect to order success page
            header("location: order_success.php?token=$token");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    if ($_POST['payment-option'] == 'online') {
        // Get offline payment details
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        // Generate a token
        $token = generateToken();

        // Prepare cart item names
        $item_names = array_column($cart, 'name');
        $item_names_str = implode(', ', $item_names);

        // Retrieve unique_id from session
        $unique_id = $_SESSION['unique_id'];

        // Store order details in the database
        $sql = "INSERT INTO orders (booking_date, booking_time, total_amount, payment_method, customer_name, phone_number, token_no, item_names, unique_id, address) 
        VALUES ('$order_date', '$order_time', $total, 'Online', '$name', '$phone', '$token', '$item_names_str', '$unique_id', '$address')";
        
        if (mysqli_query($conn, $sql)) {
            unset($_SESSION['cart']);
            // Redirect to order success page
            header("location: order_success.php?token=$token");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<?php include_once "header.php"; ?>
<?php include_once "components/_navbar.php"; ?>

<div class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32">
    <div class="px-4 pt-8">
        <p class="text-xl font-medium">Order Summary</p>
        <p class="text-gray-400">Check your items. And select a suitable shipping method.</p>
        <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6">
            <?php foreach ($cart as $item) { ?>
                <div class="flex flex-col rounded-lg bg-white sm:flex-row">
                    <div class="flex w-full flex-col px-4 py-4">
                        <span class="font-semibold"><?php echo $item['name']; ?></span>
                        <p class="text-lg font-bold">₹<?php echo number_format($item['price'], 2); ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>


    </div>
    <div class="mt-10 bg-gray-50 px-4 pt-8 lg:mt-0">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p class="text-xl font-medium">Payment Details</p>
        <p class="text-gray-400">Complete your order by providing your payment details.</p>
        <div class="">
            <label for="payment-option" class="mt-4 mb-2 block text-sm font-medium">Select Payment Option</label>
            <select id="payment-option" name="payment-option" class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" required>
                <option value="online">Online Payment</option>
                <option value="offline">Offline Payment</option>
            </select>
            <label for="name" class="block mt-4 text-sm font-medium">Name</label>
            <input type="text" name="name" id="name" class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Your Name" required>
            <label for="phone" class="block mt-4 text-sm font-medium">Phone Number</label>
            <input type="tel" name="phone" id="phone" class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Your Phone Number" required>
            <label for="address" class="block mt-4 text-sm font-medium">Address</label>
            <input type="text" name="address" id="address" class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Your Address" required>
            <!-- Order Date -->
            <div class="mt-6">
                <label for="order-date" class="block mt-4 text-sm font-medium">Event Date</label>
                <input type="date" name="order-date" id="order-date" class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Select Order Date" min="<?php echo date('Y-m-d'); ?>" required onchange="validateOrderDate(this.value)">
                <span id="order-date-error" class="text-red-500 hidden">Please select a date after today.</span>
            </div>
            <!-- Order Time -->
            <div class="mt-6">
                <label for="order-time" class="block mt-4 text-sm font-medium">Order Time</label>
                <input type="time" name="order-time" id="order-time" class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Select Order Time" required>
            </div>
            <!-- Total -->
            <div class="mt-6 border-t border-b py-2">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900">Subtotal</p>
                    <p class="font-semibold text-gray-900">₹<?php echo number_format($total, 2); ?></p>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-between">
                <p class="text-sm font-medium text-gray-900">Total</p>
                <p class="text-2xl font-semibold text-gray-900">₹<?php echo number_format($total, 2); ?></p>
            </div>
        </div>
        <button type="submit" name="place_order" class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">Place Order</button>
    </form>

    </div>
</div>

<script>
    document.getElementById('payment-option').addEventListener('change', function() {
        var option = this.value;
        var onlinePayment = document.getElementById('online-payment');
        var offlinePayment = document.getElementById('offline-payment');

        if (option === 'online') {
            onlinePayment.classList.remove('hidden');
            offlinePayment.classList.add('hidden');
        } else {
            offlinePayment.classList.remove('hidden');
            onlinePayment.classList.add('hidden');
        }
    });
</script>
<script>
    function validateOrderDate(selectedDate) {
        var today = new Date();
        var selected = new Date(selectedDate);

        if (selected < today && !isSameDay(selected, today)) {
            document.getElementById('order-date-error').classList.remove('hidden');
            document.getElementById('order-date').value = ''; // Clear the selected date
        } else {
            document.getElementById('order-date-error').classList.add('hidden');
        }
    }

    function isSameDay(date1, date2) {
        return date1.getFullYear() === date2.getFullYear() &&
            date1.getMonth() === date2.getMonth() &&
            date1.getDate() === date2.getDate();
    }
</script>

<?php include_once "components/_footer.php"; ?>
</body>

</html>