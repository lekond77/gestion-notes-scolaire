<?php

function change_password_content($email, $key)
{

                $link = '<a href="http://releve-notes?email=' . urlencode($email) . '&key=' . urldecode($key) . ' ">
                http://releve-notes?email=' . urlencode($email) . '&key=' . urlencode($key) . '</a>';

    return  '<p><b>Bonjour</b>, <br/> Nous avons reçu une demande de changement de mot de passe pour 
                cette adresse e-mail pour votre compte collège/lycée.</p>
                <p>Si vous êtes à l\'origine de cette demande, veuillez cliquer sur le bouton en dessous :</p>
                <a style="margin-left: 8em" href="http://releve-notes?email=' . urlencode($email) . '&key=' . urldecode($key) . ' ">
                <button style="
                background-color: red;
                border: none;
                padding: 6px;
                color: white;
                border-radius: 3px;
                font-size: 1em;
                cursor:pointer;
                ">Réinitialiser mot de passe</button> </a><br/>
                <p>Vous pouvez également copiez ce lien directement dans votrz navigateur :</p>
                <p>' . $link . '</p>
                <p>Si vous n\'êtes pas à l\'origine de cette demande, vous pouvez ignorer ce e-mail<br/></p>
                
                ----------------------------------------------------------------------------------------------
                
                 <p>Ce mail est automatique. Merci de ne pas y répondre !</p>';
}
