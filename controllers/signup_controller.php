<?php
include '../connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dateOfBirth = $_POST['dateOfBirth']; // Capture the date of birth
    $phonenumber = $_POST['phonenumber']; // Capture the phone number
    $role = $_POST['role'];  // Capture the role

    // Hash the password before storing it for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare the SQL query to insert user data
        $sql = "INSERT INTO user (firstname, lastname, email, password, role, dateOfBirth, phonenumber) 
                VALUES (:firstname, :lastname, :email, :password, :role, :dateOfBirth, :phonenumber)";
        
        // Prepare the statement
        $stmt = $conn->prepare($sql);
        
        // Bind the parameters to the statement
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':dateOfBirth', $dateOfBirth);  // Bind the date of birth
        $stmt->bindParam(':phonenumber', $phonenumber);  // Bind the phone number
        $stmt->bindParam(':role', $role);  // Bind the role
        
        // Execute the query
        $stmt->execute();
        
        // If successful, redirect or display a success message
        echo "<h1>Signup Successful</h1>";
        echo "<p>Thank you for signing up, $firstname $lastname!</p>";
        
    } catch (PDOException $e) {
        // Handle any errors that occur during the query
        echo "Error: " . $e->getMessage();
    }
}
?>
