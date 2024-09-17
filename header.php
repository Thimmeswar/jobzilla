<?php

// Database connection
include 'db.php';

// Fetch candidate data
if (isset($_SESSION['id'])) {
    $candidate_id = $_SESSION['id'];

    $stmt = $conn->prepare("SELECT firstname, email_id, phone, profile_image FROM candidate_profile WHERE id = ?");
    $stmt->bind_param("i", $candidate_id);
    $stmt->execute();
    $stmt->bind_result($username, $email, $phone, $profile_image);
    $stmt->fetch();
    $stmt->close();
} else {
    $username = null;
    $email = null;
    $phone = null;
    $profile_image = null;
}

$conn->close();
?>



<header class="site-header header-style-3 mobile-sider-drawer-menu">
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar">  
            <div class="container-fluid clearfix"> 
                <div class="logo-header">
                    <div class="logo-header-inner logo-header-one">
                        <a href="http://talenttap.solutions/">
                            <img src="images/logo-dark.png" alt="Logo">
                        </a>
                    </div>
                </div>  

                <!-- NAV Toggle Button -->
                <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggler collapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar icon-bar-first"></span>
                    <span class="icon-bar icon-bar-two"></span>
                    <span class="icon-bar icon-bar-three"></span>
                </button> 

                <!-- MAIN Nav -->
                <div class="nav-animation header-nav navbar-collapse collapse d-flex justify-content-center">
                    <ul class="nav navbar-nav">
                        <li class="has-mega-menu"><a href="index.php">Home</a></li>
                        <li class="has-child"><a href="About_Us.php">About us</a></li>
                        <li class="has-child"><a href="Jobs.php">Jobs</a></li>
                        <li class="has-child"><a href="faq.php">FAQ'S</a></li>
                        <li class="has-child"><a href="blog.php">Blog</a></li>
                        <li class="has-child"><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Header Right Section -->
                <div class="extra-nav header-2-nav">
                    <div class="extra-cell">
                        <div class="header-nav-btn-section">
                            <?php if(isset($username)): ?>
                                <?php
                                    $displayUsername = strlen($username) > 15 ? substr($username, 0, 15) . '...' : $username;
                                ?>
                                <div class="user-info d-flex align-items-center dropdown">
                                    <a href="#" id="dropdownMenuLink" class="d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="user-image">
                                            <img src="images/user-avtar/<?= $profile_image ? $profile_image : 'a.png' ?>" alt="Profile Image">
                                        </div>
                                        <div class="has-child ms-2">
                                            <span><?= htmlspecialchars($displayUsername) ?></span>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="candidate-profile.php">My Profile</a></li>
                                    <li><a class="dropdown-item" href="candidate-jobs-applied.php">Applied Jobs</a></li>
                                    <li><a class="dropdown-item" href="candidate-shortlist-jobs.php">Shortlisted Jobs</a></li>
                                    <li><a class="dropdown-item" href="candidate-change-password.php">Change Password</a></li>
                                    <li><a href="javascript:;" data-bs-toggle="modal" data-bs-target="#logout-dash-profile"><span class="dropdown-item">Logout</span></a></li>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <div class="twm-nav-btn-left">
                                    <a class="twm-nav-sign-up" data-bs-toggle="modal" href="#sign_up_popup" role="button">
                                        <i class="feather-log-in"></i> Sign Up
                                    </a>
                                </div>
                                <div class="twm-nav-btn-left">
                                        <a class="twm-nav-sign-up" data-bs-toggle="modal" href="#sign_up_popup2" role="button">
                                            <i class="feather-log-in"></i> Login
                                        </a>
                                    </div>
                            <?php endif; ?>
                        </div>
                    </div> 
                </div>                        
            </div>    
        </div>
    </div>
</header>



<style>
    .user-info {
    display: flex;
    align-items: center;
    position: relative;
}

.user-image img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.username {
    color: #ffffff;
    font-weight: 600;
    font-family: 'YourFontFamily'; /* Replace with the font family used for the 'Home' link */
    margin-left: 10px; /* Adjust spacing if needed */
}

.dropdown-menu {
    background-color: #ffffff; /* Adjust background color if needed */
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 10px 0;
    min-width: 150px; /* Adjust dropdown width */
    position: absolute;
    top: 100%;
    left: 0;
}

.dropdown-item {
    color: #333;
    padding: 8px 20px;
    font-family: 'YourFontFamily'; 
    text-decoration: none;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
    color: #000;
}

@media (max-width: 767px) {
    .user-image img {
        width: 30px;
        height: 30px;
    }

    .dropdown-menu {
        min-width: 120px;
    }
}

</style>