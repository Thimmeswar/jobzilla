
<?php
include 'db.php';

// Fetch the first five applied candidates with their salary information from job_postings table
$sql = "SELECT aj.*, jp.offered_salary 
        FROM applied_jobs aj
        JOIN job_postings jp ON aj.jobid = jp.id 
        ORDER BY aj.created_at DESC 
        LIMIT 5";
        
$result = $conn->query($sql);

$candidates = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $candidates[] = $row;
    }
} else {
    echo "No candidates found";
}

$conn->close();
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
<?php
// Database connection
include 'db.php';

// Fetch counts from the tables
// Count of posted jobs
$posted_jobs_query = "SELECT COUNT(*) as total_posted_jobs FROM job_postings";
$posted_jobs_result = $conn->query($posted_jobs_query);
$posted_jobs_row = $posted_jobs_result->fetch_assoc();
$total_posted_jobs = $posted_jobs_row['total_posted_jobs'];

// Count of applied candidates
$applied_candidates_query = "SELECT COUNT(*) as total_applied_candidates FROM applied_jobs";
$applied_candidates_result = $conn->query($applied_candidates_query);
$applied_candidates_row = $applied_candidates_result->fetch_assoc();
$total_applied_candidates = $applied_candidates_row['total_applied_candidates'];

// Count of shortlisted candidates
$shortlisted_candidates_query = "SELECT COUNT(*) as total_shortlisted FROM applied_jobs WHERE status='shortlisted'";
$shortlisted_candidates_result = $conn->query($shortlisted_candidates_query);
$shortlisted_candidates_row = $shortlisted_candidates_result->fetch_assoc();
$total_shortlisted_candidates = $shortlisted_candidates_row['total_shortlisted'];

// Count of total candidates
$total_candidates_query = "SELECT COUNT(*) as total_candidates FROM candidate_profile";
$total_candidates_result = $conn->query($total_candidates_query);
$total_candidates_row = $total_candidates_result->fetch_assoc();
$total_candidates = $total_candidates_row['total_candidates'];

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
    <title>jobzilla Template | dashboard</title>
    
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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
    
       <?php include 'Header_2.php';?>
    	
        <!-- Sidebar Holder -->
        <?php include 'Nav.php';?>

        <!-- Page Content Holder -->
        <div id="content">

            <div class="content-admin-main">

                <div class="wt-admin-right-page-header clearfix">
                    <h2>Hello, <?php echo htmlspecialchars($admin['fname']); ?></h2>
                    <div class="breadcrumbs"><a href="#">Home</a><span>Dasboard</span></div>
                </div>

                <div class="twm-dash-b-blocks mb-5">
                    <div class="row">
                      <div class="col-xl-3 col-lg-6 col-md-12 mb-3">
        <div class="panel panel-default">
            <div class="panel-body wt-panel-body gradi-1 dashboard-card">
                <div class="wt-card-wrap">
                    <div class="wt-card-icon"><i class="far fa-address-book"></i></div>
                    <div class="wt-card-right wt-total-active-listing counter">
                        <?php echo $total_posted_jobs; ?>
                    </div>
                    <div class="wt-card-bottom">
                        <h4 class="m-b0">Posted Jobs</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Applied Candidates -->
    <div class="col-xl-3 col-lg-6 col-md-12 mb-3">
        <div class="panel panel-default">
            <div class="panel-body wt-panel-body gradi-1 dashboard-card">
                <div class="wt-card-wrap">
                    <div class="wt-card-icon"><i class="far fa-user"></i></div>
                    <div class="wt-card-right wt-total-active-listing counter">
                        <?php echo $total_applied_candidates; ?>
                    </div>
                    <div class="wt-card-bottom">
                        <h4 class="m-b0">Applied Candidates</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shortlisted Candidates -->
    <div class="col-xl-3 col-lg-6 col-md-12 mb-3">
        <div class="panel panel-default">
            <div class="panel-body wt-panel-body gradi-1 dashboard-card">
                <div class="wt-card-wrap">
                    <div class="wt-card-icon"><i class="far fa-user"></i></div>
                    <div class="wt-card-right wt-total-active-listing counter">
                        <?php echo $total_shortlisted_candidates; ?>
                    </div>
                    <div class="wt-card-bottom">
                        <h4 class="m-b0">Shortlisted Candidates</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Candidates -->
    <div class="col-xl-3 col-lg-6 col-md-12 mb-3">
        <div class="panel panel-default">
            <div class="panel-body wt-panel-body gradi-1 dashboard-card">
                <div class="wt-card-wrap">
                    <div class="wt-card-icon"><i class="far fa-user"></i></div>
                    <div class="wt-card-right wt-total-active-listing counter">
                        <?php echo $total_candidates; ?>
                    </div>
                    <div class="wt-card-bottom">
                        <h4 class="m-b0">Total Candidates</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
                </div>

                <div class="twm-pro-view-chart-wrap">
                    <div class="row">
