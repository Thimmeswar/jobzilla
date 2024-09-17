
<?php
session_start();
// Database connection
include 'db.php';

// Fetch unique job positions
$job_title_query = "SELECT DISTINCT job_title FROM job_postings";
$job_title_result = $conn->query($job_title_query);

// Fetch unique job types
$job_types_query = "SELECT DISTINCT job_type FROM job_postings";
$job_types_result = $conn->query($job_types_query);

// Fetch unique locations
$locations_query = "SELECT DISTINCT location FROM job_postings";
$locations_result = $conn->query($locations_query);

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
    <title>TalentTap Solutions | Shape your future with us</title>
    
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


        <!--template buy button-->
<!--        <div class="buy-btn-wrap">
            <div class="buy-btn-list">
                <a href="javascript:;" id="all-demo-open" class="all-demos-view">All Demo</a>
                <a href="https://themeforest.net/item/job-board-html-template/38681133" class="buy-now-btn">
                    <i class="fas fa-cart-plus"></i>Buy NoW
                </a>
           </div>
        </div>-->
        <!--template All demo button-->
        <div class="twm-all-demo-list-wrap">
            <div class="twm-all-demo-inner scrollbar-macosx">
            <a href="javascript:;" class="all-demo-close"></a>
                <ul class="twm-all-demo-list">
                    <li><a href="index.html"><img src="images/home-14/all-demo-pages/1.jpg"></a></li>
                    <li><a href="index-2.html"><img src="images/home-14/all-demo-pages/2.jpg"></a></li>
                    <li><a href="index-3.html"><img src="images/home-14/all-demo-pages/3.jpg"></a></li>
                    <li><a href="index-4.html"><img src="images/home-14/all-demo-pages/4.jpg"></a></li>
                    <li><a href="index-5.html"><img src="images/home-14/all-demo-pages/5.jpg"></a></li>
                    <li><a href="index-6.html"><img src="images/home-14/all-demo-pages/6.jpg"></a></li>
                    <li><a href="index-7.html"><img src="images/home-14/all-demo-pages/7.jpg"></a></li>
                    <li><a href="index-8.html"><img src="images/home-14/all-demo-pages/8.jpg"></a></li>
                    <li><a href="index-9.html"><img src="images/home-14/all-demo-pages/9.jpg"></a></li>
                    <li><a href="index-10.html"><img src="images/home-14/all-demo-pages/10.jpg"></a></li>
                    <li><a href="index-11.html"><img src="images/home-14/all-demo-pages/11.jpg"></a></li>
                    <li><a href="index-12.html"><img src="images/home-14/all-demo-pages/12.jpg"></a></li>
                    <li><a href="index-13.html"><img src="images/home-14/all-demo-pages/13.jpg"></a></li>
                    <li><a href="index-14.html"><img src="images/home-14/all-demo-pages/14.jpg"></a></li>
                    <li><a href="index-15.html"><img src="images/home-14/all-demo-pages/15.jpg"></a></li>
                    <li><a href="index-16.html"><img src="images/home-14/all-demo-pages/16.jpg"></a></li>
                    <li><a href="index-17.html"><img src="images/home-14/all-demo-pages/17.jpg"></a></li>
                    <li><a href="index-18.html"><img src="images/home-14/all-demo-pages/18.jpg"></a></li>
                </ul>
            </div>                                                                
        </div>
     
        <!-- HEADER START -->
        <?php include 'header.php'; ?>
        <!-- HEADER END -->
        <!-- CONTENT START -->
        <div class="page-content">

            <!--Banner Start-->
            
            
            <div class="twm-home1-banner-section site-bg-gray bg-cover" style="background-image:url(images/main-slider/slider1/bg1.jpg); padding-top: 85px;">
               
                <div class="row">
                    
                    <!--Left Section-->
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="twm-bnr-left-section">
                            <div class="twm-bnr-title-small">We Have <span class="site-text-primary">208,000+</span> Live Jobs</div>
                            <div class="twm-bnr-title-large">Find the <span class="site-text-primary">job</span> that fits your life</div>
                            <div class="twm-bnr-discription">Type your keyword, then click search to find your perfect job.</div>

                            <div class="twm-bnr-search-bar">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <!--Title-->
                                        <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                            <label>What</label>
                                            <select class="wt-search-bar-select selectpicker"  data-live-search="true" title="" id="j-Job_Title" data-bv-field="size">
                                                <option disabled selected value="">Select Category</option>
                                                <?php while ($row = $job_title_result->fetch_assoc()): ?>
                                                        <option value="<?php echo htmlspecialchars($row['job_title']); ?>"><?php echo htmlspecialchars($row['job_title']); ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <!--All Category-->
                                        <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                            <label>Type</label>
                                            <select class="wt-search-bar-select selectpicker"  data-live-search="true" title="" id="j-All_Category" data-bv-field="size">
                                                <option disabled selected value="">Select Job Type</option>
                                                <?php while ($row = $job_types_result->fetch_assoc()): ?>
                                                        <option value="<?php echo htmlspecialchars($row['job_type']); ?>"><?php echo htmlspecialchars($row['job_type']); ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <!--Location-->
                                        <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                            <select class="wt-select-bar-large selectpicker"  data-live-search="true" data-bv-field="size" name="location" id="location">
                                                    <option disabled selected value="">Location</option>
                                                    <?php while ($row = $locations_result->fetch_assoc()): ?>
                                                        <option value="<?php echo htmlspecialchars($row['location']); ?>"><?php echo htmlspecialchars($row['location']); ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                        </div>

                                        <!--Find job btn-->
                                        <div class="form-group col-xl-3 col-lg-6 col-md-6">
                                            <button type="button" class="site-button" onclick="findJob()">Find Job</button>
                                        </div>

                                    </div>
                                </form>
                                        <script>
                                             function findJob() {
                                             window.location.href = 'Jobs.php';
                                            }
                                        </script>
                            </div>

                            <div class="twm-bnr-popular-search">
                                <span class="twm-title">Popular Searches:</span>
                                <a href="Jobs.php">Developer</a> ,
                                <a href="Jobs.php">Designer</a> ,
                                <a href="Jobs.php">Architect</a> ,
                                <a href="Jobs.php">Engineer</a> ...
                            </div>
                        </div>
                    </div>

                    <!--right Section-->
                    <div class="col-xl-6 col-lg-6 col-md-12 twm-bnr-right-section">
                        <div class="twm-bnr-right-content">

                            <div class="twm-img-bg-circle-area">
                                <div class="twm-img-bg-circle1 rotate-center"><span></span></div>
                                <div class="twm-img-bg-circle2 rotate-center-reverse"><span></span></div>
                                <div class="twm-img-bg-circle3"><span></span></div>
                            </div>

                            <div class="twm-bnr-right-carousel">
                                <div class="owl-carousel twm-h1-bnr-carousal">
                                    <div class="item">
                                      <div class="slide-img">
                                        <img src="images/main-slider/slider1/r-img1.png" alt="#">
                                      </div>
                                    </div>
                                    <div class="item">
                                      <div class="slide-img">
                                        <div class="slide-img">
                                            <img src="images/main-slider/slider1/r-img2.png" alt="#">
                                          </div>
                                      </div>
                                    </div>
                                </div>

                                <div class="twm-bnr-blocks-position-wrap">
                                    <!--icon-block-1-->
                                    <div class="twm-bnr-blocks twm-bnr-blocks-position-1">
                                        <div class="twm-icon">
                                            <img src="images/main-slider/slider1/icon-1.png" alt="">
                                        </div>
                                        <div class="twm-content">
                                            <div class="tw-count-number text-clr-sky">
                                                <span class="counter">12</span>K+
                                            </div>
                                            <p class="icon-content-info">Companies Jobs</p>
                                        </div>
                                    </div>

                                    <!--icon-block-2-->
                                    <div class="twm-bnr-blocks twm-bnr-blocks-position-2">
                                        <div class="twm-icon">
                                            <img src="images/main-slider/slider1/icon-2.png" alt="">
                                        </div>
                                        <div class="twm-content">
                                            <div class="tw-count-number text-clr-pink">
                                                <span class="counter">98</span> +
                                            </div>
                                            <p class="icon-content-info">Job For Countries </p>
                                        </div>
                                    </div>

                                    <!--icon-block-3-->
                                    <div class="twm-bnr-blocks-3 twm-bnr-blocks-position-3">
                                        <div class="twm-pics">
                                            <span><img src="images/main-slider/slider1/user/u-1.jpg" alt=""></span>
                                            <span><img src="images/main-slider/slider1/user/u-2.jpg" alt=""></span>
                                            <span><img src="images/main-slider/slider1/user/u-3.jpg" alt=""></span>
                                            <span><img src="images/main-slider/slider1/user/u-4.jpg" alt=""></span>
                                            <span><img src="images/main-slider/slider1/user/u-5.jpg" alt=""></span>
                                            <span><img src="images/main-slider/slider1/user/u-6.jpg" alt=""></span>
                                        </div>
                                        <div class="twm-content">
                                            <div class="tw-count-number text-clr-green">
                                                <span class="counter">3</span>K+
                                            </div>
                                            <p class="icon-content-info">Jobs Done</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            

                            <!--Samll Ring Left-->
                            <div class="twm-small-ring-l slide-top-animation"></div>
                            <div class="twm-small-ring-2 slide-top-animation"></div>

                            

                        </div>
                    </div>

                </div>
                <div class="twm-gradient-text">
                    Jobs
                </div>
            </div>
            <!--Banner End-->

            <!-- HOW IT WORK SECTION START -->
            <div class="section-full p-t120 p-b90 site-bg-white twm-how-it-work-area" style="margin-top: -30px;">
                        
                <div class="container">
                    <div class="twm-about-1-section-wrap">
                        <div class="row">
                            
                            <div class="col-lg-6 col-md-12">
                                <div class="twm-about-1-section">
                                    <div class="twm-media">
                                        <img src="images/home-11/about-pic1.png" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="twm-about-1-section-right">
                                    <!-- TITLE START-->
                                        <div class="section-head left wt-small-separator-outer">
                                            <div class="wt-small-separator site-text-primary">
                                                <div>About Jobzilla</div>                                
                                            </div>
                                            <h2 class="wt-title">Millions of jobs. Find the
                                                one that’s right for you.</h2>
                                            <p>Create an account for job information that you wanted, get notification
                                            everyday and you can easily apply directly to the company you want
                                            create and account now for free.</p>
                                            
                                        </div>
                                    <!-- TITLE END-->
                                        <ul class="description-list">
                                            <li>
                                                <i class="feather-check"></i>
                                                Full lifetime access
                                            </li>
                                            <li>
                                                <i class="feather-check"></i>
                                                20+ downloadable resources
                                            </li>
                                            <li>
                                                <i class="feather-check"></i>
                                                Certificate of completion
                                            </li>
                                            <li>
                                                <i class="feather-check"></i>
                                                Free Trial 7 Days
                                            </li>
                                        </ul>                  
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- TITLE START-->
                    <div class="section-head center wt-small-separator-outer" style="margin-top: -30px;">
                        <div class="wt-small-separator site-text-primary">
                           <div>Working Process</div>                                
                        </div>
                        <h2 class="wt-title">How It Works</h2>
                        
                    </div>                  
                    <!-- TITLE END-->

                    <div class="twm-how-it-work-section">
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="twm-w-process-steps">
                                    <span class="twm-large-number">01</span>
                                    <div class="twm-w-pro-top bg-clr-sky">
                                        <div class="twm-media">
                                            <span><img src="images/work-process/icon1.png" alt="icon1"></span>
                                        </div>
                                        <h4 class="twm-title">Register<br>Your Account</h4>
                                    </div>
                                    <p>You need to create an account to find the best and preferred job.</p>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="twm-w-process-steps">
                                    <span class="twm-large-number">02</span>
                                    <div class="twm-w-pro-top bg-clr-pink">
                                        <div class="twm-media">
                                            <span><img src="images/work-process/icon2.png" alt="icon1"></span>
                                        </div>
                                        <h4 class="twm-title">Apply <br>
                                            For Dream Job</h4>
                                    </div>
                                    <p>You need to create an account to find the best and preferred job.</p>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="twm-w-process-steps">
                                    <span class="twm-large-number">03</span>
                                    <div class="twm-w-pro-top bg-clr-green">
                                        <div class="twm-media">
                                            <span><img src="images/work-process/icon3.png" alt="icon1"></span>
                                        </div>
                                        <h4 class="twm-title">Upload <br>Your Resume</h4>
                                    </div>
                                    <p>You need to create an account to find the best and preferred job.</p>
                                </div>
                            </div>

                        </div>
                    </div>                  
                </div>

            </div>   
            <!-- HOW IT WORK SECTION END -->

             <div class="section-full p-t120 p-b90 site-bg-gray twm-job-categories-area2" style="margin-top: -50px; margin-bottom: -40px;">
                <!-- TITLE START-->
                <div class="section-head center wt-small-separator-outer" style="margin-top: -60px;">
                    <div class="wt-small-separator site-text-primary">
                       <div>Jobs by Categories</div>                                
                    </div>
                    <h2 class="wt-title">Choose Your Desire Category</h2>
                </div>                  
                <!-- TITLE END--> 
                
                <div class="container" style="margin-bottom: -30px;">

                    <div class="twm-job-categories-section-2">
                       
                        <div class="job-categories-style1 m-b30">
                            <div class="row">
                            
                                <!-- COLUMNS 1 --> 
                                <div class="col-lg-3 col-md-6">
                                    <div class="job-categories-block-2 m-b30">
                                        <div class="twm-media">
                                            <div class="flaticon-dashboard"></div>
                                        </div>                                   
                                        <div class="twm-content">
                                            <div class="twm-jobs-available">9,185 Jobs</div>
                                            <a href="Jobs.php">Business Development</a>
                                        </div>                               
                                    </div>
                                </div>

                                <!-- COLUMNS 2 --> 
                                <div class="col-lg-3 col-md-6">
                                    <div class="job-categories-block-2 m-b30">
                                        <div class="twm-media">
                                            <div class="flaticon-project-management"></div>
                                        </div>                                   
                                        <div class="twm-content">
                                            <div class="twm-jobs-available">3,205 Jobs</div>
                                            <a href="Jobs.php">Project Management</a>
                                        </div>                               
                                    </div>
                                </div>
                                
                                <!-- COLUMNS 3 --> 
                                <div class="col-lg-3 col-md-6">
                                    <div class="job-categories-block-2 m-b30">
                                        <div class="twm-media">
                                            <div class="flaticon-note"></div>
                                        </div>                                   
                                        <div class="twm-content">
                                            <div class="twm-jobs-available">2,100 Jobs</div>
                                            <a href="Jobs.php">Content Writer</a>
                                        </div>                               
                                    </div>
                                </div>
                                
                                <!-- COLUMNS 4 --> 
                                <div class="col-lg-3 col-md-6">
                                    <div class="job-categories-block-2 m-b30">
                                        <div class="twm-media">
                                            <div class="flaticon-customer-support"></div>
                                        </div>                                   
                                        <div class="twm-content">
                                            <div class="twm-jobs-available">1,500 Jobs</div>
                                            <a href="Jobs.php">Costomer Services</a>
                                        </div>                               
                                    </div>
                                </div>
                                
                                <!-- COLUMNS 5 --> 
                                <div class="col-lg-3 col-md-6">
                                    <div class="job-categories-block-2 m-b30">
                                        <div class="twm-media">
                                            <div class="flaticon-bars"></div>
                                        </div>                                   
                                        <div class="twm-content">
                                            <div class="twm-jobs-available">9,185 Jobs</div>
                                            <a href="Jobs.php">Finance</a>
                                        </div>                               
                                    </div>
                                </div>

                                <!-- COLUMNS 6 --> 
                                <div class="col-lg-3 col-md-6">
                                    <div class="job-categories-block-2 m-b30">
                                        <div class="twm-media">
                                            <div class="flaticon-user"></div>
                                        </div>                                   
                                        <div class="twm-content">
                                            <div class="twm-jobs-available">3,205 Jobs</div>
                                            <a href="Jobs.php">Marketing</a>
                                        </div>                               
                                    </div>
                                </div>
                                
                                <!-- COLUMNS 7 --> 
                                <div class="col-lg-3 col-md-6">
                                    <div class="job-categories-block-2 m-b30">
                                        <div class="twm-media">
                                            <div class="flaticon-computer"></div>
                                        </div>                                   
                                        <div class="twm-content">
                                            <div class="twm-jobs-available">2,100 Jobs</div>
                                            <a href="Jobs.php">Design & Art</a>
                                        </div>                               
                                    </div>
                                </div>
                                
                                <!-- COLUMNS 8 --> 
                                <div class="col-lg-3 col-md-6">
                                    <div class="job-categories-block-2 m-b30">
                                        <div class="twm-media">
                                            <div class="flaticon-coding"></div>
                                        </div>                                   
                                        <div class="twm-content">
                                            <div class="twm-jobs-available">1,500 Jobs</div>
                                            <a href="Jobs.php">Web Development</a>
                                        </div>                               
                                    </div>
                                </div>                                         

                            </div>
                        </div>

                        <div class="text-center job-categories-btn">
                            <a href="Jobs.php" class=" site-button">All Categories</a>
                        </div>

                    </div>

                </div>

            </div>                           
            <!-- EXPLORE NEW LIFE START -->
            <?php include 'Update_resume.php';?>
            <!-- EXPLORE NEW LIFE END -->

            <!-- TOP COMPANIES START -->
            <div class="section-full p-t120  site-bg-white twm-companies-wrap" style="margin-top: -40px;">
                  
                    <!-- TITLE START-->
                    <div class="section-head center wt-small-separator-outer" style="margin-top: -60px;">
                        <div class="wt-small-separator site-text-primary">
                           <div>Top Companies</div>                                
                        </div>
                        <h2 class="wt-title">Get hired in top companies</h2>
                    </div>                  
                    <!-- TITLE END-->

                    <div class="container">
                        <div class="section-content">
                            <div class="owl-carousel home-client-carousel2 owl-btn-vertical-center">
                            
                                <div class="item">
                                    <div class="ow-client-logo">
                                        <div class="client-logo client-logo-media">
                                        <a href=""><img src="images/client-logo/w1.png" alt=""></a></div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="ow-client-logo">
                                        <div class="client-logo client-logo-media">
                                        <a href=""><img src="images/client-logo/w2.png" alt=""></a></div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="ow-client-logo">
                                        <div class="client-logo client-logo-media">
                                        <a href=""><img src="images/client-logo/w3.png" alt=""></a></div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="ow-client-logo">
                                        <div class="client-logo client-logo-media">
                                        <a href=""><img src="images/client-logo/w4.png" alt=""></a></div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="ow-client-logo">
                                        <div class="client-logo client-logo-media">
                                        <a href=""><img src="images/client-logo/w5.png" alt=""></a></div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="ow-client-logo">
                                        <div class="client-logo client-logo-media">
                                        <a href=""><img src="images/client-logo/w6.png" alt=""></a></div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="ow-client-logo">
                                        <div class="client-logo client-logo-media">
                                        <a href=""><img src="images/client-logo/w1.png" alt=""></a></div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="ow-client-logo">
                                        <div class="client-logo client-logo-media">
                                        <a href=""><img src="images/client-logo/w2.png" alt=""></a></div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="ow-client-logo">
                                        <div class="client-logo client-logo-media">
                                        <a href=""><img src="images/client-logo/w3.png" alt=""></a></div>
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="ow-client-logo">
                                        <div class="client-logo client-logo-media">
                                        <a href=""><img src="images/client-logo/w5.png" alt=""></a></div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="twm-company-approch-outer">
                        <div class="twm-company-approch">
                            <div class="row">

                                <!--block 1-->
                                <div class="col-lg-4 col-md-12">
                                    <div class="counter-outer-two">
                                        <div class="icon-content">
                                            <div class="tw-count-number text-clr-sky">
                                                <span class="counter">5</span>M+</div>
                                            <p class="icon-content-info">Million daily active users</p>
                                        </div>
                                    </div>
                                </div>

                                <!--block 2-->
                                <div class="col-lg-4 col-md-12">
                                    <div class="counter-outer-two">
                                        <div class="icon-content">
                                            <div class="tw-count-number text-clr-pink">
                                                <span class="counter">9</span>K+</div>
                                            <p class="icon-content-info">Open job positions</p>
                                        </div>
                                    </div>
                                </div>

                                <!--block 3-->
                                <div class="col-lg-4 col-md-12">
                                    <div class="counter-outer-two">
                                        <div class="icon-content">
                                            <div class="tw-count-number text-clr-green">
                                                <span class="counter">2</span>M+</div>
                                            <p class="icon-content-info">Million stories shared</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>                
            </div>
            <!-- TOP COMPANIES END -->            
             <div class="section-full p-t120 p-b90 site-bg-gray twm-bg-ring-wrap2">
                
                <div class="container" style="margin-bottom: -10px;">

                    <div class="wt-separator-two-part" style="margin-top: -70px;">
                        <div class="row wt-separator-two-part-row">
                            <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-left">
                                <!-- TITLE START-->
                                <div class="section-head left wt-small-separator-outer">
                                    <div class="wt-small-separator site-text-primary">
                                    <div>All Jobs Post</div>                                
                                    </div>
                                    <h2 class="wt-title">Find Your Career You Deserve it</h2>
                                </div>                  
                                <!-- TITLE END-->
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 wt-separator-two-part-right text-right">
                                <a href="Jobs.php" class=" site-button">Browse All Jobs</a>
                            </div>
                        </div>
                    </div>
                   
                    <div class="section-content">
                       <div class="twm-jobs-grid-wrap">
                           <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="twm-jobs-grid-style1  m-b30">
                                        <div class="twm-media">
                                            <img src="images/jobs-company/pic1.jpg" alt="#">
                                        </div>
                                        <span class="twm-job-post-duration">1 days ago</span>
                                        <div class="twm-jobs-category green"><span class="twm-bg-green">New</span></div>
                                        <div class="twm-mid-content">
                                            <a href="Jobs.php" class="twm-job-title">
                                                <h4>Senior Web Designer , Developer</h4>
                                            </a>
                                            <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                            <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                        </div>
                                        <div class="twm-right-content">
                                            
                                            <div class="twm-jobs-amount">₹20000 - ₹25000 <span>/ Month</span></div>
                                            <a href="Jobs.php" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="twm-jobs-grid-style1 m-b30">
                                        <div class="twm-media">
                                            <img src="images/jobs-company/pic2.jpg" alt="#">
                                        </div>
                                        <span class="twm-job-post-duration">15 days ago</span>
                                        <div class="twm-jobs-category green"><span class="twm-bg-brown">Intership</span></div>
                                        <div class="twm-mid-content">
                                            <a href="Jobs.php" class="twm-job-title">
                                                <h4>Senior Rolling Stock Technician</h4>
                                            </a>
                                            <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                            <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                        </div>
                                        <div class="twm-right-content">
                                            <div class="twm-jobs-amount">₹700 <span>/ Hour</span></div>
                                            <a href="Jobs.php" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="twm-jobs-grid-style1  m-b30">
                                        <div class="twm-media">
                                            <img src="images/jobs-company/pic3.jpg" alt="#">
                                        </div>
                                        <span class="twm-job-post-duration">6 Month ago</span>
                                        <div class="twm-jobs-category green"><span class="twm-bg-purple">Fulltime</span></div>
                                        <div class="twm-mid-content">
                                            <a href="Jobs.php" class="twm-job-title">
                                                <h4 class="twm-job-title">IT Department Manager</h4>
                                            </a>
                                            <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                            <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                        </div>
                                        <div class="twm-right-content">
                                            
                                            <div class="twm-jobs-amount">₹20000 - ₹25000 <span>/ Month</span></div>
                                            <a href="Jobs.php" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="twm-jobs-grid-style1 m-b30">
                                        <div class="twm-media">
                                            <img src="images/jobs-company/pic4.jpg" alt="#">
                                        </div>
                                        <span class="twm-job-post-duration">2 days ago</span>
                                        <div class="twm-jobs-category green"><span class="twm-bg-sky">Freelancer</span></div>
                                        <div class="twm-mid-content">
                                            <a href="Jobs.php" class="twm-job-title">
                                                <h4 class="twm-job-title">Art Production Specialist</h4>
                                            </a>
                                            <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                            <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                        </div>
                                        <div class="twm-right-content">
                                            
                                            <div class="twm-jobs-amount">₹15000 - ₹18000 <span>/ Month</span></div>
                                            <a href="Jobs.php" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="twm-jobs-grid-style1  m-b30">
                                        <div class="twm-media">
                                            <img src="images/jobs-company/pic5.jpg" alt="#">
                                        </div>
                                        <span class="twm-job-post-duration">1 days ago</span>
                                        <div class="twm-jobs-category green"><span class="twm-bg-golden">Temporary</span></div>
                                        <div class="twm-mid-content">
                                            <a href="Jobs.php" class="twm-job-title">
                                                <h4 class="twm-job-title">Recreation & Fitness Worker</h4>
                                            </a>
                                            <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                            <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                        </div>
                                        <div class="twm-right-content">
                                            <div class="twm-jobs-amount">₹5000 - ₹10000 <span>/ Month</span></div>
                                            <a href="Jobs.php" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="twm-jobs-grid-style1 m-b30">
                                        <div class="twm-media">
                                            <img src="images/jobs-company/pic1.jpg" alt="#">
                                        </div>
                                        <span class="twm-job-post-duration">1 days ago</span>
                                        <div class="twm-jobs-category green"><span class="twm-bg-green">New</span></div>
                                        <div class="twm-mid-content">
                                            <a href="Jobs.php" class="twm-job-title">
                                                <h4>Senior Web Designer , Developer</h4>
                                            </a>
                                            <p class="twm-job-address">1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                            <a href="https://themeforest.net/user/thewebmax/portfolio" class="twm-job-websites site-text-primary">https://thewebmax.com</a>
                                        </div>
                                        <div class="twm-right-content">
                                            
                                            <div class="twm-jobs-amount">₹200 <span>/ Hour</span></div>
                                            <a href="Jobs.php" class="twm-jobs-browse site-text-primary">Browse Job</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                           
                       </div>
                    </div>
                   
                </div>
            </div>
           
            <!-- OUR BLOG START -->
            <div class="section-full p-t120 p-b90 site-bg-white" style="margin-top: -90px; margin-bottom: -70px;">
                <div class="container">
                   
                    <!-- TITLE START-->
                    <div class="section-head center wt-small-separator-outer">
                        <div class="wt-small-separator site-text-primary">
                           <div>News and Blogs</div>                                
                        </div>
                        <h2 class="wt-title">Get the latest news,
                            updates and tips</h2>
                        
                    </div>                  
                    <!-- TITLE END-->


                    <div class="section-content">
                        <div class="twm-blog-post-h5-wrap">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <!--Block one-->
                                    <div class="blog-post twm-blog-post-h5-outer">
                                        <div class="wt-post-media">
                                            <a href="Blog-Details.php"><img src="images/home-5/blog/pic1.jpg" alt=""></a>
                                        </div>                                    
                                        <div class="wt-post-info">
                                            <div class="post-author">
                                                <div class="post-author-pic">
                                                    <div class="p-a-pic"><img src="images/home-5/blog-avtar/pic1.jpg" alt=""></div>
                                                    <div class="p-a-info">
                                                        <a href="Blog-Details.php">Ralph Johnson</a> 
                                                        <p>12 January</p>
                                                    </div>
                                                </div>
                                                <div class="post-categories">
                                                    <a href="blog-single.html">Events</a>
                                                </div> 
                                            </div>
                                            <div class="wt-post-title ">
                                                <h4 class="post-title">
                                                    <a href="Blog-Details.php">How to convince recruiters and get your dream job</a>
                                                </h4>
                                            </div>
                                            <div class="wt-post-text ">
                                                <p>
                                                    New chip traps clusters of migrating tumor cells asperiortenetur, blanditiis odit.
                                                </p>
                                            </div>
                                            <div class="wt-post-readmore ">
                                                <a href="Blog-Details.php" class="site-button-link site-text-primary">Read More</a>
                                            </div>                                        
                                        </div>
                                    </div>                               
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <!--Block two-->
                                    <div class="blog-post twm-blog-post-h5-outer">
                                        <div class="wt-post-media">
                                            <a href="Blog-Details.php"><img src="images/home-5/blog/pic2.jpg" alt=""></a>
                                        </div>                                    
                                        <div class="wt-post-info">
                                            <div class="post-author">
                                                <div class="post-author-pic">
                                                    <div class="p-a-pic"><img src="images/home-5/blog-avtar/pic2.jpg" alt=""></div>
                                                    <div class="p-a-info">
                                                        <a href="Blog-Details.php">Christina Fischer</a> 
                                                        <p>12 January</p>
                                                    </div>
                                                </div>
                                                <div class="post-categories">
                                                    <a href="Blog-Details.php">Events</a>
                                                </div> 
                                            </div>
                                            <div class="wt-post-title ">
                                                <h4 class="post-title">
                                                    <a href="Blog-Details.php">How to convince recruiters and get your dream job</a>
                                                </h4>
                                            </div>
                                            <div class="wt-post-text ">
                                                <p>
                                                    New chip traps clusters of migrating tumor cells asperiortenetur, blanditiis odit.
                                                </p>
                                            </div>
                                            <div class="wt-post-readmore ">
                                                <a href="Blog-Details.php" class="site-button-link site-text-primary">Read More</a>
                                            </div>                                        
                                        </div>                                
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-md-6">
                                    <!--Block three-->
                                    <div class="blog-post twm-blog-post-h5-outer">
                                        <div class="wt-post-media">
                                            <a href="Blog-Details.php"><img src="images/home-5/blog/pic3.jpg" alt=""></a>
                                        </div>                                    
                                        <div class="wt-post-info">
                                            <div class="post-author">
                                                <div class="post-author-pic">
                                                    <div class="p-a-pic"><img src="images/home-5/blog-avtar/pic3.jpg" alt=""></div>
                                                    <div class="p-a-info">
                                                        <a href="Blog-Details.php">Peter Hawkins</a> 
                                                        <p>12 January</p>
                                                    </div>
                                                </div>
                                                <div class="post-categories">
                                                    <a href="Blog-Details.php">Events</a>
                                                </div> 
                                            </div>
                                            <div class="wt-post-title ">
                                                <h4 class="post-title">
                                                    <a href="Blog-Details.php">How to convince recruiters and get your dream job</a>
                                                </h4>
                                            </div>
                                            <div class="wt-post-text ">
                                                <p>
                                                    New chip traps clusters of migrating tumor cells asperiortenetur, blanditiis odit.
                                                </p>
                                            </div>
                                            <div class="wt-post-readmore ">
                                                <a href="Blog-Details.php" class="site-button-link site-text-primary">Read More</a>
                                            </div>                                        
                                        </div>                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
      <!-- OUR BLOG END -->
      <!-- TESTIMONIAL SECTION START -->
            <?php include 'Testimonials.php';?>
            <!-- TESTIMONIAL SECTION END -->
        </div>
        <!-- CONTENT END -->

        <!-- FOOTER START -->
        <?php include 'footer.php';?>
        <!-- FOOTER END -->
        <!-- BUTTON TOP START -->
		<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

        <!--Model Popup Section Start-->
            <!--Signup popup -->
            

 <!-- Signup popup -->

