<?php
session_start();
include_once "../config.php";

// Check if the GET request contains the parameter 'delete_photo' and it's not empty
if (isset($_GET['delete_photo']) && !empty($_GET['delete_photo'])) {
    // Sanitize the input to prevent SQL injection
    $photo_id = mysqli_real_escape_string($conn, $_GET['delete_photo']);

    // Select the photo from the database to get its details before deletion
    $sql_select = "SELECT img FROM gallery WHERE id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $photo_id);
    $stmt_select->execute();
    $result_select = $stmt_select->get_result();

    // Check if the photo exists
    if ($result_select->num_rows > 0) {
        // Fetch the photo details
        $row = $result_select->fetch_assoc();
        $img_name = $row['img'];

        // Delete the photo from the database
        $sql_delete = "DELETE FROM gallery WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $photo_id);
        $stmt_delete->execute();

        // Check if the photo is deleted successfully
        if ($stmt_delete->affected_rows > 0) {
            // Delete the photo file from the server
            $file_path = "../" . $img_name;
            if (file_exists($file_path)) {
                unlink($file_path); // Delete the file
            }

            // Set session alert message
            $_SESSION['alertSuccess'] = "Photo deleted successfully.";
        } else {
            // Set session alert message if deletion failed
            $_SESSION['alertError'] = "Failed to delete photo.";
        }
    } else {
        // Set session alert message if photo not found
        $_SESSION['alertError'] = "Photo not found.";
    }
} else {
    // Set session alert message if delete_photo parameter is missing or empty
    $_SESSION['alertError'] = "Invalid request.";
}

// Redirect back to the manage.php page
header("Location: ../admin/gallery.php");
exit();
?>
