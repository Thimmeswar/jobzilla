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
        // Display the job details
        
        // Add more fields as needed
    } else {
        echo "<p>Job not found.</p>";
    }

    $stmt->close();
} else {
    echo "<p>Invalid job ID.</p>";
}

$conn->close();
?>
<?php

include 'db.php'; // Include your database connection file

// Get the job id from the URL
$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Initialize the candidate array
$candidate = [
    'first_name' => '',
    'last_name' => '',
    'phone' => '',
    'email' => '',
    'id' => 0,
    'country' => ''
];

// Fetch candidate details from the session if logged in
if (isset($_SESSION['id'])) {
    $candidate_id = $_SESSION['id'];

    $stmt = $conn->prepare("SELECT firstname, lastname, phone, email_id, id, country FROM candidate_profile WHERE id = ?");
    $stmt->bind_param("i", $candidate_id);
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name, $phone, $email, $id, $country);

    if ($stmt->fetch()) {
        $candidate['first_name'] = $first_name;
        $candidate['last_name'] = $last_name;
        $candidate['phone'] = $phone;
        $candidate['email'] = $email;
        $candidate['id'] = $id;
        $candidate['country'] = $country;
    }
    $stmt->close();
}

if ($job_id > 0 && $candidate['id'] > 0) {
    // Check if the job has already been applied by the candidate
    $query = "SELECT id FROM applied_jobs WHERE jobid = ? AND candidateid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $job_id, $candidate['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Job already applied
      echo "<script>
    alert('You have already applied for this job.');
    window.location.href = 'Jobs.php';
</script>";


    } else {
        // Job not applied, show job details and apply option
        // Fetch and display job details
        $job_query = "SELECT * FROM job_postings WHERE id = ?";
        $job_stmt = $conn->prepare($job_query);
        $job_stmt->bind_param('i', $job_id);
        $job_stmt->execute();
        $job_result = $job_stmt->get_result();

        if ($job_result->num_rows > 0) {
            $job = $job_result->fetch_assoc();
           
        } else {
            echo "<p>Job not found.</p>";
        }

        $job_stmt->close();
    }

    $stmt->close();
} else {
   
}

$conn->close();
?>


<?php

include 'db.php'; // Include your database connection file

$candidate = [
    'first_name' => '',
    'last_name' => '',
    'phone' => ''
];

if (isset($_SESSION['id'])) {
    $candidate_id = $_SESSION['id'];

    $stmt = $conn->prepare("SELECT firstname, lastname, phone, email_id, id,country FROM candidate_profile WHERE id = ?");
$stmt->bind_param("i", $candidate_id);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $phone, $email_id, $id,$country);

// Fetch and store the result in the $candidate array
if ($stmt->fetch()) {
    $candidate['first_name'] = $first_name;
    $candidate['last_name'] = $last_name;
    $candidate['phone'] = $phone;
    $candidate['email'] = $email_id;
    $candidate['id'] = $id;
    $candidate['country'] = $country;
        
    }
    $stmt->close();
}

$conn->close();
?>
<?php
// Start the session


// Include database connection
include 'db.php'; // Update with your actual database connection file