<!--                        <div class="col-xl-6 col-lg-12 col-md-12 mb-4">
                            <div class="panel panel-default site-bg-white">
                                <div class="panel-heading wt-panel-heading p-a20">
                                    <h4 class="panel-tittle m-a0"><i class="far fa-chart-bar"></i>Your Profile Views</h4>
                                </div>
                                <div class="panel-body wt-panel-body twm-pro-view-chart">
                                    <canvas id="profileViewChart"></canvas>
                                </div>
                            </div>
                        
                        </div>-->
                        

<!--                        <div class="col-xl-6 col-lg-12 col-md-12 mb-4">
                            <div class="panel panel-default">
                                <div class="panel-heading wt-panel-heading p-a20">
                                    <h4 class="panel-tittle m-a0">Inbox</h4>
                                </div>
                                <div class="panel-body wt-panel-body bg-white">
                                    <div class="dashboard-messages-box-scroll scrollbar-macosx">
                                    
                                        <div class="dashboard-messages-box">
                                            <div class="dashboard-message-avtar"><img src="images/user-avtar/pic1.jpg" alt=""></div>
                                            <div class="dashboard-message-area">
                                                <h5>Lucy Smith<span>18 June 2023</span></h5>
                                                <p>Bring to the table win-win survival strategies to ensure proactive domination. at the end of the day, going forward, a new normal that has evolved from generation.</p>
                                            </div>
                                        </div>                    
                                
                                        <div class="dashboard-messages-box">
                                            <div class="dashboard-message-avtar"><img src="images/user-avtar/pic3.jpg" alt=""></div>
                                            <div class="dashboard-message-area">
                                                <h5>Richred paul<span>19 June 2023</span></h5>
                                                <p>Bring to the table win-win survival strategies to ensure proactive domination. at the end of the day, going forward, a new normal that has evolved from generation.</p>
                                            </div>
                                        </div>
                                        
                                        <div class="dashboard-messages-box">
                                            <div class="dashboard-message-avtar"><img src="images/user-avtar/pic4.jpg" alt=""></div>
                                            <div class="dashboard-message-area">
                                                <h5>Jon Doe<span>20 June 2023</span></h5>
                                                <p>Bring to the table win-win survival strategies to ensure proactive domination. at the end of the day, going forward, a new normal that has evolved from generation.</p>
                                            </div>
                                        </div>
                                        
                                        <div class="dashboard-messages-box">
                                            <div class="dashboard-message-avtar"><img src="images/user-avtar/pic1.jpg" alt=""></div>
                                            <div class="dashboard-message-area">
                                                <h5>Thomas Smith<span>22 June 2023</span></h5>
                                                <p>Bring to the table win-win survival strategies to ensure proactive domination. at the end of the day, going forward, a new normal that has evolved from generation. </p>
                                            </div>
                                        </div>
                                    </div>                        
                                                     
                                </div>
                            </div>

                        </div>-->

                        <div class="col-lg-12 col-md-12 mb-4">
                            <div class="panel panel-default site-bg-white m-t30">
<!--                                <div class="panel-heading wt-panel-heading p-a20">
                                    <h4 class="panel-tittle m-a0"><i class="far fa-list-alt"></i>Recent Activities</h4>
                                </div>-->
                                <div class="panel-body wt-panel-body">
                                    
                                    <div class="dashboard-list-box list-box-with-icon">
