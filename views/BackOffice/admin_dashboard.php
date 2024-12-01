<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.html');
    exit;
}

echo "<h1>Welcome, Admin " . $_SESSION['firstname'] . "!</h1>";
?>
<a href="../../controllers/logout.php">Logout</a>