// Initialize variables for error messages
$email_error = '';
$password_error = '';
$general_error = '';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email and password from the POST request
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validate input
    if (empty($email)) {
        $email_error = 'Email is required.';
    }

    if (empty($password)) {
        $password_error = 'Password is required.';
    }

    if (empty($email_error) && empty($password_error)) {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, firstname, lastname, password FROM candidate_profile WHERE email_id = ?");
        $stmt->bind_param('s', $email);

        // Execute the query
        $stmt->execute();
        $stmt->store_result();

        // Check if the candidate exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $firstname, $lastname, $stored_password);
            $stmt->fetch();

            // Verify the password
            if ($password === $stored_password) {
                // Set session variables
                $_SESSION['id'] = $id;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;

                // Redirect to job-detail.php with success alert
                echo "<script>
                    alert('Login successful! Redirecting to the Jobs page...');
                    window.location.href = 'job-detail.php?id=" . htmlspecialchars($_GET['id']) . "';
                </script>";
                exit();
            } else {
                $password_error = 'Invalid password. Please enter the correct password.';
            }
        } else {
            $email_error = 'Invalid email. Please enter the correct email ID.';
        }

        // If both email and password are wrong, display a combined message
        if (!empty($email_error) && !empty($password_error)) {
            $general_error = 'Both email and password are incorrect. Please enter the correct credentials.';
            echo "<script>
                alert('$general_error');
                window.location.href = 'job-detail.php?id=" . htmlspecialchars($_GET['id']) . "';
            </script>";
        } else {
            // Show individual alerts for email or password errors
            if (!empty($email_error)) {
                echo "<script>
                    alert('$email_error');
                    window.location.href = 'job-detail.php?id=" . htmlspecialchars($_GET['id']) . "';
                </script>";
            } elseif (!empty($password_error)) {
                echo "<script>
                    alert('$password_error');
                    window.location.href = 'job-detail.php?id=" . htmlspecialchars($_GET['id']) . "';
                </script>";
            }
        }

        // Close the statement
        $stmt->close();
    } else {
        // Redirect with error messages for missing fields
        if (!empty($email_error)) {
            echo "<script>
                alert('$email_error');
                window.location.href = 'job-detail.php?id=" . htmlspecialchars($_GET['id']) . "';
            </script>";
        } elseif (!empty($password_error)) {
            echo "<script>
                alert('$password_error');
                window.location.href = 'job-detail.php?id=" . htmlspecialchars($_GET['id']) . "';
            </script>";
        }
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">


<head>
    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />    
    <meta name="description" content="" />
    
    <!-- FAVICONS ICON -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
    
    <!-- PAGE TITLE HERE -->
    <title>Jobzilla Template | Job detail</title>
    
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"><!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"><!-- FONTAWESOME STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/feather.css"><!-- FEATHER ICON SHEET -->
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css"><!-- OWL CAROUSEL STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/magnific-popup.min.css"><!-- MAGNIFIC POPUP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/lc_lightbox.css"><!-- Lc light box popup -->     
    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css"><!-- BOOTSTRAP SLECT BOX STYLE SHEET  -->
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap5.min.css"><!-- DATA table STYLE SHEET  -->
    <link rel="stylesheet" type="text/css" href="css/select.bootstrap5.min.css"><!-- DASHBOARD select bootstrap  STYLE SHEET  -->     
    <link rel="stylesheet" type="text/css" href="css/dropzone.css"><!-- DROPZONE STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/scrollbar.css"><!-- CUSTOM SCROLL BAR STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"><!-- DATEPICKER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/flaticon.css"> <!-- Flaticon -->
    <link rel="stylesheet" type="text/css" href="css/swiper-bundle.min.css"><!-- Swiper Slider -->
    <link rel="stylesheet" type="text/css" href="css/style.css"><!-- MAIN STYLE SHEET -->

    <!-- THEME COLOR CHANGE STYLE SHEET -->
    <link rel="stylesheet" class="skin" type="text/css" href="css/skins-type/skin-6.css">
    <!-- SIDE SWITCHER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/switcher.css">   
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY" async defer></script>
</head>

<body>

    <!-- LOADING AREA START ===== -->
<!--    <div class="loading-area">
        <div class="loading-box"></div>
        <div class="loading-pic">
            <div class="wrapper">
                <div class="cssload-loader"></div>
            </div>
        </div>
    </div>-->
    <!-- LOADING AREA  END ====== -->

	<div class="page-wraper">
     
        <!-- HEADER START -->
       <?php        include 'header.php';?>
        <!-- HEADER END -->

      
        <!-- CONTENT START -->
        <div class="page-content">

            <!-- INNER PAGE BANNER -->
            <div class="wt-bnr-inr overlay-wraper bg-center" style="background-image:url(images/banner/1.jpg); height: 300px;">
                <div class="overlay-main site-bg-white opacity-01"></div>
                <div class="container">
                    <div class="wt-bnr-inr-entry">
                        <div class="banner-title-outer">
                            <div class="banner-title-name">
                                <?php


include 'db.php';
// Query to fetch job details
 
$sql = "SELECT * FROM job_postings WHERE id = $job_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Fetch data
    $row = $result->fetch_assoc();
    $job_category = $row['job_category'];
    $job_title = $row['job_title'];
    $company_name = $row['company_name'];
    $offered_salary = $row['offered_salary'];
    $location = $row['location'];
    $website = $row['website'];
    $end_date = date("F j, Y", strtotime($row['end_date']));
    $created_at = date("F j, Y", strtotime($row['created_at']));
    $company_profile_image = $row['company_profile_image'];
    $complete_address = $row['complete_address'];
    $description = $row['description'];
     $responsibilities = $row['responsibilities'];
} else {
    // Set default values if no data is found
    $job_title = "Not Available";
    $company_name = "Not Available";
    $offered_salary = "Not Available";
    $location = "Not Available";
    $website = "#";
    $end_date = "Not Available";
    $created_at = "Not Available";
    $company_profile_image = "images/jobs-company/default.jpg"; // Default image path
    $complete_address = "Not Available";
}

