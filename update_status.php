<?php
// Database connection
include('db.php');

if (isset($_POST['candidate_id']) && isset($_POST['status'])) {
    $candidateId = $_POST['candidate_id'];
    $status = $_POST['status'];

    // Validate inputs
    $candidateId = mysqli_real_escape_string($conn, $candidateId);
    $status = mysqli_real_escape_string($conn, $status);

    // Update query
    $query = "UPDATE applied_jobs SET status = '$status' WHERE id = '$candidateId'";
    
    if (mysqli_query($conn, $query)) {
        echo "Status updated successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
