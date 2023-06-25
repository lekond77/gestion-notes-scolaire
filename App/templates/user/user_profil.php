<?php 
require_once('templates/upload.php');

$profil = 
'<div>
    <img src="' . (isset($messageUploadFileSucces) ? $filePath : (isset($_SESSION['user']) ? (!empty($_SESSION['user']['user']->getProfilImage()) 
    && file_exists($targetDirectory . $_SESSION['user']['user']->getProfilImage()) ? $_SESSION['user']['user']->getProfilImage() : 
    '/public/images/user.png') : '')) .'" alt="icon-user" width="80" height="80" class="icon-user" title="Appuyer pour modifier">
    <p>' . (isset($_SESSION['user']) ? 'BONJOUR ' . strtoupper($_SESSION['user']['user']->getLastName() . ' ' . $_SESSION['user']['user']->getFirstName()) : '') . '</p>
    <p>Matricule : ' . ($_SESSION['user']['user']->getRegister() ?? '') . '</p>
</div>';


$form = 

'<div id="img-profil" hidden="hidden">

    <form id="imageForm" enctype="multipart/form-data" method="post" action="index.php">
        <div class="form-div">
            <label for="userImage">Choisir une image</label>
            <i> (Taille-Max: 2Mo)</i>
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
            <input type="file" id="userImage" name="userImage" hidden accept="image/*">
            <input type="image" src="/public/images/user.png" alt="icon-user" width="20%" height="100em" class="icon-user" id="icon-user" title="Cliquer pour remplacer l\'image par défaut" name="default_profil">
        </div>

        <div>

            <p style="color:green">' .(isset($messageUploadFileSucces) ? $messageUploadFileSucces : '').
            '</p>
            <p style="color:rgb(224, 45, 45)">'.
                ( isset($messageUploadFileError) ? $messageUploadFileError : '').
            '</p>
        </div>
        <div class="form-div">
            <span>Fermer</span>
            <input type="submit" value="Modifier" id="submit">
        </div>
    </form>
</div>' ;
