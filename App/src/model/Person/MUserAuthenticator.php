<?php

declare(strict_types=1);

namespace App\Model\Person;

use App\Lib\DatabaseConnection;
use App\Model\Exceptions\UserNotFoundException;

class MUserAuthenticator
{
    private DatabaseConnection  $connection; //Variable de connection à la base de données

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }


    public function login(array $userInput): ?Object
    {
        $query = "SELECT * FROM  user WHERE(email =:identifier) ;";

        $statement = null;
        $conn = $this->connection->getConnection();
        $statement = $this->statement($query);

        if (null !==  $statement) {
            $statement->execute([
                'identifier' => $userInput['email']
            ]);
            $row =  $statement->fetch(\PDO::FETCH_ASSOC);

            if (!empty($row)) {
                $dtObj = date_create($row['birthDay'], timezone_open("Europe/Paris"));
                $date = DATE_FORMAT($dtObj, 'd/m/Y');
                
                $register = $row['register'];
                //Si les données selectionnées dans la table des users correpondent à un élève ou à un prof
                if (false == $row['isTeacher']) {
                
                    //Jointure avec la table student si élève
                    $statement  = $conn->query("SELECT * FROM user, student WHERE student.studentRegister = user.register AND user.register =  '$register' ");

                    $row =  $statement->fetch(\PDO::FETCH_ASSOC);

                    return (password_verify($userInput['password'], $row['password']) ? new MStudent($row['register'], $row['email'], $row['firstName'], $row['lastName'], $date, $row['profilImage'], $row['classRoom'], '') : null);
                } else {
                    //Jointure avec la table teacher si prof
                    $statement  = $conn->query("SELECT * FROM user, teacher WHERE teacher.teacherRegister = user.register AND user.register =  '$register' ");

                    $row =  $statement->fetch(\PDO::FETCH_ASSOC);

                    return (password_verify($userInput['password'], $row['password']) ? new MTeacher($row['register'], $row['email'], $row['firstName'], $row['lastName'], $date, $row['profilImage'], $row['grade'], '') : null);
                }
            }
        }
        return null;
    }


    //Verifier si l'étudiant est dans la base avant de procéder à tout changement de mot de passe
    public function checkUser(string $userEmail): bool
    {

        $query = "SELECT * FROM user WHERE email =:identifier ;";

        $statement = $this->statement($query);

        $statement->execute(['identifier' => $userEmail]);

        $row =  $statement->fetch(\PDO::FETCH_ASSOC);

        if (!empty($row)) {
            date_default_timezone_set('Europe/Paris');
            $difference = (strtotime(date('Y-m-d H:i:s')) - strtotime($row['dateLastUpdate'])) / 3600;

            if ($difference <  3)
                throw new \Exception("Vous devez attendre au moins 3h de temps avant de changer un nouveau changement de votre mot de passe.");
        } else {
            throw new UserNotFoundException();
        }

        return true;
    }

    //Mettre à jour la clé
    public function updateKey(array $userInput): void
    {
        $query = "UPDATE user SET keyPass =:keyP WHERE email =:identifier ;";
        $statement = $this->statement($query);
        $statement->execute(['identifier' => $userInput['email'], 'keyP' => $userInput['key']]);
    }

    //Verifier la clé lorsque clic sur le lien de réinitialisation
    public function checkKey(array $userInput): bool
    {
        $query =  "SELECT * FROM user WHERE keyPass=:keySended AND email=:identifier";

        $statement = $this->statement($query);
        $statement->execute([
            'identifier' => $userInput['email'],
            'keySended' => $userInput['key'] 
        ]);

        $row =  $statement->fetch(\PDO::FETCH_ASSOC);

        return !empty($row);
    }


    //Mettre à jour le mot de passe et la clé à la valeur par défaut '0'
    public function updatePass(array $userInput): bool
    {
        $query =  "UPDATE user SET keyPass = 0, password=:newPass, dateLastUpdate = NOW()  WHERE email=:identifier;";

        $statement = $this->statement($query);
        $statement->execute([
            'newPass' => password_hash($userInput['password'], PASSWORD_DEFAULT),
            'identifier' => $userInput['email']
        ]);

        return ($statement->rowCount() > 0);
    }

    private function statement($query): \PDOStatement
    {
        return $this->connection->getConnection()->prepare($query);
    }
}


