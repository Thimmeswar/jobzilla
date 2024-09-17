<?php
session_start();

// Include your database connection
include 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_SESSION['id']; // Use session ID
    $old_password = trim($_POST['old_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_new_password']);

    // Fetch the stored password from the database
    $sql = "SELECT password FROM admin WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        echo "<script>alert('User not found.'); window.location.href = 'dash-change-password.php';</script>";
        exit;
    }

    $row = $result->fetch_assoc();
    $stored_password = $row['password'];
    
    if($old_password === ""){
       echo "<script>alert('Old password is must be filled.'); window.location.href = 'dash-change-password.php';</script>";
       exit; 
    }
    // Verify old password
    if ($old_password !== $stored_password) {
        echo "<script>alert('Old password is incorrect.'); window.location.href = 'dash-change-password.php';</script>";
        exit;
    }
    if ($new_password === ""){
       echo "<script>alert('New password is must be filled.'); window.location.href = 'dash-change-password.php';</script>";
       exit; 
    }
    // PHP validation for new password
    if (!preg_match('/[A-Z]/', $new_password) || !preg_match('/\d/', $new_password) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $new_password)) {
        echo "<script>alert('New password must contain at least one uppercase letter, one special character, and one number.'); window.location.href = 'dash-change-password.php';</script>";
        exit;
    }

    $letter_count = preg_replace('/[^a-zA-Z]/', '', $new_password);
    if (strlen($letter_count) < 4) {
        echo "<script>alert('New password must contain at least 4 alphabet letters.'); window.location.href = 'dash-change-password.php';</script>";
        exit;
    }

    if (strlen($new_password) < 8 || strlen($new_password) > 15) {
        echo "<script>alert('New password should be between 8 to 15 characters long.'); window.location.href = 'dash-change-password.php';</script>";
        exit;
    }
    if ($confirm_password === ""){
       echo "<script>alert('Confirm password is must be filled.'); window.location.href = 'dash-change-password.php';</script>";
       exit; 
    }
    // Check if new password and confirm password match
    if ($new_password !== $confirm_password) {
        echo "<script>alert('New password and confirm password should be same.'); window.location.href = 'dash-change-password.php';</script>";
        exit;
    }

    // Update the new password in the database
    $sql = "UPDATE admin SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_password, $admin_id);

    if ($stmt->execute()) {
        echo "<script>alert('Password changed successfully.'); window.location.href = 'dash-change-password.php';</script>";
    } else {
        echo "<script>alert('Error updating password: " . $conn->error . "'); window.location.href = 'dash-change-password.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
