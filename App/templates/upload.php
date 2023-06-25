<?php

use App\Lib\DatabaseConnection;

//Chemin absolu vers le repertoire scindé en deux
$targetDirectory = 'chemin_absolu_';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_FILES['userImage']) && $_FILES['userImage']['error'] === UPLOAD_ERR_OK) {

    //Reste du chemin vers le repertoire où sera stocké le profil
    $targetDirectoryAdd = '/public/images/userIcon/';
    //Nom du fichier stocké(chemin absolu)
    $targetFile = $targetDirectory .  $targetDirectoryAdd . basename($_FILES['userImage']['name']);

    //Vérifie la taille du fichier < 2Mo
    if ($_FILES['userImage']['size'] <= 2000000) {

      $fileInfo = pathinfo($_FILES['userImage']['name']);
      $extension = '.' . $fileInfo['extension'];

      //Les extensions autorisées
      $allowExtensions = ['.jpeg', '.jpg', '.gif', '.png', '.webP', '.svg'];

      //Vérifie si l'extension du fichier soumis fait partie du tableau
      if (in_array($extension, $allowExtensions)) {

        //Renommé le fichier selon l'email de l'utilisateur
        $fileName =  md5($_SESSION['user']['user']->getEmail()) . $extension;

        //Si le fichier est bien déplacé, on le renomme par $fileName
        if (move_uploaded_file($_FILES['userImage']['tmp_name'], $targetFile)) {
          rename($targetFile, $targetDirectory . $targetDirectoryAdd . $fileName);

          try {
            $filePath =  $targetDirectoryAdd . $fileName;

            //Enregistre le chemin du fichier dans la base de données 
            $statement = (new DatabaseConnection())->getConnection()->prepare('UPDATE student SET profilImage =:imageUser WHERE studentNum =:email;');

            $row = $statement->execute(['imageUser' => $filePath, 'email' => $_SESSION['user']['user']->getEmail()]);
          } catch (Exception $e) {
          }
          $messageUploadFileSucces = 'L\'image a été téléchargée avec succès.';
        } else {
          $messageUploadFileError = 'Une erreur s\'est produite lors du téléchargement de l\'image.';
        }
      } else {
        $messageUploadFileError = sprintf('L\'extension \'%s\' non valide. Accepté :\'.%s\'', $extension, implode(', ', $allowExtensions));
      }
    } else {
      $messageUploadFileError = "Vérifier la taille de votre fichier !";
    }
  } else {

    //Mise à jour du profil vers l'image par défaut
    if (isset($_POST['default_profil_x']) && isset($_POST['default_profil_y'])) {

      try {

        $statement = (new DatabaseConnection())->getConnection()->prepare('UPDATE student SET profilImage = "" WHERE studentNum =:email;');

        $row = $statement->execute(['email' => $_SESSION['user']['user']->getEmail()]);

        $messageUploadFileSucces = "Profil par defaut changé !";
        $filePath = "/public/images/user.png";
      } catch (Exception $e) {
      }
    }
  }
}
