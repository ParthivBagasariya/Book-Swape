<?php
session_start();
include_once "../config.php";

// Assume you've verified the user's identity and the reset token is valid
// Let's say the verified email is stored in $_SESSION['reset_email']

$new_password = mysqli_real_escape_string($conn, $_POST['new-password']);
$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm-password']);

// Check if new passwords are set and match
if (!empty($new_password) && !empty($confirm_password)) {
    if ($new_password === $confirm_password) {
        // Ideally, you should use password_hash() instead of md5 for hashing passwords
        $hashed_password = md5($new_password);
        
        // Update the user's password in the database
        $unique_id = $_SESSION['unique_id']; // Assuming the email is stored in the session
        $sql = mysqli_query($conn, "UPDATE users SET password = '{$hashed_password}' WHERE unique_id = '{$unique_id}'");
        
        if ($sql) {
            // Password updated successfully
            header("Location: ../index.php");
            $_SESSION['alertSuccess'] = "Your password has been updated successfully!";
        } else {
            // Error updating password
            header("Location: ../Auth/auth.php?auth=forgotpassword"); // Assuming this is the reset password page
            $_SESSION['alertError'] = "Failed to update your password!";
        }
    } else {
        // New passwords do not match
        header("Location: ../Auth/auth.php?auth=forgotpassword"); // Assuming this is the reset password page
        $_SESSION['alertError'] = "The passwords do not match!";
    }
} else {
    // New password fields are empty
    header("Location: ../Auth/auth.php?auth=forgotpassword"); // Assuming this is the reset password page
    $_SESSION['alertError'] = "All input fields are required!";
}
?>
