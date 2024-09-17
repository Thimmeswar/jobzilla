<?php
session_start();

// Database connection using MySQLi
include 'db.php';

// Get filter parameters
$category = isset($_GET['category']) ? $_GET['category'] : '';
$keyword = isset($_GET['keyword']) ? '%' . $_GET['keyword'] . '%' : '';
$location = isset($_GET['location']) ? '%' . $_GET['location'] . '%' : '';
$date_posted = isset($_GET['date_posted']) ? $_GET['date_posted'] : '';
$employment_type = isset($_GET['job_type']) ? $_GET['job_type'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$show_count = isset($_GET['show_count']) ? (int)$_GET['show_count'] : 3;
$offset = ($page - 1) * $show_count;

// Prepare the base SQL query
$sql = "SELECT * FROM job_postings WHERE 1=1";

// Add filters
if (!empty($category) && $category != 'All Category') {
    $sql .= " AND job_category = '" . $conn->real_escape_string($category) . "'";
}
if (!empty($keyword)) {
    $sql .= " AND job_title LIKE '" . $conn->real_escape_string($keyword) . "'";
}
if (!empty($location)) {
    $sql .= " AND location LIKE '" . $conn->real_escape_string($location) . "'";
}
if (!empty($date_posted)) {
    switch ($date_posted) {
        case '1':
            $sql .= " AND start_date >= NOW() - INTERVAL 1 HOUR";
            break;
        case '24':
            $sql .= " AND start_date >= NOW() - INTERVAL 1 DAY";
            break;
        case '7':
            $sql .= " AND start_date >= NOW() - INTERVAL 7 DAY";
            break;
        case '14':
            $sql .= " AND start_date >= NOW() - INTERVAL 14 DAY";
            break;
        case '30':
            $sql .= " AND start_date >= NOW() - INTERVAL 30 DAY";
            break;
    }
}
if (!empty($employment_type)) {
    $sql .= " AND job_type = '" . $conn->real_escape_string($employment_type) . "'";
}

// Add pagination
$sql .= " ORDER BY start_date DESC LIMIT $show_count OFFSET $offset";

// Execute the query
$result = $conn->query($sql);
$jobs = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
}

// Get total number of jobs for pagination
$total_jobs_query = "SELECT COUNT(*) AS total FROM job_postings WHERE 1=1";
if (!empty($category) && $category != 'All Category') {
    $total_jobs_query .= " AND job_category = '" . $conn->real_escape_string($category) . "'";
}
if (!empty($keyword)) {
    $total_jobs_query .= " AND job_title LIKE '" . $conn->real_escape_string($keyword) . "'";
}
if (!empty($location)) {
    $total_jobs_query .= " AND location LIKE '" . $conn->real_escape_string($location) . "'";
}
if (!empty($date_posted)) {
    switch ($date_posted) {
        case '1':
            $total_jobs_query .= " AND start_date >= NOW() - INTERVAL 1 HOUR";
            break;
        case '24':
            $total_jobs_query .= " AND start_date >= NOW() - INTERVAL 1 DAY";
            break;
        case '7':
            $total_jobs_query .= " AND start_date >= NOW() - INTERVAL 7 DAY";
            break;
        case '14':
            $total_jobs_query .= " AND start_date >= NOW() - INTERVAL 14 DAY";
            break;
        case '30':
            $total_jobs_query .= " AND start_date >= NOW() - INTERVAL 30 DAY";
            break;
    }
}
if (!empty($employment_type)) {
    $total_jobs_query .= " AND job_type = '" . $conn->real_escape_string($employment_type) . "'";
}

$total_jobs_result = $conn->query($total_jobs_query);
$total_jobs_row = $total_jobs_result->fetch_assoc();
$total_jobs = $total_jobs_row['total'];
$total_pages = ceil($total_jobs / $show_count);

