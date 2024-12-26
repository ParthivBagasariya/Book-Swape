<nav class="bg-white border-gray-600 border-b-2 rounded-b-xl ">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="logo.svg" class="h-12" alt="Bookswap logo" />
            <span class="self-center text-2xl font-bold whitespace-nowrap ">BookSwap</span>
        </a>
        <button data-collapse-toggle="navbar-multi-level" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 " aria-controls="navbar-multi-level" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-multi-level">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a href="/bookswap" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 " aria-current="page">Home</a>
                </li>
                <li>
                    <a href="add_book.php" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 " aria-current="page">Add Book</a>
                </li>
                
                    <a href="/bookswap/#contact" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0  ">Contact</a>
                </li>
                <li>
                    <a href="/bookswap/#about" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0  ">About</a>
                </li>
            </ul>
        </div>


        <div class="text-center">
            <?php if (isset($_SESSION['unique_id'])) { ?>
                <!-- <div class="relative inline-block">
                    <button id="userDropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button">
                        <?php echo "Welcome Back, " . $_SESSION['username']; ?>
                    </button>
                    <ul class="user-menu absolute z-30 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <li>
                            <a href="php/logout.php" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
                        </li>
                        <li>
                            <a href="auth/forgotpassword.php" class="block px-4 py-2 hover:bg-gray-100">Forgot Password</a>
                        </li>
                    </ul>
                </div> -->

            <?php } else { ?>
                <div class="pt-4">
                <a href="auth/auth.php?auth=login">
                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button">Login</button>
                </a>
                <a href="auth/auth.php?auth=signup">
                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button">Register</button>
                </a>
                </div>
            <?php } ?>
            <?php if (!empty($_SESSION['cart'])) { ?>
                <a href="cart.php">
                    <button class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800" type="button">
                        Cart(<?php echo count($_SESSION['cart']); ?>)
                    </button>
                </a>
            <?php } ?>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Target the user dropdown button and menu
        const userDropdownButton = document.getElementById('userDropdown');
        const userDropdownMenu = document.querySelector('.user-menu');

        userDropdownButton.addEventListener('click', function(event) {
            // Prevent default action
            event.preventDefault();

            // Toggle the visibility of the dropdown menu
            userDropdownMenu.classList.toggle('hidden');
        });
    });
</script>