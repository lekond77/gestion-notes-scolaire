<?php if (isset($errorMessage)) { ?>
    <div id="div-error">
        <?= $img ?? '' ;?>
        <p id="error">
            Une erreur est survenue : <?= $errorMessage ?>
        </p>
    </div>
    <?php }