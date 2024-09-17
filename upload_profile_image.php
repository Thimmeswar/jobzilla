<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_image'])) {
    $file = $_FILES['profile_image'];

    if ($file['error'] == UPLOAD_ERR_OK) {
        $validFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($file['type'], $validFileTypes)) {
            $target_dir = "images/user-avtar/";
            $file_name = uniqid() . "_" . basename($file["name"]);
            $target_file = $target_dir . $file_name;

            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                if (isset($_SESSION['id'])) {
                    $candidate_id = $_SESSION['id'];

                    // Update profile image in the database
                    $sql = "UPDATE candidate_profile SET profile_image=? WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("si", $file_name, $candidate_id);

                    if ($stmt->execute()) {
                        echo "<script>
                          alert('Profile picture updated successfully.');
                          window.location.href = 'candidate-profile.php';
                          </script>";
                        exit();
                    } else {
                        echo "Error updating record: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    echo "No user is logged in.";
                }
            } else {
                echo "Failed to upload file.";
            }
        } else {
            echo "Invalid file type. Only JPEG, PNG, and GIF formats are allowed.";
        }
    } else {
        echo "File upload error: " . $file['error'];
    }
} else {
    echo "No file uploaded.";
}

$conn->close();
?>
