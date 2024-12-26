<?php
session_start();
include_once "config.php";
// Include header and navbar

?>

<?php
// Function to add an item to the cart
include_once "config.php";
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
    $query2 = "SELECT * FROM books_bookswap WHERE name = ?";
    $stmt = mysqli_prepare($conn, $query2);
    mysqli_stmt_bind_param($stmt, "s", $item);
    mysqli_stmt_execute($stmt);
    $result2 = mysqli_stmt_get_result($stmt);

    if ($result2 && $row = mysqli_fetch_assoc($result2)) {
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
    echo $item;
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
?>

<?php
// Assuming you have a database connection established
include_once "config.php";
// Fetch books from the database
$query = "SELECT name, price, img FROM books_bookswap";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Fetch all rows as an associative array
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo '<div class="grid grid-cols-2 md:grid-cols-3 gap-4">';
    // Display the books
    foreach ($books as $book) {
      $bookname = $book['name'];
        echo '<div class="flex flex-col items-center">';
        echo '<img class="h-auto max-h-[200px] rounded-lg object-cover mx-auto" src="php/img/' . $book['img'] . '" alt="">';
        echo '<p class="text-center">' . $bookname . '</p>';
        echo '<p class="text-center">₹' . $book['price'] . '</p>';
        echo "<form method='post' action='/bookswap/index.php'>
                <input type='hidden' name='add_to_cart' value=" . $bookname . ">
                <button type='submit' class='p-2 px-6 bg-purple-500 text-white rounded-md hover:bg-purple-600'>Add To Cart</button>
                </form>";
        echo '</div>';
    }
    echo '</div>';
} else {
    // Handle the error if the query fails
    echo 'Error: ' . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
<div id="gallery" class="relative w-full px-4 py-4" data-carousel="slide">
  <!-- Carousel wrapper -->
  <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
     <!-- Item 1 -->
    <!-- <div class="hidden duration-700 ease-in-out" data-carousel-item>
      <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
    </div> -->
    <!-- Item 2 -->
    <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
      <img src="php/img/hero1.jpg" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
    </div>
    <!-- Item 3 -->
    <div class="hidden duration-700 ease-in-out" data-carousel-item>
      <img src="php/img/hero2.jpg" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
    </div>
    <!-- Item 4 -->
    <div class="hidden duration-700 ease-in-out" data-carousel-item>
      <img src="php/img/hero3.webp" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
    </div>
    <!-- Item 5 -->
    <div class="hidden duration-700 ease-in-out" data-carousel-item>
      <img src="php/img/hero4.webp" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="">
    </div>
  </div>
  <!-- Slider controls -->
  <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
      <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
      </svg>
      <span class="sr-only">Previous</span>
    </span>
  </button>
  <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
      <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
      </svg>
      <span class="sr-only">Next</span>
    </span>
  </button>
</div>



<?php
// include_once "components/_cart_icon.php"; 
include_once "components/_items.php"; 
?>



<?php
include_once "components/_cart_icon.php";
// include_once "components/_cart_icon.php"; 
include_once "components/_footer.php"; ?>
</body>

</html>