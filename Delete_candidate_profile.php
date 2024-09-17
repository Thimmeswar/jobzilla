<?php
// Check if the admin is logged in
if (!isset($_SESSION['id'])) {
    header("Location: index.php"); // Redirect to the index page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="modal fade" id="delete-dash-profile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" data-admin-id="<?php echo htmlspecialchars($_SESSION['id']); ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Do you want to delete your profile?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary outline-primary">Yes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.0/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('#delete-dash-profile .outline-primary').on('click', function() {
        var candidateId = $('#delete-dash-profile').data('admin-id');
        
        if (!candidateId) {
            alert('Candidate ID is not set.');
            return;
        }

        $.ajax({
            url: 'Delete_candidate_check.php',
            type: 'POST',
            data: { id: candidateId },
            dataType: 'json', // Expect JSON response
            success: function(response) {
                if (response.success) {
                    alert('Profile deleted successfully.');
                    window.location.href = 'index.php'; // Redirect to the index page after deletion
                } else {
                    alert('Error deleting profile: ' + response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('An error occurred while processing your request: ' + textStatus);
                console.error('Error details:', jqXHR.responseText); // Log response for debugging
            }
        });
    });
});
</script>

</body>
</html>
