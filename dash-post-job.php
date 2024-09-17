<?php
session_start();
// Check if admin_id is set in session
if (!isset($_SESSION['id'])) {
    // Redirect to login page or show an error message
    header('Location: login.php');
    exit();
}
$admin_id = $_SESSION['id'];
?>
<?php
include 'db.php';
// Fetch current admin data
$sql = "SELECT * FROM admin WHERE id='$admin_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
} else {
    die("Admin not found");
}
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
    <title>Jobzilla Template | Post a jobs</title>
    
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Add this in the <head> section of your HTML -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
    <style>
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
 
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
    
        <?php include 'Header_2.php';?>  
            <?php include 'Nav.php';?>
    	
        <!-- Sidebar Holder -->
        <!-- Sidebar Holder -->
       
        <!-- Page Content Holder -->
        <div id="content">

            <div class="content-admin-main">

            	<div class="wt-admin-right-page-header clearfix">
                    <h2>Post a Job</h2>
                    <div class="breadcrumbs"><a href="dashboard.php">Home</a><span>Post A Job</span></div>
                </div>

                <!--Logo and Cover image-->
                <!-- <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Logo and Cover image</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 p-b0 m-b30 ">
                        
                        <div class="row">
                                
                            <div class="col-lg-12 col-md-6">
                                <div class="form-group">
                                    
                                    <div class="dashboard-profile-pic">
                                        <div class="dashboard-profile-photo">
                                            <img src="images/jobs-company/pic1.jpg" alt="">
                                            <div class="upload-btn-wrapper">
                                                <button class="site-button button-sm">Upload Photo</button>
                                                <input type="file" name="myfile">
                                            </div>
                                        </div>
                                        <p><b>Company Logo :- </b> Max file size is 1MB, Minimum dimension: 136 x 136 And Suitable files are .jpg & .png</p>
                                    </div>
                                </div> 
                            </div>

                            <div class="col-lg-12 col-md-6">
                                <div class="dashboard-cover-pic">
                                    <form action="upload.php" class="dropzone"></form>
                                    <p><b>Background Banner Image :- </b> Max file size is 1MB, Minimum dimension: 770 x 310 And Suitable files are .jpg & .png</p> 
                                </div>                                    
                            </div>

                        </div>
                                    
                    </div>
                </div>  -->

                <!--Basic Information-->
               <div class="panel panel-default">
<!--    <div class="panel-heading wt-panel-heading p-a20">
        <h4 class="panel-title m-a0"><i class="fa fa-suitcase"></i>Job Details</h4>
    </div>-->
    <div class="panel-body wt-panel-body p-a20 m-b30">
        <div class="container mt-5">
            <?php
// Start session if you use session-based messages


