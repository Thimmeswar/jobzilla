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
    <title>TalentTap Solutions | Login</title>
    
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
     
      
        <!-- CONTENT START -->
        <div class="page-content">

           


            <!-- Login Section Start -->
            <div class="section-full site-bg-white">
                
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-8 col-lg-6 col-md-5 twm-log-reg-media-wrap">
                            <div class="twm-log-reg-media">
                                <div class="twm-l-media">
                                    <img src="images/login-bg.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-7">
                            <div class="twm-log-reg-form-wrap">
                                <div class="twm-log-reg-logo-head">
                                    <a href="http://talenttap.solutions/">
                                        <img src="images/logo-dark.png" alt="" class="logo">
                                    </a> 
                                </div>

                                <div class="twm-log-reg-inner">
                                    <div class="twm-log-reg-head">
<!--                                        <div class="twm-log-reg-logo">
                                            <span class="log-reg-form-title"> Admin Log In</span>
                                        </div>-->
                                    </div>
                                    <div class="twm-tabs-style-2">
                                        
                                        <ul class="nav nav-tabs" id="myTab2" role="tablist">

                                            <!--Login Candidate-->  
                                            <li class="nav-item">
                                            </li>
                                            <!--Login Employer-->
                                            <li class="nav-item">
                                            </li>
                                        
                                        </ul>
                                        
                                        <div class="tab-content" id="myTab2Content">
                                            <!--Login Candidate Content-->  
                                            <div class="tab-pane fade show active" id="twm-login-candidate">
                                                 <div class="login-container">
                                                     
                                                     
        <form name="myform" method="POST" action="admin_login.php" onsubmit="return validateForm()">
            <h2>Admin Login</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <input name="username" type="text"  class="form-control" placeholder="Username*">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <input name="password" type="password"  class="form-control" placeholder="Password*">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="twm-forgot-wrap">
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="Password4">
                                <label class="form-check-label rem-forgot" for="Password4">
                                    Remember me 
                                    <a href="javascript:;" class="site-text-primary">Forgot Password</a>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="site-button">Log in</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                           
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
            <!-- Login Section End -->
          
            
     
        </div>
        <!-- CONTENT END -->

        <!-- FOOTER START -->
       <?php include 'footer.php';?>
        <!-- FOOTER END -->

        <!-- BUTTON TOP START -->
		<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>


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
    function validateForm(){
        var Username = document.myform.username.value;
        var Password = document.myform.password.value;
        
        if (Username === ""){
            alert('Username is required');
            return false;
        }
        if (Password === ""){
            alert('Password is required');
            return false;
        }
        return true;  // Continue form submission if validation is successful
    }
    
</script>

<!-- STYLE SWITCHER  ======= --> 
<div class="styleswitcher">
    
    <div class="styleswitcher-inner">
    
        <h6 class="switcher-title">Color Skin</h6>
        <ul class="color-skins">
            <li><a class="theme-skin skin-1" href="logina39b.php?theme=css/skin/skin-1"></a></li>
            <li><a class="theme-skin skin-2" href="login61e7.php?theme=css/skin/skin-2"></a></li>
            <li><a class="theme-skin skin-3" href="logincce5.php?theme=css/skin/skin-3"></a></li>
            <li><a class="theme-skin skin-4" href="login13f7.php?theme=css/skin/skin-4"></a></li>
            <li><a class="theme-skin skin-5" href="login19a6.php?theme=css/skin/skin-5"></a></li>
            <li><a class="theme-skin skin-6" href="loginfe5c.php?theme=css/skin/skin-6"></a></li>
            <li><a class="theme-skin skin-7" href="loginab47.php?theme=css/skin/skin-7"></a></li>
            <li><a class="theme-skin skin-8" href="login5f8d.php?theme=css/skin/skin-8"></a></li>
            <li><a class="theme-skin skin-9" href="login5663.php?theme=css/skin/skin-9"></a></li>
            <li><a class="theme-skin skin-10" href="login28ac.php?theme=css/skin/skin-10"></a></li>
            
        </ul>           
        
    </div>    
</div>
<!-- STYLE SWITCHER END ==== -->



</body>


</html>
