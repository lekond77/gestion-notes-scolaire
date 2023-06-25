<?php
declare(strict_types = 1);

namespace App\Model\Person;

class MTeacher extends Personnal
{
    private string $grade;

    public function __construct(?string $register, ?string $email, ?string $fistName, ?string $lastName, ?string $birthday, ?string $profilImage, ?string $grade, ?string $password ){
        parent::__construct($register, $email, $fistName, $lastName, $birthday, $profilImage, $password);
        $this->grade = $grade;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(?string $grade){
        $this->grade = $grade;
    }
}