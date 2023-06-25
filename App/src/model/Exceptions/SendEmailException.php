<?php
declare (strict_types = 1);
namespace App\Model\Exceptions;
use \Exception;


class SendEmailException extends Exception{
    
    public function __construct()
    {
        parent::__construct('Oup! Une erreur inattendue s\'est produite.
        Veuillez-réessayer plus tard !');
    }
   
}