<!--                                        <ul>
                                            <li>
                                                <i class="fa fa-envelope text-success list-box-icon"></i>Nikol Tesla has sent you <a href="#" class="text-success">private message!</a>
                                                <a href="#" class="close-list-item color-lebel clr-red">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <i class="fa fa-suitcase text-primary list-box-icon"></i>Your job for  
                                                <a href="#" class="text-primary">Web Designer</a>
                                                has been approved!
                                                <a href="#" class="close-list-item color-lebel clr-red">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </li>
                                                
                                            <li>
                                                <i class="fa fa-bookmark text-warning list-box-icon"></i>
                                                Someone bookmarked your
                                                <a href="#" class="text-warning">SEO Expert</a> 
                                                Job listing! 
                                                <a href="#" class="close-list-item color-lebel clr-red">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <i class="fa fa-tasks text-info list-box-icon"></i>
                                                Your job listing Core
                                                <a href="#" class="text-info">PHP Developer</a> for Site Maintenance is expiring! 
                                                <a href="#" class="close-list-item color-lebel clr-red">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <i class="fa fa-paperclip text-success list-box-icon"></i>
                                                You have new application for
                                                <a href="#" class="text-success"> UI/UX Developer & Designer! </a>
                                                <a href="#" class="close-list-item color-lebel clr-red">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <i class="fa fa-suitcase text-danger list-box-icon"></i>
                                                Your Magento Developer job expire  
                                                <a href="#" class="text-danger">Renew</a>  now it.
                                                <a href="#" class="close-list-item color-lebel clr-red">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <i class="fa fa-star site-text-orange list-box-icon"></i> 
                                                David cope left a 
                                                <a href="#" class="site-text-orange"> review 4.5</a> for Real Estate Logo
                                                <a href="#" class="close-list-item color-lebel clr-red">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </li>
                                        </ul>-->
                                    
                                    </div>
                                                
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 mb-4">
                            <div class="panel panel-default">
                                <div class="panel-heading wt-panel-heading p-a20">
                                    <h4 class="panel-tittle m-a0">Recent Applicants</h4>
                                </div>
                                <div class="panel-body wt-panel-body bg-white">
                                    <div class="twm-dashboard-candidates-wrap">
                                      <div class="row">
    <?php foreach ($candidates as $candidate) : ?>
        <div class="col-xl-6 col-lg-12 col-md-12">
            <div class="twm-dash-candidates-list">
                <div class="twm-media">
                    <div class="twm-media-pic">
                        <?php if (!empty($candidate['picture'])): ?>
                            <img src="<?php echo htmlspecialchars($candidate['picture']); ?>" alt="Candidate Image">
                        <?php else: ?>
                            <img src="images/candidates/default.jpg" alt="Default Image">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="twm-mid-content">
                    <a href="#" class="twm-job-title">
                        <h4><?php echo htmlspecialchars($candidate['first_name']) . ' ' . htmlspecialchars($candidate['last_name']); ?></h4>
                    </a>
                    <p><?php echo htmlspecialchars($candidate['job_category']); ?></p>
                    <div class="twm-fot-content">
                        <div class="twm-left-info">
                            <p class="twm-candidate-address"><i class="feather-map-pin"></i><?php echo htmlspecialchars($candidate['country']); ?></p>
                            <div class="twm-candidate-salary">
                                <?php
                                // Remove non-numeric characters
                                $clean_salary = preg_replace('/[^0-9.]/', '', $candidate['offered_salary']);
                                
                                // Convert to float and format
                                echo "₹" . number_format((float)$clean_salary); ?> <span>/ Year</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

                          
        
                                            

                                           
                                        
                                    </div>              
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                                                      
            </div>

    	</div>

         <!--Delete Profile Popup-->
       <?php include 'Delete-Profile-admin.php';?>
        <?php include 'Logout_session.php';?>
