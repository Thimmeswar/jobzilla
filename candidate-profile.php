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
    <title>TalentTap Solutions | Candidate Profile</title>
    
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
    <div class="loading-area">
        <div class="loading-box"></div>
        <div class="loading-pic">
            <div class="wrapper">
                <div class="cssload-loader"></div>
            </div>
        </div>
    </div>
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
                                <h2 class="wt-title">Candidate Profile</h2>
                            </div>
                        </div>
                        <!-- BREADCRUMB ROW -->                            
                        
                            <div>
                                <ul class="wt-breadcrumb breadcrumb-style-2">
                                    <li><a href="index.php">Home</a></li>
                                    <li>My Profile</li>
                                </ul>
                            </div>
                        
                        <!-- BREADCRUMB ROW END -->                        
                    </div>
                </div>
            </div>
            <!-- INNER PAGE BANNER END -->


            <!-- OUR BLOG START -->
            <div class="section-full p-t120  p-b90 site-bg-white">
                

             <?php include('side_bar_user.php'); ?>


                        <div class="col-xl-9 col-lg-8 col-md-12 m-b30">
                            <!--Filter Short By-->
                            <div class="twm-right-section-panel site-bg-gray">






<!-- Your existing form -->

    <div class="dashboard-profile-wrapper mb-4">
        <div class="row">


        

<!-- Profile Image Section -->
<div class="col-md-4 col-sm-12 text-center">
    <form id="profileImageForm" method="POST" enctype="multipart/form-data" action="upload_profile_image.php">
        <div class="dash-prf-start">
            <div class="dash-prf-start-thumb">
                <figure>
                    <?php if (!empty($profile_img)): ?>
                        <img id="profileImg" src="images/user-avtar/<?php echo htmlspecialchars($profile_img); ?>" class="img-fluid rounded-circle" alt="Profile Image" style="height:110px;width:120px;">
                    <?php else: ?>
                        <img id="profileImg" src="images/user-avtar/a.png" class="img-fluid rounded-circle" alt="Default Image" style="height:110px;width:120px;">
                    <?php endif; ?>
                </figure>
            </div>
            <div class="dash-prf-start-bottom mt-3">
                <div class="upload-btn-wrapper small">
                    <button type="button" class="btn" style="background-color: #00c2e5;color:black;" onclick="document.getElementById('profilePicInput').click();">Change Profile</button>
                    <input type="file" name="profile_image" id="profilePicInput" accept="image/*" style="display:none;" onchange="document.getElementById('profileImageForm').submit();">
                </div>
            </div>
        </div>
    </form>
</div>
<script>
 document.getElementById('profilePicInput').addEventListener('change', function(event) {
    var file = event.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileImg').setAttribute('src', e.target.result);
        };
        reader.readAsDataURL(file);
    }
});
</script>

<!-- <script>
document.getElementById('profilePicInput').addEventListener('change', function(event) {
    var file = event.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(event) {
            var imgSrc = event.target.result;
            document.getElementById('profileImg').setAttribute('src', imgSrc);
            
            var formData = new FormData();
            formData.append('profilePic', file);
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'upload_profile_image.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert('Profile picture updated successfully.');
                        window.location.href = "candidate-profile.php";
                    } else {
                        alert('Failed to update profile picture.');
                    }
                }
            };
            xhr.send(formData);
        };
        reader.readAsDataURL(file);
    }
});

</script>
 -->



        
        <!-- Profile Details Section -->
        <div class="col-md-8 col-sm-12">
            <div class="dash-prf-end">
                <!-- First Name -->
                <div class="dash-prfs-caption mb-3 mt-5">
                    <h4><?php echo htmlspecialchars($firstname); ?></h4>
                </div>

                <!-- Email and Phone in Same Line -->
                <div class="row mb-2">
                    <!-- Email -->
                    <div class="col-md-6 mb-3"> <!-- Add margin-bottom here -->
                        <div class="d-flex align-items-center">
                            <i class="bi bi-envelope me-2"></i>
                            <div>
                                <p class="text-muted mb-0 ">Email</p>
                                <h5><?php echo htmlspecialchars($email); ?></h5>
                            </div>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-telephone me-2"></i>
                            <div>
                                <p class="text-muted mb-0">Phone</p>
                                <h5><?php echo htmlspecialchars($phone); ?></h5>
                            </div>
                        </div>
                    </div>
                </div> <!-- End of row -->
            </div>
        </div>
    </div>
