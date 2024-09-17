<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if candidate ID is set in the session
if (isset($_SESSION['id'])) {
    $candidateid = $_SESSION['id'];
} else {
    die("No candidate ID found in the session.");
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['job_id'])) {
    $job_id = $_POST['job_id'];

    // Prepare the SQL statement to delete the job
    $stmt = $conn->prepare("
        DELETE FROM applied_jobs 
        WHERE jobid = ? AND candidateid = ?
    ");

    // Bind the job ID and candidate ID parameters (i for integer)
    $stmt->bind_param("ii", $job_id, $candidateid);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to delete job']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>
