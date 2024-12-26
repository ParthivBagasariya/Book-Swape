<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include_once "config.php";
include_once "header.php";
include_once "_navbar.php";
include "../php/alerts.php";

?>
<div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border mt-8">
    <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
        <div class="flex items-center justify-between gap-8 mb-8">
            <div>
                <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Add New Photo
                </h5>
                <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                    click btn to add a new service
                </p>
            </div>
            <div class="py-4 px-4">
                <button data-modal-target="add-photo-modal" data-modal-toggle="add-photo-modal" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Add Photo
                    </span>
                </button>
            </div>
        </div>


    </div>
</div>
<!-- Add photo modal -->
<div id="add-photo-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Add New Photo
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="add-photo-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="px-6 py-6 lg:px-8">
                <form method="post" action="../php/add_photo.php" class="space-y-4" autocomplete="TRUE" enctype="multipart/form-data">
                    <div class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                        <div class="text-center">
                            <input type="file" name="image" accept="image/*" required>
                        </div>
                        <div>
                            <label for="photo_name" class="block mb-2 text-sm font-semibold text-gray-900">Photo Name</label>
                            <input class="bg-gray-200 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:bg-white focus:border-blue-500 w-full py-3 px-4 mb-3 leading-tight" id="photo_name" name="photo_name" type="text" placeholder="Enter Photo Name" required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Add Photo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border mt-8">
    <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
        <div class="flex items-center justify-between gap-8 mb-8">
            <div>
                <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Gallery
                </h5>
                <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                    View and manage gallery images
                </p>
            </div>
        </div>
        <div class="p-6 px-0 overflow-scroll">
            <table class="w-full mt-4 text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Image Name
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Image
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Action
                            </p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch gallery images from the database
                    $sql = "SELECT * FROM gallery";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["img_name"] . "</td>";
                            echo "<td class='p-4 border-b border-blue-gray-50'><img src='../" . $row["img"] . "' alt='Gallery Image' class='w-20 h-20 object-cover rounded-full'></td>";
                            echo "<td class='p-4 border-b border-blue-gray-50'>
                            <a href='../php/delete_photo.php?delete_photo=". $row["id"] ."'>
                            <button class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'>Delete</button>
                            </a>          </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>0 results</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

                 

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>
</html>
