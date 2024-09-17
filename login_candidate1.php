<?php
session_start(); 
include 'db.php'; // Include your database connection file

// Get the job id from the URL
$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($job_id > 0) {
    // Prepare a SQL query to fetch the job details by id
    $query = "SELECT * FROM job_postings WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $job_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if job details are found
    if ($result->num_rows > 0) {
        $job = $result->fetch_assoc();
        // Store all the relevant fields
        $job_category = $job['job_category'];
        $job_title = $job['job_title'];
        $company_name = $job['company_name'];
        $offered_salary = $job['offered_salary'];
        $location = $job['location'];
        $website = $job['website'];
        $end_date = date("F j, Y", strtotime($job['end_date']));
        $created_at = date("F j, Y", strtotime($job['created_at']));
        $company_profile_image = $job['company_profile_image'];
        $complete_address = $job['complete_address'];
        $description = $job['description'];
        $responsibilities = $job['responsibilities'];
    } else {
        // If no job is found, show an alert and redirect
        echo "<script>alert('Job not found. Redirecting...'); window.location.href = 'job-detail.php?id=" . htmlspecialchars($_GET['id']) . "';
</script>";
        exit();
    }

    $stmt->close();
} else {
    // If invalid job id, show an alert and redirect
    echo "<script>alert('Invalid Job ID. Redirecting...'); window.location.href = 'job-detail.php?id=" . htmlspecialchars($_GET['id']) . "';</script>";
    exit();
}

// Close the database connection
$conn->close();
?>
