<?php
declare (strict_types = 1);
namespace App\Model\Exceptions;
use \Exception;


class UserNotFoundException extends Exception{
    
    public function __construct()
    {
        parent::__construct('Nous n\'avons pas pu identifier votre email.');
    }
   
}