<nav id="sidebar-admin-wraper">
    <div class="page-logo">
        <a href="index.php"><img src="images/logo-dark.png" alt=""></a>
    </div>
    
    <div class="admin-nav scrollbar-macosx">
        <ul>
            <li>
                <a href="dashboard.php"><i class="fa fa-home"></i><span class="admin-nav-text">Dashboard</span></a>
            </li>
            <li>
                <a href="dash-my-profile.php"><i class="fa fa-user"></i><span class="admin-nav-text">My Profile</span></a>
            </li>
            <li>
                <a href="javascript:;"><i class="fa fa-suitcase"></i><span class="admin-nav-text">Jobs</span></a>
                <ul class="sub-menu">
                    <li><a href="dash-post-job.php"><span class="admin-nav-text">Post a New Job</span></a></li>
                    <li><a href="dash-manage-jobs.php"><span class="admin-nav-text">Manage Jobs</span></a></li>
                </ul>
            </li>
            <li>
                <a href="dash-candidates.php"><i class="fa fa-user-friends"></i><span class="admin-nav-text">Candidates</span></a>
            </li>
            <li>
                <a href="dash-change-password.php"><i class="fa fa-fingerprint"></i><span class="admin-nav-text">Change Password</span></a>
            </li>
            <li>
                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#delete-dash-profile"><i class="fa fa-trash-alt"></i><span class="admin-nav-text">Delete Profile</span></a>
            </li>  
            <li>
                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#logout-dash-profile"><i class="fa fa-share-square"></i><span class="admin-nav-text">Logout</span></a>
            </li>                    
        </ul>
    </div>   
</nav>



<script>
    // Get the current URL path
    const currentPath = window.location.pathname.split("/").pop();

    // Select all the navigation links
    const navLinks = document.querySelectorAll('.admin-nav ul li a');

    // Loop through each link and compare with the current URL
    navLinks.forEach(link => {
        const linkHref = link.getAttribute('href');
        const parentLi = link.parentElement;

        if (linkHref === currentPath) {
            // Add active class to the clicked link's parent <li>
            parentLi.classList.add('active');

            // If the link is within a sub-menu, add the active class to the parent "Jobs" <li>
            if (parentLi.parentElement.classList.contains('sub-menu')) {
                parentLi.parentElement.parentElement.classList.add('active');
            }
        } else {
            parentLi.classList.remove('active');
        }
    });
</script>