<div class="modal fade" id="view-candidate-modal" tabindex="-1" aria-labelledby="viewCandidateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="view-candidate-form">
                <div class="modal-header">
                    <h2 class="modal-title" id="viewCandidateModalLabel">View Candidate</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="candidate_id" id="candidate-id">

                    <!-- Full Name and Email -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="full-name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full-name" name="fullname" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" readonly>
                        </div>
                    </div>

                    <!-- Location and Phone -->
                    <div class="row mb-3">
                        <div class="col-md-6">
            <label for="country" class="form-label">Country</label>
            <input type="text" class="form-control" id="country" name="country" readonly>
        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" readonly>
                        </div>
                    </div>

                    <!-- Source and Experience -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="source" class="form-label">Source</label>
                            <input type="text" class="form-control" id="source" name="source" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="experience" class="form-label">Experience</label>
                            <input type="text" class="form-control" id="experience" name="experience" readonly>
                        </div>
                    </div>

                    <!-- Notice Period and Skill -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="notice-period" class="form-label">Notice Period</label>
                            <input type="text" class="form-control" id="notice-period" name="notice_period" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="skill" class="form-label">Skill</label>
                            <input type="text" class="form-control" id="skill" name="skill" readonly>
                        </div>
                    </div>

                    <!-- Remarks and Employee Status -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="remarks" class="form-label">Remarks</label>
                            <input type="text" class="form-control" id="remarks" name="remarks" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="employee-status" class="form-label">Employee Status</label>
                            <select class="form-select" id="employee-status" name="employee_status" disabled>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <!-- Resume and Profile Image -->
                   <div class="row mb-3">
    <div class="col-md-6">
        <label for="resume" class="form-label">Resume</label>
        <input type="text" class="form-control" id="resume" name="resume" readonly onclick="openFile('resume')">
    </div>
    <div class="col-md-6">
        <label for="image" class="form-label">Profile Image</label>
        <input type="text" class="form-control" id="image" name="image" readonly onclick="openFile('image')">
    </div>
</div>

                    <!-- Job Role and Status -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="job-role" class="form-label">Job Role</label>
                            <input type="text" class="form-control" id="job-role" name="job_role" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-job-modal" tabindex="-1" aria-labelledby="deleteJobModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteJobModalLabel">Delete Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the job: <strong id="modalJobTitle"></strong> from <strong id="modalCompanyName"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
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
<script>
    function checkAll(checkbox) {
        const checkboxes = document.querySelectorAll('#candidate_data_table tbody input[type="checkbox"]');
        checkboxes.forEach(cb => cb.checked = checkbox.checked);
    }

    function showCandidateDetails(id) {
        // Implement the function to show candidate details in a modal
    }

    function updateStatus(select, id) {
        const status = select.value;
        // Implement the function to update candidate status in the database
    }

    function deleteCandidate(id) {
        if (confirm('Are you sure you want to delete this candidate?')) {
            // Implement the function to delete the candidate from the database
        }
    }
</script>
<script>
    function updateStatus(selectElement, candidateId) {
    var status = selectElement.value;

    // Make an AJAX request to update the status in the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Display success message or handle error
            alert(xhr.responseText);
        }
    };
    xhr.send("candidate_id=" + encodeURIComponent(candidateId) + "&status=" + encodeURIComponent(status));
}

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var viewCandidateModal = document.getElementById('view-candidate-modal');

    viewCandidateModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        // Retrieve data attributes from the button
        var candidateId = button.getAttribute('data-candidate-id');
        var fullName = button.getAttribute('data-fullname');
        var email = button.getAttribute('data-email');
        var location = button.getAttribute('data-location');
        var phone = button.getAttribute('data-phone');
        var source = button.getAttribute('data-source');
        var experience = button.getAttribute('data-experience');
        var noticePeriod = button.getAttribute('data-notice-period');
        var skill = button.getAttribute('data-skill');
        var remarks = button.getAttribute('data-remarks');
        var employeeStatus = button.getAttribute('data-employee-status');
        var resume = button.getAttribute('data-resume');
        var image = button.getAttribute('data-image');
        var jobRole = button.getAttribute('data-job-role');
        var status = button.getAttribute('data-status');

        // Populate the modal form fields with the retrieved values
        var modal = viewCandidateModal.querySelector('form');
        modal.querySelector('#candidate-id').value = candidateId;
        modal.querySelector('#full-name').value = fullName;
        modal.querySelector('#email').value = email;
        modal.querySelector('#country').value = country; 
        modal.querySelector('#phone').value = phone;
        modal.querySelector('#source').value = source;
        modal.querySelector('#experience').value = experience;
        modal.querySelector('#notice-period').value = noticePeriod;
        modal.querySelector('#skill').value = skill;
        modal.querySelector('#remarks').value = remarks;
        modal.querySelector('#employee-status').value = employeeStatus;
        modal.querySelector('#resume').value = resume;
        modal.querySelector('#image').value = image;
        modal.querySelector('#job-role').value = jobRole;
        modal.querySelector('#status').value = status;
    });
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.delete-job-btn');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var jobId = this.getAttribute('data-job-id');
            var companyName = this.getAttribute('data-company-name');
            var jobTitle = this.getAttribute('data-job-title');

            document.getElementById('modalJobTitle').textContent = jobTitle;
            document.getElementById('modalCompanyName').textContent = companyName;

            // Set the job ID in the confirm delete button
            document.getElementById('confirmDelete').setAttribute('data-job-id', jobId);
        });
    });

    document.getElementById('confirmDelete').addEventListener('click', function() {
        var jobId = this.getAttribute('data-job-id');

        // Send the AJAX request to delete the job
        fetch('delete_job.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'job_id=' + jobId
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                alert('Job deleted successfully!');
                window.location.reload(); // Reload the page to reflect the deletion
            } else {
                alert('Error deleting job: ' + data);
            }
        });
    });
});

    </script>
    
    <script>
    function openFile(type) {
        var filePath;
        if (type === 'resume') {
            filePath = document.getElementById('resume').value;
        } else if (type === 'image') {
            filePath = document.getElementById('image').value;
        }
        
        if (filePath) {
            window.open(filePath, '_blank');
        } else {
            alert('No file path specified.');
        }
    }
