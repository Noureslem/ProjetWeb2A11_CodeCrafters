<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php');
    exit;
}

echo "<h1>Welcome, " . $_SESSION['firstname'] . "!</h1>";
echo "<p>Your role is: " . $_SESSION['role'] . "</p>";
?>
<a href="../../controllers/logout.php">Logout</a>