</div>




<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return validateForm()">
    <!-- Hidden Fields -->
    <input type="hidden" name="profile_image" value="<?php echo htmlspecialchars($profile_image); ?>">
    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
    <!-- Add more hidden fields as needed --> 
 <!-- Basic Information -->
    <div class="panel panel-default">
        <div class="panel-heading wt-panel-heading p-a20">
            <h4 class="panel-title m-a0">EDIT PROFILE</h4>
        </div>
        <div class="panel-body wt-panel-body p-a20 m-b30">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>Title</label>
                        <div class="ls-inputicon-box">
                            <select class="form-control" name="prefix">
                                <option value="" disabled>Select Title</option>
                                <option value="Mr" <?php echo ($prefix === 'Mr') ? 'selected' : ''; ?>>Mr</option>
                                <option value="Miss" <?php echo ($prefix === 'Miss') ? 'selected' : ''; ?>>Miss</option>
                                <option value="Mrs" <?php echo ($prefix === 'Mrs') ? 'selected' : ''; ?>>Mrs</option>
                            </select>
                            <i class="fs-input-icon fa fa-user"></i>
                            <span class="error-message" id="title-error"></span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>First Name</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" name="firstname" type="text" placeholder="First Name" value="<?php echo htmlspecialchars($firstname); ?>">
                            <i class="fs-input-icon fa fa-user"></i>
                            <span class="error-message" id="firstname-error"></span>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>Last Name</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" name="lastname" type="text" placeholder="Last Name" value="<?php echo htmlspecialchars($lastname); ?>">
                            <i class="fs-input-icon fa fa-user"></i>
                            <span class="error-message" id="lastname-error"></span>
                        </div>
                    </div>
                </div>
                <script>
function updateCountryCode() {
    var country = document.getElementById("candidatecountry").value;
    var countryCodeSelect = document.getElementById("candidatecountrycode");

    var countryCodeMap = {
        "India": "+91",
        "USA": "+1",
        "UK": "+44",
        "Australia": "+61"
    };

    var defaultCode = countryCodeMap[country] || "";
    var options = countryCodeSelect.options;

    // Set the default selection to the matching country code
    for (var i = 0; i < options.length; i++) {
        if (options[i].value === defaultCode) {
            countryCodeSelect.selectedIndex = i;
            break;
        }
    }
}
</script>

<div class="col-xl-6 col-lg-6 col-md-12">
    <div class="form-group city-outer-bx has-feedback">
        <label>Country</label>
        <div class="ls-inputicon-box">
            <select id="candidatecountry" class="form-control" name="country" onchange="updateCountryCode()">
                <option value="">Select Country</option>
                <option value="India" <?php echo $country === 'India' ? 'selected' : ''; ?>>India</option>
                <option value="USA" <?php echo $country === 'USA' ? 'selected' : ''; ?>>USA</option>
                <option value="UK" <?php echo $country === 'UK' ? 'selected' : ''; ?>>UK</option>
                <option value="Australia" <?php echo $country === 'Australia' ? 'selected' : ''; ?>>Australia</option>
            </select>
            <i class="fs-input-icon fa fa-globe-americas"></i>
            <span class="error-message" id="country-error"></span>
        </div>
    </div>
</div>
<div class="col-xl-6 col-lg-6 col-md-12">
    <div class="form-group">
        <label for="candidatecountrycode">Country Code</label>
        <div class="ls-inputicon-box">
            <select id="candidatecountrycode" class="form-control" name="countrycode" readonly>
                <option value="">Select Code</option>
                <option value="+91" <?php echo $countrycode === '+91' ? 'selected' : ''; ?>>+91 (India)</option>
                <option value="+1" <?php echo $countrycode === '+1' ? 'selected' : ''; ?>>+1 (USA)</option>
                <option value="+44" <?php echo $countrycode === '+44' ? 'selected' : ''; ?>>+44 (UK)</option>
                <option value="+61" <?php echo $countrycode === '+61' ? 'selected' : ''; ?>>+61 (Australia)</option>
                <!-- Add more options as needed -->
            </select>
            <i class="fs-input-icon fa fa-globe"></i>
        </div>
    </div>
