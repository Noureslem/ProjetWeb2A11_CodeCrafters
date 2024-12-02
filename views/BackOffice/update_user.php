<?php

require_once '../../controllers/user_controller.php';
require_once '../../connect.php';

// Start the session to check if the admin is logged in
session_start();



if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../views/FrontOffice/login.php');
    exit;
}

// Instantiate UserController with database connection
$userController = new UserController($conn);

// Get the user ID from the URL (passed as a query parameter)
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch the user data from the database
    $user = $userController->getUserById($userId);
    
    // If no user is found with the given ID, redirect
    if (!$user) {
        header('Location: admin_dashboard.php');
        exit;
    }
} else {
    // If no user ID is provided, redirect to the admin dashboard
    header('Location: admin_dashboard.php');
    exit;
}

// Check if the form is submitted to update user data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $password = $_POST['password']; // Remember to hash passwords for security!
    $role = $_POST['role'];
    $phoneNumber = $_POST['phoneNumber'];

    // Update the user
    $user->setFirstName($firstName);
    $user->setLastName($lastName);
    $user->setEmail($email);
    $user->setDateOfBirth($dateOfBirth);
    $user->setPassword($password); // Update password (consider hashing)
    $user->setRole($role);
    $user->setPhoneNumber($phoneNumber);

    // Call the UserController to update the user
    if ($userController->updateUser($user)) {
        // If successful, redirect back to the admin dashboard
        header('Location: admin_dashboard.php');
        exit;
    } else {
        // If error occurs, show an error message
        $errorMessage = "Error updating user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Update User</h1>
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($user->getFirstName()); ?>" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($user->getLastName()); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user->getEmail()); ?>" required>
            </div>
            <div class="mb-3">
                <label for="dateOfBirth" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" value="<?php echo htmlspecialchars($user->getDateOfBirth()); ?>" required>
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo htmlspecialchars($user->getPhoneNumber()); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($user->getPassword()); ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role">
                    <option value="user" <?php echo ($user->getRole() == 'user' ? 'selected' : ''); ?>>User</option>
                    <option value="admin" <?php echo ($user->getRole() == 'admin' ? 'selected' : ''); ?>>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
        
        <a href="admin_dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
