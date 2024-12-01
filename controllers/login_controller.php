<?php

include '../connect.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            
            if (password_verify($password, $user['password'])) {
               
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['firstname'] = $user['firstname'];
                $_SESSION['lastname'] = $user['lastname'];
                $_SESSION['role'] = $user['role'];

               
                if ($user['role'] == 'admin') {
                    header('Location: ../views/BackOffice/admin_dashboard.php');
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
        
        echo "Error: " . $e->getMessage();
    }
}
?>