</div>


                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>Email</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" name="email" type="email" placeholder="email@example.com" value="<?php echo htmlspecialchars($email); ?>" readonly>
                            <i class="fs-input-icon fas fa-at"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="form-group">
                        <label>Contact No</label>
                        <div class="ls-inputicon-box">
                            <input class="form-control" name="phone" type="text" placeholder="6302483715" value="<?php echo htmlspecialchars($phone); ?>" readonly>
                            <i class="fs-input-icon fa fa-phone-alt"></i>
                        </div>
                    </div>
                </div>

                

                <div class="col-xl-6 col-lg-6 col-md-12">
    <div class="form-group city-outer-bx has-feedback">
        <label>Resume Upload</label>
        <div class="ls-inputicon-box">
            <!-- Display current resume link if it exists -->
            <?php if (!empty($resume)): ?>
                <input type="hidden" name="current_resume" value="<?php echo htmlspecialchars($resume); ?>">
            <?php endif; ?>
            <!-- File input for new resume upload -->
            <input class="form-control" name="resume" type="file" placeholder="Resume" accept=".pdf, .doc, .docx">
            <i class="fs-input-icon fa fa-file-upload"></i>
            <div>
                <?php if (!empty($resume)): ?>
                    <a href="uploads/<?php echo htmlspecialchars($resume); ?>" download class="btn btn-primary">
                        Download Resume
                    </a>
                <?php endif; ?>
            </div>
            <span class="error-message" id="resume-error"></span>
        </div>
    </div>
</div>

                <div class="col-lg-12 col-md-12">
                    <div class="text-left">
                        <button type="submit" class="site-button">Save Changes</button>
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
            </div>   

 

            <!-- OUR BLOG END -->
          
            
     
        
        <!-- CONTENT END -->

        <!-- FOOTER START -->
        <!-- <footer class="footer-dark" style="background-image: url(images/f-bg.jpg);">
            <div class="container">

                
                <div class="ftr-nw-content">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="ftr-nw-title">
                                Join our email subscription now to get updates 
                                on new jobs and notifications.
                            </div>
                        </div>
                        <div class="col-md-7">
                            <form>
                                <div class="ftr-nw-form">
                                    <input name="news-letter" class="form-control" placeholder="Enter Your Email" type="text">
                                    <button class="ftr-nw-subcribe-btn">Subscribe Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                 
                <div class="footer-top">
                    <div class="row">

                        <div class="col-lg-3 col-md-12">
                            
                            <div class="widget widget_about">
                                <div class="logo-footer clearfix">
                                    <a href="index.php"><img src="images/logo-light.png" alt=""></a>
                                </div>
                                <p>Many desktop publishing packages and web page editors now.</p>
                                <ul class="ftr-list">
                                    <li><p><span>Address :</span>65 Sunset CA 90026, USA </p></li>
                                    <li><p><span>Email :</span>example@max.com</p></li>
                                    <li><p><span>Call :</span>555-555-1234</p></li>
                                </ul>
                            </div>                            
                            
                        </div> 

                        <div class="col-lg-9 col-md-12">
                            <div class="row">
                               
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="widget widget_services ftr-list-center">
                                        <h3 class="widget-title">For Candidate</h3>
                                        <ul>
                                            <li><a href="dashboard.php">User Dashboard</a></li>
                                            <li><a href="dash-resume-alert.php">Alert resume</a></li>
                                            <li><a href="candidate-grid.php">Candidates</a></li>
                                            <li><a href="blog-list.php">Blog List</a></li>
                                            <li><a href="blog-single.php">Blog single</a></li>
                                        </ul>
                                    </div>
                                </div>
                            
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="widget widget_services ftr-list-center">
                                        <h3 class="widget-title">For Employers</h3>
                                        <ul>
                                            <li><a href="dash-post-job.php">Post Jobs</a></li>
                                            <li><a href="blog-grid.php">Blog Grid</a></li>
                                            <li><a href="contact.php">Contact</a></li>
                                            <li><a href="job-list.php">Jobs Listing</a></li>
                                            <li><a href="job-detail.php">Jobs details</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="widget widget_services ftr-list-center">
                                        <h3 class="widget-title">Helpful Resources</h3>
                                        <ul>
                                            <li><a href="faq.php">FAQs</a></li>
                                            <li><a href="employer-detail.php">Employer detail</a></li>
                                            <li><a href="dash-my-profile.php">Profile</a></li>
                                            <li><a href="error-404.php">404 Page</a></li>
                                            <li><a href="pricing.php">Pricing</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">  
                                    <div class="widget widget_services ftr-list-center">
                                        <h3 class="widget-title">Quick Links</h3>
                                        <ul>
                                         <li><a href="index.php">Home</a></li>
                                            <li><a href="about-1.php">About us</a></li>
                                            <li><a href="dash-bookmark.php">Bookmark</a></li>
                                            <li><a href="job-grid.php">Jobs</a></li>
                                            <li><a href="employer-list.php">Employer</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>  

                        </div> 

                    </div>
                </div>
        
                <div class="footer-bottom">
                
                    <div class="footer-bottom-info">
                    
                        <div class="footer-copy-right">
                            <span class="copyrights-text">Copyright © 2023 by thewebmax All Rights Reserved.</span>
                        </div>
                        <ul class="social-icons">
                            <li><a href="javascript:void(0);" class="fab fa-facebook-f"></a></li>
                            <li><a href="javascript:void(0);" class="fab fa-twitter"></a></li>
                            <li><a href="javascript:void(0);" class="fab fa-instagram"></a></li>
                            <li><a href="javascript:void(0);" class="fab fa-youtube"></a></li>
                        </ul>
                        
                    </div>
                    
                </div>

            </div>
    
        

        <!-- BUTTON TOP START -->
		<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

        <!--Model Popup Section Start-->
            <!--Signup popup -->
            <div class="modal fade twm-sign-up" id="sign_up_popup" aria-hidden="true" aria-labelledby="sign_up_popupLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form>

                            <div class="modal-header">
                                <h2 class="modal-title" id="sign_up_popupLabel">Sign Up</h2>
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
        

 	</div>

