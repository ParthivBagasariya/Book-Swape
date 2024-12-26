<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the form data
    $category = $_POST["category"];
    $subcategory = $_POST["subcategory"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $image = $_FILES["image"];


    // Check if the image is valid
    if (!empty($image) && $image["error"] == 0) {

        // Get the image extension
        $extension = pathinfo($image["name"], PATHINFO_EXTENSION);

        // Validate the image extension
        if (!in_array($extension, ["jpg", "jpeg", "png"])) {
            echo "Invalid image format.";
            return;
        }

        // Upload the image to the image folder
        $upload_dir = "img/uploaded/";
        $image_name = uniqid() . "." . $extension;
        move_uploaded_file($image["tmp_name"], $upload_dir . $image_name);
    }

    // Print the customer details
    echo "Customer details:";
    echo "<ul>";
    echo "<li>Name: $name</li>";
    echo "<li>Category: $category</li>";
    echo "<li>Subcategory: $subcategory</li>";
    echo "<li>Price: $price</li>";
    if (!empty($image_name)) {
        echo "<li>Image: <img src='$upload_dir$image_name' alt='$name' style='width: 100px; height: 100px;'></li>";
    }
    echo "</ul>";
}

// Remove the unnecessary closing PHP tag
