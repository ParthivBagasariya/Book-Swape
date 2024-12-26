<nav class="bg-white border-gray-600 border-b-2 rounded-b-xl">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <!-- <img src="image.png" class="h-12" alt="Wewin Event logo" /> -->
            <span class="self-center text-2xl font-bold whitespace-nowrap">BookSwap Admin</span>
        </a>
        <button data-collapse-toggle="navbar-multi-level" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-multi-level" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-multi-level">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a href="index.php" class="block py-2 px-3 text-blue-700 font-bold rounded md:bg-transparent md:text-blue-700 md:p-0" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="orders.php" class="block py-2 px-3 text-blue-700 font-bold rounded md:bg-transparent md:text-blue-700 md:p-0" aria-current="page">Orders</a>
                </li>
                <li>
                    <a href="manage.php" class="block py-2 px-3 text-blue-700 font-bold rounded md:bg-transparent md:text-blue-700 md:p-0" aria-current="page">Manage Services</a>
                </li>
                <li>
                    <a href="gallery.php" class="block py-2 px-3 text-blue-700 font-bold rounded md:bg-transparent md:text-blue-700 md:p-0" aria-current="page">Manage Gallery</a>
                </li>
                <li>
                    <a href="users.php" class="block py-2 px-3 text-blue-700 font-bold rounded md:bg-transparent md:text-blue-700 md:p-0" aria-current="page">Users</a>
                </li>
                <li>
                    <a href="add_admin.php" class="block py-2 px-3 text-blue-700 font-bold rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Add Admin</a>
                </li>
            </ul>
        </div>

        <?php
        if (isset($_SESSION['admin_logged_in'])) {
            echo '<a href="logout.php" class="block py-2 px-3 font-bold text-red-500 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Logout</a>';
        }
        ?>
    </div>
</nav>
