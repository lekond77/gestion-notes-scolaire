<?php $title = "Prof";
$nav = "nav.php";
$footer = "footer.php";
$btnDisplaySemesters = "";

?>

<?php ob_start(); ?>

<div id="user-info">
    <?php require_once('templates/user/user_profil.php'); ?>

    <?= $profil; ?>
    <div>
        <p>Grade : <?= isset($_SESSION['user']) ? $_SESSION['user']['user']->getGrade() : ''  ?></p>

    </div>
</div>
<?= $form; ?>
<?php $content = ob_get_clean(); ?>

<?php require("templates/home/layout.php"); ?>

</body>

</html>