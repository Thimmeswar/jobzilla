<?php
session_start(); ?>

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
    <title>TalentTap Solutions | Contact us</title>
    
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
     
        <!-- HEADER START -->
        <?php include 'header.php';?>
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
                                <h2 class="wt-title">Contact Us</h2>
                            </div>
                        </div>
                        <!-- BREADCRUMB ROW -->                            
                        
                            <div>
                                <ul class="wt-breadcrumb breadcrumb-style-2">
                                    <li><a href="index.php">Home</a></li>
                                    <li>Contact Us</li>
                                </ul>
                            </div>
                        
                        <!-- BREADCRUMB ROW END -->                        
                    </div>
                </div>
            </div>
            <!-- INNER PAGE BANNER END -->
           
            <!-- CONTACT FORM -->
            <div class="section-full twm-contact-one">   
                <div class="section-content">
                    <div class="container">
                            
                        <!-- CONTACT FORM-->
                        <div class="contact-one-inner">
                            <div class="row">

                                <div class="col-lg-6 col-md-12">
                                    <div class="contact-form-outer">

                                        <!-- TITLE START-->
                                        <div class="section-head left wt-small-separator-outer">
                                            <h2 class="wt-title">Send Us a Message</h2>
                                            <p>Feel free to contact us and we will get back to you as soon as we can.</p>
                                        </div>
                                        <!-- TITLE END--> 

                                        <form id="contactForm" class="cons-contact-form">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="form-group mb-3">
                <input name="username1" type="text" id="username1" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group mb-3">
                <input name="email1" type="email" id="email1" class="form-control" placeholder="Email">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group mb-3">
                <input name="phone1" type="text" id="phone1" class="form-control" placeholder="Phone">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group mb-3">
                <input name="subject1" type="text" id="subject1" class="form-control" placeholder="Subject">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group mb-3">
                <textarea name="message1" id="message1" class="form-control" rows="3" placeholder="Message"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <button type="submit" class="site-button">Submit Now</button>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#contactForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Perform validation
        var username = $('#username1').val().trim();
        var email = $('#email1').val().trim();
        var phone = $('#phone1').val().trim();
        var subject = $('#subject1').val().trim();
        var message = $('#message1').val().trim();

        if (!validateName(username)) {
            alert('Please enter a valid name (minimum 3 characters, only alphabets, one space allowed).');
            return false;
        }
        if (!validateEmail(email)) {
            alert('Please enter a valid email address ending with @gmail.com.');
            return false;
        }
        if (!validatePhone(phone)) {
            alert('Please enter a valid phone number (10 digits, starts with 6-9).');
            return false;
        }
        if (!validateSubject(subject)) {
            alert('Please enter a valid subject (minimum 5 characters, only alphabets, one space allowed).');
            return false;
        }
        if (!validateMessage(message)) {
            alert('Please enter a valid message (minimum 5 characters, only alphabets, one space allowed).');
            return false;
        }

        // If validation passes, submit the form via AJAX
        $.ajax({
            url: 'mail.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                alert(response.message); // Show the alert with the response message
                location.reload(); // Reload the page after the alert is closed
            },
            error: function() {
                alert('An error occurred. Please try again.');
                location.reload(); // Reload the page after the alert is closed
            }
        });
    });

    function validateName(name) {
        var namePattern = /^[A-Za-z]+(?:\s[A-Za-z]+)?$/;
        return name.length >= 3 && namePattern.test(name);
    }

    function validateEmail(email) {
        var emailPattern = /^[a-zA-Z0-9._-]+@gmail\.com$/;
        return emailPattern.test(email);
    }

    function validatePhone(phone) {
        var phonePattern = /^[6-9]\d{9}$/;
        return phonePattern.test(phone);
    }

    function validateSubject(subject) {
        var subjectPattern = /^[A-Za-z]+(?:\s[A-Za-z]+)?$/;
        return subject.length >= 5 && subjectPattern.test(subject);
    }

    function validateMessage(message) {
        var messagePattern = /^[A-Za-z]+(?:\s[A-Za-z]+)?$/;
        return message.length >= 5 && messagePattern.test(message);
    }
});
</script>


                                    </div>
                                </div> 

                                <div class="col-lg-6 col-md-12">
                                    <div class="contact-info-wrap">

                                        <div class="contact-info">
                                            <div class="contact-info-section">  
                                                    
                                                    <div class="c-info-column">
                                                        <div class="c-info-icon"><i class=" fas fa-map-marker-alt"></i></div>
                                                        <h3 class="twm-title">In the bay area?</h3>
                                                        <p>1363-1385 Sunset Blvd Los Angeles, CA 90026, USA</p>
                                                    </div>  

                                                    <div class="c-info-column">
                                                        <div class="c-info-icon custome-size"><i class="fas fa-mobile-alt"></i></div>
                                                        <h3 class="twm-title">Feel free to contact us</h3>
                                                        <p><a href="tel:+216-761-8331">+2 900 234 4241</a></p>
                                                        <p><a href="tel:+216-761-8331">+2 900 234 3219</a></p>
                                                    </div>

                                                    <div class="c-info-column">
                                                        <div class="c-info-icon"><i class="fas fa-envelope"></i></div>
                                                        <h3 class="twm-title">Support</h3>
                                                        <p>infohelp@gmail.com</p>
                                                        <p>support12@gmail.com</p>
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
            <div class="gmap-outline">
                <div class="google-map">
                    <div style="width: 100%">
                        <iframe height="460" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3304.8534521658976!2d-118.2533646842856!3d34.073270780600225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c6fd9829c6f3%3A0x6ecd11bcf4b0c23a!2s1363%20Sunset%20Blvd%2C%20Los%20Angeles%2C%20CA%2090026%2C%20USA!5e0!3m2!1sen!2sin!4v1620815366832!5m2!1sen!2sin"></iframe>
                    </div>
                </div>
            </div>
      

        </div>
        <!-- CONTENT END -->

        <!-- FOOTER START -->
        <?php include 'footer.php';?>
        <!-- FOOTER END -->

        <!-- BUTTON TOP START -->
		<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

        <!--Model Popup Section Start-->
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