<div class="modal fade twm-sign-up" id="sign_up_popup" aria-hidden="true" aria-labelledby="sign_up_popupLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="sign_up_popupLabel">Sign Up</h2>
                <p>Sign Up and get access to all the features of Jobzilla</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="twm-tabs-style-2">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <!-- Signup Candidate -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active mb-4" data-bs-toggle="tab" data-bs-target="#sign-candidate" type="button"><i class="fas fa-user-tie"></i>Candidate</button>
                        </li>
                        <!-- Signup Employer -->
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sign-employer" type="button"><i class="fas fa-building"></i>Employer</button>
                        </li>
                    </ul> -->
                    <div class="tab-content" id="myTabContent">
                        <!-- Signup Candidate Content -->

                       <div class="tab-pane fade show active" id="sign-candidate">

                           <form id="candidateForm" method="POST" action="signup_candidate.php" enctype="multipart/form-data" onsubmit="return candidateForm()">
                               <div class="row">
                                   <div class="col-lg-12">
                                       <div class="form-group mb-3">
                                           <select id="candidateprefix" name="prefix" class="form-control">
                                               <option value="" disabled selected>Select prefix*</option>
                                               <option value="Mr">Mr</option>
                                               <option value="Mrs">Mrs</option>
                                               <option value="Miss">Miss</option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-lg-12">
                                       <div class="form-group mb-3">
                                           <input id="candidatefirstname" name="firstname" type="text" class="form-control" placeholder="firstname*">
                                       </div>
                                   </div>
                                   <div class="col-lg-12">
                                       <div class="form-group mb-3">
                                           <input id="candidatelastname" name="lastname" type="text" class="form-control" placeholder="lastname*">
                                       </div>
                                   </div>
                                   <div class="col-lg-12">
                                       <div class="form-group mb-3">
                                           <input id="candidateEmail" name="email_id" type="email" class="form-control" placeholder="Email*">
                                       </div>
                                   </div>
                                   
                                   <div class="col-lg-12">

    <div class="form-group mb-3">
        <select id="candidatecountry" name="country" class="form-control" onchange="updateCountryCode()">
            <option value="" disabled selected>Select country*</option>
            <option value="India">India</option>
            <option value="USA">USA</option>
            <option value="UK">UK</option>
            <option value="Australia">Australia</option>
            
        </select>
    </div>
