<?php
// Get the cart items from the session
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Get the count of cart items
$cartItemCount = count($cartItems);
?>
<div class="ml-6 mb-4 sticky bottom-5 flex justify-end z-30 cursor-pointer" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">
    <div>
        <h1 class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white ">

            <span class="flex items-center relative px-5 py-2.5 transition-all ease-in duration-75 bg-white rounded-md group-hover:bg-opacity-0">
                <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                    <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                </svg>
                Cart (<?php echo $cartItemCount; ?>)
            </span>
        </h1>
    </div>
</div>
<!-- drawer component -->
<div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 " tabindex="-1" aria-labelledby="drawer-right-label">
    <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 "><svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>Cart Items</h5>
    <?php
    $cartItems = getCartItems();
    foreach ($cartItems as $item) {
        echo '
<div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
<img class="w-40 mx-auto rounded-xl" src="php/img/' . $item['img'] . '" alt="">
        <h2 class="mb-2 text-lg font-bold tracking-tight text-gray-900 ">' . $item['name'] . '</h2>
    <p class="mb-3 font-normal text-gray-700 ">₹ ' . $item['price'] . '</p>
</div>
';
        echo "
        <form method='post' action=''>
      <input type='hidden' name='remove_from_cart' value='" . $item['name'] . "'>
      
      <button type='submit' class='font-bold text-red-500'>Remove from Cart</button>
      </form>";
        echo "<br>";
    }
    $totalPrice = 0;
    foreach ($cartItems as $item) {
        $totalPrice += $item['price'];
    }
    echo "Total Price: ₹" . $totalPrice;
    ?>
    <form method="get" action="checkout.php">
        <button type="submit" class="mt-4 px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">Checkout</button>
    </form>
</div>