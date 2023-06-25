<?php

namespace App\Model\SemesterM;

class Semester 
{
    private string $semesterLabel;
    private array $courses;


    public function __construct($semesterLabel){
        $this->semesterLabel = $semesterLabel;
        $this->courses = [];
    }
    
    public function getLabel() : string
    {
        return $this->semesterLabel;
    }

    public function getCourses(): array{
        return $this->courses;
    }

    public function getCourseData(string $course){
        return $this->courses[$course] ?? null;
    }

    public function addCourseData($course, MCourseData $courseData) : void{
        $this->courses[$course] = $courseData;
    }

}