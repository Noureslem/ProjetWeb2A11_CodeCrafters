<?php
// Include the database connection
include '../connect.php';

// Start a session to store user data
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Store user data in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] == 'admin') {
                    header('Location: ../views/FrontOffice/admin_dashboard.php');
                } else if ($user['role'] == 'teacher') {
                    header('Location: ../views/FrontOffice/user_dashboard.php');
                } else {
                    header('Location: ../views/FrontOffice/user_dashboard.php');
                }
                exit;
            } else {
                echo "<p>Incorrect password.</p>";
            }
        } else {
            echo "<p>No user found with this email.</p>";
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
