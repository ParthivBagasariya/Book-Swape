<?php
session_start();
// Include header and navbar
include_once "config.php";

// Function to add an item to the cart
function addToCart($conn, $item)
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    // Check if the item is already in the cart
    foreach ($_SESSION['cart'] as $cartItem) {
        if ($cartItem['name'] === $item) {
            // Item is already in the cart, so do not add it again
            return true; // Return true to indicate success
        }
    }
    // Query to fetch item details from the database
    $query = "SELECT name, price, img FROM services WHERE name = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $item);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        // Store the item details in the cart
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
                break; // Stop loop after removing the item
            }
        }
    }
}

// Function to get the items in the cart
function getCartItems()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart'];
    }
    return array();
}

?>

<?php


// Check if an item is added to the cart
if (isset($_POST['add_to_cart'])) {
    $item = $_POST['add_to_cart'];
    if (addToCart($conn, $item)) {
         // Set session alert message
    $_SESSION['alertSuccess'] = "Service Added to cart";
    } else {
        $_SESSION['alertError'] = "Something Went Wrong: Item not Added";
    }
}

// Check if an item is removed from the cart
if (isset($_POST['remove_from_cart'])) {
    $item = $_POST['remove_from_cart'];
    removeFromCart($item);
}

include_once "header.php";
include_once "components/_navbar.php";
include_once "php/alerts.php";
 

echo '<main>';
// Check if category and subcategory parameters are set
if (isset($_GET['category']) && isset($_GET['subcategory'])) {
    $category = $_GET['category'];
    $subcategory = $_GET['subcategory'];
    
    // Check if category is "wedding" and subcategory is "mahendi" or "haldi"
    if ($category == "wedding" && ($subcategory == "mahendi")) {
        
        include_once "service_components/mahendi.php";
    } 
    // Check if category is "wedding" and subcategory is "mahendi" or "haldi"
    if ($category == "wedding" && ($subcategory == "haldi")) {
        
        include_once "service_components/haldi.php";
    } 
    // Check if category is "wedding" and subcategory is "mandap" or "VanaRasam"
    if ($category == "wedding" && ($subcategory == "mandap")) {
        
        include_once "service_components/mandap.php";
    }
    // Check if category is "wedding" and subcategory is "mandap" or "VanaRasam"
    if ($category == "wedding" && ($subcategory == "vanarasam")) {
        
        include_once "service_components/VanaRasam.php";
    }
    // Check if category is "Birthday Parties" and subcategory is "Children's Birthday" or "Adult Birthday"
    if ($category == "Birthday Parties" && ($subcategory == "Children's Birthday")) {
        
        include_once "service_components/child_birthday.php";
    }
    // Check if category is "Birthday Parties" and subcategory is "Children's Birthday" or "Adult Birthday"
    if ($category == "Birthday Parties" && ($subcategory == "Adult Birthday")) {
        
        include_once "service_components/adult_birthday.php";
    }
    // Invalid subcategory
    else {
        // Invalid URL
        // echo "Invalid URL";
    }
}
echo '</main>';

?>


<?php
// include_once "components/_cart_icon.php"; 
include_once "components/_cart_icon.php";
include_once "components/_footer.php"; ?>
</body>

</html>