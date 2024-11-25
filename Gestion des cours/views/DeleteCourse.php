<?php
require_once '../controller/CourseController.php'; 
$courseController = new CourseController();
$courseController->deleteCourse($_GET['id']);
header('Location:ListCourse.php');
?>
