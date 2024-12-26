<?php
session_start();
include_once "../config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $token = $_POST["token"];
    $card_number = $_POST["card-number"];
    $expiration_date = $_POST["expiration-date"];
    $cvv = $_POST["cvv"];
    $card_holder = $_POST["card-holder"];

    // Validate the form data (you can add more validation as needed)

    // Insert payment information into the database
    $sql = "INSERT INTO payment_info (token, card_number, expiration_date, cvv, card_holder) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $token, $card_number, $expiration_date, $cvv, $card_holder);
    if ($stmt->execute()) {
        // Update payment status to "complete"
        $sql_update = "UPDATE orders SET payment_status = 'complete' WHERE token_no = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("s", $token);
        $stmt_update->execute();
        
        // Set session alert message for success
        $_SESSION['alertSuccess'] = "Payment information stored successfully.";
    } else {
        // Set session alert message for failure
        $_SESSION['alertError'] = "Failed to store payment information.";
    }

    // Redirect back to the previous page or any desired location
    header("Location: ../order_success.php?token=$token");
    exit();
} else {
    // Set session alert message for invalid request
    $_SESSION['alert_msg'] = "Invalid request.";
    header("Location: ../previous_page.php");
    exit();
}
?>
