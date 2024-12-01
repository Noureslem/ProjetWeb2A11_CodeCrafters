<?php
include '../connect.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dateOfBirth = $_POST['dateOfBirth']; 
    $phonenumber = $_POST['phonenumber']; 
    $role = $_POST['role'];  

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
       
        $sql = "INSERT INTO user (firstname, lastname, email, password, role, dateOfBirth, phonenumber) 
                VALUES (:firstname, :lastname, :email, :password, :role, :dateOfBirth, :phonenumber)";
        
        
        $stmt = $conn->prepare($sql);
        
       
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':dateOfBirth', $dateOfBirth);  
        $stmt->bindParam(':phonenumber', $phonenumber);  
        $stmt->bindParam(':role', $role);  
        
     
        $stmt->execute();
        
        echo "<h1>Signup Successful</h1>";
        echo "<p>Thank you for signing up, $firstname $lastname!</p>";
        
    } catch (PDOException $e) {
       
        echo "Error: " . $e->getMessage();
    }
}
?>
