<?php
// Include database connection
include 'db.php';

// Fetch job postings from the database
$query = "SELECT job_title, job_category, job_type, start_date, end_date, complete_address, country, company_name, company_profile_image FROM job_postings";
$result = $conn->query($query);

// Check for query execution errors
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
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
// Include database connection
include 'db.php';

// Fetch current admin data
$sql = "SELECT * FROM admin WHERE id='$admin_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
} else {
    die("Admin not found");
}
// Fetch job postings from the database
$query = "SELECT job_title, job_category, job_type, start_date, end_date, complete_address, country, company_name, company_profile_image FROM job_postings";
$result = $conn->query($query);

// Check for query execution errors
if (!$result) {
    die("Query failed: " . $conn->error);
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
    <title>Jobzilla Template | Manage Jobs</title>
    
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
    <!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle with Popper -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
 <style>
        .modal-dialog {
            max-width: 80%;
        }
        .modal-body {
            max-height: 60vh;
            overflow-y: auto;
        }
        .image-container {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .image-container img {
            display: block;
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .company-name-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 1rem;
            box-sizing: border-box;
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
    	
        <!-- Sidebar Holder -->
        <?php include 'Nav.php';?>
        <!-- Modal -->
                                       <!-- Modal -->
<div class="modal fade" id="edit-job-modal" tabindex="-1" aria-labelledby="editJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="edit-job-form" action="update_job.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJobModalLabel">Edit Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="job_id" id="job-id">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="company-name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="company-name" name="company_name">
                        </div>
                        <div class="col-md-6">
                            <label for="job-title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="job-title" name="job_title">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="job-category" class="form-label">Job Category</label>
                            <input type="text" class="form-control" id="job-category" name="job_category">
                        </div>
                        <div class="col-md-6">
                            <label for="job-type" class="form-label">Job Type</label>
                            <input type="text" class="form-control" id="job-type" name="job_type">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
    <label for="offered-salary" class="form-label">Offered Salary</label>
    <div class="input-group">
        <span class="input-group-text">₹</span>
        <input type="text" class="form-control" id="offered-salary" name="offered_salary" placeholder="Enter salary">
    </div>
</div>
                        <div class="col-md-6">
                            <label for="experience" class="form-label">Experience</label>
                            <input type="text" class="form-control" id="experience" name="experience">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="qualification" class="form-label">Qualification</label>
                            <input type="text" class="form-control" id="qualification" name="qualification">
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="gender" name="gender">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country">
                        </div>
                        <div class="col-md-6">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-md-6">
                            <label for="website" class="form-label">Website</label>
                            <input type="text" class="form-control" id="website" name="website">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="complete-address" class="form-label">Complete Address</label>
                        <textarea class="form-control" id="complete-address" name="complete_address"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="required-skills" class="form-label">Required Skills</label>
                        <textarea class="form-control" id="required-skills" name="required_skills"></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="responsibilities" class="form-label">Responsibilities</label>
                            <textarea class="form-control" id="responsibilities" name="responsibilities"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="start-date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start-date" name="start_date">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="end-date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end-date" name="end_date">
                        </div>
                        <div class="col-md-6">
                            <label for="company-profile-image" class="form-label">Company Profile Image</label>
                            <input type="text" class="form-control" id="company-profile-image" name="company_profile_image">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('edit-job-form');
    var startDateInput = document.getElementById('start-date');
    var endDateInput = document.getElementById('end-date');
    var companyProfileImageInput = form.elements['company_profile_image'];
    var descriptionTextarea = form.elements['description'];
    var responsibilitiesTextarea = form.elements['responsibilities'];
    var requiredSkillsTextarea = form.elements['required_skills'];

    // Real-time validation
    form.addEventListener('input', function(event) {
        var target = event.target;

        if (target.name === 'website') {
            validateWebsite(target);
        } else if (target.name === 'complete_address') {
            validateCompleteAddress(target);
        } else if (target.name === 'start_date') {
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
        } else if (target.name === 'country') {
            validateCountry(target);
        } else if (target.name === 'location') {
            validateLocation(target);
        } else if (target.name === 'email') {
            validateEmail(target);
        } else if (target.name === 'company_name') {
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
        }
    });

    // Validate on submit
    form.addEventListener('submit', function(event) {
        if (!validateAllFields()) {
            event.preventDefault();
        }
    });

    function validateWebsite(input) {
        var regex = /^(https?:\/\/)?([a-zA-Z0-9.-]+\.[a-zA-Z]{2,})(\/\S*)?$/;
        if (input.value && !regex.test(input.value)) {
            alert('Please enter a valid website URL. Example: http://www.example.com');
            return false;
        }
        return true;
    }

    function validateCompleteAddress(input) {
        if (input.value.trim() === '') {
            alert('Complete Address cannot be empty.');
            return false;
        }
        return true;
    }

    function lockEndDate(startDateInput) {
        var startDate = new Date(startDateInput.value);
        var endDate = new Date(startDate);
        endDate.setDate(startDate.getDate() + 1);
        if (startDateInput.value) {
            endDateInput.value = endDate.toISOString().split('T')[0];
        }
    }

    function validateEndDate(endDateInput) {
        var startDate = new Date(startDateInput.value);
        var endDate = new Date(endDateInput.value);
        if (endDateInput.value && endDate <= startDate) {
            alert('End Date must be after the Start Date.');
            return false;
        }
        return true;
    }

    function validateCompanyProfileImage(input) {
        if (input.value === '') {
            alert('Please enter a valid image URL for the company profile image.');
            return false;
        }
        return true;
    }

    function validateDescription(textarea) {
        if (textarea.value.trim() === '') {
            alert('Description cannot be empty.');
            return false;
        }
        return true;
    }

    function validateResponsibilities(textarea) {
        if (textarea.value.trim() === '') {
            alert('Responsibilities cannot be empty.');
            return false;
        }
        return true;
    }

    function validateRequiredSkills(textarea) {
        if (textarea.value.trim() === '') {
            alert('Required Skills cannot be empty.');
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

    function validateCompanyName(input) {
        var regex = /^[A-Za-z\s]+$/;
        if (!regex.test(input.value)) {
            alert('Company Name should only contain letters and spaces.');
            return false;
        }
        return true;
    }

    function validateJobTitle(input) {
        var regex = /^[A-Za-z\s]+$/;
        if (!regex.test(input.value)) {
            alert('Job Title should only contain letters and spaces.');
            return false;
        }
        return true;
    }

    function validateJobCategory(input) {
        if (input.value.trim() === '') {
            alert('Job Category cannot be empty.');
            return false;
        }
        return true;
    }

    function validateJobType(input) {
        if (input.value.trim() === '') {
            alert('Job Type cannot be empty.');
            return false;
        }
        return true;
    }

    function validateOfferedSalary(input) {
        if (input.value.trim() === '') {
            alert('Offered Salary cannot be empty.');
            return false;
        }
        return true;
    }

    function validateExperience(input) {
        if (input.value.trim() === '') {
            alert('Experience cannot be empty.');
            return false;
        }
        return true;
    }

    function validateQualification(input) {
        if (input.value.trim() === '') {
            alert('Qualification cannot be empty.');
            return false;
        }
        return true;
    }

    function validateGender(input) {
        if (input.value.trim() === '') {
            alert('Gender cannot be empty.');
            return false;
        }
        return true;
    }

    function validateCountry(input) {
        if (input.value.trim() === '') {
            alert('Country cannot be empty.');
            return false;
        }
        return true;
    }

    function validateLocation(input) {
        var regex = /^[A-Za-z\s]+$/;
        if (!regex.test(input.value)) {
            alert('Location should only contain letters and spaces.');
            return false;
        }
        return true;
    }

    function validateEmail(input) {
        var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!regex.test(input.value)) {
            alert('Please enter a valid email address.');
            return false;
        }
        return true;
    }

    function validateStartDate(input) {
        if (!input.value) {
            alert('Start Date is required.');
            return false;
        }
        return true;
    }
});

            </script>
        </div>
    </div>
</div>
                                       <div class="modal fade" id="delete-job-modal" tabindex="-1" aria-labelledby="deleteJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="delete-job-form" action="delete_job.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteJobModalLabel">Delete Job Posting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the job posting for <strong id="delete-job-title"></strong> at <strong id="delete-company-name"></strong>?</p>
                    <input type="hidden" name="job_id" id="delete-job-id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var editJobModal = document.getElementById('edit-job-modal');

    editJobModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var jobId = button.getAttribute('data-job-id');
        var companyName = button.getAttribute('data-company-name');
        var jobTitle = button.getAttribute('data-job-title');
        var jobCategory = button.getAttribute('data-job-category');
        var jobType = button.getAttribute('data-job-type');
        var offeredSalary = button.getAttribute('data-offered-salary');
        var experience = button.getAttribute('data-experience');
        var qualification = button.getAttribute('data-qualification');
        var gender = button.getAttribute('data-gender');
        var country = button.getAttribute('data-country');
        var location = button.getAttribute('data-location');
        var email = button.getAttribute('data-email');
        var website = button.getAttribute('data-website');
        var completeAddress = button.getAttribute('data-complete-address');
        var description = button.getAttribute('data-description');
        var requiredSkills = button.getAttribute('data-required-skills');
        var responsibilities = button.getAttribute('data-responsibilities');
        var startDate = button.getAttribute('data-start-date');
        var endDate = button.getAttribute('data-end-date');
        var companyProfileImage = button.getAttribute('data-company-profile-image');

        var modal = editJobModal.querySelector('form');
        modal.querySelector('#job-id').value = jobId;
        modal.querySelector('#company-name').value = companyName;
        modal.querySelector('#job-title').value = jobTitle;
        modal.querySelector('#job-category').value = jobCategory;
        modal.querySelector('#job-type').value = jobType;
        modal.querySelector('#offered-salary').value = offeredSalary;
        modal.querySelector('#experience').value = experience;
        modal.querySelector('#qualification').value = qualification;
        modal.querySelector('#gender').value = gender;
        modal.querySelector('#country').value = country;
        modal.querySelector('#location').value = location;
        modal.querySelector('#email').value = email;
        modal.querySelector('#website').value = website;
        modal.querySelector('#complete-address').value = completeAddress;
        modal.querySelector('#description').value = description;
        modal.querySelector('#required-skills').value = requiredSkills;
        modal.querySelector('#responsibilities').value = responsibilities;
        modal.querySelector('#start-date').value = startDate;
        modal.querySelector('#end-date').value = endDate;
        modal.querySelector('#company-profile-image').value = companyProfileImage;
    });
});


