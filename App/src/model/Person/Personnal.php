<?php
declare(strict_types=1);
namespace App\Model\Person;

abstract class Personnal {
   private ?string $register;
   private ?string $email;
   private ?string $firstName;
   private ?string $lastName;
   private ?string $birthday;
   private ?string $profilImage;
   private ?string $password;

   public function __construct(?string $register, ?string $email, ?string $firstName, ?string $lastName , ?string $birthday, ?string $profilImage, ?string $password){
      $this->register = $register;
      $this->email = $email;
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->birthday = $birthday;
      $this->profilImage = $profilImage;
      $this->password = $password;
   }

      
   //Setter getter email

   public function getRegister(): ?string
   {
      return $this->register;
   }

   
   public function setRegister(string $register): void
   {
      $this->register = $register;
   }


   //Setter getter email

   public function getEmail(): ?string
   {
      return $this->email;
   }

   
   public function setEmail(string $email): void
   {
      $this->email = $email;
   }

   //Setter getter firstName
   public function getFirstName(): ?string
   {
      return $this->firstName;
   }

   
   public function setFirstName(string $firstName): void
   {
      $this->firstName = $firstName;
   }

   //Setter getter lastName
   public function getLastName(): ?string
   {
      return $this->lastName;
   }

   
   public function setLastName(string $lastName): void
   {
      $this->lastName = $lastName;
   }

   //Setter getter birthday
   public function getBirthday(): ?string
   {
      return $this->birthday;
   }

   
   public function setBirthday(string $birthday): void
   {
      $this->birthday = $birthday;
   }


     //Setter getter prrofil image

     public function getProfilImage(): ?string
     {
        return $this->profilImage;
     }
  
     
     public function setProfilImage(string $profilImage): void
     {
        $this->profilImage = $profilImage;
     }

     
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

}