$conn->close();
?>
   <h2 class="wt-title"><?php echo htmlspecialchars($job_category); ?></h2>

</div>

                        </div>
                        <!-- BREADCRUMB ROW -->                            
                        
                            <div>
                                <ul class="wt-breadcrumb breadcrumb-style-2">
                                    <li><a href="index.php">Home</a></li>
                                    <li>Job Detail</li>
                                </ul>
                            </div>
                        
                        <!-- BREADCRUMB ROW END -->                        
                    </div>
                </div>
            </div>
            <!-- INNER PAGE BANNER END -->



            <!-- OUR BLOG START -->
            <div class="section-full  p-t120 p-b90 bg-white">
                <div class="container">
                
                    <!-- BLOG SECTION START -->
                    <div class="section-content">
                        <div class="row d-flex justify-content-center">
                        
                            <div class="col-lg-8 col-md-12">
                                <!-- Candidate detail START -->
                                <div class="cabdidate-de-info">
                                    <div class="twm-job-self-wrap">
                                        <div class="twm-job-self-info">
                                          <?php
include 'db.php';

// Function to calculate time difference
function timeAgo($datetime) {
    $createdDate = new DateTime($datetime);
    $now = new DateTime();
    $interval = $now->diff($createdDate);

    if ($interval->y >= 1) {
        return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
    } elseif ($interval->m >= 1) {
        return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
    } elseif ($interval->d >= 10) { // Check if the difference is more than 10 days
        $weeks = floor($interval->d / 7); // Calculate weeks
        return $weeks . ' week' . ($weeks > 1 ? 's' : '') . ' ago';
    } elseif ($interval->d >= 1) {
        return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
    } elseif ($interval->h >= 1) {
        return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
    } else {
        return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
    }
}

// Query to fetch job details
 
$sql = "SELECT * FROM job_postings WHERE id = $job_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Fetch data
    $row = $result->fetch_assoc();
    $job_category = $row['job_category'];
    $job_title = $row['job_title'];
    $company_name = $row['company_name'];
    $offered_salary = $row['offered_salary'];
    $location = $row['location'];
    $website = $row['website'];
    $end_date = date("F j, Y", strtotime($row['end_date']));
    $start_date = timeAgo($row['start_date']); // Calculate relative time using start_date
    $company_profile_image = $row['company_profile_image'];
    $complete_address = $row['complete_address'];
    $description = $row['description'];
    $responsibilities = $row['responsibilities'];
    $required_skills = $row['required_skills']; 
} else {
    // Set default values if no data is found
    $job_title = "Not Available";
    $company_name = "Not Available";
    $offered_salary = "Not Available";
    $location = "Not Available";
    $website = "#";
    $end_date = "Not Available";
    $start_date = "Not Available"; // Updated default value
    $company_profile_image = "images/jobs-company/default.jpg"; // Default image path
    $complete_address = "Not Available";
}