// Check if the status query parameter is set
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    echo '<div class="alert alert-success" role="alert">';
    echo 'New job posted successfully!';
    echo '</div>';
}
?>

            <form method="post" action="job_postings.php" enctype="multipart/form-data" id="jobForm">
        <div class="row">
            <!-- Company Name -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Company Name</label>
                    <div class="ls-inputicon-box">
                        <input class="form-control" name="company_name" type="text" placeholder="Company Name">
                        <i class="fs-input-icon fa fa-building"></i>
                    </div>
                </div>
            </div>

            <!-- Job Title -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Job Title</label>
                    <div class="ls-inputicon-box">
                        <input class="form-control" name="job_title" type="text" placeholder="Job Title">
                        <i class="fs-input-icon fa fa-address-card"></i>
                    </div>
                </div>
            </div>

            <!-- Job Category -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group city-outer-bx has-feedback">
                    <label>Job Category</label>
                    <div class="ls-inputicon-box">
                        <select name="job_category" class="wt-select-box selectpicker" data-live-search="true" title="" id="job_category">
                            <option disabled selected value="">Select IT Category</option>
                            <option>Software Development</option>
                            <option>Network Administration</option>
                            <option>Database Management</option>
                            <option>Cybersecurity</option>
                            <option>Cloud Computing</option>
                            <option>IT Support</option>
                            <option>Web Development</option>
                            <option>Mobile App Development</option>
                            <option>DevOps</option>
                            <option>Data Science</option>
                            <option>Artificial Intelligence</option>
                            <option>IT Project Management</option>
                        </select>
                        <i class="fs-input-icon fa fa-laptop-code"></i>
                    </div>
                </div>
            </div>

            <!-- Job Type -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Job Type</label>
                    <div class="ls-inputicon-box">
                        <select name="job_type" class="wt-select-box selectpicker" data-live-search="true" title="" id="job_type">
                            <option class="bs-title-option" value="">Select Type</option>
                            <option>Full Time</option>
                            <option>Freelance</option>
                            <option>Internship</option>
                        </select>
                        <i class="fs-input-icon fa fa-file-alt"></i>
                    </div>
                </div>
            </div>

            <!-- Offered Salary -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Offered Salary (in INR)</label>
                    <div class="ls-inputicon-box">
                        <select name="offered_salary" class="wt-select-box selectpicker" data-live-search="true" title="" id="offered_salary">
                            <option class="bs-title-option" value="">Select Salary</option>
                            <option>10,000</option>
                            <option>20,000</option>
                            <option>30,000</option>
                            <option>40,000</option>
                            <option>50,000</option>
                        </select>
                        <i class="fs-input-icon fa fa-rupee-sign"></i>
                    </div>
                </div>
            </div>

            <!-- Experience -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Experience</label>
                    <div class="ls-inputicon-box">
                        <select name="experience" class="wt-select-box selectpicker" data-live-search="true" title="" id="experience">
                            <option class="bs-title-option" value="">Experience</option>
                            <option>Fresher</option>
                            <option>1 Year</option>
                            <option>2 Years</option>
                            <option>3 Years</option>
                            <option>More than 3 Years</option>
                        </select>
                        <i class="fs-input-icon fa fa-calendar-alt"></i>
                    </div>
                </div>
            </div>

            <!-- Qualification -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Qualification</label>
                    <div class="ls-inputicon-box">
                        <select name="qualification" class="wt-select-box selectpicker" data-live-search="true" title="" id="qualification">
                            <option class="bs-title-option" value="">Qualification</option>
                            <option>Bachelor Degree</option>
                            <option>Master Degree</option>
                            <option>Diploma</option>
                        </select>
                        <i class="fs-input-icon fa fa-graduation-cap"></i>
                    </div>
                </div>
            </div>

            <!-- Gender -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Gender</label>
                    <div class="ls-inputicon-box">
                        <select name="gender" class="wt-select-box selectpicker" data-live-search="true" title="" id="gender">
                            <option class="bs-title-option" value="">Select Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                            <option>Both</option>
                        </select>
                        <i class="fs-input-icon fa fa-venus-mars"></i>
                    </div>
                </div>
            </div>

            <!-- Country -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group city-outer-bx has-feedback">
                    <label>Country</label>
                    <div class="ls-inputicon-box">
                        <select name="country" class="wt-select-box selectpicker" data-live-search="true" title="" id="country">
                            <option class="bs-title-option" value="">Select Country</option>
                            <option>USA</option>
                            <option>India</option>
                            <option>Canada</option>
                            <option>UK</option>
                            <option>Australia</option>
                        </select>
                        <i class="fs-input-icon fa fa-globe"></i>
                    </div>
                </div>
            </div>

            <!-- Location -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Location</label>
                    <div class="ls-inputicon-box">
                        <input class="form-control" name="location" type="text" placeholder="Location" id="location">
                        <i class="fs-input-icon fa fa-map-marker"></i>
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Email</label>
                    <div class="ls-inputicon-box">
                        <input class="form-control" name="email" type="email" placeholder="Email" id="email">
                        <i class="fs-input-icon fa fa-envelope"></i>
                    </div>
                </div>
            </div>

            <!-- Website -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Website</label>
                    <div class="ls-inputicon-box">
                        <input class="form-control" name="website" type="text" placeholder="Website" id="website">
                        <i class="fs-input-icon fa fa-globe"></i>
                    </div>
                </div>
            </div>

            <!-- Complete Address -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Complete Address</label>
                    <div class="ls-inputicon-box">
                        <input class="form-control" name="complete_address" type="text" placeholder="Complete Address" id="complete_address">
                        <i class="fs-input-icon fa fa-map"></i>
                    </div>
                </div>
            </div>

            <!-- Start Date -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Application Start Date</label>
                    <div class="ls-inputicon-box">
                        <input class="form-control" name="start_date" type="date" placeholder="Start Date" id="start_date">
                        <i class="fs-input-icon fa fa-calendar-alt"></i>
                    </div>
                </div>
            </div>

            <!-- End Date -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Application End Date</label>
                    <div class="ls-inputicon-box">
                        <input class="form-control" name="end_date" type="date" placeholder="End Date" id="end_date">
                        <i class="fs-input-icon fa fa-calendar-alt"></i>
                    </div>
                </div>
            </div>

            <!-- Company Profile Image -->
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="form-group">
                    <label>Company Profile Image</label>
                    <div class="ls-inputicon-box">
                        <input class="form-control" name="company_profile_image" accept=".jpg,.jpeg,.png" type="file">
                        <i class="fs-input-icon fa fa-image"></i>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="col-xl-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="4" placeholder="Job Description"></textarea>
                </div>
            </div>

            <!-- Responsibilities -->
            <div class="col-xl-12">
                <div class="form-group">
                    <label>Responsibilities</label>
                    <textarea class="form-control" name="responsibilities" rows="4" placeholder="Job Responsibilities"></textarea>
                </div>
            </div>

            <!-- Required Skills -->
            <div class="col-xl-12">
                <div class="form-group">
                    <label>Required Skills</label>
                    <textarea class="form-control" name="required_skills" rows="4" placeholder="Required Skills"></textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12 text-center">
                <button class="site-button m-t20" type="submit">Post Job</button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('jobForm');
    var startDateInput = document.getElementById('start_date');
    var endDateInput = document.getElementById('end_date');
    var companyProfileImageInput = form.elements['company_profile_image'];
    var descriptionTextarea = form.elements['description'];
    var responsibilitiesTextarea = form.elements['responsibilities'];
    var requiredSkillsTextarea = form.elements['required_skills'];

    // Set today's date as the default for the start date
    var today = new Date().toISOString().split('T')[0];
    startDateInput.value = today;
    startDateInput.setAttribute('min', today);

    // Real-time validation
    form.addEventListener('input', function(event) {
        var target = event.target;

        if (target.name === 'company_name') {
            validateCompanyName(target);
        } else if (target.name === 'job_title') {
            validateJobTitle(target);
        } else if (target.name === 'job_category') {
            validateJobCategory(target);
        } else if (target.name === 'job_type') {
            validateJobType(target);
        } else if (target.name === 'offered_salary') {
            validateOfferedSalary(target);
        } else if (target.name === 'experience') {
            validateExperience(target);
        } else if (target.name === 'qualification') {
            validateQualification(target);
        } else if (target.name === 'gender') {
            validateGender(target);
        } else if (target.name === 'country') {
            validateCountry(target);
        } else if (target.name === 'location') {
            validateLocation(target);
        } else if (target.name === 'email') {
            validateEmail(target);
        } else if (target.name === 'website') {
            validateWebsite(target);
        } else if (target.name === 'complete_address') {
            validateCompleteAddress(target);
        } else if (target.name === 'start_date') {
            validateStartDate(target);
            lockEndDate(target);
        } else if (target.name === 'end_date') {
            validateEndDate(target);
        } else if (target.name === 'company_profile_image') {
            validateCompanyProfileImage(target);
        } else if (target.name === 'description') {
            validateDescription(target);
        } else if (target.name === 'responsibilities') {
            validateResponsibilities(target);
        } else if (target.name === 'required_skills') {
            validateRequiredSkills(target);
        }
    });

    // Validate on submit
    form.addEventListener('submit', function(event) {
        if (!validateAllFields()) {
            event.preventDefault();
        }
    });

    function validateCompanyName(input) {
        var regex = /^[A-Za-z\s]+$/;
        if (!regex.test(input.value)) {
            alert('Company Name is required and should only contain letters and spaces.');
            return false;
        }
        return true;
    }

    function validateJobTitle(input) {
        if (input.value.trim() === '') {
            alert('Job Title is required.');
            return false;
        }
        return true;
    }

    function validateJobCategory(select) {
        if (select.value === '') {
            alert('Job Category is required.');
            return false;
        }
        return true;
    }

    function validateJobType(select) {
        if (select.value === '') {
            alert('Job Type is required.');
            return false;
        }
        return true;
    }

    function validateOfferedSalary(select) {
        if (select.value === '') {
            alert('Offered Salary is required.');
            return false;
        }
        return true;
    }

    function validateExperience(select) {
        if (select.value === '') {
            alert('Experience is required.');
            return false;
        }
        return true;
    }

    function validateQualification(select) {
        if (select.value === '') {
            alert('Qualification is required.');
            return false;
        }
        return true;
    }

    function validateGender(select) {
        if (select.value === '') {
            alert('Gender is required.');
            return false;
        }
        return true;
    }

    function validateCountry(select) {
        if (select.value === '') {
            alert('Country is required.');
            return false;
        }
        return true;
    }

    function validateLocation(input) {
        var regex = /^[A-Za-z\s]+$/;
        if (!regex.test(input.value)) {
            alert('Location is required and should only contain letters and spaces.');
            return false;
        }
        return true;
    }

    function validateEmail(input) {
        var regex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        if (!regex.test(input.value)) {
            alert('Email is required and must end with @gmail.com.');
            return false;
        }
        return true;
    }

    function validateWebsite(input) {
        if (input.value.trim() === '') {
            alert('Website is required.');
            return false;
        }
        var regex = /^(https?:\/\/)?([a-zA-Z0-9.-]+\.[a-zA-Z]{2,})(\/\S*)?$/;
        if (!regex.test(input.value)) {
            alert('Website must be a valid URL.');
            return false;
        }
        return true;
    }

    function validateCompleteAddress(input) {
        if (input.value.trim() === '') {
            alert('Complete Address is required.');
            return false;
        }
        return true;
    }

    function validateStartDate(input) {
        var startDate = new Date(input.value);
        var today = new Date();
        today.setHours(0, 0, 0, 0); // Reset time for accurate comparison

        if (!input.value || startDate <= today) {
            alert('Start Date must be in the future.');
            return false;
        }
        return true;
    }

    function lockEndDate(startDateInput) {
        var startDate = new Date(startDateInput.value);
        var endDate = new Date(startDate);
        endDate.setDate(startDate.getDate() + 1);
        if (startDateInput.value) {
            endDateInput.setAttribute('min', endDate.toISOString().split('T')[0]);
            endDateInput.value = endDate.toISOString().split('T')[0];
        }
    }

    function validateEndDate(endDateInput) {
        if (endDateInput.value.trim() === '') {
            alert('Application End Date is required.');
            return false;
        }
        var startDate = new Date(startDateInput.value);
        var endDate = new Date(endDateInput.value);
        if (endDate <= startDate) {
            alert('End Date must be after the Start Date.');
            return false;
        }
        return true;
    }

    function validateCompanyProfileImage(input) {
        if (input.files.length === 0) {
            alert('Company Profile Image is required.');
            return false;
        }
        var file = input.files[0];
        var validExtensions = ['jpg', 'jpeg', 'png'];
        var fileExtension = file.name.split('.').pop().toLowerCase();
        if (validExtensions.indexOf(fileExtension) === -1) {
            alert('Company Profile Image must be a JPG or PNG image.');
            input.value = ''; // Clear the file input
            return false;
        }
        if (file.size > 5 * 1024 * 1024) { // 5MB limit
            alert('Company Profile Image must not exceed 5MB.');
            input.value = ''; // Clear the file input
            return false;
        }
        return true;
    }

    function validateDescription(textarea) {
        if (textarea.value.trim() === '') {
            alert('Description is required.');
            return false;
        }
        return true;
    }

    function validateResponsibilities(textarea) {
        if (textarea.value.trim() === '') {
            alert('Responsibilities are required.');
            return false;
        }
        return true;
    }

    function validateRequiredSkills(textarea) {
        if (textarea.value.trim() === '') {
            alert('Required Skills are required.');
            return false;
        }
        return true;
    }

    function validateAllFields() {
        return validateCompanyName(form.elements['company_name']) &&
               validateJobTitle(form.elements['job_title']) &&
               validateJobCategory(form.elements['job_category']) &&
               validateJobType(form.elements['job_type']) &&
               validateOfferedSalary(form.elements['offered_salary']) &&
               validateExperience(form.elements['experience']) &&
               validateQualification(form.elements['qualification']) &&
               validateGender(form.elements['gender']) &&
               validateCountry(form.elements['country']) &&
               validateLocation(form.elements['location']) &&
               validateEmail(form.elements['email']) &&
               validateWebsite(form.elements['website']) &&
               validateCompleteAddress(form.elements['complete_address']) &&
               validateStartDate(startDateInput) &&
               validateEndDate(endDateInput) &&
               validateCompanyProfileImage(companyProfileImageInput) &&
               validateDescription(descriptionTextarea) &&
               validateResponsibilities(responsibilitiesTextarea) &&
               validateRequiredSkills(requiredSkillsTextarea);
    }
});
</script>



                 <!--Delete Profile Popup-->
       <?php include 'Delete-Profile-admin.php';?>
        <?php include 'Logout_session.php';?>


         

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
<div class="styleswitcher">

