<?php

// Database connection
include 'db.php';

if (!$_POST) {
    // Fetch data from database if not a POST request
    if (isset($_SESSION['id'])) {
        $candidate_id = $_SESSION['id'];

        $sql = "SELECT prefix, firstname, lastname, countrycode, phone, country, email_id, resume, profile_image FROM candidate_profile WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $candidate_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($prefix, $firstname, $lastname, $countrycode, $phone, $country, $email, $resume, $profile_img);
        $stmt->fetch();
        $stmt->close();

       
    } else {
        echo "<script>alert('No user is logged in.');</script>";
    }
}

// Close the connection
$conn->close();
?>



<div class="container">
                    <div class="row">
                        
                        <div class="col-xl-3 col-lg-4 col-md-12 rightSidebar m-b30">

                            <div class="side-bar-st-1">
                                
                                <div class="twm-candidate-profile-pic">
                                <figure>
                    <!-- Check if a profile image exists; if not, use the default image -->
                    <?php if (!empty($profile_img)): ?>
                        <img id="profileImg" src="images/user-avtar/<?php echo htmlspecialchars($profile_img); ?>" class="img-fluid rounded-circle" alt="Profile Image" style="height:110px;width:120px;">
                    <?php else: ?>
                        <img id="profileImg" src="images/user-avtar/a.png" class="img-fluid rounded-circle" alt="Default Image" style="height:110px;">
                    <?php endif; ?>
                </figure>
                                    
                                    <!-- <img src="images/user-avtar/pic4.jpg" alt=""> -->
                                    <div class="upload-btn-wrapper">
                                        
                                        <div id="upload-image-grid"></div>
                                        <!-- <button class="site-button button-sm">Upload Photo</button>
                                        <input type="file" name="myfile" id="file-uploader" accept=".jpg, .jpeg, .png"> -->
                                    </div>
                                    
                                </div>
                                <div class="twm-mid-content text-center">
    <h4>
        <?php if(isset($firstname)): ?>
            <?php
                $displayUsername = strlen($firstname) > 15 ? substr($firstname, 0, 15) . '...' : $firstname;
                echo $displayUsername;
            ?>
        <?php endif; ?>
    </h4>
                                    <!-- <p>IT Contractor</p> -->
                                </div>
                               
                                <div class="twm-nav-list-1">
    <ul>
        <li><a href="candidate-profile.php"><i class="fa fa-user"></i> My Profile</a></li>
        <li><a href="candidate-jobs-applied.php"><i class="fa fa-suitcase"></i> Applied Jobs</a></li>
        <li><a href="candidate-shortlist-jobs.php"><i class="fa fa-paperclip"></i> Shortlisted Jobs</a></li>
        <li><a href="candidate-change-password.php"><i class="fa fa-fingerprint"></i> Change Password</a></li>
        <li><a href="javascript:;" data-bs-toggle="modal" data-bs-target="#delete-dash-profile"><i class="fa fa-trash-alt"></i><span class="admin-nav-text">Delete Profile</span></a></li>
        <li><a href="javascript:;" data-bs-toggle="modal" data-bs-target="#logout-dash-profile"><i class="fa fa-share-square"></i><span class="admin-nav-text">Logout</span></a></li>
    </ul>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    var links = document.querySelectorAll('.twm-nav-list-1 ul li a');
    var currentUrl = window.location.href;

    links.forEach(function(link) {
        if (link.href === currentUrl) {
            link.parentElement.classList.add('active');
        }
    });
});

</script>



                                
                            </div>

                        </div>