$conn->close();
?>


<div class="twm-job-self-top">
    <div class="twm-media-bg">
        <img src="images/job-detail-bg.jpg" alt="#">
        <div class="twm-jobs-category green"><span class="twm-bg-green">New</span></div>
    </div>

    <div class="twm-mid-content">
        <div class="twm-media">
            <img src="<?php echo $company_profile_image; ?>" alt="#">
        </div>

        <h4 class="twm-job-title"><?php echo $job_title; ?> <span class="twm-job-post-duration">/ <?php echo  $start_date; ?></span></h4>
        <p class="twm-job-address"><i class="feather-map-pin"></i><?php echo $complete_address; ?></p>
        <div class="twm-job-self-mid">
            <div class="twm-job-self-mid-left">
                <a href="<?php echo $website; ?>" class="twm-job-websites site-text-primary"><?php echo $website; ?></a>
                <div class="twm-jobs-amount"><?php echo $offered_salary; ?> <span>/ Month</span></div>
            </div>
            <div class="twm-job-apllication-area">Application ends:
                <span class="twm-job-apllication-date"><?php echo $end_date; ?></span>
            </div>
        </div>

        <div class="twm-job-self-bottom">
    <a id="apply-now-btn" class="site-button" role="button">
        Apply Now
    </a>
</div>

<script>
    document.getElementById('apply-now-btn').addEventListener('click', function() {
        <?php if(isset($_SESSION['id'])): ?>
            // Candidate is logged in, show the apply modal
            var applyJobModal = new bootstrap.Modal(document.getElementById('apply_job_popup'));
            applyJobModal.show();
        <?php else: ?>
            // Candidate is not logged in, show an alert and then display the signup modal
            var signUpModal = new bootstrap.Modal(document.getElementById('sign_up_popup2'));
            signUpModal.show();
        <?php endif; ?>
    });
</script>
    </div>
</div>

                                        </div>
                                    </div>

                                    <h4 class="twm-s-title">Job Description:</h4>
<p><?php echo $description; ?></p>
<h4 class="twm-s-title">Required Skills:</h4>
<ul class="description-list-2">
    <?php
    $required_skills = $row['required_skills']; // Retrieve required skills from database
    $skills_list = explode("\n", $required_skills); // Split by new lines
    foreach ($skills_list as $skill) {
        $skill = trim($skill); // Remove extra spaces or newlines
        if (!empty($skill)) {
            echo "<li><i class='feather-check'></i>$skill</li>";
        }
    }
    ?>
</ul>


                                    <h4 class="twm-s-title">Responsibilities:</h4>

<ul class="description-list-2">
    <?php
    // Assuming responsibilities are stored as a newline-separated string in the database
    $responsibilities_list = explode("\n", $responsibilities); // Split by new lines
    foreach ($responsibilities_list as $responsibility) {
        $responsibility = trim($responsibility); // Remove any extra spaces or newlines
        if (!empty($responsibility)) {
            echo "<li><i class='feather-check'></i>$responsibility</li>";
        }
    }
    ?>
</ul>


                                  
                                    

                                    

                                    <div class="twm-two-part-section">
                                        <div class="row">

                                            
                                            

                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-12 rightSidebar">

                                <div class="side-bar mb-4">
                                    <div class="twm-s-info2-wrap mb-5">
                                        <?php
include 'db.php';
// Query to fetch job details
 // Example job ID, you can replace this with dynamic ID
$sql = "SELECT * FROM job_postings WHERE id = $job_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Fetch data
    $row = $result->fetch_assoc();
    $date_posted = date("F d, Y", strtotime($row['created_at']));
    $location = $row['location'];
    $job_title = $row['job_title'];
    $experience = $row['experience'];
    $qualification = $row['qualification'];
    $gender = $row['gender'];
    $offered_salary = $row['offered_salary'];
} else {
    // Set default values if no data is found
    $date_posted = "Not Available";
    $location = "Not Available";
    $job_title = "Not Available";
    $experience = "Not Available";
    $qualification = "Not Available";
    $gender = "Not Available";
    $offered_salary = "Not Available";
}

