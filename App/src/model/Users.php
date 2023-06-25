<?php

declare(strict_types=1);

namespace App\Model;

use App\Lib\DatabaseConnection;
use App\Model\Person\Personnal;
use DateTime;

class Users extends Personnal
{
    private DatabaseConnection  $connection; //Variable de connection à la base de données
    private ?string $password;


    public function __construct(?string $register, ?string $email,  ?string $fistName,  ?string $lastName, ?DateTime $birthday, ?string $password)
    {
        parent::__construct($register, $email, $fistName, $lastName, $birthday);
        $this->password = $password;
        $this->connection = new DatabaseConnection();
        
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

   
    //Recupère les informations de l'étudiant depuis la base des donnees 
    public function login(Users $user): ?Users
    {

        $query = "SELECT * FROM  STUDENT WHERE(studentNum =:email) ;";

        $statement = $this->connection->getConnection()->prepare($query);
        
        $statement->execute([
            'email' => $user->getEmail()
        ]);

        $row =  $statement->fetch(\PDO::FETCH_ASSOC);

        if (!empty($row)){
            $dtObj = date_create($row['birthDay'], timezone_open("Europe/Paris"));
            $date = DATE_FORMAT($dtObj, 'd/m/Y');
            return (password_verify($user->getPassword(), $row['studentPass']) ? new Users("", $row['studentNum'], $row['firstName'], $row['lastName'], $dtObj, "") : null);
        }
        return null;
    }


    //Verifier si l'étudiant est dans la base avant de procéder à tout changement de mot de passe
    public function checkUser(Users $user) : bool
    {

        $key = md5(strval(microtime(TRUE) * 100000)); //Clé qui sera envoyé 

        $query = "SELECT * FROM STUDENT WHERE studentNum =:identifier ;";

        $statement = $this->connection->getConnection()->prepare($query);

        $statement->execute(['identifier' => $user->getEmail()]);

        $row =  $statement->fetch(\PDO::FETCH_ASSOC);

        if (!empty($row)) {
            date_default_timezone_set('Europe/Paris');
            $difference = (strtotime(date('Y-m-d H:i:s')) - strtotime($row['dateLastUpdate'])) / 3600;

            if ($difference <  3)
                throw new \Exception("Vous devez attendre au moins 3h de temps avant de changer un nouveau changement de votre mot de passe.");
        } else {
            throw new \Exception("Nous n'avons pas pu identifier votre email.");
        }

        return true;
    }

    //Mettre à jour la clé
    public function updateKey(Users $user): void {

        $query = "UPDATE STUDENT SET keyPass =:keyP WHERE studentNum =:identifier ;";
        $statement = $this->connection->getConnection()->prepare($query);
        $statement->execute(['identifier' => $user->getEmail(), 'keyP' => $user->getPassword()]);

    }
 
    //Verifier la clé lorsque clic sur le lien de réinitialisation
    public function checkKey(Users $user)
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT studentNum FROM STUDENT WHERE keyPass=:keySended AND studentNum=:email"
        );
        $statement->execute([
            'email' => $user->getEmail(),
            'keySended' => $user->getPassword() //Ici  en tant que key de réinitialisation
        ]);

        $row =  $statement->fetch(\PDO::FETCH_ASSOC);

        return (empty($row)) ? (throw new \Exception('Une erreur s\'est produite ! Nous ne pouvons pas changer votre mot de passe!
    Veuillez réessayer plus tard !')) : (($row['studentNum']));
    }


    //Mettre à jour le mot de passe et la clé à la valeur par défaut '0'
    public function updatePass(Users $user): bool
    {
        $query =  "UPDATE STUDENT SET keyPass = 0, studentPass=:newPass, dateLastUpdate = NOW()  WHERE studentNum=:email;";

        $statement = $this->connection->getConnection()->prepare($query);

        $passUpdate = $statement->execute([
            'newPass' => $user->getPassword(),
            'email' => $user->getEmail()
        ]);

        return ($passUpdate > 0);
    }
}