<!-- STYLE SWITCHER END ==== -->



<?php
// Include database connection
include 'db.php';

// Fetch job postings from the database
$query = "SELECT job_title, job_category, job_type, start_date, end_date, complete_address, country, company_name, company_profile_image FROM job_postings";
$result = $conn->query($query);

// Check for query execution errors
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>



    


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
    	
        <!-- Sidebar Holder -->
        <?php include 'Nav.php';?>
        <!-- Page Content Holder -->
        <div id="content">

            <div class="content-admin-main">

            	<div class="wt-admin-right-page-header clearfix">
                    <h2>Manage Jobs</h2>
                    <div class="breadcrumbs"><a href="#">Home</a><a href="#">Dasboard</a><span>My Job Listing</span></div>
                </div>

                <!--Basic Information-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0"><i class="fa fa-suitcase"></i> Job Details</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">
                        <div class="twm-D_table p-a20 table-responsive">
                            <div class="panel-body wt-panel-body p-a20 m-b30 ">
    <div class="twm-D_table p-a20 table-responsive">
       
        <?php
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "jobzilla"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination settings
$jobs_per_page = 5; // Number of jobs per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$start = ($page - 1) * $jobs_per_page; // Start index

// Fetch total number of jobs
$total_query = "SELECT COUNT(*) AS total FROM job_postings";
$total_result = $conn->query($total_query);
$total_jobs = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_jobs / $jobs_per_page);