$conn->close();
?>

<div class="twm-s-info2">
    <h4 class="section-head-small mb-4">Job Information</h4>
   
    <ul class="twm-job-hilites2">
        <li>
            <div class="twm-s-info-inner">
                <i class="fas fa-calendar-alt"></i>
                <span class="twm-title">Date Posted</span>
                <div class="twm-s-info-discription"><?php echo $date_posted; ?></div>
            </div>
        </li>
        <li>
            <div class="twm-s-info-inner">
                <i class="fas fa-map-marker-alt"></i>
                <span class="twm-title">Location</span>
                <div class="twm-s-info-discription"><?php echo $location; ?></div>
            </div>
        </li>
        <li>
            <div class="twm-s-info-inner">
                <i class="fas fa-user-tie"></i>
                <span class="twm-title">Job Title</span>
                <div class="twm-s-info-discription"><?php echo $job_title; ?></div>
            </div>
        </li>
        <li>
            <div class="twm-s-info-inner">
                <i class="fas fa-clock"></i>
                <span class="twm-title">Experience</span>
                <div class="twm-s-info-discription"><?php echo $experience; ?></div>
            </div>
        </li>
        <li>
            <div class="twm-s-info-inner">
                <i class="fas fa-suitcase"></i>
                <span class="twm-title">Qualification</span>
                <div class="twm-s-info-discription"><?php echo $qualification; ?></div>
            </div>
        </li>
        <li>
            <div class="twm-s-info-inner">
                <i class="fas fa-venus-mars"></i>
                <span class="twm-title">Gender</span>
                <div class="twm-s-info-discription"><?php echo $gender; ?></div>
            </div>
        </li>
        <li>
            <div class="twm-s-info-inner">
                <i class="fas fa-money-bill-wave"></i>
                <span class="twm-title">Offered Salary</span>
                <div class="twm-s-info-discription"><?php echo $offered_salary; ?></div>
            </div>
        </li>
    </ul>
</div>

                                    </div>
    
                                    

                                </div>

                                <?php
include 'db.php';

// Query to fetch job details
 // Example job ID, replace with dynamic ID if needed
$sql = "SELECT * FROM job_postings WHERE id = $job_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // Fetch data
    $row = $result->fetch_assoc();
    $company_name = $row['company_name'];
    $job_title = $row['job_title'];
   
    $email = $row['email'];
    $website = $row['website'];
    $complete_address = $row['complete_address'];
    $company_profile_image = $row['company_profile_image'];
} else {
    // Set default values if no data is found
    $company_name = "Not Available";
    $job_title = "Not Available";
    $phone = "Not Available";
    $email = "Not Available";
    $website = "Not Available";
    $complete_address = "Not Available";
    $company_profile_image = "images/jobs-company/default.jpg"; // Default image path
}

$conn->close();
?>

<div class="twm-s-info3-wrap mb-5">
    <div class="twm-s-info3">
        <div class="twm-s-info-logo-section">
            <div class="twm-media">
                <img src="<?php echo $company_profile_image; ?>" alt="#">
            </div>
            <h4 class="twm-title"><?php echo $job_title; ?></h4>
        </div>
        <ul>
            <li>
                <div class="twm-s-info-inner">
                    <i class="fas fa-building"></i>
                    <span class="twm-title">Company</span>
                    <div class="twm-s-info-discription"><?php echo $company_name; ?></div>
                </div>
            </li>
            
            
            <li>
                <div class="twm-s-info-inner">
                    <i class="fas fa-desktop"></i>
                    <span class="twm-title">Website</span>
                    <div class="twm-s-info-discription"><?php echo $website; ?></div>
                </div>
            </li>
            <li>
                <div class="twm-s-info-inner">
                    <i class="fas fa-map-marker-alt"></i>
                    <span class="twm-title">Address</span>
                    <div class="twm-s-info-discription"><?php echo $complete_address; ?></div>
                </div>
            </li>
        </ul>
    </div>
