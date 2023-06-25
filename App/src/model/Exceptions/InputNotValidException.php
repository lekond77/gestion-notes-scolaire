<?php
declare (strict_types = 1);
namespace App\Model\Exceptions;
use \Exception;


class InputNotValidException extends Exception{
    
    public function __construct()
    {
        parent::__construct('Les données sont invalides ! ');
    }
   
}