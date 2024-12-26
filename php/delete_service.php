<?php
session_start();
include_once "../config.php";

// Check if the GET request contains the parameter 'delete_id' and it's not empty
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    // Sanitize the input to prevent SQL injection
    $service_id = mysqli_real_escape_string($conn, $_GET['delete_id']);

    // Delete the service from the database
    $sql_delete = "DELETE FROM services WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $service_id);
    $stmt_delete->execute();

    // Check if the service is deleted successfully
    if ($stmt_delete->affected_rows > 0) {
        // Set session alert message
        $_SESSION['alertSuccess'] = "Service deleted successfully.";
    } else {
        // Set session alert message if deletion failed
        $_SESSION['alertError'] = "Failed to delete service.";
    }
} else {
    // Set session alert message if delete_id parameter is missing or empty
    $_SESSION['alertError'] = "Invalid request.";
}

// Redirect back to the manage.php page
header("Location: ../admin/manage.php");
exit();
?>
