<?php
session_start();
include_once "config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: auth/auth.php?auth=login");
}



include_once "header.php";
include_once "components/_navbar.php";
include_once "php/alerts.php";
?>

<div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border mt-8">
    <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
        <div class="flex items-center justify-between gap-8 mb-8">
            <div>
                <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                    Add New Book
                </h5>
                <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                    click btn to add a new Book
                </p>
            </div>
            <div class="py-4 px-4">
                <button data-modal-target="add-service-modal" data-modal-toggle="add-service-modal" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Add Book
                    </span>
                </button>
            </div>
        </div>


    </div>
</div>
<!-- Add service modal -->
<div id="add-service-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Add New Book
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="add-service-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="px-6 py-6 lg:px-8">
                <form method="post" action="php/add_book.php" class="space-y-4" autocomplete="TRUE" enctype="multipart/form-data">
                    <div class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
                        <div class="text-center">
                            <input type="file" name="image" accept="image/*" required>

                        </div>

                        <div>
                            <label for="category" class="block mb-2 text-sm font-semibold text-gray-900">Category</label>
                            <select class="bg-gray-200 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:bg-white focus:border-blue-500 w-full py-3 px-4 mb-3 leading-tight" id="category" name="category" required onchange="updateSubcategoryOptions()">
                                <option value="">Select Category</option>
                                <option value="BE">BE</option>
                                <option value="BCA">BCA</option>
                                <option value="BCOM">BCOM</option>
                                <option value="MBA">MBA</option>
                            </select>
                        </div>
                            </select>
                        </div>
                        <div>
                            <label for="subcategory" class="block mb-2 text-sm font-semibold text-gray-900">Subcategory</label>
                            <select class="bg-gray-200 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:bg-white focus:border-blue-500 w-full py-3 px-4 mb-3 leading-tight" id="subcategory" name="subcategory" required>
                                <option value="">Select Subcategory</option>
                            </select>
                        </div>

                        <div>
                            <label for="name" class="block mb-2 text-sm font-semibold text-gray-900">Name</label>
                            <input class="bg-gray-200 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:bg-white focus:border-blue-500 w-full py-3 px-4 mb-3 leading-tight" id="name" name="name" type="text" placeholder="Enter Name" required>
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-semibold text-gray-900">Price</label>
                            <input class="bg-gray-200 border border-gray-300 text-gray-700 text-sm rounded-lg focus:outline-none focus:bg-white focus:border-blue-500 w-full py-3 px-4 mb-3 leading-tight" id="price" name="price" type="number" placeholder="Enter Price" required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Add Service</button>
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
                    Your List
                </h5>
            </div>
        </div>
        <div class="p-6 px-0 overflow-scroll">
            <table class="w-full mt-4 text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Image
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Category
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Subcategory
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Name
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Price
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
                // Fetch services from the database
                $sql = "SELECT * FROM books_bookswap";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    echo '<p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                    See information about all your added books in past.
                </p>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "
                       
                        <td class='p-4 border-b border-blue-gray-50 cursor-pointer font-bold text-blue-600'>
                        <img src='php/img/" . $row["img"] . "' alt='Service Image' class='w-20 h-20 object-cover rounded-full'>
                        </td>
                        ";
                        echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["category"] . "</td>";
                        echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["subcategory"] . "</td>";
                        echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["name"] . "</td>";
                        echo "<td class='p-4 border-b border-blue-gray-50'>" . $row["price"] . "</td>";
                        echo "<td class='p-4 border-b border-blue-gray-50'>
                        <a href='edit_service.php?id=". $row["id"] . "'>
                                <button class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Edit</button>
                                </>
                                <a href='../php/delete_service.php?delete_id=". $row["id"] . "'>
                                <button class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'>Delete</button>
                                </>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr class='font-bold text-xl'><td colspan='6' class='font-bold text-xl'>You have not added any book yet.</td></tr>";
                }
                ?>
            </tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
    function updateSubcategoryOptions() {
        var categorySelect = document.getElementById("category");
        var subcategorySelect = document.getElementById("subcategory");
        var subcategoryOptions = subcategorySelect.options;

        // Clear existing options
        subcategoryOptions.length = 0;

        // Add default option
        var defaultOption = document.createElement("option");
        defaultOption.text = "Select Subcategory";
        subcategorySelect.add(defaultOption);

        // Add options based on selected category
        if (categorySelect.value === "BE") {
            addOption(subcategorySelect, "BE 1st Year");
            addOption(subcategorySelect, "BE 2nd Year");
            addOption(subcategorySelect, "BE 3rd Year");
            addOption(subcategorySelect, "BE 4th Year");
        } else if (categorySelect.value === "BCA") {
            addOption(subcategorySelect, "BCA 1st Year");
            addOption(subcategorySelect, "BCA 2nd Year");
            addOption(subcategorySelect, "BCA 3rd Year");
        } else if (categorySelect.value === "BCOM") {
            addOption(subcategorySelect, "BCOM 1st Year");
            addOption(subcategorySelect, "BCOM 2nd Year");
            addOption(subcategorySelect, "BCOM 3rd Year");
        } else if (categorySelect.value === "MBA") {
            addOption(subcategorySelect, "MBA 1st Year");
            addOption(subcategorySelect, "MBA 2nd Year");
        }
    }

    function addOption(selectElement, optionText) {
        var option = document.createElement("option");
        option.text = optionText;
        selectElement.add(option);
    }
</script>
</body>

</html>