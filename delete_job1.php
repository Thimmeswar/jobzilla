<?php
include 'db.php';

header('Content-Type: application/json');
$response = ['success' => false, 'error' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = isset($_POST['job_id']) ? intval($_POST['job_id']) : null;

    if ($job_id) {
        // Prepare and execute the deletion query based on 'jobid'
        $query = "DELETE FROM applied_jobs WHERE jobid = ?";
        $stmt = $conn->prepare($query);

        if ($stmt === false) {
            $response['error'] = 'Prepare failed: ' . $conn->error;
        } else {
            $stmt->bind_param('i', $job_id);

            if ($stmt->execute()) {
                $response['success'] = true;
            } else {
                $response['error'] = 'Error deleting job posting: ' . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $response['error'] = 'Invalid job ID.';
    }
} else {
    $response['error'] = 'Invalid request method.';
}

$conn->close();
echo json_encode($response);
?>
