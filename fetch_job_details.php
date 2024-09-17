<?php
// Database connection settings
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['job_id'])) {
    $job_id = $_POST['job_id'];

    // Prepare the SQL statement to fetch job details
    $stmt = $conn->prepare("
        SELECT 
            company_name, 
            job_title, 
            job_category, 
            experience, 
            description 
        FROM 
            job_postings 
        WHERE 
            id = ?
    ");

    // Bind the job ID parameter (i for integer)
    $stmt->bind_param("i", $job_id);

    // Execute the statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the job details
        $job_details = $result->fetch_assoc();
        echo json_encode($job_details);
    } else {
        echo json_encode(['error' => 'Job not found']);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
