<?php
require_once '../../connect.php';
require_once '../../controllers/user_controller.php';

session_start();

// Ensure the user is logged in and is an admin (optional)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../controllers/login.php');
    exit;
}

// Check if the 'id' parameter is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id'];

    try {
        $userController = new UserController($conn);

        // Attempt to delete the user
        $isDeleted = $userController->deleteUserById($userId);

        if ($isDeleted) {
            // Redirect back to the admin dashboard with a success message
            header('Location: admin_dashboard.php?status=success&action=delete');
        } else {
            // Redirect back with an error message
            header('Location: admin_dashboard.php?status=error&action=delete');
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    // Redirect back if no ID is provided
    header('Location: admin_dashboard.php?status=error&reason=missing_id');
    exit;
}
?>
