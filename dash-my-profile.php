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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated data from the form
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $phone = $_POST['company_phone'];
    $email = $_POST['company_Email'];
    $dob = $_POST['start_date'];
    $gender = $_POST['gender'];
    $address = $_POST['location'];

    // Handle the image upload
    $profile_photo = $_FILES['myfile'];
    $upload_dir = 'uploads/';  // Directory to save the uploaded files
    $upload_file = $upload_dir . basename($profile_photo['name']);
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));

    // Check if image file is a real image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($profile_photo["tmp_name"]);
        if($check !== false) {
            $upload_ok = 1;
        } else {
            $error_message = "File is not an image.";
            $upload_ok = 0;
        }
    }

    // Check file size (limit to 5MB)
    if ($profile_photo["size"] > 5000000) {
        $error_message = "Sorry, your file is too large.";
        $upload_ok = 0;
    }

    // Allow certain file formats
    if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg") {
        $error_message = "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $upload_ok = 0;
    }

    // Check if $upload_ok is set to 0 by an error
    if ($upload_ok == 0) {
        $error_message = "Sorry, your file was not uploaded.";
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($profile_photo["tmp_name"], $upload_file)) {
            $success_message = "The file ". htmlspecialchars(basename($profile_photo["name"])). " has been uploaded.";
        } else {
            $error_message = "Sorry, there was an error uploading your file.";
        }
    }

    // If file was uploaded, update the profile photo in the database
    if ($upload_ok == 1) {
        $update_sql = "UPDATE admin SET 
                       fname='$first_name',
                       lname='$last_name',
                       phone='$phone',
                       email='$email',
                       dob='$dob',
                       gender='$gender',
                       address='$address',
                       image='$upload_file'
                       WHERE id='$admin_id'";
    } else {
        // If file wasn't uploaded, update without changing the profile photo
        $update_sql = "UPDATE admin SET 
                       fname='$first_name',
                       lname='$last_name',
                       phone='$phone',
                       email='$email',
                       dob='$dob',
                       gender='$gender',
                       address='$address'
                       WHERE id='$admin_id'";
    }

    if ($conn->query($update_sql) === TRUE) {
        $success_message = "Profile updated successfully!";
    } else {
        $error_message = "Error updating profile: " . $conn->error;
    }
}

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
    <title>Jobzilla Template | dashboard My Listing</title>
    
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
    
       <?php include 'Header_2.php';?>
    	
        <!-- Sidebar Holder -->
        <?php include 'Nav.php';?>

        <!-- Page Content Holder -->
        <div id="content">

            <div class="content-admin-main">


            	<div class="wt-admin-right-page-header clearfix">
                    <h2>My Profile</h2>
                    <div class="breadcrumbs"><a href="dashboard.php">Home</a><span>Profile</span></div>
                </div>
                <?php if (isset($success_message)) { ?>
    <div class="alert alert-success">
        <?php echo $success_message; ?>
    </div>
<?php } elseif (isset($error_message)) { ?>
    <div class="alert alert-danger">
        <?php echo $error_message; ?>
    </div>
<?php } ?>
                <form method="POST" action="" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Update Profile Image</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 bg-white">
                        
                            <div class="dashboard-profile-section clearfix">
                                <div class="dashboard-profile-pic">
                                    <div class="dashboard-profile-photo">
                                        <img src="<?php echo !empty($admin['image']) ? $admin['image'] : 'images/user-avtar/pic4.jpg'; ?>" alt="">
                                        <div class="upload-btn-wrapper">
                                            <div id="upload-image-grid"></div>
                                            <button class="site-button button-sm">Upload Photo</button>
                                            <input type="file" name="myfile" id="file-uploader" accept=".jpg, .jpeg, .png">
                                        </div>
                                    </div>
                                </div>                                
                            </div> 
                                   
                    </div>
                </div>

                <!--Basic Information-->
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Basic Informations</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20 m-b30 ">
                        
                        <div class="row">
                                            
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <div class="ls-inputicon-box"> 
                                            <input class="form-control" name="fname" type="text" value="<?php echo htmlspecialchars($admin['fname']); ?>" placeholder="Devid">
                                            <i class="fs-input-icon fa fa-user "></i>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <div class="ls-inputicon-box"> 
                                            <input class="form-control" name="lname" type="text" value="<?php echo htmlspecialchars($admin['lname']); ?>" placeholder="Smith">
                                            <i class="fs-input-icon fa fa-user "></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <div class="ls-inputicon-box"> 
                                            <input class="form-control" name="company_phone" type="text" value="<?php echo htmlspecialchars($admin['phone']); ?>" placeholder="(251) 1234-456-7890">
                                            <i class="fs-input-icon fa fa-phone-alt"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <div class="ls-inputicon-box"> 
                                            <input class="form-control" name="company_Email" type="email" value="<?php echo htmlspecialchars($admin['email']); ?>" placeholder="Devid@example.com">
                                            <i class="fs-input-icon fas fa-at"></i>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label>Date Of Birth</label>
                                        <div class="ls-inputicon-box">
                                            <input class="form-control" name="start_date" type="date" value="<?php echo htmlspecialchars($admin['dob']); ?>" placeholder="Date of Birth" required>
                                            <i class="fs-input-icon fa fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>Gender</label>
                            <div class="ls-inputicon-box">
                                <select name="gender" class="wt-select-box selectpicker" data-live-search="true" title="" id="gender" required>
                                    <option class="bs-title-option" value="">Select Gender</option>
                                    <option value="Male" <?php echo $admin['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?php echo $admin['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                                    <option value="Other" <?php echo $admin['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                                </select>
                                <i class="fs-input-icon fa fa-venus-mars"></i>
                            </div>
                        </div>
                    </div>

                                <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>Address</label>
                            <div class="ls-inputicon-box">
                                <input class="form-control" name="location" type="text" value="<?php echo htmlspecialchars($admin['address']); ?>" placeholder="Type Address" required>
                                <i class="fs-input-icon fa fa-map-marker"></i>
                            </div>
                        </div>
                    </div>
                                                                                            
                                <div class="col-lg-12 col-md-12">                                   
                                    <div class="text-center">
                                        <button type="submit" class="site-button">Save Changes</button>
                                    </div>
                                </div> 
                                                                    
                            
                        </div>
                                  
                    </div>
                </div>
                </form>                                                      
            </div>
    	</div>
        <script>
   document.querySelector("form").addEventListener("submit", function (event) {
    // Validate first name
    const firstName = document.querySelector("input[name='fname']").value.trim();
    if (firstName === "") {
        alert("First name is required.");
        event.preventDefault();
        return;
    }

    // Validate last name
    const lastName = document.querySelector("input[name='lname']").value.trim();
    if (lastName === "") {
        alert("Last name is required.");
        event.preventDefault();
        return;
    }

    // Ensure first name and last name are not the same
    if (firstName.toLowerCase() === lastName.toLowerCase()) {
        alert("First name and last name should be different.");
        event.preventDefault();
        return;
    }

    // Name regex: Only letters, may have one space, at least 3 characters
    const nameRegex = /^[A-Za-z]{3,}( [A-Za-z]{3,})?$/;
    if (!nameRegex.test(firstName) || !nameRegex.test(lastName)) {
        alert("Names should only contain letters, may have one space, and be at least 3 characters long.");
        event.preventDefault();
        return;
    }

    // Validate email
    const email = document.querySelector("input[name='company_Email']").value.trim();
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
    const phone = document.querySelector("input[name='company_phone']").value.trim();
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

    // Validate date of birth
    const dob = document.querySelector("input[name='start_date']").value.trim();
    if (dob === "") {
        alert("Date of Birth is required.");
        event.preventDefault();
        return;
    }

    // Validate gender selection
    const gender = document.querySelector("select[name='gender']").value;
    if (gender === "") {
        alert("Please select your gender.");
        event.preventDefault();
        return;
    }

    // Validate address
    const address = document.querySelector("input[name='location']").value.trim();
    if (address === "") {
        alert("Address is required.");
        event.preventDefault();
        return;
    }

    // Validate profile picture (PNG and JPEG only)
    const profilePic = document.querySelector("input[name='myfile']").files[0];
    if (profilePic) {
        const allowedImageTypes = ["image/jpeg", "image/png"];
        if (!allowedImageTypes.includes(profilePic.type)) {
            alert("Only PNG and JPG files are allowed for the profile picture.");
            event.preventDefault();
            return;
        }
    }
});
</script>
       <!--Delete Profile Popup-->
       <?php include 'Delete-Profile-admin.php';?>
        <?php include 'Logout_session.php';?>

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

<!-- Hide success message after 30 seconds -->

<!-- STYLE SWITCHER  ======= --> 
<div class="styleswitcher">
    
    <div class="styleswitcher-inner">
    
        <h6 class="switcher-title">Color Skin</h6>
        <ul class="color-skins">
            <li><a class="theme-skin skin-1" href="dash-my-profilea39b.php?theme=css/skin/skin-1"></a></li>
            <li><a class="theme-skin skin-2" href="dash-my-profile61e7.php?theme=css/skin/skin-2"></a></li>
            <li><a class="theme-skin skin-3" href="dash-my-profilecce5.php?theme=css/skin/skin-3"></a></li>
            <li><a class="theme-skin skin-4" href="dash-my-profile13f7.php?theme=css/skin/skin-4"></a></li>
            <li><a class="theme-skin skin-5" href="dash-my-profile19a6.php?theme=css/skin/skin-5"></a></li>
            <li><a class="theme-skin skin-6" href="dash-my-profilefe5c.php?theme=css/skin/skin-6"></a></li>
            <li><a class="theme-skin skin-7" href="dash-my-profileab47.php?theme=css/skin/skin-7"></a></li>
            <li><a class="theme-skin skin-8" href="dash-my-profile5f8d.php?theme=css/skin/skin-8"></a></li>
            <li><a class="theme-skin skin-9" href="dash-my-profile5663.php?theme=css/skin/skin-9"></a></li>
            <li><a class="theme-skin skin-10" href="dash-my-profile28ac.php?theme=css/skin/skin-10"></a></li>
            
        </ul>           
        
    </div>    
</div>
<!-- STYLE SWITCHER END ==== -->
</body>


</html>