// Function to calculate time ago
function timeAgo($datetime) {
    $createdDate = new DateTime($datetime);
    $now = new DateTime();
    $interval = $now->diff($createdDate);

    if ($interval->y >= 1) {
        return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
    } elseif ($interval->m >= 1) {
        return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
    } elseif ($interval->d >= 10) {
        $weeks = floor($interval->d / 7);
        return $weeks . ' week' . ($weeks > 1 ? 's' : '') . ' ago';
    } elseif ($interval->d >= 1) {
        return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
    } elseif ($interval->h >= 1) {
        return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
    } else {
        return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
    }
}

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
    <title>TalentTap Solutions | Job List</title>
    
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
  
    <!-- LOADING AREA  END ====== -->   

	<div class="page-wraper">
    <?php 
    include 'header.php';
     ?>
       
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
                                <h2 class="wt-title">The Most Exciting Jobs</h2>
                            </div>
                        </div>
                        <!-- BREADCRUMB ROW -->                            
                        
                            <div>
                                <ul class="wt-breadcrumb breadcrumb-style-2">
                                    <li><a href="index.php">Home</a></li>
                                    <li>Jobs </li>
                                </ul>
                            </div>
                        
                        <!-- BREADCRUMB ROW END -->                        
                    </div>
                </div>
            </div>
            <!-- INNER PAGE BANNER END -->


            <!-- OUR BLOG START -->
            <div class="section-full p-t120  p-b90 site-bg-white" style="margin-top: -40px;">
                <!-- TITLE START-->
                    <div class="section-head center wt-small-separator-outer">
                        <div class="wt-small-separator site-text-primary">
                           <div>The Top Most Jobs</div>                                
                        </div>
                        <h2 class="wt-title">Find your job in one place</h2>
                    </div>                  
            <!-- TITLE END-->  

                <div class="container">
                    <div class="row">
                        
                        <div class="col-lg-4 col-md-12 rightSidebar">

                            <div class="side-bar">

                                <div class="sidebar-elements search-bx">
                                                                            
                               <?php
     include 'db.php';

// Get filter values from GET request
$date_filter = isset($_GET['date_posted']) ? (int)$_GET['date_posted'] : '';
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$keyword_filter = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$location_filter = isset($_GET['location']) ? $_GET['location'] : '';
$employment_type = isset($_GET['employment_type']) ? $_GET['employment_type'] : ''; // Corrected from 'job_type' to 'employment_type'

// Pagination settings
$jobs_per_page = isset($_GET['show_count']) ? (int)$_GET['show_count'] : 3; // Number of jobs per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $jobs_per_page;

// Build the WHERE clause
$where_clauses = [];
if (!empty($date_filter)) {
    $date_filter_value = date('Y-m-d', strtotime("-$date_filter days"));
    $where_clauses[] = "created_at >= '$date_filter_value'";
}
if (!empty($category_filter)) {
    $where_clauses[] = "job_category = '" . $conn->real_escape_string($category_filter) . "'";
}
if (!empty($keyword_filter)) {
    $where_clauses[] = "job_title LIKE '%" . $conn->real_escape_string($keyword_filter) . "%'";
}
if (!empty($location_filter)) {
    $where_clauses[] = "location LIKE '%" . $conn->real_escape_string($location_filter) . "%'";
}
if (!empty($employment_type)) {
    $where_clauses[] = "job_type = '" . $conn->real_escape_string($employment_type) . "'";
}

// Join WHERE clauses
$where_clause = implode(" AND ", $where_clauses);
if (!empty($where_clause)) {
    $where_clause = "WHERE " . $where_clause;
}

// Count total number of jobs for pagination
$total_jobs_query = "SELECT COUNT(*) as total FROM job_postings $where_clause";
$total_jobs_result = $conn->query($total_jobs_query);
$total_jobs = $total_jobs_result->fetch_assoc()['total'];
$total_pages = ceil($total_jobs / $jobs_per_page);

// Fetch the filtered jobs with pagination
$jobs_query = "SELECT * FROM job_postings $where_clause LIMIT $offset, $jobs_per_page";
$jobs_result = $conn->query($jobs_query);

// Fetch categories
$category_query = "SELECT DISTINCT job_category FROM job_postings";
$category_result = $conn->query($category_query);

// Fetch locations
$location_query = "SELECT DISTINCT location FROM job_postings";
$location_result = $conn->query($location_query);

