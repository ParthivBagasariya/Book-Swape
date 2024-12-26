<?php
echo '
        <div class="py-10">
        <h1 class=" flex justify-center mt-2 text-2xl font-bold text-gray-800 md:text-3xl uppercase "> ' . $subcategory . ' </h1>
        <img class="w-40 mx-auto" src="php/img/images/heading.png" >
        </div>
        ';
        
        // Query to fetch items with category=wedding and subcategory=mahendi
        $query = "SELECT name, price, img FROM services WHERE category = 'wedding' AND subcategory = 'mandap'";

        // Execute the query
        $result = mysqli_query($conn, $query);
        
        // Check if the query was successful
        if ($result && mysqli_num_rows($result) > 0) {
            // Display the items
            echo '
            <section class="container mx-auto px-4 p-10 md:py-12 md:p-8">
            <section class="p-5 md:p-0 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">
            ';

            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['name'];
                $price = $row['price'];
                echo '
                <section class="p-5 py-8 border-2 border-purple-300 rounded-xl backdrop-blur-md text-center transform duration-500 hover:-translate-y-2 cursor-pointer">
                <img class="w-[80%] h-[80%] object-cover mx-auto rounded-lg drop-shadow-xl" src="php/img/' . $row['img'] . '" alt="">
                <h1 class="font-bold text-base my-3">' . $name . '</h1>
                <h2 class="font-semibold mb-5">₹ ' . $price . '</h2>';
                
                echo "<form method='post' action=''>
                <input type='hidden' name='add_to_cart' value='$name'>
                <button type='submit' class='p-2 px-6 bg-purple-500 text-white rounded-md hover:bg-purple-600'>Add To Cart</button>
                </form>
                </section>
                ";
            }
            echo '
                </section>
                </section>';

        } else {
            // No items found
            echo "No items found.";
        }

        
        ?>