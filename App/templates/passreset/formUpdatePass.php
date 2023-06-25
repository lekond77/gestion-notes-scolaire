<?php $title = "Relevé de notes"; ?>

<?php ob_start(); ?>

<?php require('templates/home/error.php'); ?>

<form action="index.php" method="POST">
    <fieldset id="fieldset">
        <legend id="legend">
            Changer mot de passe
        </legend>
        <div class="for-pass">
            <input type="email" id="email" name="email" placeholder="Entrer votre identifiant" required="true" value="<?= $userResquestChangePassInput['email'] ?? $email ?>">
        </div>
        <div class="for-pass">
            <input type="password" name="password" id="password" placeholder="Entrer votre mot de passe" require="true">
            <div class="password-icon">
                <i data-feather="eye"></i>
                <i data-feather="eye-off"></i>
            </div>
        </div>
        <div class="for-pass">
            <input type="password" name="passwordBis" id="passwordBis" placeholder="Confirmer votre mot de passe" require="true">
            <div class="password-icon">
                <i data-feather="eye"></i>
                <i data-feather="eye-off"></i>
            </div>
        </div>

        <input type="submit" value="Soumettre" id="change-pass">
    </fieldset>
</form>

<?php $content = ob_get_clean(); ?>
<?php require('templates/home/layout.php');
