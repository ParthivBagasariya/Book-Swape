<?php
session_start();
include_once "../config.php";

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
            $_SESSION['alert_msg'] = "Invalid image format.";
            header("Location: ./add_book.php");
            exit();
        }

        // Set the upload directory based on subcategory
        switch ($category) {
            case "BE":
                $upload_dir = "img/BE/";
                break;
            case "MBA":
                $upload_dir = "img/MBA/";
                break;
            default:
                $upload_dir = "img/uploaded/";
                break;
        }

        // Generate the image name using subcategory and timestamp
        $image_name = time() . "." . $extension;

        // Upload the image to the image folder
        move_uploaded_file($image["tmp_name"], $upload_dir . $image_name);
    }

    // Insert data into the database


    switch ($category) {
        case "BE":
            $img_path =  "BE/" . $image_name;
            break;
        case "MBA":
            $img_path =  "MBA/" . $image_name;
            break;
        default:
            $img_path =  "uploaded/" . $image_name;
            break;
    }

    $unique_id = $_SESSION['unique_id']; // Generate a unique ID
    $sql = "INSERT INTO books_bookswap (unique_id, category, subcategory, name, price, img) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $unique_id, $category, $subcategory, $name, $price, $img_path);
    $stmt->execute();
    $stmt->close();

    // Set session alert message
    $_SESSION['alert_msg'] = "Service added successfully.";

    // Redirect to manage.php
    header("Location: ../add_book.php");
    exit();
}



