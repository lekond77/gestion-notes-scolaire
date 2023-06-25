<?php
declare (strict_types = 1);
namespace App\Model\Exceptions;
use \Exception;


class FailedResetPassException extends Exception{
    
    public function __construct()
    {
        parent::__construct('Nous ne pouvons pas changer votre mot de passe!
        Veuillez réessayer !');
    }
   
}