</div>

<div class="col-lg-12">
    <div class="form-group mb-3">
        <select id="candidatecountrycode" name="countrycode" class="form-control" readonly>
            <option value="+91">+91 (India)</option>
            <option value="+1">+1 (USA)</option>
            <option value="+44">+44 (UK)</option>
            <option value="+61">+61 (Australia)</option>
        </select>
    </div>
</div>

<script>
function updateCountryCode() {
    var country = document.getElementById("candidatecountry").value;
    var countryCodeSelect = document.getElementById("candidatecountrycode");

    if (country === "India") {
        countryCodeSelect.value = "+91";
    } else if (country === "USA") {
        countryCodeSelect.value = "+1";
    } else if (country === "UK") {
        countryCodeSelect.value = "+44";
    } else if (country === "Australia") {
        countryCodeSelect.value = "+61";
    } else {
        countryCodeSelect.value = "";
    }
}
</script>

                                   <div class="col-lg-12">
                                       <div class="form-group mb-3">
                                           <input id="candidatephone" name="phone" type="text" class="form-control" placeholder="Phone*">
                                       </div>
                                   </div>
                                   <div class="col-lg-12">
                                       <div class="form-group mb-3">
                                           <input id="candidatepassword" name="password" type="password" class="form-control" placeholder="Password*">
                                       </div>
                                   </div>
                                   <div class="col-lg-12">
                                       <div class="form-group mb-3">
                                           <input id="candidateconfirmpassword" name="confirmpassword" type="password" class="form-control" placeholder="confirmpassword*">
                                       </div>
                                   </div>
                                   <div class="col-lg-12">
                                       <div class="form-group mb-3">
                                           <div class="form-check">
                                               <input type="checkbox" class="form-check-input" id="agree1">
                                               <label class="form-check-label" for="agree1">I agree to the <a href="javascript:;">Terms and conditions</a></label>
                                               <p>Already registered?
                                                   <button type="button" class="twm-backto-login" data-bs-target="#sign_up_popup2" data-bs-toggle="modal" data-bs-dismiss="modal">Log in here</button>
                                               </p>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col-md-12">
                                       <button type="submit" class="site-button">Sign Up</button>
                                   </div>
                                               <div class="modal-footer">
                <span class="modal-f-title">Login or Sign up with</span>
                <ul class="twm-modal-social">
                    <li><a  href="https://www.facebook.com/" target="_blank" class="facebook-clr"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://x.com/" target="_blank" class="twitter-clr"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://www.linkedin.com/" target="_blank" class="linkedin-clr"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="https://www.instagram.com/" target="_blank" class="google-clr"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
                               </div>
                           </form>
