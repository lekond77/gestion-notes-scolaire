<?php $title = "Notes-examen";
$nav = "nav.php";
$footer = "footer.php";
?>
<?php $btnDisplaySemesters = "<button class=\"w3-bar-item w3-button w3-mobile btnSemester\" onclick=\"openSemester(event, 'Semester1')\" id=\"defaultOpen\">Semestre 1</button>
    <button class=\"w3-bar-item w3-button w3-mobile btnSemester\" onclick=\"openSemester(event, 'Semester2')\">Semestre 2</button>"; ?>

<?php ob_start(); ?>

<div id="semester-display">
    <div id="user-info">
        <?php require('templates/user/user_profil.php'); ?>

        <?= $profil; ?>

        <div>
            <p>Classe : <?= isset($_SESSION['user']) ? $_SESSION['user']['user']->getClassRoom() : ''  ?></p>
            <p>Moyenne: </p>
            <p>Rang : </p>
        </div>
    </div>

    <?= $form; ?>

    <div class="content-notes" id="Semester1">
        <h2 class="semester-i"><var>1<sup>er</sup></var> Semestre</h2>
        <?php
        //var_dump($_SESSION);
        $courses = (array_key_exists('semestre1', $_SESSION['data'])) ? $_SESSION['data']['semestre1']->getCourses() : null;
        displayNoteForSemestre($courses);
        ?>
    </div>

    <div class="content-notes" id="Semester2">
        <h2 class="semester-i"><var>2<sup>ème</sup></var> Semestre</h2>

        <?php
        $courses = (array_key_exists('semestre2', $_SESSION['data'])) ? $_SESSION['data']['semestre2']->getCourses() : null;
        displayNoteForSemestre($courses);
        ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require("templates/home/layout.php"); ?>

<script>
    function openSemester(evt, semester) {
        let i, semesterContent, btnSemester;
        semesterContent = document.getElementsByClassName("content-notes");
        for (i = 0; i < semesterContent.length; i++) {
            semesterContent[i].style.display = "none";
        }
        btnSemester = document.getElementsByClassName("btnSemester");
        for (i = 0; i < btnSemester.length; i++) {
            btnSemester[i].className = btnSemester[i].className.replace(" active", "");
        }
        document.getElementById(semester).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>


<?php

function displayNoteForSemestre($courses)
{

    if (null  !==  $courses) {
        foreach ($courses as $course) { ?>
            <div class="course" style="background-color: <?= $course->getCourseColor() ?>;">
                <div>
                    <p class="course-i"><?= $course->getLessonLabel(); ?></p>
                    <p class="coeff"><?= 'Coefficient : ' .  $course->getCredit(); ?></p>
                </div>
                <div>
                    <p><?= 'Moyenne : '  ?></p>
                    <p><?= 'Rang : '  ?></p>
                </div>
            </div>

            <div class="notes">
                <?php
                $evaluations = $course->getEvaluations();
                foreach ($evaluations as $evaluation) { ?>
                    <p class="note"><?= $evaluation->getTypeEv() . ' : ' . $evaluation->getScore(); ?></p>

                <?php }; ?>
            </div>
        <?php };
    } else { ?>
        <h2>Aucune notes disponible</h2>
<?php }
}
?>

</body>
</html>