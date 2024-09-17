<?php
// Include database connection file
include 'db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data with default values
    $jobid = isset($_POST['jobid']) ? (int)$_POST['jobid'] : 0;
    $id = isset($_POST['candidateid']) ? (int)$_POST['candidateid'] : 0;
    $title = isset($_POST['title']) ? mysqli_real_escape_string($conn, $_POST['title']) : '';
    $first_name = isset($_POST['first_name']) ? mysqli_real_escape_string($conn, $_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? mysqli_real_escape_string($conn, $_POST['last_name']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : '';
    $source = isset($_POST['source']) ? mysqli_real_escape_string($conn, $_POST['source']) : '';
    $experience_years = isset($_POST['experience_years']) ? (int)$_POST['experience_years'] : 0;
    $experience_months = isset($_POST['experience_months']) ? (int)$_POST['experience_months'] : 0;
    $notice_period = isset($_POST['notice_period']) ? (int)$_POST['notice_period'] : 0;
    $remark = isset($_POST['remark']) ? mysqli_real_escape_string($conn, $_POST['remark']) : '';
    $skill = isset($_POST['skill']) ? mysqli_real_escape_string($conn, $_POST['skill']) : '';
    $country = isset($_POST['country']) ? mysqli_real_escape_string($conn, $_POST['country']) : '';
    $job_category = isset($_POST['category']) ? mysqli_real_escape_string($conn, $_POST['category']) : '';
    $is_employee = isset($_POST['is_employee']) ? mysqli_real_escape_string($conn, $_POST['is_employee']) : 'no';
    $status = isset($_POST['status']) ? mysqli_real_escape_string($conn, $_POST['status']) : 'pending';

    // File upload handling for resume and picture
    $resume = NULL;
    $picture = NULL;
    
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == UPLOAD_ERR_OK) {
        $resume = 'uploads/' . basename($_FILES['resume']['name']);
        move_uploaded_file($_FILES['resume']['tmp_name'], $resume);
    }

    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == UPLOAD_ERR_OK) {
        $picture = 'uploads/' . basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $picture);
    }

    // Check if the jobid exists in the job_postings table
    $checkJobQuery = "SELECT id FROM job_postings WHERE id = $jobid";
    $jobResult = mysqli_query($conn, $checkJobQuery);
    if (mysqli_num_rows($jobResult) == 0) {
        echo "<script>alert('Error: jobid does not exist in the job_postings table.');</script>";
    } else {
        // Check if the id exists in the candidate_profile table
        $checkCandidateQuery = "SELECT id FROM candidate_profile WHERE id = $id";
        $candidateResult = mysqli_query($conn, $checkCandidateQuery);
        if (mysqli_num_rows($candidateResult) == 0) {
            echo "<script>alert('Error: id does not exist in the candidate_profile table.');</script>";
        } else {
            // Check if the job has already been applied by the candidate
            $checkApplicationQuery = "SELECT id FROM applied_jobs WHERE jobid = $jobid AND candidateid = $id";
            $applicationResult = mysqli_query($conn, $checkApplicationQuery);

            if (mysqli_num_rows($applicationResult) > 0) {
                echo "<script>alert('Error: You have already applied for this job.'); window.location.href = 'Jobs.php';</script>";
            } else {
                // Prepare SQL statement for insertion
                $query = "INSERT INTO applied_jobs 
                    (jobid, candidateid, title, first_name, last_name, email, phone, source, experience_years, experience_months, notice_period, remark, skill, country, job_category, is_employee, resume, picture, status) 
                    VALUES (
                        $jobid, 
                        $id, 
                        '$title', 
                        '$first_name', 
                        '$last_name', 
                        '$email', 
                        '$phone', 
                        '$source', 
                        $experience_years, 
                        $experience_months, 
                        $notice_period, 
                        '$remark', 
                        '$skill', 
                        '$country', 
                        '$job_category', 
                        '$is_employee', 
                        '$resume', 
                        '$picture', 
                        '$status'
                    )";

                if (mysqli_query($conn, $query)) {
                    echo "<script>alert('Job Applied successfully.'); window.location.href = 'Jobs.php';</script>";
                } else {
                    echo "<script>alert('Error executing statement: " . mysqli_error($conn) . "');</script>";
                }
            }
        }
    }
}

// Close the connection
mysqli_close($conn);
?>

