<?php
declare(strict_types=1);
namespace App\Model\Person;

class MStudent extends Personnal{

private string $classRoom;

   public function __construct(?string $register, ?string $email, ?string $fistName, ?string $lastName, ?string $birthday, ?string $profilImage, ?string $classRoom, ?string $password ){
      parent::__construct($register, $email, $fistName, $lastName, $birthday, $profilImage, $password);
      $this->classRoom = $classRoom;
  }

  public function getClassRoom(): string
  {
     return $this->classRoom;
  }

  public function setClassRoom(string $classRoom): void
  {
     $this->classRoom = $classRoom;
  }  

}