<?php
session_start();

// Database connection
include 'db.php';

// Initialize response array
$response = array('success' => false, 'error_message' => '');

// Validate input
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    $response['error_message'] = "Please enter both email and password.";
    echo json_encode($response);
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and execute the query
$stmt = $conn->prepare("SELECT id, email_id FROM candidate_profile WHERE email_id = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Successful login
    $row = $result->fetch_assoc();
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $row['id']; // Store the id in the session
    $response['success'] = true;
    $response['error_message'] = "Login successful! Welcome back.";
} else {
    // Invalid credentials
    $response['error_message'] = "Invalid email or password. Please try again.";
}

// Close connections
$stmt->close();
$conn->close();

// Send JSON response
echo json_encode($response);
?>
