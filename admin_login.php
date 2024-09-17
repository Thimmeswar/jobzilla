<?php
session_start();

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve username and password from POST request
    $admin_name = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query to check credentials
    $query = "SELECT * FROM admin WHERE fname = ? LIMIT 1";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('s', $admin_name); // Bind the correct parameter
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();

        // Check if the password matches (plain text comparison)
        if ($admin && $password === $admin['password']) {
            // Start a session and store admin details
            $_SESSION['id'] = $admin['id']; // Ensure the correct column name is used
            $_SESSION['fname'] = $admin['fname'];

            // Display alert for successful login and redirect
            echo "<script>alert('Successfully logged in'); window.location.href = 'dash-my-profile.php';</script>";
            exit();
        } else {
            echo "<script>alert('Incorrect email id or password'); window.location.href = 'login.php';</script>";
        }
    } else {
        $error = "Database query failed.";
    }
}
?>

<!-- Display error message if login fails -->
<?php if (isset($error)) { ?>
    <div class="error">
        <p><?php echo $error; ?></p>
    </div>
<?php } ?>
