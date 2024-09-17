<?php
// Include database connection file
include 'db.php';

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $job_id = isset($_POST['job_id']) ? intval($_POST['job_id']) : null;
    $company_name = isset($_POST['company_name']) ? mysqli_real_escape_string($conn, $_POST['company_name']) : '';
    $job_title = isset($_POST['job_title']) ? mysqli_real_escape_string($conn, $_POST['job_title']) : '';
    $job_category = isset($_POST['job_category']) ? mysqli_real_escape_string($conn, $_POST['job_category']) : '';
    $job_type = isset($_POST['job_type']) ? mysqli_real_escape_string($conn, $_POST['job_type']) : '';
    $offered_salary = isset($_POST['offered_salary']) ? mysqli_real_escape_string($conn, $_POST['offered_salary']) : '';
    $experience = isset($_POST['experience']) ? mysqli_real_escape_string($conn, $_POST['experience']) : '';
    $qualification = isset($_POST['qualification']) ? mysqli_real_escape_string($conn, $_POST['qualification']) : '';
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : '';
    $country = isset($_POST['country']) ? mysqli_real_escape_string($conn, $_POST['country']) : '';
    $location = isset($_POST['location']) ? mysqli_real_escape_string($conn, $_POST['location']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $website = isset($_POST['website']) ? mysqli_real_escape_string($conn, $_POST['website']) : '';
    $complete_address = isset($_POST['complete_address']) ? mysqli_real_escape_string($conn, $_POST['complete_address']) : '';
    $description = isset($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : '';
    $required_skills = isset($_POST['required_skills']) ? mysqli_real_escape_string($conn, $_POST['required_skills']) : '';
    $responsibilities = isset($_POST['responsibilities']) ? mysqli_real_escape_string($conn, $_POST['responsibilities']) : '';
    $start_date = isset($_POST['start_date']) ? mysqli_real_escape_string($conn, $_POST['start_date']) : null;
    $end_date = isset($_POST['end_date']) ? mysqli_real_escape_string($conn, $_POST['end_date']) : null;

    // Validate required fields (example)
    if (empty($job_id) || empty($job_title)) {
        echo "Job ID and Job Title are required fields.";
        exit;
    }

    // Construct the SQL update query
    $query = "UPDATE job_postings SET 
                company_name = '$company_name', 
                job_title = '$job_title', 
                job_category = '$job_category', 
                job_type = '$job_type', 
                offered_salary = '$offered_salary', 
                experience = '$experience', 
                qualification = '$qualification', 
                gender = '$gender', 
                country = '$country', 
                location = '$location', 
                email = '$email', 
                website = '$website', 
                complete_address = '$complete_address', 
                description = '$description', 
                required_skills = '$required_skills', 
                responsibilities = '$responsibilities', 
                start_date = '$start_date', 
                end_date = '$end_date' 
              WHERE id = $job_id";

    // Execute the query
    if ($conn->query($query) === TRUE) {
        // Set a success message in session
        $_SESSION['success_message'] = "Job posting updated successfully.";
        // Redirect to the manage jobs page
        header('Location: dash-manage-jobs.php');
        exit;
    } else {
        echo "Error updating job posting: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