// Fetch job postings from the database with pagination
$query = "SELECT id, job_title, website, complete_address, description, required_skills, responsibilities, start_date, end_date, company_name, offered_salary, experience, qualification, gender, country, location, email, job_category, job_type, company_profile_image 
          FROM job_postings 
          ORDER BY id DESC 
          LIMIT $start, $jobs_per_page";
$result = $conn->query($query);
?>

<table class="table table-bordered twm-bookmark-list-wrap">
    <thead>
        <tr>
            <th>Job Title</th>
            <th>Category</th>
            <th>Job Types</th>
            <th>Created & Expired</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td>
                    <div class="twm-bookmark-list">
                        <div class="twm-media">
                            <div>
                                <?php if ($row['company_profile_image']): ?>
                                    <div class="image-container">
                                        <img src="<?php echo htmlspecialchars($row['company_profile_image']); ?>" alt="Company Image" class="img-fluid">
                                    </div>
                                <?php else: ?>
                                    <img src="images/default.jpg" alt="Default Image" class="img-fluid">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="twm-mid-content">
                            <a href="#" class="twm-job-title"
                               data-bs-toggle="modal"
                               data-bs-target="#edit-job-modal"
                               data-job-id="<?php echo htmlspecialchars($row['id']); ?>"
                               data-job-title="<?php echo htmlspecialchars($row['job_title']); ?>"
                               data-job-category="<?php echo htmlspecialchars($row['job_category']); ?>"
                               data-job-type="<?php echo htmlspecialchars($row['job_type']); ?>"
                               data-start-date="<?php echo htmlspecialchars($row['start_date']); ?>"
                               data-end-date="<?php echo htmlspecialchars($row['end_date']); ?>"
                               data-required-skills="<?php echo htmlspecialchars($row['required_skills']); ?>"
                               data-description="<?php echo htmlspecialchars($row['description']); ?>">
                                <h4><?php echo htmlspecialchars($row['job_title']); ?></h4>
                                <p class="twm-bookmark-address">
                                    <i class="feather-map-pin"></i><?php echo htmlspecialchars($row['complete_address']); ?>
                                </p>
                            </a>
                        </div>
                    </div>
                </td>
                <td><?php echo htmlspecialchars($row['job_category']); ?></td>
                <td>
                    <div class="twm-jobs-category">
                        <span class="twm-bg-green"><?php echo htmlspecialchars($row['job_type']); ?></span>
                    </div>
                </td>
                <td>
                    <div><?php echo htmlspecialchars($row['start_date']); ?></div>
                    <div><?php echo htmlspecialchars($row['end_date']); ?></div>
                </td>
                <td>
                    <div class="twm-table-controls">
                        <ul class="twm-DT-controls-icon list-unstyled">
                            <li>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-job-modal"
                                   data-job-id="<?php echo htmlspecialchars($row['id']); ?>"
                                   data-company-name="<?php echo htmlspecialchars($row['company_name']); ?>"
                                   data-job-title="<?php echo htmlspecialchars($row['job_title']); ?>"
                                   data-job-category="<?php echo htmlspecialchars($row['job_category']); ?>"
                                   data-job-type="<?php echo htmlspecialchars($row['job_type']); ?>"
                                   data-offered-salary="<?php echo htmlspecialchars($row['offered_salary']); ?>"
                                   data-experience="<?php echo htmlspecialchars($row['experience']); ?>"
                                   data-qualification="<?php echo htmlspecialchars($row['qualification']); ?>"
                                   data-gender="<?php echo htmlspecialchars($row['gender']); ?>"
                                   data-country="<?php echo htmlspecialchars($row['country']); ?>"
                                   data-location="<?php echo htmlspecialchars($row['location']); ?>"
                                   data-email="<?php echo htmlspecialchars($row['email']); ?>"
                                   data-website="<?php echo htmlspecialchars($row['website']); ?>"
                                   data-complete-address="<?php echo htmlspecialchars($row['complete_address']); ?>"
                                   data-description="<?php echo htmlspecialchars($row['description']); ?>"
                                   data-required-skills="<?php echo htmlspecialchars($row['required_skills']); ?>"
                                   data-responsibilities="<?php echo htmlspecialchars($row['responsibilities']); ?>"
                                   data-start-date="<?php echo htmlspecialchars($row['start_date']); ?>"
                                   data-end-date="<?php echo htmlspecialchars($row['end_date']); ?>"
                                   data-company-profile-image="<?php echo htmlspecialchars($row['company_profile_image']); ?>"
                                   class="custom-toltip">
                                    <span class="far fa-edit"></span>
                                    <span class="custom-toltip-block">Edit</span>
                                </a>
                            </li>
                            <li>
                                <button class="delete-job-btn custom-toltip"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#delete-job-modal"
                                        data-job-id="<?php echo htmlspecialchars($row['id']); ?>"
                                        data-company-name="<?php echo htmlspecialchars($row['company_name']); ?>"
                                        data-job-title="<?php echo htmlspecialchars($row['job_title']); ?>">
                                    <span class="far fa-trash-alt"></span>
                                    <span class="custom-toltip-block">Delete</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Pagination Controls -->
