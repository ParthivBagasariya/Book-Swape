<?php
session_start();
include_once "../config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the form data
    $photo_name = $_POST["photo_name"];
    $image = $_FILES["image"];

    // Check if the image is valid
    if (!empty($image) && $image["error"] == 0) {

        // Get the image extension
        $extension = pathinfo($image["name"], PATHINFO_EXTENSION);

        // Validate the image extension
        if (!in_array($extension, ["jpg", "jpeg", "png"])) {
            $_SESSION['alert_msg'] = "Invalid image format.";
            header("Location: ../admin/manage.php");
            exit();
        }

        // Set the upload directory for photos
        $upload_dir = "../pics/";

        // Generate a unique image name
        $image_name = time() . "_" . uniqid() . "." . $extension;

        // Upload the image to the gallery folder
        move_uploaded_file($image["tmp_name"], $upload_dir . $image_name);

        $db_img_name = "pics/" . $image_name;
        // Insert data into the database
        $sql = "INSERT INTO gallery (img_name, img) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $photo_name, $db_img_name);
        $stmt->execute();
        $stmt->close();

        // Set session alert message
        $_SESSION['alertSuccess'] = "Photo added successfully.";

        // Redirect to manage.php or any other desired location
        header("Location: ../admin/gallery.php");
        exit();
    } else {
        $_SESSION['alertError'] = "Error uploading image.";
        header("Location: ../admin/gallery.php");
        exit();
    }
} else {
    $_SESSION['alertError'] = "Invalid request.";
    header("Location: ../admin/gallery.php");
    exit();
}
?>