<!-- STYLE SWITCHER  ======= --> 
<div class="styleswitcher">

<!--    <div class="switcher-btn-bx">
        <a class="switch-btn">
            <span class="fa fa-cog fa-spin"></span>
        </a>
    </div>-->
    
    <div class="styleswitcher-inner">
    
        <h6 class="switcher-title">Color Skin</h6>
        <ul class="color-skins">
            <li><a class="theme-skin skin-1" href="contacta39b.php?theme=css/skin/skin-1"></a></li>
            <li><a class="theme-skin skin-2" href="contact61e7.php?theme=css/skin/skin-2"></a></li>
            <li><a class="theme-skin skin-3" href="contactcce5.php?theme=css/skin/skin-3"></a></li>
            <li><a class="theme-skin skin-4" href="contact13f7.php?theme=css/skin/skin-4"></a></li>
            <li><a class="theme-skin skin-5" href="contact19a6.php?theme=css/skin/skin-5"></a></li>
            <li><a class="theme-skin skin-6" href="contactfe5c.php?theme=css/skin/skin-6"></a></li>
            <li><a class="theme-skin skin-7" href="contactab47.php?theme=css/skin/skin-7"></a></li>
            <li><a class="theme-skin skin-8" href="contact5f8d.php?theme=css/skin/skin-8"></a></li>
            <li><a class="theme-skin skin-9" href="contact5663.php?theme=css/skin/skin-9"></a></li>
            <li><a class="theme-skin skin-10" href="contact28ac.php?theme=css/skin/skin-10"></a></li>
            
        </ul>           
        
    </div>    
</div>
<!-- STYLE SWITCHER END ==== -->


</body>



</html>