<!--    <div class="switcher-btn-bx">
        <a class="switch-btn">
            <span class="fa fa-cog fa-spin"></span>
        </a>
    </div>-->
    
    <div class="styleswitcher-inner">
    
        <h6 class="switcher-title">Color Skin</h6>
        <ul class="color-skins">
            <li><a class="theme-skin skin-1" href="dash-post-joba39b.php?theme=css/skin/skin-1"></a></li>
            <li><a class="theme-skin skin-2" href="dash-post-job61e7.php?theme=css/skin/skin-2"></a></li>
            <li><a class="theme-skin skin-3" href="dash-post-jobcce5.php?theme=css/skin/skin-3"></a></li>
            <li><a class="theme-skin skin-4" href="dash-post-job13f7.php?theme=css/skin/skin-4"></a></li>
            <li><a class="theme-skin skin-5" href="dash-post-job19a6.php?theme=css/skin/skin-5"></a></li>
            <li><a class="theme-skin skin-6" href="dash-post-jobfe5c.php?theme=css/skin/skin-6"></a></li>
            <li><a class="theme-skin skin-7" href="dash-post-jobab47.php?theme=css/skin/skin-7"></a></li>
            <li><a class="theme-skin skin-8" href="dash-post-job5f8d.php?theme=css/skin/skin-8"></a></li>
            <li><a class="theme-skin skin-9" href="dash-post-job5663.php?theme=css/skin/skin-9"></a></li>
            <li><a class="theme-skin skin-10" href="dash-post-job28ac.php?theme=css/skin/skin-10"></a></li>
            
        </ul>           
        
    </div>    
</div>
<!-- STYLE SWITCHER END ==== -->


</body>




</html>
