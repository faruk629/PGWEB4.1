<?php
DECLARE(strict_types=1);
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
	<main>
    <h1>Formulaire d'inscription</h1>
			<form name="monForm" id="monForm" method="post" action="Confirmation.php">
                <div id="formMain">
                <div class="formMain">
                <?php require_once("FormElev.php"); ?>
                </div>

                <div class="formMain">
                    <?php require_once("FormTuteur.php"); ?>
                    <fieldset id="fieldseTuteur1">
                        <legend>Inscription tuteur 1</legend>
                    <?php
                    setFormRespNameAndID("statutTuteur1","nomTuteur1","prenomTuteur1","sexeTuteur1",
                    "nRegistreTuteur1","emailTuteur1","mobileTuteur1","telephoneTuteur1");
                    ?>

                    </fieldset>
                </div>
                <div class="formMain" >
                    <fieldset id="fieldseTuteur2" style="visibility:hidden" disabled="false" >
                        <legend>Inscription tuteur 2</legend>
                    <?php
                    setFormRespNameAndID("statutTuteur2","nomTuteur2","prenomTuteur2","sexeTuteur2",
                    "nRegistreTuteur2","emailTuteur2","mobileTuteur2","telephoneTuteur2");
                ?>
                    </fieldset>
                </div>
                </div>
                <input type="hidden" id="hiddenClear"name="hiddenClear" value="hidden">
                <input type="submit" name="valider"id="valider" value="valider">
            </form>
    </main>
	</body>
</html>
<script>
    function show2(value) {
        if (value=="one"){
            document.getElementById("fieldseTuteur1").disabled=false;
            document.getElementById("fieldseTuteur2").disabled=true;
            document.getElementById("fieldseTuteur2").style.visibility = "hidden";
        }else {
            document.getElementById('hiddenClear').setAttribute("value","clear");
            document.getElementById("fieldseTuteur1").style.visibility = "visible";
            document.getElementById("fieldseTuteur2").style.visibility = "visible";
            document.getElementById("fieldseTuteur2").disabled=false;
        }
    }

    function addFile() {

    }
</script>