// Fetch job types
$job_type_query = "SELECT DISTINCT job_type FROM job_postings";
$job_type_result = $conn->query($job_type_query);
?>
            
<form method="GET" action="">
    <div class="form-group mb-4">
        <h4 class="section-head-small mb-4">Category</h4>
        <select class="wt-select-bar-large selectpicker" name="category" data-live-search="true" data-bv-field="size">
            <option value="">All Category</option>
            <?php while ($row = $category_result->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($row['job_category']); ?>" <?php echo isset($_GET['category']) && $_GET['category'] == $row['job_category'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['job_category']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="form-group mb-4">
        <h4 class="section-head-small mb-4">Keyword</h4>
        <div class="input-group">
            <input type="text" class="form-control" name="keyword" placeholder="Job Title or Keyword" value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
            <button class="btn" type="submit"><i class="feather-search"></i></button>
        </div>
    </div>

    <div class="form-group mb-4">
        <h4 class="section-head-small mb-4">Location</h4>
        <select class="wt-select-bar-large selectpicker" name="location" data-live-search="true">
            <option value="">All Locations</option>
            <?php while ($row = $location_result->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($row['location']); ?>" <?php echo isset($_GET['location']) && $_GET['location'] == $row['location'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['location']); ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="twm-sidebar-ele-filter">
        <h4 class="section-head-small mb-4">Date Posted</h4>
        <ul>
            <li>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="date_posted" id="exampleradio1" value="1" <?php echo isset($_GET['date_posted']) && $_GET['date_posted'] == '1' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="exampleradio1">Last hour</label>
                </div>
            </li>
            <li>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="date_posted" id="exampleradio2" value="24" <?php echo isset($_GET['date_posted']) && $_GET['date_posted'] == '24' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="exampleradio2">Last 24 hours</label>
                </div>
            </li>
            <li>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="date_posted" id="exampleradio3" value="7" <?php echo isset($_GET['date_posted']) && $_GET['date_posted'] == '7' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="exampleradio3">Last 7 days</label>
                </div>
            </li>
            <li>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="date_posted" id="exampleradio4" value="14" <?php echo isset($_GET['date_posted']) && $_GET['date_posted'] == '14' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="exampleradio4">Last 14 days</label>
                </div>
            </li>
            <li>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="date_posted" id="exampleradio5" value="30" <?php echo isset($_GET['date_posted']) && $_GET['date_posted'] == '30' ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="exampleradio5">Last 30 days</label>
                </div>
            </li>
            <li>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="date_posted" id="exampleradio6" value="" <?php echo !isset($_GET['date_posted']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="exampleradio6">All</label>
                </div>
            </li>
        </ul>
    </div>

    <div class="twm-sidebar-ele-filter">
        <h4 class="section-head-small mb-4">Type of Employment</h4>
        <ul>
            <?php while ($row = $job_type_result->fetch_assoc()): ?>
                <li>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="employment_type" id="<?php echo htmlspecialchars($row['job_type']); ?>" value="<?php echo htmlspecialchars($row['job_type']); ?>" <?php echo isset($_GET['employment_type']) && $_GET['employment_type'] == $row['job_type'] ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="<?php echo htmlspecialchars($row['job_type']); ?>"><?php echo htmlspecialchars($row['job_type']); ?></label>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <button type="submit" name="filter" class="btn btn-primary">Apply Filter</button>
    <button type="reset" class="btn btn-secondary" onclick="clearFilters()" style="color: white">Clear Filters</button>
</form>
                                    <script>
                                             function clearFilters() {
                                             window.location.href = 'Jobs.php';
                                            }
                                        </script>

<?php
$conn->close();
?>
                   
                                </div>



                                
                            </div>

                            <div class="twm-advertisment" style="background-image:url(images/add-bg.jpg);">
                               <div class="overlay"></div>
                               <h4 class="twm-title">Recruiting?</h4>
                               <p>Get Best Matched Jobs On your <br>
                                Email. Add Resume NOW!</p>
                                <a href="about-1.php" class="site-button white">Read More</a> 
                            </div>

                        </div>

                        <div class="col-lg-8 col-md-12">
                            <!--Filter Short By-->
                             <div class="product-filter-wrap d-flex justify-content-between align-items-center m-b30">
        <span class="woocommerce-result-count-left">Showing <?php echo $total_jobs; ?> jobs</span>

        <form class="woocommerce-ordering twm-filter-select" method="get" id="filterForm">
            <input type="hidden" name="page" value="<?php echo $page; ?>">
            <span class="woocommerce-result-count">Sort By</span>
            <select name="job_type" class="wt-select-bar-2 selectpicker" data-live-search="true" onchange="document.getElementById('filterForm').submit();">
                <option value="">Most Recent</option>
                <?php while ($row = $job_type_result->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['job_type']); ?>" <?php echo (isset($_GET['job_type']) && $_GET['job_type'] == $row['job_type']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($row['job_type']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <select name="show_count" class="wt-select-bar-2 selectpicker" data-live-search="true" onchange="document.getElementById('filterForm').submit();">
                <option value="3" <?php echo ($jobs_per_page == 3) ? 'selected' : ''; ?>>Show 3</option>
                <option value="10" <?php echo ($jobs_per_page == 10) ? 'selected' : ''; ?>>Show 10</option>
                <option value="20" <?php echo ($jobs_per_page == 20) ? 'selected' : ''; ?>>Show 20</option>
                <option value="30" <?php echo ($jobs_per_page == 30) ? 'selected' : ''; ?>>Show 30</option>
                <option value="40" <?php echo ($jobs_per_page == 40) ? 'selected' : ''; ?>>Show 40</option>
                <option value="50" <?php echo ($jobs_per_page == 50) ? 'selected' : ''; ?>>Show 50</option>
                <option value="60" <?php echo ($jobs_per_page == 60) ? 'selected' : ''; ?>>Show 60</option>
            </select>
        </form>
    </div>

                            <div class="twm-jobs-list-wrap">
                              <ul>
    <?php foreach ($jobs as $job): ?>
        <li>
            <div class="twm-jobs-list-style1 mb-5">
                <div class="twm-media">
                    <img src="<?php echo htmlspecialchars($job['company_profile_image']); ?>" alt="Company Image">
                </div>
                <div class="twm-mid-content">
                    <a href="job-detail.php?id=<?php echo htmlspecialchars($job['id']); ?>" class="twm-job-title">
                        <h4><?php echo htmlspecialchars($job['job_title']); ?>
                            <span class="twm-job-post-duration"><?php echo timeAgo($job['start_date']); ?></span>
                        </h4>
                    </a>
                    <p class="twm-job-address"><?php echo htmlspecialchars($job['location']); ?></p>
                   <p class="twm-job-type"><strong>Address:</strong> <?php echo htmlspecialchars($job['complete_address']); ?></p>

                    <a href="<?php echo htmlspecialchars($job['website']); ?>" class="twm-job-websites site-text-primary">
                        <?php echo htmlspecialchars($job['website']); ?>
                    </a>
                    <div id="map" class="map"></div>
                </div>
                <div class="twm-right-content">
                    <div class="twm-jobs-category green">
                        <span class="twm-bg-green"><?php echo htmlspecialchars($job['job_type']); ?></span>
                    </div>
                    <div class="twm-jobs-amount">₹<?php echo htmlspecialchars($job['offered_salary']); ?> <span>/ Month</span></div>
                    <a href="job-detail.php?id=<?php echo htmlspecialchars($job['id']); ?>" class="twm-jobs-browse site-text-primary">Browse Job</a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

                                    
                            </div>

                           <div class="pagination-outer">
        <div class="pagination-style1">
            <ul>
                <?php if ($page > 1): ?>
                    <li class="prev"><a href="?page=<?php echo $page - 1; ?>&show_count=<?php echo htmlspecialchars($jobs_per_page); ?>">«</a></li>
                <?php else: ?>
                    <li class="prev disabled"><a href="#">«</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                        <a href="?page=<?php echo $i; ?>&show_count=<?php echo htmlspecialchars($jobs_per_page); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <li class="next"><a href="?page=<?php echo $page + 1; ?>&show_count=<?php echo htmlspecialchars($jobs_per_page); ?>">»</a></li>
                <?php else: ?>
                    <li class="next disabled"><a href="#">»</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
                        </div>

                    </div>
                </div>
            </div>   
            <!-- OUR BLOG END -->
          <!-- How It Work START -->
            <div class="section-full site-bg-primary twm-how-it-work-1-area" style="margin-top: -60px; margin-bottom: 50px;">
                <div class="container" style="margin-top: -60px; margin-bottom: -80px;">

                    <div class="section-content">
                        <div class="twm-how-it-work-1-content">
                            <div class="row">

                                <div class="col-xl-5 col-lg-12 col-md-12">
                                    <div class="twm-how-it-work-1-left">
                                        <div class="twm-how-it-work-1-section">
                                            <!-- TITLE START-->
                                            <div class="section-head left wt-small-separator-outer">
                                                <div class="wt-small-separator">
                                                    <div>How it Works</div>                                
                                                </div>
                                                <h2>Follow our steps we will help you.</h2>
                                            </div>
                                            <!-- TITLE END-->

                                            <div class="twm-step-section-4">
                                                <ul>
                                                    <li>
                                                        <div class="twm-step-count bg-clr-sky-light">01</div>
                                                        <div class="twm-step-content">
                                                            <h4 class="twm-title">Register Your Account</h4>
                                                            <p>You need to create an account to find the best and preferred job.</p>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="twm-step-count bg-clr-yellow-light">02</div>
                                                        <div class="twm-step-content">
                                                            <h4 class="twm-title">Search Your Job</h4>
                                                            <p>After creating an account, search for your favorite job.</p>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="twm-step-count bg-clr-pink-light">03</div>
                                                        <div class="twm-step-content">
                                                            <h4 class="twm-title">Apply For Dream Job</h4>
                                                            <p>After creating the account, you have to apply for the desired job.</p>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="twm-step-count bg-clr-green-light">04</div>
                                                        <div class="twm-step-content">
                                                            <h4 class="twm-title">Upload Your Resume</h4>
                                                            <p>Upload your resume after filling all the relevant information.</p>
                                                        </div>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-7 col-lg-12 col-md-12">
                                    
                                    <div class="twm-how-it-right-section">
                                        <div class="twm-media">
                                            <div class="twm-bg-circle"><img src="images/home-4/how-it-work/bg-circle-large.png" alt=""></div>
                                            <div class="twm-block-left anm" data-speed-x="-4" data-speed-scale="-25"><img src="images/home-4/how-it-work/block-left.png" alt=""></div>
                                            <div class="twm-block-right anm" data-speed-x="-4" data-speed-scale="-25"><img src="images/home-4/how-it-work/block-right.png" alt=""></div>
                                            <div class="twm-main-bg anm" data-wow-delay="1000ms" data-speed-x="2" data-speed-y="2"><img src="images/home-4/how-it-work/main-bg.png" alt=""></div>
                                        </div>
                                            
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            <!-- How It Work END -->
            <!-- EXPLORE NEW LIFE START -->
            <?php include 'Update_resume.php';?>
            <!-- EXPLORE NEW LIFE END -->
            
            <!-- Testimonial START -->
            <?php include 'Testimonials.php';?>
            <!-- Testimonial END -->
            
     
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
        <select id="candidatecountrycode" name="countrycode" class="form-control" readonly>
            <option value="+91">+91 (India)</option>
            <option value="+1">+1 (USA)</option>
            <option value="+44">+44 (UK)</option>
            <option value="+61">+61 (Australia)</option>
        </select>
    </div>
</div>
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
                    <li><a href="https://www.facebook.com/" target="_blank" class="facebook-clr"><i class="fab fa-facebook-f"></i></a></li>
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
                alert('Country is required.');
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
<script>
        function initMap() {
            var mapOptions = {
                zoom: 10,
                center: {lat: -34.397, lng: 150.644}
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var locations = <?php echo json_encode($jobs); ?>;
            locations.forEach(function(job) {
                var marker = new google.maps.Marker({
                    position: {lat: parseFloat(job.latitude), lng: parseFloat(job.longitude)},
                    map: map,
                    title: job.job_title
                });
            });
        }

        window.onload = initMap;
    </script>

 

</body>
</html>