</div>


                                <div class="twm-advertisment" style="background-image:url(images/add-bg.jpg);">
                                    <div class="overlay"></div>
                                    <h4 class="twm-title">Recruiting?</h4>
                                    <p>Get Best Matched Jobs On your <br>
                                     Email. Add Resume NOW!</p>
                                     <a href="javascript:;" class="site-button white">Read More</a> 
                                 </div>
    
    
                            </div>
                        
                        </div>
                                                
                    </div>
                    
                </div>
                
            </div>   
            <!-- OUR BLOG END -->          
            
     
        </div>
        <!-- CONTENT END -->
<div class="modal fade" id="apply_job_popup" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="sign_up_popupLabel">Apply For This Job</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="applied.php" method="post" enctype="multipart/form-data">
                    <div class="apl-job-inpopup">
                        <div class="panel panel-default">
                            <div class="panel-body wt-panel-body p-a20">
                                <div class="twm-tabs-style-1">
                                    <div class="row">
                                        <!-- Hidden fields for jobid and candidateid -->
                                        <input type="hidden" id="jobid" name="jobid" value="<?php echo htmlspecialchars($job_id); ?>">
                                        <input type="hidden" id="candidateid" name="candidateid" value="<?php echo htmlspecialchars($id); ?>">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" id="country" class="form-control" name="country" value="<?php echo htmlspecialchars($country); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Job Category</label>
                                                <input type="text" id="category" class="form-control" name="category" value="<?php echo htmlspecialchars($job_category); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <select class="form-control" name="title">
                                                    <option value="Mr">Mr</option>
                                                    <option value="Ms">Ms</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <div class="ls-inputicon-box">
                                                    <input class="form-control" id="first_name" name="first_name" type="text" placeholder="First Name" >
                                                    <i class="fs-input-icon fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <div class="ls-inputicon-box">
                                                    <input class="form-control" id="last_name" name="last_name" type="text" placeholder="Last Name" >
                                                    <i class="fs-input-icon fa fa-user"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <div class="ls-inputicon-box">
                                                    <input class="form-control" id="emailid" name="email" type="email" placeholder="Email Address" >
                                                    <i class="fs-input-icon fas fa-at"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input class="form-control" id="phone" name="phone" type="text" placeholder="Phone Number" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>How did you hear about us?</label>
                                                <select class="form-control" name="source" >
                                                     <option value="" disabled selected>Select</option>
                                                    <option value="company_career_page">Company Career Page</option>
                                                    <option value="linkedin">LinkedIn</option>
                                                    <option value="naukri">Naukri</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6">
    <div class="form-group">
        <label>Experience (Years)</label>
        <select class="form-control" name="experience_years" >
            <option value="" disabled selected>Select Experience (Years)</option>
            <option value="1">Less Than 1 year</option>
            <option value="1">1 year</option>
            <option value="2">2 years</option>
            <option value="3">3 years</option>
            <option value="4">4 years</option>
            <option value="5">5 years</option>
        </select>
    </div>
</div>

<!-- Experience (Months) -->
<div class="col-xl-6 col-lg-6 col-md-6">
    <div class="form-group">
        <label>Experience (Months)</label>
        <select class="form-control" name="experience_months" >
            <option value="" disabled selected>Select Experience (Months)</option>
            <option value="1">1 Month</option>
            <option value="2">2 Months</option>
            <option value="3">3 Months</option>
            <option value="4">4 Months</option>
            <option value="5">5 Months</option>
        </select>
    </div>
</div>

<!-- Notice Period (Months) -->
<div class="col-xl-6 col-lg-6 col-md-6">
    <div class="form-group">
        <label>Notice Period (Months)</label>
        <select class="form-control" name="notice_period" >
            <option value="" disabled selected>Select Notice Period (Months)</option>
            <option value="1">1 Month</option>
            <option value="2">2 Months</option>
            <option value="3">3 Months</option>
            <option value="4">4 Months</option>
            <option value="5">5 Months</option>
            <option value="6">6 Months</option>
            <option value="7">7 Months</option>
            <option value="8">8 Months</option>
            <option value="9">9 Months</option>
            <option value="10">10 Months</option>
            <option value="11">11 Months</option>
            <option value="12">12 Months</option>
        </select>
    </div>