<!-- Logout popup -->
<?php include 'Candidate_logout_session.php';?>

<!-- Delete popup -->
<?php include 'Delete_candidate_profile.php';?>
     


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
<!-- <div class="styleswitcher">

    <div class="switcher-btn-bx">
        <a class="switch-btn">
            <span class="fa fa-cog fa-spin"></span>
        </a>
    </div>
    
    <div class="styleswitcher-inner">
    
        <h6 class="switcher-title">Color Skin</h6>
        <ul class="color-skins">
            <li><a class="theme-skin skin-1" href="candidate-profilea39b.php?theme=css/skin/skin-1"></a></li>
            <li><a class="theme-skin skin-2" href="candidate-profile61e7.php?theme=css/skin/skin-2"></a></li>
            <li><a class="theme-skin skin-3" href="candidate-profilecce5.php?theme=css/skin/skin-3"></a></li>
            <li><a class="theme-skin skin-4" href="candidate-profile13f7.php?theme=css/skin/skin-4"></a></li>
            <li><a class="theme-skin skin-5" href="candidate-profile19a6.php?theme=css/skin/skin-5"></a></li>
            <li><a class="theme-skin skin-6" href="candidate-profilefe5c.php?theme=css/skin/skin-6"></a></li>
            <li><a class="theme-skin skin-7" href="candidate-profileab47.php?theme=css/skin/skin-7"></a></li>
            <li><a class="theme-skin skin-8" href="candidate-profile5f8d.php?theme=css/skin/skin-8"></a></li>
            <li><a class="theme-skin skin-9" href="candidate-profile5663.php?theme=css/skin/skin-9"></a></li>
            <li><a class="theme-skin skin-10" href="candidate-profile28ac.php?theme=css/skin/skin-10"></a></li>
            
        </ul>           
        
    </div>    
</div> -->
<!-- STYLE SWITCHER END ==== -->

</body>



</html>