<nav aria-label="Job pagination">
    <ul class="pagination">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<?php
// Close database connection
$conn->close();
?>


        <!-- Modal -->
                                       <!-- Modal -->
<div class="modal fade" id="edit-job-modal" tabindex="-1" aria-labelledby="editJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="edit-job-form" action="update_job.php" method="post">
                <div class="modal-header">
                    <h2 class="modal-title" id="editJobModalLabel">Edit Job</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="job_id" id="job-id">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="company-name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="company-name" name="company_name">
                        </div>
                        <div class="col-md-6">
                            <label for="job-title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="job-title" name="job_title">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="job-category" class="form-label">Job Category</label>
                            <input type="text" class="form-control" id="job-category" name="job_category">
                        </div>
                        <div class="col-md-6">
                            <label for="job-type" class="form-label">Job Type</label>
                            <input type="text" class="form-control" id="job-type" name="job_type">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="offered-salary" class="form-label">Offered Salary</label>
                            <input type="text" class="form-control" id="offered-salary" name="offered_salary">
                        </div>
                        <div class="col-md-6">
                            <label for="experience" class="form-label">Experience</label>
                            <input type="text" class="form-control" id="experience" name="experience">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="qualification" class="form-label">Qualification</label>
                            <input type="text" class="form-control" id="qualification" name="qualification">
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="gender" name="gender">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="country">
                        </div>
                        <div class="col-md-6">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-md-6">
                            <label for="website" class="form-label">Website</label>
                            <input type="text" class="form-control" id="website" name="website">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="complete-address" class="form-label">Complete Address</label>
                        <textarea class="form-control" id="complete-address" name="complete_address"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="required-skills" class="form-label">Required Skills</label>
                        <textarea class="form-control" id="required-skills" name="required_skills"></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="responsibilities" class="form-label">Responsibilities</label>
                            <textarea class="form-control" id="responsibilities" name="responsibilities"></textarea>
                        </div>
                        
                    </div>

                    <div class="row mb-3">
                        
                        <div class="col-md-6">
                            <label for="end-date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end-date" name="end_date">
                        </div>
                       
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
                                       <div class="modal fade" id="delete-job-modal" tabindex="-1" aria-labelledby="deleteJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="delete-job-form" action="delete_job.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteJobModalLabel">Delete Job Posting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the job posting for <strong id="delete-job-title"></strong> at <strong id="delete-company-name"></strong>?</p>
                    <input type="hidden" name="job_id" id="delete-job-id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var editJobModal = document.getElementById('edit-job-modal');

    editJobModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var jobId = button.getAttribute('data-job-id');
        var companyName = button.getAttribute('data-company-name');
        var jobTitle = button.getAttribute('data-job-title');
        var jobCategory = button.getAttribute('data-job-category');
        var jobType = button.getAttribute('data-job-type');
        var offeredSalary = button.getAttribute('data-offered-salary');
        var experience = button.getAttribute('data-experience');
        var qualification = button.getAttribute('data-qualification');
        var gender = button.getAttribute('data-gender');
        var country = button.getAttribute('data-country');
        var location = button.getAttribute('data-location');
        var email = button.getAttribute('data-email');
        var website = button.getAttribute('data-website');
        var completeAddress = button.getAttribute('data-complete-address');
        var description = button.getAttribute('data-description');
        var requiredSkills = button.getAttribute('data-required-skills');
        var responsibilities = button.getAttribute('data-responsibilities');
        var startDate = button.getAttribute('data-start-date');
        var endDate = button.getAttribute('data-end-date');
        var companyProfileImage = button.getAttribute('data-company-profile-image');

        var modal = editJobModal.querySelector('form');
        modal.querySelector('#job-id').value = jobId;
        modal.querySelector('#company-name').value = companyName;
        modal.querySelector('#job-title').value = jobTitle;
        modal.querySelector('#job-category').value = jobCategory;
        modal.querySelector('#job-type').value = jobType;
        modal.querySelector('#offered-salary').value = offeredSalary;
        modal.querySelector('#experience').value = experience;
        modal.querySelector('#qualification').value = qualification;
        modal.querySelector('#gender').value = gender;
        modal.querySelector('#country').value = country;
        modal.querySelector('#location').value = location;
        modal.querySelector('#email').value = email;
        modal.querySelector('#website').value = website;
        modal.querySelector('#complete-address').value = completeAddress;
        modal.querySelector('#description').value = description;
        modal.querySelector('#required-skills').value = requiredSkills;
        modal.querySelector('#responsibilities').value = responsibilities;
        modal.querySelector('#start-date').value = startDate;
        modal.querySelector('#end-date').value = endDate;
        modal.querySelector('#company-profile-image').value = companyProfileImage;
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-job-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const jobId = this.getAttribute('data-job-id');
            const companyName = this.getAttribute('data-company-name');
            const jobTitle = this.getAttribute('data-job-title');

            document.getElementById('delete-job-id').value = jobId;
            document.getElementById('delete-company-name').textContent = companyName;
            document.getElementById('delete-job-title').textContent = jobTitle;
        });
    });
});

</script>

    <!-- jQuery (required for Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    


    <!-- jQuery (required for Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    


    	</div>

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

    
<!-- STYLE SWITCHER END ==== -->

</body>


</html>