</div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Your Remark</label>
                                                <textarea class="form-control" name="remark" rows="3" placeholder="Your Remark" ></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Your Skill</label>
                                                <textarea class="form-control" name="skill" rows="1" placeholder="Your Skill" ></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Are you currently an employee at this company?</label><br>
                                                <input type="radio" name="is_employee" value="yes"> Yes
                                                <input type="radio" name="is_employee" value="no"> No
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Upload Resume</label>
                                                <input class="form-control" name="resume" type="file">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Upload Picture</label>
                                                <input class="form-control" name="picture" type="file">
                                            </div>
                                        </div>

                                        <input type="hidden" name="status" value="pending">

                                        <!-- Submit Button -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit Application</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
   document.querySelector("form").addEventListener("submit", function (event) {
    // Validate first name
    const firstName = document.getElementById("first_name").value.trim();
    if (firstName === "") {
        alert("First name is required.");
        event.preventDefault();
        return;
    }

    // Validate last name
    const lastName = document.getElementById("last_name").value.trim();
    if (lastName === "") {
        alert("Last name is required.");
        event.preventDefault();
        return;
    }

    // Ensure first name and last name are not the same
    if (firstName.toLowerCase() === lastName.toLowerCase()) {
        alert("First name and last name cannot be the same.");
        event.preventDefault();
        return;
    }

    // Name regex: Only letters, at least 5 characters
    const nameRegex = /^[A-Za-z]{3,}( [A-Za-z]{3,})?$/;
    if (!nameRegex.test(firstName) || !nameRegex.test(lastName)) {
        alert("Names should only contain letters, may have one space, and be at least 3 characters long.");
        event.preventDefault();
        return;
    }


    // Validate email
    const email = document.getElementById("emailid").value.trim();
    const emailRegex = /^[^\s@]+@gmail\.com$/;
    if (email === "") {
        alert("Email address is required.");
        event.preventDefault();
        return;
    } else if (!emailRegex.test(email)) {
        alert("Please enter a valid Gmail address (ending with @gmail.com).");
        event.preventDefault();
        return;
    }

    // Validate phone number: Starts with 6-9, only digits, 10 digits long
    const phone = document.getElementById("phone").value.trim();
    const phoneRegex = /^[6-9]\d{9}$/;
    if (phone === "") {
        alert("Phone number is required.");
        event.preventDefault();
        return;
    } else if (!phoneRegex.test(phone)) {
        alert("Please enter a valid 10-digit phone number that starts with 6, 7, 8, or 9.");
        event.preventDefault();
        return;
    }

    // Validate source selection
    const source = document.querySelector("select[name='source']").value;
    if (source === "") {
        alert("Please select how you heard about us.");
        event.preventDefault();
        return;
    }

    // Validate experience years
    const experienceYears = document.querySelector("select[name='experience_years']").value;
    if (experienceYears === "") {
        alert("Please select your experience in years.");
        event.preventDefault();
        return;
    }

    // Validate experience months
    const experienceMonths = document.querySelector("select[name='experience_months']").value;
    if (experienceMonths === "") {
        alert("Please select your experience in months.");
        event.preventDefault();
        return;
    }

    // Validate notice period
    const noticePeriod = document.querySelector("select[name='notice_period']").value;
    if (noticePeriod === "") {
        alert("Please select your notice period in months.");
        event.preventDefault();
        return;
    }

    // Validate remark
    const remark = document.querySelector("textarea[name='remark']").value.trim();
    if (remark === "") {
        alert("Please enter your remark.");
        event.preventDefault();
        return;
    }

    // Validate skill
    const skill = document.querySelector("textarea[name='skill']").value.trim();
    if (skill === "") {
        alert("Please enter your skill.");
        event.preventDefault();
        return;
    }

    // Validate employee status
    const isEmployee = document.querySelector("input[name='is_employee']:checked");
    if (!isEmployee) {
        alert("Please select if you are currently an employee at this company.");
        event.preventDefault();
        return;
    }

    // Validate resume file type (PDF only)
    const resume = document.querySelector("input[name='resume']").files[0];
    if (!resume) {
        alert("Please upload your resume.");
        event.preventDefault();
        return;
    } else if (resume.type !== "application/pdf") {
        alert("Only PDF files are allowed for the resume.");
        event.preventDefault();
        return;
    }

    // Validate picture file (PNG and JPEG only)
    const picture = document.querySelector("input[name='picture']").files[0];
    if (!picture) {
        alert("Please upload your picture.");
        event.preventDefault();
        return;
    } else if (picture.type !== "image/png" && picture.type !== "image/jpeg") {
        alert("Only PNG and JPG files are allowed for the picture.");
        event.preventDefault();
        return;
    }
});
</script>
<!-- FOOTER START -->
<?php include 'footer.php';?>
<!-- FOOTER END -->
<!--Model Popup Section Start-->
            <!--Signup popup -->
