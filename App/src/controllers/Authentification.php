<?php

declare(strict_types=1);

namespace App\Controllers;

use Exception;
use App\Model\SemesterM\Note;
use App\Model\Person\MUserAuthenticator;
use App\Model\Exceptions\SendEmailException;
use App\Model\Exceptions\{BadAuthenException, FailedResetPassException, InputNotValidException, UserNotFoundException};

class Authentification
{
    private $authenticathor;

    public function __construct()
    {
        $this->authenticathor = new MUserAuthenticator(); //Utilisateur auquel on affectera les données de connexion ou de changement de mot de passe

    }


    //Afficher les notes si les données de connexion sont bonnes
    public function executeLogin(array $userInput)
    {

        if (!empty($userInput['email']) && !empty($userInput['password'])) { //Vérifie les entrees

            $userInput = [
                'email' => htmlspecialchars($userInput['email']),
                'password' => htmlspecialchars($userInput['password'])
            ];
        } else
            throw new BadAuthenException();


        $this->authenticathor = $this->authenticathor->login($userInput);  //Récupère les informations de l'utilisateur.

        if ($this->authenticathor == null) {
            throw new BadAuthenException();
        }
      
       

        $arrayClassPath = explode("\\", get_class($this->authenticathor));

        //Vérifie si l'objet renvoyé par le modèle est Mstudent et affiche les notes
        //Sinon, on afficher l'interfaces pour les profs 
        if (in_array('MStudent',  $arrayClassPath)) {
            $note = new  Note();
            $semester =  $note->displayNotes($this->authenticathor->getEmail()); // Affiche les notes  
            $_SESSION['user']['user'] = $this->authenticathor;
            $_SESSION['data'] = $semester;
            require('templates/student/student.php');
            exit();
        }

        if (in_array('MTeacher',  $arrayClassPath)) {

            $_SESSION['user']['user'] = $this->authenticathor;
            require('templates/teacher/teacher.php');
            exit();
        }
    }


    // Envoie de message lors de la réinitialisation du mot de passe

    public function sendMessage(string $email)
    {
        $input = null;
        $key = md5(strval(microtime(TRUE) * 100000)); //Clé qui sera envoyé 

        try {
            if (empty($email))
                throw new InputNotValidException();

            $isUserFound = $this->authenticathor->checkUser(htmlspecialchars($email));

        if ($isUserFound) {

                require('templates/email/email_content.php');
                $subject = "Demande de changement de mot de passe !";
                $message = change_password_content($email, $key);

                if ((new SendMail())->sendMail($email, $subject, $message, '')) {

                    $Message = sprintf("Un couriel contenant un lien est envoyé à l'adresse (%s). 
                 Si vous ne recevez pas de message, pensez à consulter votre spam.", $email);

                    $input = ['email' => $email, 'key' => $key];
                    $this->authenticathor->updateKey($input);
                } else {
                    throw new  SendEmailException(); 
                }
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
        }
        require 'templates/passreset/updatepass.php';
    }

    // Affiche le formulaire après que l'utilisateur ait cliqué sur le lien de réinitialisation

    public function displayFormForUpdate(array $userResquestChangePassInput)
    {

        try {
            if (empty($userResquestChangePassInput['email']) && empty($userResquestChangePassInput['key'])) {

                throw new FailedResetPassException();
            }
            $arrayInput = [
                'email' =>  htmlspecialchars($userResquestChangePassInput['email']),
                'key' => htmlspecialchars($userResquestChangePassInput['key'])
            ];

            if (!$this->authenticathor->checkKey($arrayInput)) {
                throw new FailedResetPassException();
            }
        } catch (FailedResetPassException $ex) {
            $errorMessage = $ex->getMessage();
            require 'templates/passreset/updatepass.php';
            exit();
        }

        require('templates/passreset/formUpdatePass.php');
    }


    //Mettre à jour le mot de passe et la cle
    public function update(array $userInput): void
    {

        try {
            if (!empty($userInput['email']) && !empty($userInput['password']) && !empty($userInput['passwordBis'])) {

                $email =  htmlspecialchars($userInput['email']);
                $pass =  htmlspecialchars($userInput['password']);
                $passBis =  htmlspecialchars($userInput['passwordBis']); 

                $userInput = ['email' => $email, 'password' => $pass];
                if ($pass !== $passBis)
                    throw new \Exception('Vos mots de passe ne sont pas identiques! Merci de réessayer !');
            } else {
                throw new FailedResetPassException();
            }

            $update = $this->authenticathor->updatePass($userInput);

            if(!$update){
                throw new FailedResetPassException();
            }
        } catch (Exception $ex) {
            $errorMessage = $ex->getMessage();
            require('templates/passreset/formUpdatePass.php');
            exit();
        }

            $this->executeLogin($userInput);
    }
}
