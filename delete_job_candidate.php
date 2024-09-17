<?php
// Database connection
include 'db.php';

if (isset($_POST['delete'])) {
    $id = $_POST['id']; // Get the candidate's application ID from the form

    // SQL query to delete the candidate's application
    $sql = "DELETE FROM applied_jobs WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Candidate application has been successfully deleted.'); window.location.href='dash-candidates.php';</script>";

    } else {
        echo "<script>alert('Error deleting the candidate application. Please try again.');</script>";
    }

    $stmt->close();
}

$conn->close();
?>