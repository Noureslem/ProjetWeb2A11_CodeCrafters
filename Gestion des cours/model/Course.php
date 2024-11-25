<?php
class Course {
    private $id;
    private $title;
    private $description;
    private $price;
    private $teacher_id; 
    private $study_duration;
    private $level;

    // construct initialisation
    public function __construct(int $id = null, $title = null, $description = null, $price = null, $teacher_id = null, $study_duration = null, $level = null) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->teacher_id = $teacher_id;
        $this->study_duration = $study_duration;
        $this->level = $level;
    }

    
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getTeacherId() {
        return $this->teacher_id;
    }

    public function getStudyDuration() {
        return $this->study_duration;
    }

    public function getLevel() {
        return $this->level;
    }    
}
?>
