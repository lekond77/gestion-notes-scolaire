<?php

declare(strict_types=1);

include_once('../vendor/autoload.php');
include_once('autoload.php');

use App\controllers\Authentification;
use App\model\Exceptions\BadAuthenException;

try {

    session_start();
    if (isset($_GET['reset'])) {
        require('templates/passreset/updatepass.php');
        exit();
    }

    $input = null;
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordBis'])) {

        $input = $_POST;
         //Changement de mot de passe
       (new Authentification())->update($input);
        exit();
    } elseif (isset($_POST['email']) && isset($_POST['password'])){
        //Connexion
        //Ajout des informations d'authentification   
        $input = $_POST;

        //Connecter l'utilisateur
        (new Authentification())->executeLogin($input);
        exit();
    } elseif(!empty($_SESSION['user'])) {

        $arrayClassPath = explode("\\", get_class( $_SESSION['user']['user']));
        (in_array('MStudent',  $arrayClassPath)) ?  require('templates/student/student.php') : require('templates/teacher/teacher.php');
        exit();

    } elseif (isset($_POST['email']) && !isset($_POST['password'])) {

        (new Authentification())->sendMessage($_POST['email']);
        exit();
        
    } elseif (isset($_GET['email']) && isset($_GET['key'])) {
        //Afficher le formulaire pour changer le password
        $input = $_GET;

        (new Authentification())->displayFormForUpdate($input);
        exit();
    } else {
        require('templates/home/home.php');
    }
} catch (Exception | BadAuthenException  $e) {

    $errorMessage = $e->getMessage();
    require 'templates/home/home.php';
}




