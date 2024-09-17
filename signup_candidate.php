<?php
// Database connection
include 'db.php';

// Validate input
if (!isset($_POST['prefix']) || empty($_POST['prefix'])) {
    echo "<script>alert('Prefix is required'); window.location.href='index.php';</script>";
    exit();
}

// Check for existing email or phone number
$email_id = $_POST['email_id'];
$phone = $_POST['phone'];

$sql = "SELECT id FROM candidate_profile WHERE email_id = ? OR phone = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email_id, $phone);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // If a record is found with the same email or phone, show an error
    echo "<script>alert('Email or Phone number already exists. Please use a different one.'); window.location.href='index.php';</script>";
    $stmt->close();
    $conn->close();
    exit();
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO candidate_profile (prefix, firstname, lastname, email_id, phone, country, countrycode, password, confirmpassword) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $prefix, $firstname, $lastname, $email_id, $phone, $country, $countrycode, $password, $confirmpassword);

// Set parameters and execute
$prefix = $_POST['prefix'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$country = $_POST['country'];
$countrycode = $_POST['countrycode'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];

if ($stmt->execute()) {
    echo "<script>alert('Registered successfully'); window.location.href='index.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
