<?php
require_once 'core.php';
require_once 'php_action/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user ID from the session
    $userId = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

    // Check if a user is logged in
    if ($userId > 0) {
        // Get other form data
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $college = $_POST['college'];
        $program = $_POST['program'];
        $yearLevel = $_POST['yearLevel'];

        // Fetch user data from the database
        $userData = getUserData($userId);

        // Check if user data is fetched successfully
        if ($userData !== null) {
            // Update user profile in the database
            $query = "UPDATE s_users 
                      SET lname='$lastName', fname='$firstName', college='$college', program='$program', year_level='$yearLevel' 
                      WHERE user_id=$userId";

            if ($connect->query($query) === TRUE) {
                // Profile updated successfully
                header("Location: edit_profile.php"); // Redirect to the profile page
                exit();
            } else {
                // Error updating profile
                echo "Error: " . $query . "<br>" . $connect->error;
            }
        } else {
            // Handle the case where no user data is found
            echo "Error: User data not found.";
        }
    } else {
        // Redirect or handle the case where the user is not logged in
        header("Location: core.php");
    
        exit();
    }
}
?>
