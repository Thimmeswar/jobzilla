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


 


<!-- Login Modal -->
<div class="modal fade twm-sign-up" id="sign_up_popup2" aria-hidden="true" aria-labelledby="sign_up_popupLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="sign_up_popupLabel2">Login</h2>
                <p>Login and get access to all the features of Jobzilla</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  action="" method="POST">
                    <div class="twm-tabs-style-2">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <!-- Login Candidate -->
                            <li class="nav-item">
                                <button class="nav-link active mb-4" data-bs-toggle="tab" data-bs-target="#login-candidate" type="button">
                                    <i class="fas fa-user-tie"></i>Candidate
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTab2Content">
                            <!-- Login Candidate Content -->
                            <div class="tab-pane fade show active" id="login-candidate">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <input id="email" name="email" type="text" class="form-control" placeholder="Email*">
                                            <span id="email-error" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <input id="password" name="password" type="password" class="form-control" placeholder="Password*">
                                            <span id="password-error" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="Password3">
                                                <label class="form-check-label rem-forgot" for="Password3">
                                                    Remember me <a href="javascript:;">Forgot Password</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button id="login-button" type="submit" class="site-button">Log in</button>
                                        <div class="mt-3 mb-3">
                                            Don't have an account?
                                            <button class="twm-backto-login" data-bs-target="#sign_up_popup" data-bs-toggle="modal" data-bs-dismiss="modal">Sign Up</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<!--<script>
document.getElementById('login-button').addEventListener('click', function() {
    if (validateLoginForm()) {
        // Get form values
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        // Create an AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "login_candidate1.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Handle server response
        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert('You have successfully logged in.');
                    window.location.href = response.redirect_url; // Redirect on success
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

    // Validate email (only Gmail allowed)
    const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
    if (email === '' || !emailPattern.test(email)) {
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
</script>-->

<!-- Bootstrap JS (Ensure you have included the latest version) -->
<script src="path/to/bootstrap.bundle.js"></script>
