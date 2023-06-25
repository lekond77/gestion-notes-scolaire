<?php
declare (strict_types = 1);
namespace App\Model\Exceptions;
use \Exception;


class BadAuthenException extends Exception{
    
    public function __construct()
    {
        parent::__construct('L\'identifiant et/ou mot de passe incorrect ! ');
    }
   
}