<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include 'db.php';

    // Get form data
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $job_title = mysqli_real_escape_string($conn, $_POST['job_title']);
    $job_category = mysqli_real_escape_string($conn, $_POST['job_category']);
    $job_type = mysqli_real_escape_string($conn, $_POST['job_type']);
    $offered_salary = mysqli_real_escape_string($conn, $_POST['offered_salary']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $complete_address = mysqli_real_escape_string($conn, $_POST['complete_address']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $required_skills = mysqli_real_escape_string($conn, $_POST['required_skills']);
    $responsibilities = mysqli_real_escape_string($conn, $_POST['responsibilities']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);

    // Handle file upload
    if (isset($_FILES['company_profile_image']) && $_FILES['company_profile_image']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['company_profile_image']['tmp_name'];
        $name = basename($_FILES['company_profile_image']['name']);
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . $name;

        // Ensure the upload directory exists
        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                die("Failed to create directory: " . $upload_dir);
            }
        }

        // Move the uploaded file
        if (move_uploaded_file($tmp_name, $upload_file)) {
            $company_profile_image = $upload_file;
        } else {
            $error_message = "Failed to move uploaded file.";
            echo $error_message;
            exit;
        }
    } else {
        $error_message = "No image uploaded or there was an error uploading. Error code: " . $_FILES['company_profile_image']['error'];
        echo $error_message;
        exit;
    }

    // Construct SQL query
    $sql = "INSERT INTO job_postings (company_name, job_title, job_category, job_type, offered_salary, experience, qualification, gender, country, location, email, website, complete_address, description, required_skills, responsibilities, start_date, end_date, company_profile_image) 
            VALUES ('$company_name', '$job_title', '$job_category', '$job_type', '$offered_salary', '$experience', '$qualification', '$gender', '$country', '$location', '$email', '$website', '$complete_address', '$description', '$required_skills', '$responsibilities', '$start_date', '$end_date', '$company_profile_image')";

    // Execute SQL query
    if (mysqli_query($conn, $sql)) {
        // Redirect with success message
        header("Location: dash-post-job.php?status=success");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>
