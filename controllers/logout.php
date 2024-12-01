<?php
session_start();
session_destroy();
header('Location: ../views/FrontOffice/login.php');
exit;
?>
