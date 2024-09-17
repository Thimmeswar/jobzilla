<?php
session_start();

include 'db.php';


// Initialize variables
$prefix = '';
$firstname = '';
$lastname = '';
$countrycode = '';
$phone = '';
$country = '';
$email = '';
$resume = '';
$profile_img = '';
$errors = [];

// Handling form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch form data
    $prefix = isset($_POST['prefix']) ? htmlspecialchars($_POST['prefix']) : '';
    $firstname = isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : '';
    $countrycode = isset($_POST['countrycode']) ? htmlspecialchars($_POST['countrycode']) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    $country = isset($_POST['country']) ? htmlspecialchars($_POST['country']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $profile_img = isset($_POST['profile_image']) ? htmlspecialchars($_POST['profile_image']) : '';
    
    // Validation
    if ($prefix === '') {
        $errors[] = 'Please select a title.';
    }
    if (empty($firstname) || !preg_match("/^[a-zA-Z\s]+$/", $firstname)) {
        $errors[] = 'First Name is required and must contain only letters and spaces.';
    }
    if (empty($lastname) || !preg_match("/^[a-zA-Z\s]+$/", $lastname)) {
        $errors[] = 'Last Name is required and must contain only letters and spaces.';
    }
    if (strtolower($firstname) === strtolower($lastname)) {
        $errors[] = 'First Name and Last Name cannot be the same.';
    }
    if (empty($country) || !preg_match("/^[a-zA-Z\s]+$/", $country)) {
        $errors[] = 'Country is required and must contain only letters and spaces.';
    }
    if (!preg_match("/^[6-9][0-9]{9}$/", $phone)) {
        $errors[] = 'Contact No must be a 10-digit number starting with 6, 7, 8, or 9.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match("/@gmail\.com$/", $email)) {
        $errors[] = 'Email must be a valid Gmail address.';
    }
    
    // Handle file upload validation
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES['resume'];
        $validFileTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        if ($file['size'] > 5 * 1024 * 1024) { // Check if file size exceeds 5MB
            $errors[] = 'Resume file size must be less than 5MB.';
        } else if (!in_array($file['type'], $validFileTypes)) {
            $errors[] = 'Resume file must be in PDF, DOC, or DOCX format.';
        }
        if (empty($errors)) {
            $resume = $file['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($file["name"]);
            move_uploaded_file($file["tmp_name"], $target_file);
        }
    } else {
        // If no new file was uploaded, keep the old resume name
        $resume = isset($_POST['current_resume']) ? htmlspecialchars($_POST['current_resume']) : '';
    }

    // If no errors, proceed with database update
    if (empty($errors)) {
        if (isset($_SESSION['id'])) {
            $candidate_id = $_SESSION['id'];

            $sql = "UPDATE candidate_profile SET prefix=?, firstname=?, lastname=?, countrycode=?, phone=?, country=?, email_id=?, profile_image=?, resume=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssi", $prefix, $firstname, $lastname, $countrycode, $phone, $country, $email, $profile_img, $resume, $candidate_id);

            if ($stmt->execute()) {
                echo "<script>alert('Profile updated successfully');</script>";
            } else {
                echo "<script>alert('Error updating record: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('No user is logged in.');</script>";
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    }
} else {
    // Fetch data from database if not a POST request
    if (isset($_SESSION['id'])) {
        $candidate_id = $_SESSION['id'];

        $sql = "SELECT prefix, firstname, lastname, countrycode, phone, country, email_id, resume, profile_image FROM candidate_profile WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $candidate_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($prefix, $firstname, $lastname, $countrycode, $phone, $country, $email, $resume, $profile_img);
        $stmt->fetch();
        $stmt->close();
    } else {
        echo "<script>alert('No user is logged in.');</script>";
    }
}

// Close the connection
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
    <title>TalentTap Solutions | Candidate Applied jobs</title>
    
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
          <?php include('header.php'); ?>
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
                                <h2 class="wt-title">Candidate Applied Jobs</h2>
                            </div>
                        </div>
                        <!-- BREADCRUMB ROW -->                            
                        
                            <div>
                                <ul class="wt-breadcrumb breadcrumb-style-2">
                                    <li><a href="index.php">Home</a></li>
                                    <li>Applied Jobs</li>
                                </ul>
                            </div>
                        
                        <!-- BREADCRUMB ROW END -->                        
                    </div>
                </div>
            </div>
            <!-- INNER PAGE BANNER END -->


            <!-- OUR BLOG START -->
            <div class="section-full p-t120  p-b90 site-bg-white">
                

                <div class="container">
                     <?php include('side_bar_user.php'); ?>


                       <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
    <!--Filter Short By-->
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

    // Database credentials
    include 'db.php';

    // Prepare the SQL statement using MySQLi
    $stmt = $conn->prepare("
        SELECT 
            jp.id AS job_id,
            jp.job_title,
            jp.job_category,
            jp.company_name,
            aj.created_at AS applied_date,
            aj.status
        FROM 
            applied_jobs aj
        INNER JOIN 
            job_postings jp ON aj.jobid = jp.id
        WHERE 
            aj.candidateid = ? AND aj.status IN ('pending', 'rejected')
    ");

    // Bind the candidate ID parameter (i for integer)
    $stmt->bind_param("i", $candidateid);

    // Execute the statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Fetch all rows as an associative array
    $applied_jobs = $result->fetch_all(MYSQLI_ASSOC);

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    ?>

    <div class="twm-right-section-panel candidate-save-job site-bg-gray">
        <div class="twm-D_table table-responsive">
            <table id="jobs_bookmark_table" class="table table-bordered twm-candidate-save-job-list-wrap">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($applied_jobs)): ?>
                        <?php foreach ($applied_jobs as $job): ?>
                        <tr>
                            <td>
                                <div class="twm-candidate-save-job-list">
                                    <div class="twm-media">
                                        <div class="twm-media-pic">
                                            <img src="images/jobs-company/pic1.jpg" alt="#"> <!-- Placeholder image -->
                                        </div>
                                    </div>
                                    <div class="twm-mid-content">
                                        <a href="#" class="twm-job-title">
                                            <h4><?php echo htmlspecialchars($job['job_category']); ?></h4>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td><a href="javascript:;"><?php echo htmlspecialchars($job['company_name']); ?></a></td>
                            <td>
                                <div><?php echo htmlspecialchars($job['applied_date']); ?></div>
                            </td>
                            <td>
                                <div><?php echo htmlspecialchars($job['status']); ?></div>
                            </td>
                            <td>
                                <div class="twm-table-controls">
                                    <ul class="twm-DT-controls-icon list-unstyled">
                                        <li>
                                            <a data-bs-toggle="modal" href="#saved-jobs-view" role="button" class="custom-toltip view-job" data-job-id="<?php echo htmlspecialchars($job['job_id']); ?>">
                                                <span class="fa fa-eye"></span>
                                                <span class="custom-toltip-block">View</span>
                                            </a>
                                        </li>
                                        <li>
                                            <button title="Delete" data-bs-toggle="tooltip" data-bs-placement="top" class="delete-job1" data-job-id="<?php echo htmlspecialchars($job['job_id']); ?>">
                                                <span class="far fa-trash-alt"></span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No jobs available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

                    
                    
                    
                    
</div>

                        </div>

                    </div>
                </div>
            </div>   
            <!-- OUR BLOG END -->
          
            
     
        </div>
        <!-- CONTENT END -->

        <!-- FOOTER START -->
        <?php include 'Candidate_logout_session.php';?>

<!-- Delete popup -->
<?php include 'Delete_candidate_profile.php';?>
        <!-- FOOTER END -->

        <!-- BUTTON TOP START -->
		<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

        <!--Model Popup Section Start-->
            <!--Signup popup -->
            <div class="modal fade twm-sign-up" id="sign_up_popup" aria-hidden="true" aria-labelledby="sign_up_popupLabel1" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form>

                            <div class="modal-header">
                                <h2 class="modal-title" id="sign_up_popupLabel1">Sign Up</h2>
                                <p>Sign Up and get access to all the features of Jobzilla</p>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="twm-tabs-style-2">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    <!--Signup Candidate-->  
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sign-candidate" type="button"><i class="fas fa-user-tie"></i>Candidate</button>
                                    </li>
                                    <!--Signup Employer-->
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sign-Employer" type="button"><i class="fas fa-building"></i>Employer</button>
                                    </li>
                                    
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                    <!--Signup Candidate Content-->  
                                    <div class="tab-pane fade show active" id="sign-candidate">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="username" type="text" required="" class="form-control" placeholder="Usearname*">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="email" type="text" class="form-control" required="" placeholder="Password*">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="phone" type="text" class="form-control" required="" placeholder="Email*">
                                                </div>
                                            </div>
            
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="phone" type="text" class="form-control" required="" placeholder="Phone*">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <div class=" form-check">
                                                        <input type="checkbox" class="form-check-input" id="agree1">
                                                        <label class="form-check-label" for="agree1">I agree to the <a href="javascript:;">Terms and conditions</a></label>
                                                        <p>Already registered?
                                                            <button class="twm-backto-login" data-bs-target="#sign_up_popup2" data-bs-toggle="modal" data-bs-dismiss="modal">Log in here</button>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="site-button">Sign Up</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <!--Signup Employer Content--> 
                                    <div class="tab-pane fade" id="sign-Employer">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="username" type="text" required="" class="form-control" placeholder="Usearname*">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="email" type="text" class="form-control" required="" placeholder="Password*">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="phone" type="text" class="form-control" required="" placeholder="Email*">
                                                </div>
                                            </div>
            
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <input name="phone" type="text" class="form-control" required="" placeholder="Phone*">
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <div class=" form-check">
                                                        <input type="checkbox" class="form-check-input" id="agree2">
                                                        <label class="form-check-label" for="agree2">I agree to the <a href="javascript:;">Terms and conditions</a></label>
                                                        <p>Already registered?
                                                            <button class="twm-backto-login" data-bs-target="#sign_up_popup2" data-bs-toggle="modal" data-bs-dismiss="modal">Log in here</button>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="site-button">Sign Up</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    </div>
                                </div> 
                            </div>

                            <div class="modal-footer">
                                <span class="modal-f-title">Login or Sign up with</span>
                                <ul class="twm-modal-social">
                                    <li><a href="javascript.php" class="facebook-clr"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="javascript.php" class="twitter-clr"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="javascript.php" class="linkedin-clr"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="javascript.php" class="google-clr"><i class="fab fa-google"></i></a></li>
                                </ul>
                            </div>

                        </form>
                    </div>
                </div>
                
            </div>
            <!--Login popup -->
            <div class="modal fade twm-sign-up" id="sign_up_popup2" aria-hidden="true" aria-labelledby="sign_up_popupLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    
                        <form>
                            <div class="modal-header">
                                <h2 class="modal-title" id="sign_up_popupLabel2">Login</h2>
                                <p>Login and get access to all the features of Jobzilla</p>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="twm-tabs-style-2">
                                    <ul class="nav nav-tabs" id="myTab2" role="tablist">

                                        <!--Login Candidate-->  
                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#login-candidate" type="button"><i class="fas fa-user-tie"></i>Candidate</button>
                                        </li>
                                        <!--Login Employer-->
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#login-Employer" type="button"><i class="fas fa-building"></i>Employer</button>
                                        </li>
                                    
                                    </ul>
                                    
                                    <div class="tab-content" id="myTab2Content">
                                        <!--Login Candidate Content-->  
                                        <div class="tab-pane fade show active" id="login-candidate">
                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <input name="username" type="text" required="" class="form-control" placeholder="Usearname*">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <input name="email" type="text" class="form-control" required="" placeholder="Password*">
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <div class=" form-check">
                                                            <input type="checkbox" class="form-check-input" id="Password3">
                                                            <label class="form-check-label rem-forgot" for="Password3">Remember me <a href="javascript:;">Forgot Password</a></label>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="site-button">Log in</button>
                                                    <div class="mt-3 mb-3">Don't have an account ? 
                                                        <button class="twm-backto-login" data-bs-target="#sign_up_popup" data-bs-toggle="modal" data-bs-dismiss="modal">Sign Up</button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <!--Login Employer Content--> 
                                        <div class="tab-pane fade" id="login-Employer">
                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <input name="username" type="text" required="" class="form-control" placeholder="Usearname*">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <input name="email" type="text" class="form-control" required="" placeholder="Password*">
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-3">
                                                        <div class=" form-check">
                                                            <input type="checkbox" class="form-check-input" id="Password4">
                                                            <label class="form-check-label rem-forgot" for="Password4">Remember me <a href="javascript:;">Forgot Password</a></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <button type="submit" class="site-button">Log in</button>
                                                    <div class="mt-3 mb-3">Don't have an account ? 
                                                        <button class="twm-backto-login" data-bs-target="#sign_up_popup" data-bs-toggle="modal" data-bs-dismiss="modal">Sign Up</button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div> 
                            </div>
                            <div class="modal-footer">
                                <span class="modal-f-title">Login or Sign up with</span>
                                <ul class="twm-modal-social">
                                    <li><a href="javascript.php" class="facebook-clr"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="javascript.php" class="twitter-clr"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="javascript.php" class="linkedin-clr"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="javascript.php" class="google-clr"><i class="fab fa-google"></i></a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!--Model Popup Section End-->

        <!--saved-jobs-view-->
        <div class="modal fade twm-saved-jobs-view" id="saved-jobs-view" aria-hidden="true" aria-labelledby="sign_up_popupLabel-3" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h2 class="modal-title" id="sign_up_popupLabel-3">Company Name</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-unstyled">
                        <li><strong>Job Title :</strong><p id="modal-job-title"></p></li>
                        <li><strong>Job Category :</strong><p id="modal-job-category"></p></li>
                        <li><strong>Experience :</strong><p id="modal-experience"></p></li>
                        <li><strong>Description :</strong>
                            <p id="modal-description"></p>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="site-button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Include jQuery for AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $(".view-job").click(function() {
        var jobId = $(this).data("job-id");

        // AJAX request to fetch job details
        $.ajax({
            type: "POST",
            url: "fetch_job_details.php",
            data: { job_id: jobId },
            success: function(response) {
                var jobDetails = JSON.parse(response);
                
                if (!jobDetails.error) {
                    // Update modal content with job details
                    $("#modal-job-title").text(jobDetails.job_title);
                    $("#modal-job-category").text(jobDetails.job_category);
                    $("#modal-experience").text(jobDetails.experience);
                    $("#modal-description").text(jobDetails.description);

                    // Update the modal title to the company name
                    $(".modal-title").text(jobDetails.company_name);
                } else {
                    alert(jobDetails.error);
                }
            }
        });
    });
});
</script>
<!-- Include jQuery for AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $(".delete-job1").click(function() {
        var jobId = $(this).data("job-id");

        // Confirm before deleting
        if (confirm("Are you sure you want to delete this job?")) {
            // AJAX request to delete the job
            $.ajax({
                type: "POST",
                url: "delete_job1.php",
                data: { job_id: jobId },
                dataType: "json", // Expect JSON response
                success: function(response) {
                    if (response.success) {
                        alert("Job deleted successfully.");
                        window.location.href = "candidate-jobs-applied.php"; // Redirect to the desired page
                    } else {
                        alert(response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", status, error); // Debugging: Check AJAX error
                    alert("An error occurred: " + error);
                }
            });
        }
    });
});
</script>

 	</div>


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

<!-- STYLE SWITCHER  ======= --> 

<!-- STYLE SWITCHER END ==== -->

</body>



</html>
