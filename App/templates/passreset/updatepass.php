<?php $title = "Relevé de notes"; ?>

<?php ob_start(); ?>

<?php require('templates/home/error.php'); ?>

<form action="index.php" method="POST">
    <fieldset id="fieldset">
        <legend id="legend">
            Changer mot de passe
        </legend>

        <?php if (isset($Message)) : ?>
            <p style="font-size: 1.3em;"><?= $Message ?></p>
        <?php else : ?>
            <div class="for-pass">
                <input type="email" id="email" name="email" placeholder="Entrer votre identifiant" required="true">
            </div>
            <input type="submit" value="Envoyer">
        <?php endif; ?>
    </fieldset>
</form>

<?php $content = ob_get_clean(); ?>
<?php require('templates/home/layout.php'); ?>

</body>

</html>