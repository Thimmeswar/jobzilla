<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "jobzilla"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the admin is logged in
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

// Get the admin ID from the POST request
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
    exit();
}

// Prepare the SQL statement to delete the profile from the admin table
$sql = "DELETE FROM admin WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Successfully deleted the profile
        // Destroy the session to log out the user
        session_unset();
        session_destroy();
        echo json_encode(['success' => true, 'message' => 'Profile deleted successfully']);
    } else {
        // Error executing the statement
        echo json_encode(['success' => false, 'message' => 'Error deleting profile']);
    }

    $stmt->close();
} else {
    // Error preparing the statement
    echo json_encode(['success' => false, 'message' => 'Error preparing SQL statement']);
}

$conn->close();
?>
