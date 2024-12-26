<?php
session_start();
include_once "config.php"; // Make sure this points to your actual config file

// Function to add an item to the cart
function addToCart($conn, $item)
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    foreach ($_SESSION['cart'] as $cartItem) {
        if ($cartItem['name'] === $item) {
            return true; // Item is already in the cart
        }
    }
    $query = "SELECT name, price, img FROM services WHERE name = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $item);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result && $row = mysqli_fetch_assoc($result)) {
        $_SESSION['cart'][] = array(
            'name' => $row['name'],
            'price' => $row['price'],
            'img' => $row['img']
        );
        return true;
    } else {
        return false;
    }
}

// Function to remove an item from the cart
function removeFromCart($item)
{
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $cartItem) {
            if ($cartItem['name'] === $item) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index array
                return true;
            }
        }
    }
    return false;
}

// Function to get the items in the cart
function getCartItems()
{
    return isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
}

// Handling form submissions for add/remove actions
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['add_to_cart'])) {
        $item = $_POST['add_to_cart'];
        if (addToCart($conn, $item)) {
            $_SESSION['alertSuccess'] = "Service Added to Cart";
        } else {
            $_SESSION['alertError'] = "Something Went Wrong: Item not Added";
        }
    } elseif (isset($_POST['remove_from_cart'])) {
        $item = $_POST['remove_from_cart'];
        if (removeFromCart($item)) {
            $_SESSION['alertSuccess'] = "Item Removed from Cart";
        } else {
            $_SESSION['alertError'] = "Could not remove item";
        }
    }
}

$cartItems = getCartItems();
?>
<?php
include_once "header.php";
include_once "components/_navbar.php";
include_once "php/alerts.php";
?>

<div class="px-6 py-8">
    <div class="cart-header">
        <h2 class="text-xl font-bold">Shopping Cart</h2>
        <p>Items in your cart: <?= count($cartItems) ?></p>
    </div>

    <?php
    // Display success/error messages
    if (isset($_SESSION['alertSuccess'])) {
        echo "<p style='color: green;'>" . $_SESSION['alertSuccess'] . "</p>";
        unset($_SESSION['alertSuccess']);
    }
    if (isset($_SESSION['alertError'])) {
        echo "<p style='color: red;'>" . $_SESSION['alertError'] . "</p>";
        unset($_SESSION['alertError']);
    }
    $totalPrice = 0;
    // Display cart items
    foreach ($cartItems as $item) {
        echo "<div class='cart-item flex flex-col items-start mt-8'>";
        echo "<img class='w-40 rounded-xl' src='php/img/" . $item['img'] . "' alt='" . $item['name'] . "' style='width: 100px; height: auto;'>";
        echo "<h3 class='mb-2 text-lg font-bold tracking-tight text-gray-900'>" . $item['name'] . "</h3>";
        
        echo "<p class='mb-3 font-normal text-gray-700'>Price: ₹" . $item['price'] . "</p>";
        echo "<form method='post'><button name='remove_from_cart' value='" . $item['name'] . "' class='button remove-button font-bold text-red-500'>Remove from Cart</button></form>";
        echo "<br class='mt-8'>";
        echo "</div>";

        $totalPrice += $item['price'];
    }

    // Checkout button
    if (count($cartItems) > 0) {
        echo "<div class='text-lg font-bold border-t-2 border-gray-400 py-2'>Total Price: ₹" . $totalPrice . "</div>";
        echo "<a href='checkout.php' class='button mt-4 px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600'>Proceed to Checkout</a>";
    }
    ?>
</body>

</html>