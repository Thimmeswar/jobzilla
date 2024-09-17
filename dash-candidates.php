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

    <!-- THEME COLOR CHANGE STYLE SHEET -->
    <link rel="stylesheet" class="skin" type="text/css" href="css/skins-type/skin-6.css">
    <!-- SIDE SWITCHER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="css/switcher.css">   
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
    
       <?php include 'Header_2.php';?>
    	
        <!-- Sidebar Holder -->
        <?php include 'Nav.php';?>

        <!-- Page Content Holder -->
        <div id="content">

            <div class="content-admin-main">

                <div class="wt-admin-right-page-header clearfix">
                    <h2>Candidates</h2>
                    <div class="breadcrumbs"><a href="dashboard.php">Home</a><span>Candidates</span></div>
                </div>

                <div class="twm-pro-view-chart-wrap">

                    <div class="col-lg-12 col-md-12 mb-4">
                        <div class="panel panel-default site-bg-white m-t30">
                            <div class="panel-heading wt-panel-heading p-a20">
                                <h4 class="panel-tittle m-a0"><i class="far fa-list-alt"></i>All Applied Candidates</h4>
                            </div>
                            <div class="panel-body wt-panel-body">
                               <?php
// Fetch job application data from the database
$query = "SELECT id, jobid, candidateid, title, first_name, last_name, email, phone, source, experience_years, experience_months, notice_period, remark, is_employee, resume, picture, created_at, updated_at, status, country, job_category, skill FROM applied_jobs";
$result = $conn->query($query);
?>

<div class="twm-D_table p-a20 table-responsive">
    <table id="candidate_data_table" class="table table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" onclick="checkAll(this)"></th>
                <th>Name</th>
                <th>Applied for</th>
                <th>Date</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>
                        <div class="twm-DT-candidates-list">
                           <div class="twm-media">
                               <div class="twm-media-pic">
                                   <?php if (!empty($row['picture'])): ?>
                                       <img src="<?php echo htmlspecialchars($row['picture']); ?>" alt="Candidate Image">
                                   <?php else: ?>
                                       <img src="images/candidates/default.jpg" alt="Default Image">
                                   <?php endif; ?>
                               </div>
                           </div>
                            <div class="twm-mid-content">
                                <a href="#" class="twm-job-title" data-bs-toggle="modal" data-bs-target="#" onclick="showCandidateDetails('<?php echo htmlspecialchars($row['id']); ?>')">
                                    <h4><?php echo htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']); ?></h4>
                                    <p class="twm-candidate-address">
                                        <i class="feather-map-pin"></i><?php echo htmlspecialchars($row['country']); ?>
                                    </p>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php 
                        // Fetch job title and job category from the row
                       
                        $jobCategory = htmlspecialchars($row['job_category']);
                        ?>
                        <!-- Display job title and job category -->
                         <?php echo $jobCategory; ?>
                    </td>
                    <td><?php echo date('d/m/Y \a\t H:i a', strtotime($row['created_at'])); ?></td>
                    <td>
                        <select class="form-select" onchange="updateStatus(this, '<?php echo htmlspecialchars($row['id']); ?>')">
                            <option value="pending" <?php echo $row['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="shortlisted" <?php echo $row['status'] === 'shortlisted' ? 'selected' : ''; ?>>Shortlisted</option>
                            <option value="rejected" <?php echo $row['status'] === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                        </select>
                    </td>
                    <td>
                        <div class="twm-table-controls">
                            <ul class="twm-DT-controls-icon list-unstyled">
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#view-candidate-modal"
                                       data-candidate-id="<?php echo htmlspecialchars($row['candidateid']); ?>"
                                       data-fullname="<?php echo htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']); ?>"
                                       data-email="<?php echo htmlspecialchars($row['email']); ?>"
                                       data-phone="<?php echo htmlspecialchars($row['phone']); ?>"
                                       data-source="<?php echo htmlspecialchars($row['source']); ?>"
                                      
                                      
                                       data-notice-period="<?php echo htmlspecialchars($row['notice_period']); ?>"
                                       data-skill="<?php echo htmlspecialchars($row['skill']); ?>"
                                       data-remarks="<?php echo htmlspecialchars($row['remark']); ?>"
                                       data-employee-status="<?php echo htmlspecialchars($row['is_employee']); ?>"
                                       data-resume="<?php echo htmlspecialchars($row['resume']); ?>"
                                       data-image="<?php echo htmlspecialchars($row['picture']); ?>"
                                       data-job-title="<?php echo htmlspecialchars($row['title']); ?>"
                                       data-status="<?php echo htmlspecialchars($row['status']); ?>"
                                       class="custom-toltip">
                                        <span class="far fa-eye"></span>
                                        <span class="custom-toltip-block">View</span>
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="delete_job_candidate.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this candidate\'s application?');">
        <i class="fas fa-trash-alt"></i>
    </button>
</form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php
// Close the database connection
$conn->close();
?>

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
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="source" class="form-label">Source</label>
                            <input type="text" class="form-control" id="source" name="source" readonly>
                        </div>
                    </div>

                    <!-- Source and Experience -->
                    <div class="row mb-3">
                        
                        
                    </div>

                    <!-- Notice Period and Skill -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="notice-period" class="form-label">Notice Period(Months)</label>
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
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" readonly>
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
       
        var noticePeriod = button.getAttribute('data-notice-period');
        var skill = button.getAttribute('data-skill');
        var remarks = button.getAttribute('data-remarks');
        
        var resume = button.getAttribute('data-resume');
        var image = button.getAttribute('data-image');
        
        var status = button.getAttribute('data-status');

        // Populate the modal form fields with the retrieved values
        var modal = viewCandidateModal.querySelector('form');
        modal.querySelector('#candidate-id').value = candidateId;
        modal.querySelector('#full-name').value = fullName;
        modal.querySelector('#email').value = email;
        
        modal.querySelector('#phone').value = phone;
        modal.querySelector('#source').value = source;
        
        modal.querySelector('#notice-period').value = noticePeriod;
        modal.querySelector('#skill').value = skill;
        modal.querySelector('#remarks').value = remarks;
        
        modal.querySelector('#resume').value = resume;
        modal.querySelector('#image').value = image;
        
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
        fetch('delete_job_candidate.php', {
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
