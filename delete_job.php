<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = isset($_POST['job_id']) ? intval($_POST['job_id']) : null;

    if ($job_id) {
        $query = "DELETE FROM job_postings WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $job_id);

        if ($stmt->execute()) {
           
            echo "<script>alert('Job has been successfully deleted.'); window.location.href='dash-manage-jobs.php';</script>";

            exit();
        } else {
            echo "Error deleting job posting: " . $conn->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