<?php    include 'login-signup.php';?>
        </div>
    </div>
</div>


    <!-- Bootstrap JS (Ensure you have included the latest version) -->
    <script src="path/to/bootstrap.bundle.js"></script>

    <!-- Automatically trigger login modal if signup was successful -->
    
        <!--Model Popup Section End-->


 	</div>
<!-- Logout popup -->
<?php include('Candidate_logout_session.php'); ?>


<!-- JAVASCRIPT  FILES ========================================= --> 
<script  src="js/jquery-3.6.0.min.js"></script><!-- JQUERY.MIN JS -->
<script  src="js/popper.min.js"></script><!-- POPPER.MIN JS -->
<script  src="js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script  src="js/magnific-popup.min.js"></script><!-- MAGNIFIC-POPUP JS -->
<script  src="js/waypoints.min.js"></script><!-- WAYPOINTS JS -->
<script  src="js/counterup.min.js"></script><!-- COUNTERUP JS -->
<script  src="js/waypoints-sticky.min.js"></script><!-- STICKY HEADER -->
<script  src="js/isotope.pkgd.min.js"></script><!-- MASONRY  -->
<script  src="js/imagesloaded.pkgd.min.js"></script><!-- MASONRY  -->
<script  src="js/owl.carousel.min.js"></script><!-- OWL  SLIDER  -->
<script  src="js/theia-sticky-sidebar.js"></script><!-- STICKY SIDEBAR  -->
<script  src="js/lc_lightbox.lite.js" ></script><!-- IMAGE POPUP -->
<script  src="js/bootstrap-select.min.js"></script><!-- Form js -->
<script  src="js/dropzone.js"></script><!-- IMAGE UPLOAD  -->
<script  src="js/jquery.scrollbar.js"></script><!-- scroller -->
<script  src="js/bootstrap-datepicker.js"></script><!-- scroller -->
<script  src="js/jquery.dataTables.min.js"></script><!-- Datatable -->
<script  src="js/dataTables.bootstrap5.min.js"></script><!-- Datatable -->
<script  src="js/chart.js"></script><!-- Chart -->
<script  src="js/bootstrap-slider.min.js"></script><!-- Price range slider -->
<script  src="js/swiper-bundle.min.js"></script><!-- Swiper JS -->
<script  src="js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
<script  src="js/switcher.js"></script><!-- SHORTCODE FUCTIONS  -->

<script>
    // Pre-fill form fields with PHP data
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('first_name').value = "<?= $candidate['first_name'] ?>";
        document.getElementById('last_name').value = "<?= $candidate['last_name'] ?>";
        document.getElementById('phone').value = "<?= $candidate['phone'] ?>";
        document.getElementById('emailid').value = "<?= $candidate['email'] ?>";
       document.getElementById('candidate_id').value = "<?= $candidate['id'] ?>";

        
   
    });
</script>

</body>

<!-- Mirrored from thewebmax.org/jobzilla/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2024 12:14:41 GMT -->
</html>


    
   