</div>
<script>
        function candidateForm() {
            const emailPattern = /^[^\s@]+@gmail\.com$/;
            const phonePattern = /^[6789]\d{9}$/;
            const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_])(?=.*[a-z]).{8,}$/;

            // Validate prefix
            const prefix = document.getElementById('candidateprefix').value;
            if (prefix === '') {
                alert('Prefix is required.');
                return false;
            }

            // Validate firstname
            const firstname = document.getElementById('candidatefirstname').value.trim();
            if (firstname === '') {
                alert('Firstname is required.');
                return false;
            } else if (!/^[a-zA-Z]+$/.test(firstname)) {
                alert('Firstname should only contain alphabets.');
                return false;
            } else if (firstname.length < 3) {
                alert('Firstname should contain at least 3 alphabets.');
                return false;
            }

            // Validate lastname
            const lastname = document.getElementById('candidatelastname').value.trim();
            if (lastname === '') {
                alert('Lastname is required.');
                return false;
            } else if (!/^[a-zA-Z]+$/.test(lastname)) {
                alert('Lastname should only contain alphabets.');
                return false;
            } else if (lastname.length < 3) {
                alert('Lastname should contain at least 3 alphabets.');
                return false;
            } else if (firstname === lastname) {
                alert('Firstname and Lastname cannot be the same.');
                return false;
            }

            // Validate email
            const email = document.getElementById('candidateEmail').value.trim();
            if (!emailPattern.test(email)) {
                alert('Email must end with @gmail.com.');
                return false;
            }

            // Validate country
            const country = document.getElementById('candidatecountry').value.trim();
            if (country === '') {
                alert('select country.');
                return false;
            }

            // Validate country code
            const countrycode = document.getElementById('candidatecountrycode').value;
            if (countrycode === '') {
                alert('Country code is required.');
                return false;
            }
             

            // Validate phone
            const phone = document.getElementById('candidatephone').value.trim();
            if (!phonePattern.test(phone)) {
                alert('Phone number must start with 6, 7, 8, or 9 and be exactly 10 digits.');
                return false;
            }

            // Validate password
            const password = document.getElementById('candidatepassword').value;
            if (!passwordPattern.test(password)) {
                alert('Password must contain at least one capital letter, one number, one special character, and one alphabet.');
                return false;
            }

            // Validate confirm password
            const confirmpassword = document.getElementById('candidateconfirmpassword').value;
            if (confirmpassword === '') {
                alert('Confirm password is required.');
                return false;
            } else if (password !== confirmpassword) {
                alert('Passwords do not match.');
                return false;
            }

            // Validate terms and conditions checkbox
            const agreeCheckbox = document.getElementById('agree1');
            if (!agreeCheckbox.checked) {
                alert('You must agree to the terms and conditions.');
                return false;
            }
 
        }
    </script>

                        <!-- Signup Employer Content -->
                       <div class="tab-pane fade" id="sign-employer">
    <form id="employerForm" method="POST" action="signup_employer.php">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group mb-3">
                    <input id="employerUsername" name="username" type="text" class="form-control" placeholder="Username*">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group mb-3">
                    <input id="employerEmail" name="email" type="email" class="form-control" placeholder="Email*">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group mb-3">
                    <input id="employerPassword" name="password" type="password" class="form-control" placeholder="Password*">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group mb-3">
                    <input id="employerPhone" name="phone" type="text" class="form-control" placeholder="Phone*">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="agree2">
                        <label class="form-check-label" for="agree2">I agree to the <a href="javascript:;">Terms and conditions</a></label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <button type="submit" class="site-button">Register</button>
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


 


