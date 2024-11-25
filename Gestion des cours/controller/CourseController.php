<?php
require_once'C:\xampp\htdocs\Gestion des cours\model\Course.php';
require_once 'C:\xampp\htdocs\Gestion des cours\db.php';

class CourseController
{
   //create
   function addcourse($course)
{
    $sql = "INSERT INTO `course`(`id`, `title`, `description`, `price`, `teacher_id`, `study_duration`, `level`, `created_at`, `updated_at`) 
    VALUES (:title, :description, :price, :teacher_id, :study_duration, :level, :created_at, :updated_at)";
    
    $db = config::getConnexion();
    try {
       $query = $db->prepare($sql);
        $query->execute([
            'title' => $course['title'],
            'description' => $course['description'],
            'price' => $course['price'],
            'teacher_id' => $course['teacher_id'],
            'study_duration' => $course['study_duration'],
            'level' => $course['level'],
            'created_at' => date('Y-m-d H:i:s'), // Current timestamp for `created_at`
            'updated_at' => date('Y-m-d H:i:s')  // Current timestamp for `updated_at`
        ]);
        //$query = $db->prepare($sql);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

//listcourse
public function listCourse()
{
    $sql = "SELECT * FROM `course`";
    $db = config::getConnexion();

    try {
        $query = $db->query($sql);
        $course = $query->fetchAll(PDO::FETCH_ASSOC);
        return $course;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        return [];
    }
}

//modification of course to the professors
public function updateCourse($id, $title, $description, $price, $user_id, $study_duration, $level) {
    $sql = "UPDATE courses 
            SET title = :title, description = :description, price = :price, user_id = :user_id, 
                study_duration = :study_duration, level = :level 
            WHERE id = :id AND user_id = :user_id"; 
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'user_id' => $user_id,
            'study_duration' => $study_duration,
            'level' => $level
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

//delete course



public function deleteCourse($id)
{
    $sql = "DELETE FROM course WHERE id = :id";
    $db = config::getConnexion(); 
    $query = $db->prepare($sql);
    $query->bindvalue(':id',$id);
    try{
        $query->execute();
    }
    catch (Exception $e) {
        echo 'Error: ' . $e->getMessage(); 
    }
}
}

