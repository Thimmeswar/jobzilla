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
                    <h2>Change Password!</h2>
                    <div class="breadcrumbs"><a href="dashboard.php">Home</a><span>Change Password</span></div>
                </div>

                <!--Change Pawssword-->
               
                <div class="panel panel-default">
                    <div class="panel-heading wt-panel-heading p-a20">
                        <h4 class="panel-tittle m-a0">Change Password</h4>
                    </div>
                    <div class="panel-body wt-panel-body p-a20">
                        <form method="post" action="changepassword_check.php">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label>Old Password</label>
                    <div class="ls-inputicon-box"> 
                        <input class="form-control wt-form-control" name="old_password" type="password" placeholder="Old Password">
                        <i class="fs-input-icon fas fa-asterisk"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="form-group">
                    <label>New Password</label>
                    <div class="ls-inputicon-box"> 
                        <input class="form-control wt-form-control" name="new_password" type="password" placeholder="New Password">
                        <i class="fs-input-icon fas fa-asterisk"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Confirm New Password</label>
                    <div class="ls-inputicon-box"> 
                        <input class="form-control wt-form-control" name="confirm_new_password" type="password" placeholder="Confirm Password">
                        <i class="fs-input-icon fas fa-asterisk"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12">                                  
                <div class="text-left">
                    <button type="submit" class="site-button">Save Changes</button>
                </div>
            </div>                                         
        </div>
    </form>
</div>
            
                    </div>
                </div>

                                                     
            </div>

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
<div class="styleswitcher">
    
    <div class="styleswitcher-inner">
    
        <h6 class="switcher-title">Color Skin</h6>
        <ul class="color-skins">
            <li><a class="theme-skin skin-1" href="dash-change-passworda39b.php?theme=css/skin/skin-1"></a></li>
            <li><a class="theme-skin skin-2" href="dash-change-password61e7.php?theme=css/skin/skin-2"></a></li>
            <li><a class="theme-skin skin-3" href="dash-change-passwordcce5.php?theme=css/skin/skin-3"></a></li>
            <li><a class="theme-skin skin-4" href="dash-change-password13f7.php?theme=css/skin/skin-4"></a></li>
            <li><a class="theme-skin skin-5" href="dash-change-password19a6.php?theme=css/skin/skin-5"></a></li>
            <li><a class="theme-skin skin-6" href="dash-change-passwordfe5c.php?theme=css/skin/skin-6"></a></li>
            <li><a class="theme-skin skin-7" href="dash-change-passwordab47.php?theme=css/skin/skin-7"></a></li>
            <li><a class="theme-skin skin-8" href="dash-change-password5f8d.php?theme=css/skin/skin-8"></a></li>
            <li><a class="theme-skin skin-9" href="dash-change-password5663.php?theme=css/skin/skin-9"></a></li>
            <li><a class="theme-skin skin-10" href="dash-change-password28ac.php?theme=css/skin/skin-10"></a></li>
            
        </ul>           
        
    </div>    
</div>
<!-- STYLE SWITCHER END ==== -->

</body>



</html>