<!-- Login popup -->
<div class="modal fade twm-sign-up" id="sign_up_popup2" aria-hidden="true" aria-labelledby="sign_up_popupLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="sign_up_popupLabel2">Login</h2>
                <p>Login and get access to all the features of Jobzilla</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="twm-tabs-style-2">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <!-- Login Candidate -->
                        <li class="nav-item">
                            <button class="nav-link active mb-4" data-bs-toggle="tab" data-bs-target="#login-candidate" type="button"><i class="fas fa-user-tie"></i>Candidate</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTab2Content">
                        <!-- Login Candidate Content -->
                        <div class="tab-pane fade show active" id="login-candidate">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <input id="email" name="email" type="text" class="form-control" placeholder="Email*" required>
                                        <span id="email-error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <input id="password" name="password" type="password" class="form-control" placeholder="Password*" required>
                                        <span id="password-error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="Password3">
                                            <label class="form-check-label rem-forgot" for="Password3">Remember me <a href="javascript:;">Forgot Password</a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button id="login-button" class="site-button">Log in</button>
                                    <div class="mt-3 mb-3">
                                        Don't have an account?
                                        <button class="twm-backto-login" data-bs-target="#sign_up_popup" data-bs-toggle="modal" data-bs-dismiss="modal">Sign Up</button>
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

 

<script>
document.getElementById('login-button').addEventListener('click', function() {
    if (validateLoginForm()) {
        // Get form values
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        // Create an AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "login_candidate.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Handle server response
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert('You have successfully Loged In.');
                    window.location.href = 'index.php'; // Redirect on success
                } else {
                    document.getElementById('email-error').innerText = response.error_message;
                }
            }
        };

        // Send form data
        xhr.send(`email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`);
    }
});

function validateLoginForm() {
    let valid = true;

    // Clear previous error messages
    document.getElementById('email-error').innerText = '';
    document.getElementById('password-error').innerText = '';

    // Get form values
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();

    // Validate email
    if (email === '' || !email.endsWith('@gmail.com')) {
        document.getElementById('email-error').innerText = 'Please enter a valid Gmail address.';
        valid = false;
    }

    // Validate password
    if (password === '') {
        document.getElementById('password-error').innerText = 'Please enter your password.';
        valid = false;
    }

    return valid; // Prevent submission if validation fails
}
</script>




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

</body>

<!-- Mirrored from thewebmax.org/jobzilla/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2024 12:14:41 GMT -->
</html>
