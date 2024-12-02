<?php

require_once '../../connect.php';

require_once '../../controllers/user_controller.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../../controllers/login.php');
    exit;
}

try {

    $userController = new UserController($conn);

    $users = $userController->getAllUsers();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-responsive {
            max-height: 70vh;
            overflow-y: auto;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Admin Dashboard</h1>
        <h3 class="text-center mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['firstname']); ?>!</h3>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-center">User Management</h2>
            <a href="../../controllers/logout.php" class="btn btn-secondary">Logout</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Date of Birth</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)) { ?>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user->getIdUser()); ?></td>
                                <td><?php echo htmlspecialchars($user->getFirstName()); ?></td>
                                <td><?php echo htmlspecialchars($user->getLastName()); ?></td>
                                <td><?php echo htmlspecialchars($user->getEmail()); ?></td>
                                <td>
                                    <span class="badge <?php echo $user->getRole() === 'admin' ? 'bg-success' : 'bg-info'; ?>">
                                        <?php echo htmlspecialchars($user->getRole()); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($user->getDateOfBirth()); ?></td>
                                <td><?php echo htmlspecialchars($user->getPhoneNumber()); ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="./update_user.php?id=<?php echo $user->getIdUser(); ?>" class="btn btn-primary btn-sm">Update</a>
                                        <a href="./delete_user.php?id=<?php echo $user->getIdUser(); ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Are you sure you want to delete this user?');">
                                           Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="8" class="text-center">No users found.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
