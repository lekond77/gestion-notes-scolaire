<?php $title = "Relevé de notes";
$path = "";
$footer = "";
$img = '<img src="/public/images/mauvais-mot-de-passe.png" alt="Mot de passe incorrect" width="20%" height="45em">';
?>
<?php ob_start(); ?>
<?php require 'error.php' ?>
<form action="index.php" method="POST">
    <fieldset id="fieldset">
        <legend id="legend">
            Authentification
        </legend>
        <div class="for-pass">
            <input type="email" id="email" name="email" placeholder="Entrer votre identifiant" required="true" value="<?= isset($_POST['email']) ?  $_POST['email'] :  '' ?>">
        </div>
        <div class="for-pass">
            <input type="password" name="password" id="password" placeholder="Entrer votre mot de passe" require="true" value="<?= isset($_POST['password']) ?  $_POST['password'] :  '' ?>">
            <div class="password-icon">
                <i data-feather="eye"></i>
                <i data-feather="eye-off"></i>
            </div>
        </div>

        <p><a href="index.php?reset=clic">Mot de passe oublié ?</a></p>

        <p><label for="rememberMe"><input type="checkbox" name="rememberMe" id="rememberMe" checked="checked"> Se souvenir de moi</label></p>

        <input type="submit" value="Se connecter">

    </fieldset>
</form>

</div>

<?php $content = ob_get_clean(); ?>
<?php require('layout.php'); ?>
</body>

</html>