</script>
<script>
    function openFile(fileType) {
    // Implement the logic to open the file based on fileType ('resume' or 'image')
}

function deleteCandidate(id) {
    if (confirm('Are you sure you want to delete this candidate?')) {
        // Implement the AJAX request to delete the candidate from the database
    }
}

function showCandidateDetails(id) {
    // Implement the function to show candidate details in a modal
}

document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.delete-job-btn');

    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var jobId = this.getAttribute('data-job-id');
            var companyName = this.getAttribute('data-company-name');
            var jobTitle = this.getAttribute('data-job-title');

            document.getElementById('modalJobTitle').textContent = jobTitle;
            document.getElementById('modalCompanyName').textContent = companyName;

            // Set the job ID in the confirm delete button
            document.getElementById('confirmDelete').setAttribute('data-job-id', jobId);
        });
    });

    document.getElementById('confirmDelete').addEventListener('click', function() {
        var jobId = this.getAttribute('data-job-id');

        // Send the AJAX request to delete the job
        fetch('delete_job.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'job_id=' + encodeURIComponent(jobId)
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                alert('Job deleted successfully!');
                // Remove the deleted job row from the table or refresh the job list
                // Example: document.querySelector(`[data-job-id="${jobId}"]`).closest('tr').remove();
            } else {
                alert('Error deleting job. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the job.');
        });
    });
});

</script>


<!-- STYLE SWITCHER  ======= --> 
<div class="styleswitcher">

    
    <div class="styleswitcher-inner">
    
        <h6 class="switcher-title">Color Skin</h6>
        <ul class="color-skins">
            <li><a class="theme-skin skin-1" href="dash-candidatesa39b.php?theme=css/skin/skin-1"></a></li>
            <li><a class="theme-skin skin-2" href="dash-candidates61e7.php?theme=css/skin/skin-2"></a></li>
            <li><a class="theme-skin skin-3" href="dash-candidatescce5.php?theme=css/skin/skin-3"></a></li>
            <li><a class="theme-skin skin-4" href="dash-candidates13f7.php?theme=css/skin/skin-4"></a></li>
            <li><a class="theme-skin skin-5" href="dash-candidates19a6.php?theme=css/skin/skin-5"></a></li>
            <li><a class="theme-skin skin-6" href="dash-candidatesfe5c.php?theme=css/skin/skin-6"></a></li>
            <li><a class="theme-skin skin-7" href="dash-candidatesab47.php?theme=css/skin/skin-7"></a></li>
            <li><a class="theme-skin skin-8" href="dash-candidates5f8d.php?theme=css/skin/skin-8"></a></li>
            <li><a class="theme-skin skin-9" href="dash-candidates5663.php?theme=css/skin/skin-9"></a></li>
            <li><a class="theme-skin skin-10" href="dash-candidates28ac.php?theme=css/skin/skin-10"></a></li>
            
        </ul>           
        
    </div>    
</div>
<!-- STYLE SWITCHER END ==== -->



</body>


</html>
