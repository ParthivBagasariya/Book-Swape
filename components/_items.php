<?php
$categories = ['BE', 'BCA', 'BCOM', 'MCA'];
$items = [
    ['img' => 'php/img/BE/EP.jpeg', 'price' => '₹10.99'],
    ['img' => 'php/img/BE/FA.jpeg', 'price' => '₹12.99'],
    ['img' => 'php/img/BE/ipdc.jpeg', 'price' => '₹8.99'],
    ['img' => 'php/img/BE/mc_engg_diploma.jpeg', 'price' => '₹15.99'],
    ['img' => 'php/img/BE/ml.jpeg', 'price' => '₹9.99'],
    ['img' => 'php/img/BE/PEE.jpeg', 'price' => '₹7.99'],
    ['img' => 'php/img/BE/WD.jpeg', 'price' => '₹11.99']
];
?>

<!-- <div class="flex items-center justify-center py-4 md:py-8 flex-wrap">
    <button type="button" class="text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800">All categories</button>
    <?php foreach ($categories as $category) : ?>
        <button type="button" class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:text-white dark:focus:ring-gray-800"><?= $category ?></button>
    <?php endforeach; ?>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
    <?php foreach ($items as $item) : ?>
        <div class="flex flex-col items-center">
            <img class="h-auto max-h-[200px] rounded-lg object-cover mx-auto" src="<?= $item['img'] ?>" alt="">
            <p class="text-center"><?= $item['price'] ?></p>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Add to Cart</button>
        </div>
    <?php endforeach; ?>
</div> -->

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
        echo '<div class="flex flex-col items-center">';
        echo '<img class="h-auto max-h-[200px] rounded-lg object-cover mx-auto" src="php/img/' . $book['img'] . '" alt="">';
        echo '<p class="text-center">' . $book['name'] . '</p>';
        echo '<p class="text-center">₹' . $book['price'] . '</p>';
        echo "<form method='post' action=''>
                <input type='hidden' name='add_to_cart' value=" . $book['name'] . ">
                <button type='submit' class='p-2 px-6 bg-purple-500 text-white rounded-md hover:bg-purple-600'>Add To Cart</button>
                </form>";
        echo '</div>';
    }
    echo '</div>';
} else {
    // Handle the error if the query fails
    echo 'Error: ' . mysqli_error($connection);
}

// Close the database connection
mysqli_close($conn);
?>